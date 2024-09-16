<x-layout subPage="Product" action="Edit Product" title="Update Product"
    subtitle="Edit the details of the current product.">

    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data"
        class="product-content d-flex flex-wrap">
        @csrf
        @method('PUT')

        <div class="product-body bg-light stroke p-3 col-12 col-md-4">
            <div class="mb-3">
                <div class="fs-4 fw-medium mb-2">Product Image</div>
                @if (Auth::user()->authority != 'user')
                    <label for="image" class="form-label">jpg/ jpeg/ png</label>
                    <input class="form-control" type="file" id="image" name="image"
                        accept="image/jpeg,image/png">
                @endif
                <div id="imagePreview" class="mt-3">
                    @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}"
                            style="max-width: 100%; height: auto; border-radius: 10px;">
                    @endif
                </div>
            </div>
        </div>

        <div class="product-body bg-light stroke p-3 col-12 col-md-8 d-flex flex-column">
            <div class="fs-4 fw-medium mb-2 w-100">Product Details</div>
            <div class="mb-3 w-100">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    @forelse ($categories as $category)
                        <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif>
                            {{ $category->name }}</option>
                    @empty
                        <option>Belum ada category</option>
                    @endforelse
                </select>
            </div>

            <div class="mb-3 w-100">
                <x-text-input label="Name" name="name" placeholder="Masukkan nama product"
                    value="{{ old('name', $product->name) }}"></x-text-input>
            </div>

            <div class="mb-3 w-100">
                <x-text-input label="Price" name="price" type="number" placeholder="Enter the product price"
                    value="{{ old('price', $product->price) }}"></x-text-input>
            </div>

            <div class="mb-3 w-100">
                <x-text-input label="Stock" name="stock" type="number" placeholder="How many units do you have?"
                    value="{{ old('stock', $product->stock) }}" readonly></x-text-input>
            </div>

            @if (Auth::user()->authority != 'user')
                <div class="mb-3 w-100">
                    <x-text-input label="Add Stock" name="add_stock" type="number"
                        placeholder="Enter the quantity to add" value="{{ old('add_stock') }}"></x-text-input>
                </div>
                <div class="d-flex justify-content-end mt-auto w-100 gap-3">
                    <a href="{{ route('products.index') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-dark">Save Edit</button>
                </div>
            @else
                <div class="d-flex justify-content-end mt-auto w-100">
                    <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
                </div>
            @endif

        </div>
    </form>

    @if (Auth::user()->authority != 'user')
        <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="post"
            class="product-content mt-5" onsubmit="return confirm('Are you sure you want to delete this product?')">
            @csrf
            @method('DELETE')
            <div class="product-body bg-transparent w-100 mb-1">
                <button type="submit" class="btn btn-danger w-100 d-flex justify-content-center align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="me-2">
                        <path fill="currentColor"
                            d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zm3-4q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17" />
                    </svg>
                    Delete Product
                </button>
            </div>
        </form>
    @endif

</x-layout>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = ''; // Clear previous preview

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
