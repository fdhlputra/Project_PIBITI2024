<x-layout subPage='Orders' title="Add New Order Detail"
    subtitle="Provide details for the new order, including product selection, quantity, and price." action="Create Order"
    subAction="Add Item">
    <style>
        .order-content {
            height: 100%;
            overflow-x: hidden;
        }

        .order-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: white;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-lg-4">
                <div class="order-content stroke p-3 bg-light">
                    <div class="fw-medium fs-4 mb-3">
                        <a href="{{ route('orders.create') }}" class="text-decoration-none text-black">
                            <i class="bi-arrow-left"></i>
                        </a>
                        Product
                    </div>

                    <div>
                        <form method="post" action="{{ route('orders.store.detail', ['product' => $product->id]) }}">
                            @csrf

                            <x-text-input name="name" label="Name" value="{{ $product->name }}"
                                :disabled="true"></x-text-input>
                            <x-text-input name="quantity" label="Quantity" type="number"
                                value="{{ old('quantity', $detail ? $detail->quantity : '1') }}"></x-text-input>
                            {{-- @if ($errors->has('quantity'))
                                <div class="alert alert-danger">{{ $errors->first('quantity') }}</div>
                            @endif --}}

                            <x-text-input name="price" label="Price" type="number"
                                value="{{ old('price', $detail ? $detail->price : $product->price) }}"></x-text-input>

                            <div class="d-flex flex-row-reverse justify-content-between">
                                <button type="submit" class="btn btn-dark">Add Item</button>
                                @if ($detail)
                                    <button type="submit" name="submit" value="destroy"
                                        class="btn btn-danger">Delete</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
