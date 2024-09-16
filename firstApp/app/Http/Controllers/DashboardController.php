<?php

/* namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $bestSellers = OrderDetail::select('product_id')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->limit(3)
            ->get();

        $productIds = $bestSellers->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get();

        $bestSellersWithDetails = $bestSellers->map(function($item) use ($products) {
            $product = $products->firstWhere('id', $item->product_id);
            return (object) [
                'product' => $product,
                'total' => $item->total_quantity,
            ];
        });

        return view('dashboard', ['bestSellers' => $bestSellersWithDetails]);
    }
} */

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Mengambil 3 produk terlaris berdasarkan total quantity
        $bestSellers = OrderDetail::select('product_id')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->limit(3)
            ->get();

        $productIds = $bestSellers->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get();

        // Gabungkan data produk dengan total quantity
        $bestSellersWithDetails = $bestSellers->map(function($item) use ($products) {
            $product = $products->firstWhere('id', $item->product_id);
            return (object) [
                'product' => $product,
                'total' => $item->total_quantity,
            ];
        });

        $totalSales = OrderDetail::all()->reduce(function ($carry, $item) {
            return $carry + ($item->quantity * $item->price);
        }, 0);

        /* total user */
        $totalCustomers = User::where('authority', 'user')->count();

        $monthlySales = OrderDetail::all()
        ->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('Y M');
        })->map(function ($orders) {
            return $orders->reduce(function ($carry, $item) {
                return $carry + ($item->quantity * $item->price);
            }, 0);
        });

        $dummyData = collect([
            '2023 Jul' => 17000000,
            '2023 Aug' => 11000000,
            '2023 Sep' => 20000000,
            '2023 Oct' => 16000000,
            '2023 Nov' => 21000000,
            '2023 Des' => 23000000,
            '2024 Jan' => 10000000,
            '2024 Feb' => 16000000,
            '2024 Mar' => 12000000,
            '2024 Apr' => 18000000,
            '2024 Mei' => 16000000,
            '2024 Jun' => 14000000,
        ]);

        $combinedMonthlySales = $dummyData->merge($monthlySales);


        return view('dashboard', [
            'bestSellers' => $bestSellersWithDetails,
            'totalSales' => $totalSales,
            'totalCustomers' => $totalCustomers,
            /* 'monthlySales' => $monthlySales, */
            'monthlySales' => $combinedMonthlySales,
        ]);
    }
}
