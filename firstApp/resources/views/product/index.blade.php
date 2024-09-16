<x-layout subPage="Product" title="Product Listing" subtitle="Add, edit, and manage your product listings.">
    <style>
        .form-control {
            width: 300px;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border-radius: 20px;
        }

        #searchInput:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .card {
            border-radius: 15px;
            background-color: #f8f9fa;
        }

        .product-card:hover .sold-overlay .sold-text {
            display: none;
        }

        .product-card:hover .overlay .overlay-text {
            display: block;
        }

        .product-card .overlay .overlay-text {
            display: none;
        }

        /* add edit content */
        .product-content {
            height: 100%;
            overflow-x: hidden;
        }

        .product-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 20%;
            padding: 10px;
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
        }

        .product-body .row .col-12,
        .product-body .row .col-md-4,
        .product-body .row .col-lg-4 {
            margin-bottom: 0 !important;
            padding: 0;
        }
    </style>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-notification" role="alert" id="success-alert">
                {{ session('success') }}
            </div>
        @elseif (session('warning'))
            <div class="alert alert-warning alert-notification" role="alert" id="warning-alert">
                {{ session('warning') }}
            </div>
        @elseif (session('danger'))
            <div class="alert alert-danger alert-notification" role="alert" id="danger-alert">
                {{ session('danger') }}
            </div>
        @endif
    </div>
    <div class="product-content">
        <div class="product-body bg-light stroke">
            <div class="w-100">
                <div class="w-100 justify-content-between align-items-center ps-3 pt-2">
                    <div class="d-flex mb-2 justify-content-between">
                        @if (request()->get('search') && $products->isEmpty())
                            <h4>No results found for "{{ request()->get('search') }}"</h4>
                        @else
                            <h4>
                                {{ request()->get('search') ? 'Search for "' . request()->get('search') . '"' : 'All Products' }},
                                <span class="opacity-75">{{ $products->count() }}</span>
                            </h4>
                        @endif
                        <div class="d-flex gap-2">
                            <form class="d-flex gap-2" method="get">
                                <input type="text" class="form-control w-auto" placeholder="Search products"
                                    name="search" value="{{ request()->search }}">
                            </form>
                            @if (Auth::user()->authority != 'user')
                                <a href="{{ route('products.create') }}"
                                    class="btn btn-dark rounded-pill d-flex justify-content-center align-items-center px-3 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" class="me-1">
                                        <path fill="currentColor"
                                            d="M11 13H6q-.425 0-.712-.288T5 12t.288-.712T6 11h5V6q0-.425.288-.712T12 5t.713.288T13 6v5h5q.425 0 .713.288T19 12t-.288.713T18 13h-5v5q0 .425-.288.713T12 19t-.712-.288T11 18z" />
                                    </svg>
                                    <span>Add Products</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- card --}}

    <div class="product-content">
        <div class="row row-cols-1 row-cols-lg-4 mt-2">
            @forelse ($products as $product)
                <div class="col-md-4 col-lg-4 mb-4">
                    <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="text-decoration-none">
                        <div class="card product-card {{ !$product->active ? 'inactive-card' : '' }}">
                            <img src="{{ Storage::url($product->image) }}"
                                class="card-img-top img-thumbnail bg-light rounded-lg" alt="{{ $product->name }}"
                                style="width: 100%; height:320px; object-fit:cover; border-radius:10px">
                            @if ($product->stock <= 0)
                                <div class="sold-overlay">
                                    <div class="sold-text">Out of Stock</div>
                                </div>
                            @endif
                            <div class="overlay">
                                <div class="overlay-text">View Product</div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fs-3">{{ $product->name }}</h5>
                                <p class="card-text fw-medium">Rp.{{ $product->price }}</p>
                                <p>
                                    @if ($product->active)
                                        <span class="badge rounded-pill text-bg-primary">Ready</span>
                                        <span
                                            class="badge rounded-pill text-bg-success">{{ $product->category->name }}</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-danger">Sold Out</span>
                                        <span
                                            class="badge rounded-pill text-bg-success">{{ $product->category->name }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="product-content w-100">
                    <div class="product-body stroke bg-light" style="height: 400px">
                        <div class="w-100 d-flex justify-content-center py-5">
                            <div class="d-flex flex-column">
                                <div class="w-100 d-flex justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120"
                                        viewBox="0 0 21 21" class="mt-3">
                                        <g fill="none" fill-rule="evenodd" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="m3.5 7.5l7-4l5.992 3.424A2 2 0 0 1 17.5 8.661v4.678a2 2 0 0 1-1.008 1.737l-5 2.857a2 2 0 0 1-1.984 0l-5-2.857A2 2 0 0 1 3.5 13.339v-2.802" />
                                            <path d="M9.552 10.99a2 2 0 0 0 1.896 0L17 8m-6.5 3.5V18" />
                                            <path d="m3.5 7.5l7 4l-3 1l-7-4zm7-4l7 4l2-2l-7-4z" />
                                        </g>
                                    </svg>
                                </div>
                                <span class="mt-4 fs-5">Product is empty</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successAlert = document.getElementById('success-alert');
            var warningAlert = document.getElementById('warning-alert');
            var dangerAlert = document.getElementById('danger-alert');

            if (successAlert) {
                setTimeout(function() {
                    successAlert.classList.add('show');
                }, 10);

                setTimeout(function() {
                    successAlert.classList.remove('show');
                }, 3000);

                setTimeout(function() {
                    successAlert.remove();
                }, 3500);
            }

            if (warningAlert) {
                setTimeout(function() {
                    warningAlert.classList.add('show');
                }, 10);

                setTimeout(function() {
                    warningAlert.classList.remove('show');
                }, 3000);

                setTimeout(function() {
                    warningAlert.remove();
                }, 3500);
            }

            if (dangerAlert) {
                setTimeout(function() {
                    dangerAlert.classList.add('show');
                }, 10);

                setTimeout(function() {
                    dangerAlert.classList.remove('show');
                }, 3000);

                setTimeout(function() {
                    dangerAlert.remove();
                }, 3500);
            }
        });
    </script>
</x-layout>
