<x-layout subPage='Orders' title="Create a New Order" subtitle="Fill in the details to create a new order"
    action="Create Order">
    <style>
        .summary-card {
            height: 600px;
            overflow-y: auto;
        }

        .order-stroke {
            border-radius: 15px;
        }

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

        .form-control {
            width: 100%;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border-radius: 15px;
        }

        .form-control:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .disabled-link {
            pointer-events: none;
        }
    </style>
    <div class="order-content stroke">
        <div class="d-flex">
            <div class="col">
                <div class="d-grid gap-2">
                    <form class="hstack gap-1" method="get">
                        <select name="category_id" id="category_id" class="form-control w-auto"
                            onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request()->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="input-group">
                            <input type="text" placeholder="Search product..." class="form-control" name="search"
                                value="{{ request()->search }}" autofocus>
                        </div>
                    </form>

                    <div class="row g-2">
                        @forelse ($products as $product)
                            <div class="col-4">
                                <a href="{{ $product->stock > 0 ? route('orders.create.detail', ['product' => $product->id]) : '#' }}"
                                    class="text-decoration-none {{ $product->stock <= 0 ? 'disabled-link' : '' }}">
                                    <div class="card product-card">
                                        @if ($product->stock <= 0)
                                            <div class="sold-overlay">
                                                <div class="sold-text">Out of Stock</div>
                                            </div>
                                        @endif
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                            class="card-img-top mb-2"
                                            style="width: 100%; height: 200px; object-fit: cover;">
                                        <div class="">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <div class="d-flex flex-column gap-2">
                                                <small class="text-muted">{{ $product->category->name }}</small>
                                                <small class="text-end fw-medium">
                                                    Rp{{ number_format($product->price) }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col text-center">
                                <p class="mb-0">Product list is empty</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- summary --}}
            <div class="col-md-4">
                <form id="checkout-form" class="order-content order-stroke p-3 bg-light ms-3" method="post"
                    action="{{ route('orders.checkout') }}">
                    @csrf
                    <div class="fw-medium fs-4">Summary</div>
                    <hr>
                    <div class="">
                        <x-text-input name="customer" label="Customer"
                            value="{{ session('order')->customer }}"></x-text-input>
                        <hr>
                    </div>
                    <div class="bg-body-tertiary ">
                        <div class="mb-2">List Product</div>
                        <div class="vstack gap-2">
                            @php
                                $total = 0;
                            @endphp
                            @forelse (session('order')->details as $detail)
                                @php
                                    $total += $detail->quantity * $detail->price;
                                @endphp
                                <a href="{{ route('orders.create.detail', ['product' => $detail->product_id]) }}"
                                    class="text-decoration-none">
                                    <div class="card product-card">
                                        <div class="">
                                            <div>{{ $detail->product->name }}</div>
                                            <div class="d-flex justify-content-between">
                                                <div class="form-text">{{ $detail->quantity }} x
                                                    {{ number_format($detail->price) }}</div>
                                                <div class="ms-auto form-text">
                                                    Rp{{ number_format($detail->quantity * $detail->price) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center text-secondary py-2 border rounded">Product list is empty</div>
                            @endforelse
                        </div>
                        <hr>
                        <div class="card-body d-grid gap-2">
                            <div class="d-flex justify-content-between">
                                <div>Total</div>
                                <h4 class="ms-auto mb-0 fw-bold">Rp{{ number_format($total) }}</h4>
                            </div>
                            <div class="mt-5">
                                <x-text-input name="payment" label="Payment" type="number"
                                    placeholder="Rp."></x-text-input>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex gap-3 w-100 flex-column">
                            @if (session('order')->details->isNotEmpty())
                                <button class="btn btn-dark">Checkout</button>
                            @else
                                <button class="btn btn-dark" disabled>Checkout</button>
                            @endif
                            <a href="{{ route('orders.index') }}" class="btn border btn-border-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>
