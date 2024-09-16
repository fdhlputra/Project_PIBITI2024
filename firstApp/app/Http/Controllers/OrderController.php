<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /* public function index()
    {
        $orders = Order::with('user')->get();
        return view('order.index', ['orders' => $orders]);
    } */
    public function index(Request $request)
    {
        $query = Order::query()->with('user');

        if ($request->has('search')) {
            $search = $request->search;

            $query->where('customer', 'like', "%{$search}%");
            $query->orWhere('payment', 'like', "%{$search}%");
            $query->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
        }

        $orders = $query->get();

        return view('order.index', ['orders' => $orders]);
    }


    public function show(Order $order)
    {
        $order->load('details.product');
        return view('order.show', ['order' => $order]);
    }

    public function create(Request $request)
    {
        if (!session('order')) {
            $order = new Order();
            $order->customer = '-';
            $order->user_id = auth()->user()->id;
            session(['order' => $order]);
        }

        $categories = Category::query()->where('active', 1)->get();
        $productsQuery = Product::query()->where('active', 1);

        if ($request->category_id) {
            $productsQuery->where('category_id', $request->category_id);
        }

        if ($request->search) {
            $productsQuery->where('name', 'like', "%{$request->search}%");
        }

        $products = $productsQuery->get();

        return view('order.create', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function createDetail(Product $product)
    {
        $order = session('order');
        $detail = $order->details->where('product_id', $product->id)->first();

        return view('order.create-detail', [
            'product' => $product,
            'detail' => $detail,
        ]);
    }

    public function storeDetail(Request $request, Product $product)
    {
        $order = session('order');
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
            'price' => 'required|numeric'
        ]);

        if ($request->submit == 'destroy') {
            $order->details = $order->details->reject(function ($detail) use ($product) {
                return $detail->product_id == $product->id;
            });
            session(['order' => $order]);
            return redirect()->route('orders.create');
        }

        $detail = $order->details->where('product_id', $product->id)->first();

        if (!$detail) {
            $detail = new OrderDetail();
            $detail->product_id = $product->id;
        }

        $detail->quantity = $request->quantity;
        $detail->price = $request->price;

        $order->details = $order->details->filter(function ($existingDetail) use ($detail) {
            return $existingDetail->product_id != $detail->product_id;
        })->push($detail);

        session(['order' => $order]);
        return redirect()->route('orders.create');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'payment' => 'required|numeric',
        ]);

        $orderData = session('order');
        if (!$orderData) {
            return redirect()->route('orders.create')->withErrors(['error' => 'Tidak ada pesanan di sesi']);
        }

        $total = collect($orderData->details)->sum(function ($detail) {
            return $detail->quantity * $detail->price;
        });

        if ($request->payment < $total) {
            return back()->withInput()->withErrors(['payment' => 'Pembayaran tidak mencukupi']);
        }


        foreach ($orderData->details as $detail) {
            $product = Product::find($detail->product_id);
            if ($product->stock < $detail->quantity) {
                return back()->withInput()->withErrors(['stock' => 'Stok produk tidak mencukupi untuk ' . $product->name]);
            }
            $product->stock -= $detail->quantity;
            $product->save();
        }

        $order = Order::create([
            'customer' => $request->customer,
            'user_id' => auth()->id(),
            'payment' => $request->payment,
            'total' => $total,
        ]);

        foreach ($orderData->details as $detail) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $detail->product_id,
                'quantity' => $detail->quantity,
                'price' => $detail->price,
            ]);
        }

        $request->session()->forget('order');

        return redirect()->route('orders.show', ['order' => $order->id])->with('success', 'Your order has been placed!');
    }
}
