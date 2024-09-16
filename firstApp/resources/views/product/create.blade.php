<x-layout subPage="Product" action="Add Product" title="Create Product"
    subtitle="Provide the necessary information to add a new product.">

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data"
        class="product-content d-flex flex-wrap">
        @csrf
        <div class="product-body bg-light stroke p-3 col-12 col-md-4">
            <div class="mb-3">
                <div class="fs-4 fw-medium mb-2">Product Image</div>
                <label for="image" class="form-label">jpg/ jpeg/ png</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/jpeg,image/png">
                <div id="imagePreview" class="mt-3">
                    {{-- gambarnya ditampilkan disini --}}
                </div>
            </div>
        </div>
        <div class="product-body bg-light stroke p-3 col-12 col-md-8 d-flex flex-column">
            <div class="fs-4 fw-medium mb-2 w-100">Product Details</div>
            <div class="mb-3 w-100">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    @forelse ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @empty
                        <option>There's no categories</option>
                    @endforelse
                </select>
            </div>

            <div class="mb-3 w-100">
                <x-text-input label="Name" name="name" placeholder="Product name"
                    value="{{ old('name') }}"></x-text-input>
            </div>

            <div class="mb-3 w-100">
                <x-text-input label="Stock" name="stock" type="number" placeholder="How many units"
                    value="{{ old('stock') }}"></x-text-input>
            </div>

            <div class="mb-3 w-100">
                <x-text-input label="Price" name="price" type="number" placeholder="Enter the product price"
                    value="{{ old('price') }}"></x-text-input>
            </div>

            <div class="d-flex justify-content-end mt-auto w-100 gap-3">
                <a href="{{ route('products.index') }}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-dark">Add Product</button>
            </div>
        </div>
    </form>
</x-layout>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100%';
                img.style.height = 'auto';
                img.style.borderRadius = '10px';
                preview.appendChild(img);
            };

            reader.readAsDataURL(input.files[0]);
        }
    });
</script>
