<x-layout subPage="User" title="User Management" subtitle="Create a new user account and assign permissions."
    action="Add User">
    <div class="container mt-3 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4 fs-4 fw-medium">Add User</h5>
                        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Profile Photo</label>
                                <div class="mb-2">
                                    <input type="file" class="form-control @error('photo_file') is-invalid @enderror"
                                        id="photo_file" name="photo_file" accept="image/*"
                                        onchange="toggleInputs(); previewImage();">
                                    @error('photo_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-center mb-2">
                                    <span class="text-muted">or</span>
                                </div>
                                <div>
                                    <input type="url" class="form-control @error('photo_url') is-invalid @enderror"
                                        id="photo_url" name="photo_url" placeholder="Paste image URL"
                                        value="{{ old('photo_url') }}" onchange="toggleInputs(); previewImage()">
                                    @error('photo_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                @error('photo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <label class="form-text text-muted mt-2">Choose a profile photo: Upload a file or paste
                                    an image URL, or you can leave it and edit later.</label>
                                <!-- Image preview -->
                                <div class="mt-2">
                                    <img id="image_preview" src="#" alt="Image Preview"
                                        style="display: none; max-width: 100%; height: auto;">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Your name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Input your email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Input Password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-dark">Add New User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleInputs() {
            const fileInput = document.getElementById('photo_file');
            const urlInput = document.getElementById('photo_url');

            if (fileInput.value) {
                urlInput.disabled = true;
                urlInput.value = ''; // Clear URL input if file is selected
            } else {
                urlInput.disabled = false;
            }

            if (urlInput.value) {
                fileInput.disabled = true;
                fileInput.value = ''; // Clear file input if URL is provided
            } else {
                fileInput.disabled = false;
            }
        }

        function previewImage() {
            const fileInput = document.getElementById('photo_file');
            const urlInput = document.getElementById('photo_url');
            const imagePreview = document.getElementById('image_preview');

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };

                reader.readAsDataURL(fileInput.files[0]);
            } else if (urlInput.value) {
                imagePreview.src = urlInput.value;
                imagePreview.style.display = 'block';
            } else {
                imagePreview.src = '#';
                imagePreview.style.display = 'none';
            }
        }
    </script>
</x-layout>
