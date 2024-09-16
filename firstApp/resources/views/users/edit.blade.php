<x-layout subPage="User" action="Edit User" title="User Management" subtitle="Edit user account and assign permissions.">
    <div class="container mt-3 mb-4 stroke">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-4 fs-4 fw-medium">Edit User</h5>
                        <form action="{{ route('users.update', $user->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Profile Photo</label>
                                <div class="mb-2">
                                    <img src="{{ $user->photo_file ? Storage::url($user->photo_file) : (filter_var($user->photo_url, FILTER_VALIDATE_URL) ? $user->photo_url : asset('path/to/default-image.jpg')) }}"
                                        alt="User Photo" class="rounded-circle mb-3"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                                <a href="{{ route('users.editPhoto', $user->id) }}" class="btn btn-dark mb-3">Edit
                                    Photo</a>
                            </div>

                            <div class="mb-3 text-start">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Your name"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 text-start">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Input your email"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{--
                            @if (Auth::user()->authority == 'superadmin')
                                <div class="mb-4 text-start">
                                    <h5>Edit Authority</h5>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" id="superadmin" name="authority"
                                            value="superadmin" {{ $user->authority == 'superadmin' ? 'checked' : '' }}
                                            onclick="toggleAuthority('superadmin')">
                                        <label class="form-check-label fw-semibold" for="superadmin">Super Admin</label>
                                        <p>manage all aspects of the system.</p>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" id="admin" name="authority"
                                            value="admin" {{ $user->authority == 'admin' ? 'checked' : '' }}
                                            onclick="toggleAuthority('admin')">
                                        <label class="form-check-label fw-semibold" for="admin">Admin</label>
                                        <p>manage content and change team setting</p>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" id="user" name="authority"
                                            value="user" {{ $user->authority == 'user' ? 'checked' : '' }}
                                            onclick="toggleAuthority('user')">
                                        <label class="form-check-label fw-semibold" for="user">User</label>
                                        <p>only view content and access information.</p>
                                    </div>
                                </div>
                            @endif --}}
                            @if (Auth::user()->authority == 'superadmin')
                                <div class="mb-4 text-start">
                                    <h5>Edit Authority</h5>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" id="superadmin" name="authority"
                                            value="superadmin" {{ $user->authority == 'superadmin' ? 'checked' : '' }}
                                            {{ $user->authority == 'superadmin' ? 'disabled' : '' }}
                                            onclick="toggleAuthority('superadmin')">
                                        <label class="form-check-label fw-semibold" for="superadmin">Super Admin</label>
                                        <p>manage all aspects of the system.</p>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" id="admin" name="authority"
                                            value="admin" {{ $user->authority == 'admin' ? 'checked' : '' }}
                                            {{ $user->authority == 'superadmin' ? 'disabled' : '' }}
                                            onclick="toggleAuthority('admin')">
                                        <label class="form-check-label fw-semibold" for="admin">Admin</label>
                                        <p>manage content and change team setting</p>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" id="user" name="authority"
                                            {{ $user->authority == 'superadmin' ? 'disabled' : '' }} value="user"
                                            {{ $user->authority == 'user' ? 'checked' : '' }}
                                            onclick="toggleAuthority('user')">
                                        <label class="form-check-label fw-semibold" for="user">User</label>
                                        <p>only view content and access information.</p>
                                    </div>
                                </div>
                            @endif


                            {{-- @if (Auth::user()->authority == 'superadmin')
                                <div class="mb-4 text-start">
                                    <h5>Edit Permission</h5>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" id="allpermission" name="permission"
                                            value="allpermission" {{ $user->permission == 'allpermission' ? 'checked' : '' }}
                                            onclick="togglePermission('allpermission')">
                                        <label class="form-check-label fw-semibold" for="allpermission">All Permission</label>
                                        <p>manage all permission of the user.</p>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" id="datamanipulation" name="permission"
                                            value="datamanipulation" {{ $user->permission == 'datamanipulation' ? 'checked' : '' }}
                                            onclick="togglePermission('datamanipulation')">
                                        <label class="form-check-label fw-semibold" for="datamanipulation">Data Manipulation</label>
                                        <p>manage data import/export</p>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" id="viewonly" name="permission"
                                            value="viewonly" {{ $user->permission == 'viewonly' ? 'checked' : '' }}
                                            onclick="togglePermission('viewonly')">
                                        <label class="form-check-label fw-semibold" for="viewonly">View Only</label>
                                        <p>new user can view only the data</p>
                                    </div>
                                </div>
                            @endif --}}
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-dark">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAuthority(selectedAuthority) {
            if (selectedAuthority === 'superadmin') {
                document.getElementById('admin').checked = false;
                document.getElementById('user').checked = false;
            } else if (selectedAuthority === 'admin') {
                document.getElementById('superadmin').checked = false;
                document.getElementById('user').checked = false;
            } else if (selectedAuthority === 'user') {
                document.getElementById('superadmin').checked = false;
                document.getElementById('admin').checked = false;
            }
        }
    </script>
</x-layout>
