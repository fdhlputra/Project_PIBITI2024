<x-layout subPage="Profile" title="Profile" subtitle="View and update your personal information and account settings.">
    <style>
        .stroke {
            border: 3px solid #b4c1c8;
            border-radius: 15px;
        }

        .text-bg-purple {
            background-color: #8E44AD;
            color: white;
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
    <div class="">
        <div class="d-flex">
            <div class="w-50">
                <div class="card p-2 bg-light stroke">
                    <img src="{{ request()->user()->photo_file ? Storage::url(request()->user()->photo_file) : (filter_var(request()->user()->photo_url, FILTER_VALIDATE_URL) ? request()->user()->photo_url : asset('path/to/default-image.jpg')) }}"
                        class="card-img-top rounded-circle mx-auto mt-4" alt="Profile Image"
                        style="width: 150px; height: 150px; object-fit:cover">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <h5 class="card-title">{{ auth()->user()->name }}</h5>
                            <div>
                                @if (request()->user()->authority == 'superadmin')
                                    <p class="badge fs-6 text-bg-purple">Super Admin</p>
                                @elseif (request()->user()->authority == 'admin')
                                    <p class="badge fs-6 text-bg-primary">Admin</p>
                                @elseif (request()->user()->authority == 'user')
                                    <p class="badge fs-6 text-bg-secondary">User</p>
                                @endif
                            </div>
                        </div>
                        <div class="action">
                            <a href="{{ route('users.edit', request()->user()->id) }}"
                                class="btn btn-dark rounded-pill d-flex justify-content-center align-items-center px-3 py-2">
                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M5 19h1.425L16.2 9.225L14.775 7.8L5 17.575zm-1 2q-.425 0-.712-.288T3 20v-2.425q0-.4.15-.763t.425-.637L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.437.65T21 6.4q0 .4-.138.763t-.437.662l-12.6 12.6q-.275.275-.638.425t-.762.15zM19 6.4L17.6 5zm-3.525 2.125l-.7-.725L16.2 9.225z" />
                                </svg>
                                Edit Profile
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="w-100 mt-2">
                                @csrf
                                <button type="submit"
                                    class="btn btn-outline-danger rounded-pill d-flex justify-content-center align-items-center px-3 py-2 fw-semibold w-100">
                                    Log Out
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="w-100" style="margin-left: 10px">
                <div class="card bg-light stroke">
                    <div class="card-body">
                        <h5 class="card-title mb-4 fs-4 fw-semibold">Profile Information</h5>
                        <div class="row mb-3">
                            <div class="col-2">
                                <p class="card-text"><strong>Name</strong></p>
                            </div>
                            <div class="col-10">
                                <p class="card-text">: {{ request()->user()->name }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-2">
                                <p class="card-text"><strong>Email</strong></p>
                            </div>
                            <div class="col-10">
                                <p class="card-text">: {{ request()->user()->email }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-2">
                                <p class="card-text"><strong>Phone</strong></p>
                            </div>
                            <div class="col-10">
                                <p class="card-text">: (+62) 123-456-7890</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-2">
                                <p class="card-text"><strong>Address</strong></p>
                            </div>
                            <div class="col-10">
                                <p class="card-text">: Jawa Timur, Surabaya</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
