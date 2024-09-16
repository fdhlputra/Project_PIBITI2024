<x-layout subPage="Category" title="Categories Organization" subtitle="Organize your items into various categories.">
    <style>
        .category-content {
            height: 100%;
            overflow-x: hidden;
        }

        .category-body {
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

        #searchInput:focus {
            outline: none !important;
            box-shadow: none !important;
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
    <div class="category-content">
        <div class="category-body bg-light stroke">
            <div class="w-100">
                <div class="w-100 justify-content-between align-items-center ps-3 py-2 mb-4">
                    <div class="d-flex mb-2 justify-content-between">
                        @if (request()->get('search') && $categories->isEmpty())
                            <h4>No results found for "{{ request()->get('search') }}"</h4>
                        @else
                            <h4>
                                {{ request()->get('search') ? 'Search for "' . request()->get('search') . '"' : 'All Categories' }},
                                <span class="opacity-75">{{ $categories->count() }}</span>
                            </h4>
                        @endif
                        <div class="d-flex gap-2">
                            <form class="d-flex gap-2" method="get">
                                <input type="text" class="form-control w-auto" placeholder="Search category"
                                    name="search" value="{{ request()->search }}">
                            </form>
                            @if (Auth::user()->authority != 'user')
                                <a href="{{ route('categories.create') }}"
                                    class="btn btn-dark rounded-pill d-flex justify-content-center align-items-center px-3 py-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" class="me-1">
                                        <path fill="currentColor"
                                            d="M11 13H6q-.425 0-.712-.288T5 12t.288-.712T6 11h5V6q0-.425.288-.712T12 5t.713.288T13 6v5h5q.425 0 .713.288T19 12t-.288.713T18 13h-5v5q0 .425-.288.713T12 19t-.712-.288T11 18z" />
                                    </svg>
                                    <span>Add Category</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    @if (Auth::user()->authority != 'user')
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        @if (Auth::user()->authority != 'user')
                                            <td>
                                                @if ($category->active)
                                                    <span class="badge rounded-pill text-bg-primary">Active</span>
                                                @else
                                                    <span class="badge rounded-pill text-bg-danger">Unactive</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                                                    class="btn border border-secondary rounded-pill d-flex justify-content-center align-items-center px-4 py-2">Edit
                                                </a>
                                                <form
                                                    action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        class="btn btn-danger rounded-pill d-flex justify-content-center align-items-center px-4 py-2">Delete</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Belum ada category</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
