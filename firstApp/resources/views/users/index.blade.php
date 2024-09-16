<x-layout subPage="User" title="User Management" subtitle="Manage your team members and their account permissions.">
    <style>
        .user-body {
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

        .form-control {
            width: 300px;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border-radius: 20px;
        }

        /* user */
        #searchInput:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        .text-bg-purple {
            background-color: #8e44ad;
            color: white;
        }

        .modal-stroke {
            border: none;
            border-radius: 15px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 25px 50px -12px;
        }

        .user-content {
            height: 100%;
            overflow-x: hidden;
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
    <div class="user-content">
        <div class="user-body bg-light stroke">
            <div class="w-100">
                <div class="d-flex w-100 justify-content-between align-items-center ps-3 py-2 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center">
                                @if (request()->get('search') && $users->isEmpty())
                                    <h4>No results found for "{{ request()->get('search') }}"</h4>
                                @else
                                    <h4>
                                        {{ request()->get('search') ? 'Search for "' . request()->get('search') . '"' : 'All User' }},
                                        <span class="opacity-75">{{ $users->count() }}</span>
                                    </h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <!-- Search bar -->
                        <form id="searchForm" class="d-flex me-2" method="GET" action="{{ route('users.search') }}">
                            <input type="text" name="search" id="searchInput" class="form-control me-2 focus:none"
                                placeholder="Search user..." aria-label="Search" value="{{ request()->get('search') }}">
                        </form>

                        <!-- filter dropdown -->
                        <form id="filterForm" class="d-flex" method="GET" action="{{ route('users.search') }}">
                            <input type="hidden" name="search" value="{{ request()->get('search') }}">
                            <div class="dropdown me-2">
                                <button
                                    class="btn btn-outline-secondary rounded-pill d-flex justify-content-center align-items-center px-3 py-2 fw-medium dropdown-toggle"
                                    type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2"
                                            d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0-4 0m2-6v4m0 4v8m4-4a2 2 0 1 0 4 0a2 2 0 0 0-4 0m2-12v10m0 4v2m4-13a2 2 0 1 0 4 0a2 2 0 0 0-4 0m2-3v1m0 4v11" />
                                    </svg>
                                    Filter
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                    <li><button type="submit" name="filter" value="a-z"
                                            class="dropdown-item">A-Z</button></li>
                                    <li><button type="submit" name="filter" value="z-a"
                                            class="dropdown-item">Z-A</button></li>
                                    <li><button type="submit" name="filter" value="last-update"
                                            class="dropdown-item">Last Update</button></li>
                                </ul>
                            </div>
                        </form>
                        <!-- action button -->
                        @if (Auth::user()->authority != 'user')
                            <a href="{{ route('users.create') }}"
                                class="btn btn-dark
                                rounded-pill d-flex justify-content-center align-items-center px-3 py-2
                                add-delete-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" class="me-1">
                                    <path fill="currentColor"
                                        d="M11 13H6q-.425 0-.712-.288T5 12t.288-.712T6 11h5V6q0-.425.288-.712T12 5t.713.288T13 6v5h5q.425 0 .713.288T19 12t-.288.713T18 13h-5v5q0 .425-.288.713T12 19t-.712-.288T11 18z" />
                                </svg>
                                <span>Add User</span>
                            </a>
                        @endif
                        <!-- Modal Delete Confirmation -->
                        <div class="modal fade" id="deleteConfirmationModal" data-bs-backdrop="false"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmationLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="deleteConfirmationLabel">Delete Confirmation
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete selected user(s) with IDs: <strong></strong>?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <a class="btn btn-danger" href="javascript:void(0);"
                                            id="confirmDeleteButton">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- list --}}
                <div class="table-responsive px-3">
                    <table class="table">
                        <thead>
                            <tr>
                                @if (Auth::user()->authority != 'user')
                                    <th scope="col">
                                        <input type="checkbox" id="selectAllCheckbox" class="form-check-input"
                                            @if (Auth::user()->authority == 'admin') disabled @endif />
                                    </th>
                                @endif


                                <th scope="col">Profile</th>
                                <th scope="col">User</th>
                                <th scope="col">Permission</th>
                                <th scope="col">Date Added</th>
                                <th scope="col">Last Update</th>
                                <th scope="col" class="text-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    @if (Auth::user()->authority != 'user')
                                        <td class="align-middle">
                                            <input type="checkbox" class="form-check-input"
                                                id="userCheckbox{{ $user->id }}"
                                                data-user-id="{{ $user->id }}"
                                                @if (Auth::user()->authority == 'admin' && $user->authority == 'superadmin') disabled @endif
                                                class="@if (Auth::user()->authority == 'admin' && $user->authority == 'superadmin') superadmin-checkbox @endif">
                                        </td>
                                    @endif
                                    <td class="align-middle">
                                        @if ($user->photo_file)
                                            <img src="{{ asset('storage/' . $user->photo_file) }}"
                                                alt="{{ $user->name }}" class="rounded-circle"
                                                style="width: 52px; height: 52px; object-fit: cover;">
                                        @elseif($user->photo_url)
                                            <img src="{{ $user->photo_url }}" alt="User Photo from URL"
                                                class="rounded-circle"
                                                style="width: 52px; height: 52px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('public/images/user_default.jpg') }}"
                                                alt="Default Photo" class="rounded-circle"
                                                style="width: 52px; height: 52px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex gap-2">
                                            <div class="">
                                                <h5 class="fw-semibold mb-0">{{ $user->name }}</h5>
                                            </div>
                                            <div>
                                                @if ($user->authority == 'superadmin')
                                                    <span class="badge rounded-pill text-bg-dark">Super Admin</span>
                                                @elseif($user->authority == 'admin')
                                                    <span class="badge rounded-pill text-bg-purple">Admin</span>
                                                @elseif($user->authority == 'user')
                                                    <span class="badge rounded-pill text-bg-primary">User</span>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="opacity-75 mb-0">{{ $user->email }}</p>
                                    </td>
                                    <td class="align-middle" style="max-width: 220px">
                                        @if ($user->authority == 'superadmin')
                                            <span class="badge rounded-pill text-bg-info">Full Access</span>
                                            <span class="badge rounded-pill text-bg-success">User Management</span>
                                            <span class="badge rounded-pill text-bg-danger">Data Management</span>
                                        @elseif($user->authority == 'admin')
                                            <span class="badge rounded-pill text-bg-success">User Management</span>
                                            <span class="badge rounded-pill text-bg-danger">Data Management</span>
                                        @elseif($user->authority == 'user')
                                            <span class="badge rounded-pill text-bg-secondary">View Only</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}
                                    </td>
                                    <td class="align-middle">
                                        {{ \Carbon\Carbon::parse($user->updated_at)->format('d M Y') }}
                                    </td>
                                    @if (Auth::user()->authority == 'superadmin')
                                        <td class="align-middle text-end">
                                            @if ($user->authority != 'superadmin')
                                                <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                                    class="w-100 btn border border-secondary rounded-pill d-flex justify-content-center align-items-center px-4 py-2">Edit
                                                </a>
                                            @else
                                                <button
                                                    class="w-100 btn border border-secondary rounded-pill d-flex justify-content-center align-items-center px-4 py-2 view-profile-btn"
                                                    data-bs-toggle="modal" data-bs-target="#viewProfileModal"
                                                    data-user-name="{{ $user->name }}"
                                                    data-user-email="{{ $user->email }}"
                                                    data-photo-type="{{ $user->photo_file ? 'storage' : ($user->photo_url ? 'url' : 'default') }}"
                                                    data-photo-path="{{ $user->photo_file ? asset('storage/' . $user->photo_file) : $user->photo_url ?? asset('public/images/user_default.jpg') }}">View</button>
                                            @endif
                                        </td>
                                    @elseif (Auth::user()->authority == 'admin')
                                        <td class="align-middle text-end">
                                            @if ($user->authority == 'user' || $user->authority == 'admin')
                                                <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                                    class="w-100 btn border border-secondary rounded-pill d-flex justify-content-center align-items-center px-4 py-2">Edit
                                                </a>
                                            @else
                                                <button
                                                    class="w-100 btn border border-secondary rounded-pill d-flex justify-content-center align-items-center px-4 py-2 view-profile-btn"
                                                    data-bs-toggle="modal" data-bs-target="#viewProfileModal"
                                                    data-user-name="{{ $user->name }}"
                                                    data-user-email="{{ $user->email }}"
                                                    data-photo-type="{{ $user->photo_file ? 'storage' : ($user->photo_url ? 'url' : 'default') }}"
                                                    data-photo-path="{{ $user->photo_file ? asset('storage/' . $user->photo_file) : $user->photo_url ?? asset('public/images/user_default.jpg') }}">View</button>
                                            @endif
                                        </td>
                                    @else
                                        <td class="align-middle text-end">
                                            <button
                                                class="w-100 btn border border-secondary rounded-pill d-flex justify-content-center align-items-center px-4 py-2 view-profile-btn"
                                                data-bs-toggle="modal" data-bs-target="#viewProfileModal"
                                                data-user-name="{{ $user->name }}"
                                                data-user-email="{{ $user->email }}"
                                                data-photo-type="{{ $user->photo_file ? 'storage' : ($user->photo_url ? 'url' : 'default') }}"
                                                data-photo-path="{{ $user->photo_file ? asset('storage/' . $user->photo_file) : $user->photo_url ?? asset('public/images/user_default.jpg') }}">View</button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
                <!-- View Profile Modal -->
                <div class="modal fade" id="viewProfileModal" aria-labelledby="viewProfileModalLabel"
                    aria-hidden="true" data-bs-backdrop="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewProfileModalLabel">View Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-start py-3">
                                    <div class="d-flex align-items-start flex-column">
                                        <img id="user-photo" src="" alt="User Photo" class="rounded-circle"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                        <span id="user-name" class="pt-2 fs-4"></span>
                                        <span id="user-email" class="text-secondary"></span>
                                    </div>
                                </div>
                                <p>Isi dari profil pengguna akan ditampilkan di sini.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            /* notification */
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
            /* modal for user only */
            document.addEventListener('DOMContentLoaded', function() {
                var viewProfileButton = document.querySelectorAll('.view-profile-btn');
                var viewProfileModal = document.getElementById('viewProfileModal');

                viewProfileButton.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var userName = this.getAttribute('data-user-name');
                        var userEmail = this.getAttribute('data-user-email');
                        var photoType = this.getAttribute('data-photo-type');
                        var photoPath = this.getAttribute('data-photo-path');

                        document.getElementById('user-name').innerText = userName;
                        document.getElementById('user-email').innerText = userEmail;
                        document.getElementById('user-photo').setAttribute('src', photoPath);
                    });
                });
            });

            /* checkbox */
            document.addEventListener('DOMContentLoaded', function() {
                const selectAllCheckbox = document.getElementById('selectAllCheckbox');
                const userCheckboxes = document.querySelectorAll('input[type="checkbox"][id^="userCheckbox"]');

                if (selectAllCheckbox) {
                    selectAllCheckbox.addEventListener('change', function() {
                        userCheckboxes.forEach(checkbox => {
                            if (!checkbox.disabled) {
                                checkbox.checked = selectAllCheckbox.checked;
                            }
                        });
                    });
                }
            });

            /* handle perubahan button */
            document.addEventListener('DOMContentLoaded', function() {
                const addDeleteButton = document.querySelector('.add-delete-button');
                const userCheckboxes = document.querySelectorAll('input[type="checkbox"][id^="userCheckbox"]');
                const confirmDeleteButton = document.getElementById('confirmDeleteButton');
                const modalBody = document.querySelector('.modal-body');
                const deleteConfirmationModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));

                let selectedUserIds = [];

                userCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        if (Auth::user() - > authority === 'admin') {
                            this.disabled = true;
                            return;
                        }

                        const userId = this.getAttribute('data-user-id');

                        if (this.checked) {
                            selectedUserIds.push(userId);
                        } else {
                            selectedUserIds = selectedUserIds.filter(id => id !== userId);
                        }

                        updateDeleteButtonState();
                    });
                });

                function updateDeleteButtonState() {
                    if (selectedUserIds.length > 0) {
                        addDeleteButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5t.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5t-.288.713T19 6v13q0 .825-.587 1.413T17 21zm3-4q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8t-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8t-.712.288T13 9v7q0 .425.288.713T14 17"/>
                </svg>
                <span>Delete User</span>
            `;
                        addDeleteButton.classList.remove('btn-dark');
                        addDeleteButton.classList.add('btn-danger');
                        addDeleteButton.setAttribute('data-bs-toggle', 'modal');
                        addDeleteButton.setAttribute('data-bs-target', '#deleteConfirmationModal');
                    } else {
                        addDeleteButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M11 13H6q-.425 0-.712-.288T5 12t.288-.712T6 11h5V6q0-.425.288-.712T12 5t.713.288T13 6v5h5q.425 0 .713.288T19 12t-.288.713T18 13h-5v5q0 .425-.288.713T12 19t-.712-.288T11 18z"/>
                </svg>
                <span>Add User</span>
            `;
                        addDeleteButton.classList.remove('btn-danger');
                        addDeleteButton.classList.add('btn-dark');
                        addDeleteButton.removeAttribute('data-bs-toggle');
                        addDeleteButton.removeAttribute('data-bs-target');
                        addDeleteButton.setAttribute('href', '/users/create');
                    }
                }

                confirmDeleteButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    fetch(`/users/delete`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                user_ids: selectedUserIds
                            })
                        })
                        .then(response => {
                            if (response.ok) {
                                window.location.reload();
                            } else {
                                response.text().then(text => {
                                    console.error('Error response:', text);
                                    alert('Failed to delete user(s). ' + text);
                                });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });

                deleteConfirmationModal._element.addEventListener('show.bs.modal', function(event) {
                    const userIdsString = selectedUserIds.join(', ');
                    modalBody.innerHTML = `
            <p>Are you sure you want to delete users with IDs: <strong>${userIdsString}</strong>?</p>
        `;
                });
            });

            /* untuk searchbar */
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                searchInput.focus();

                const query = searchInput.value;
                searchInput.setSelectionRange(query.length, query.length);

                searchInput.addEventListener('input', function() {
                    const newQuery = this.value;

                    if (newQuery.length > 0) {
                        const url = `{{ route('users.search') }}?search=${encodeURIComponent(newQuery)}`;
                        window.location.href = url;
                    } else {
                        window.location.href = '{{ route('users.index') }}';
                    }
                });
            });
        </script>
    </div>
</x-layout>
