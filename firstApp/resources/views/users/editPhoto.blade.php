<x-layout subPage="User" title="Edit User Photo" subtitle="Change the profile photo" action="Edit User" >
    <div class="container mt-3 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <form action="{{ route('users.updatePhoto', $user->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3 mt-2">
                                <label class="form-label">Profile Photo</label>
                                <div class="mb-2">
                                    <img src="{{ $user->photo_file ? Storage::url($user->photo_file) : (filter_var($user->photo_url, FILTER_VALIDATE_URL) ? $user->photo_url : asset('path/to/default-image.jpg')) }}"
                                        alt="User Photo" class="rounded-circle mb-3"
                                        style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <input type="file" class="form-control @error('photo_file') is-invalid @enderror"
                                    id="photo_file" name="photo_file" accept="image/*" onchange="toggleInputs()">
                                @error('photo_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-center mb-2">
                                <span class="text-muted">or</span>
                            </div>
                            <div>
                                <input type="url" class="form-control @error('photo_url') is-invalid @enderror"
                                    id="photo_url" name="photo_url" placeholder="Paste image URL" value=""">
                                @error('photo_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @error('photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <label class="form-text text-muted mt-2">Choose a profile photo: Upload a file or paste an
                                image URL.</label>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-dark">Update Photo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script>
    function toggleInputs() {
        const fileInput = document.getElementById('photo_file');
        const urlInput = document.getElementById('photo_url');

        if (fileInput.value) {
            urlInput.disabled = true;
        } else {
            urlInput.disabled = false;
        }

        if (urlInput.value) {
            fileInput.disabled = true;
        } else {
            fileInput.disabled = false;
        }
    }
</script>
