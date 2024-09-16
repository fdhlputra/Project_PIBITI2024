<x-layout subPage="Category" action="Add Category" title="New Category Creation"
    subtitle="Fill out the details to create a new category.">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <div class="stroke bg-light p-4">
                    <form action="{{ route('categories.store') }}" method="post">
                        @csrf

                        <x-text-input label="Name" name="name" placeholder="Category name"
                            value="{{ old('name') }}"></x-text-input>

                        <div class="form-check form-switch mb-5">
                            <input class="form-check-input" type="checkbox" role="switch" id="active" name="active"
                                @checked(!old() || old('active') == 'on')>
                            <label class="form-check-label" for="active">Active</label>
                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('categories.index') }}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-dark">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
