<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <link rel="icon" href="{{ asset('icon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar d-none d-md-flex flex-column justify-content-between h-100">
        <nav class="navbar navbar-expand-lg d-flex flex-column">
            <div class="container">
                <a class="navbar-brand w-100 fw-bold fs-3 ps-4 pb-4" href="{{ route('dashboard') }}">PIBITI 2024</a>
            </div>
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarNavbarNav" aria-controls="sidebarNavbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="sidebarNavbarNav">
                    <div class="navbar-nav flex-column w-100">
                        <a class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'bg-nav-active rounded-5 text-white py-3 px-4' : 'py-3 px-4' }}"
                            href="{{ route('dashboard') }}">
                            @if (request()->is('dashboard'))
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="white"
                                        d="M14 9q-.425 0-.712-.288T13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9zM4 13q-.425 0-.712-.288T3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13zm10 8q-.425 0-.712-.288T13 20v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21zM4 21q-.425 0-.712-.288T3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9h-6q-.425 0-.712-.288T13 8M3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13H4q-.425 0-.712-.288T3 12m10 8v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21h-6q-.425 0-.712-.288T13 20M3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21H4q-.425 0-.712-.288T3 20m2-9h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2" />
                                </svg>
                            @endif
                            <span class="ms-2">Dasboard</span>
                        </a>
                        {{-- <a class="nav-link d-flex align-items-center {{ request()->is('task*') ? 'bg-nav-active rounded-5 text-white py-3 px-4' : 'py-3 px-4' }}"
                            href="/task">
                            @if (request()->is('task*'))
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M20 3h-3.2c-.4-1.2-1.5-2-2.8-2s-2.4.8-2.8 2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2m-6 0c.6 0 1 .5 1 1s-.5 1-1 1s-1-.5-1-1s.4-1 1-1m2 11H9v-2h7m3-2H9V8h10M4 21h14v2H4c-1.1 0-2-.9-2-2V7h2" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M4 7v14h14v2H4c-1.1 0-2-.9-2-2V7zm16-4c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H8c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h3.18C11.6 1.84 12.7 1 14 1s2.4.84 2.82 2zm-6 0c-.55 0-1 .45-1 1s.45 1 1 1s1-.45 1-1s-.45-1-1-1m-4 4V5H8v12h12V5h-2v2m-3 8h-5v-2h5m3-2h-8V9h8z" />
                                </svg>
                            @endif
                            <span class="ms-2">Task list</span>
                        </a> --}}
                        <a class="nav-link d-flex align-items-center {{ request()->is('categories*') ? 'bg-nav-active rounded-5 text-white py-3 px-4' : 'py-3 px-4' }}"
                            href="{{ route('categories.index') }}">
                            @if (request()->is('categories*'))
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M7.425 9.475L11.15 3.4q.15-.25.375-.363T12 2.925t.475.113t.375.362l3.725 6.075q.15.25.15.525t-.125.5t-.35.363t-.525.137h-7.45q-.3 0-.525-.137T7.4 10.5t-.125-.5t.15-.525M17.5 22q-1.875 0-3.187-1.312T13 17.5t1.313-3.187T17.5 13t3.188 1.313T22 17.5t-1.312 3.188T17.5 22M3 20.5v-6q0-.425.288-.712T4 13.5h6q.425 0 .713.288T11 14.5v6q0 .425-.288.713T10 21.5H4q-.425 0-.712-.288T3 20.5" />
                                </svg> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M3.7 11q-.575 0-.862-.488t-.013-.987l3.3-5.95q.275-.5.875-.5t.875.5l3.3 5.95q.275.5-.012.988T10.3 11zM7 21q-1.65 0-2.825-1.175T3 17q0-1.65 1.175-2.825T7 13q1.65 0 2.825 1.175T11 17q0 1.65-1.175 2.825T7 21m7 0q-.425 0-.712-.288T13 20v-6q0-.425.288-.712T14 13h6q.425 0 .713.288T21 14v6q0 .425-.288.713T20 21zm1.6-14.5l-1.9-1.9q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275L17 5.1l1.9-1.9q.275-.275.7-.275t.7.275q.275.275.275.7t-.275.7l-1.9 1.9l1.9 1.9q.275.275.275.7t-.275.7q-.275.275-.7.275t-.7-.275L17 7.9l-1.9 1.9q-.275.275-.7.275t-.7-.275q-.275-.275-.275-.7t.275-.7z" />
                                </svg>
                            @else
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M7.425 9.475L11.15 3.4q.15-.25.375-.363T12 2.925t.475.113t.375.362l3.725 6.075q.15.25.15.525t-.125.5t-.35.363t-.525.137h-7.45q-.3 0-.525-.137T7.4 10.5t-.125-.5t.15-.525M17.5 22q-1.875 0-3.187-1.312T13 17.5t1.313-3.187T17.5 13t3.188 1.313T22 17.5t-1.312 3.188T17.5 22M3 20.5v-6q0-.425.288-.712T4 13.5h6q.425 0 .713.288T11 14.5v6q0 .425-.288.713T10 21.5H4q-.425 0-.712-.288T3 20.5m14.5-.5q1.05 0 1.775-.725T20 17.5t-.725-1.775T17.5 15t-1.775.725T15 17.5t.725 1.775T17.5 20M5 19.5h4v-4H5zM10.05 9h3.9L12 5.85zm7.45 8.5" />
                                </svg> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M3.7 11q-.575 0-.862-.488t-.013-.987l3.3-5.95q.275-.5.875-.5t.875.5l3.3 5.95q.275.5-.012.988T10.3 11zM7 21q-1.65 0-2.825-1.175T3 17q0-1.675 1.175-2.838T7 13q1.65 0 2.825 1.175T11 17q0 1.65-1.175 2.825T7 21m0-2q.825 0 1.412-.587T9 17q0-.825-.587-1.412T7 15q-.825 0-1.412.588T5 17q0 .825.588 1.413T7 19M5.4 9h3.2L7 6.125zM14 21q-.425 0-.712-.288T13 20v-6q0-.425.288-.712T14 13h6q.425 0 .713.288T21 14v6q0 .425-.288.713T20 21zm1-2h4v-4h-4zm.6-12.5l-1.9-1.9q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275L17 5.1l1.9-1.9q.275-.275.7-.275t.7.275q.275.275.275.7t-.275.7l-1.9 1.9l1.9 1.9q.275.275.275.7t-.275.7q-.275.275-.7.275t-.7-.275L17 7.9l-1.9 1.9q-.275.275-.7.275t-.7-.275q-.275-.275-.275-.7t.275-.7z" />
                                </svg>
                            @endif
                            <span class="ms-2">Categories</span>
                        </a>
                        <a class="nav-link d-flex align-items-center {{ request()->is('orders*') ? 'bg-nav-active rounded-5 text-white py-3 px-4' : 'py-3 px-4' }}"
                            href="/orders">
                            @if (request()->is('orders*'))
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m17.275 18.125l-.425-.425q-.225-.225-.537-.225t-.538.225t-.225.525t.225.525l.975.975q.225.225.525.225t.525-.225l2.425-2.375q.225-.225.225-.538t-.225-.537t-.538-.225t-.537.225zM17 9q.425 0 .713-.288T18 8t-.288-.712T17 7H7q-.425 0-.712.288T6 8t.288.713T7 9zm1 14q-2.075 0-3.537-1.463T13 18t1.463-3.537T18 13t3.538 1.463T23 18t-1.463 3.538T18 23M3 21.875V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v5.5q0 .425-.35.688t-.775.137q-.7-.175-1.425-.25T17 11H7q-.425 0-.712.288T6 12t.288.713T7 13h6.1q-.425.425-.787.925T11.675 15H7q-.425 0-.712.288T6 16t.288.713T7 17h4.075q-.05.25-.062.488T11 18q0 .65.125 1.275t.325 1.25q.125.275-.1.438t-.425-.038l-.075-.075q-.15-.15-.35-.15t-.35.15l-.8.8q-.15.15-.35.15t-.35-.15l-.8-.8q-.15-.15-.35-.15t-.35.15l-.8.8q-.15.15-.35.15t-.35-.15l-.8-.8q-.15-.15-.35-.15t-.35.15l-.8.8z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m17.275 18.125l-.425-.425q-.225-.225-.537-.225t-.538.225t-.225.525t.225.525l.975.975q.225.225.525.225t.525-.225l2.425-2.375q.225-.225.225-.538t-.225-.537t-.538-.225t-.537.225zM7 9h10q.425 0 .713-.288T18 8t-.288-.712T17 7H7q-.425 0-.712.288T6 8t.288.713T7 9m11 14q-2.075 0-3.537-1.463T13 18t1.463-3.537T18 13t3.538 1.463T23 18t-1.463 3.538T18 23M3 5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v5.375q0 .425-.288.713t-.712.287t-.712-.288t-.288-.712V5H5v14.05h6.075q.05.375.15.75t.225.725q.125.275-.1.438t-.425-.038l-.075-.075q-.15-.15-.35-.15t-.35.15l-.8.8q-.15.15-.35.15t-.35-.15l-.8-.8q-.15-.15-.35-.15t-.35.15l-.8.8q-.15.15-.35.15t-.35-.15l-.8-.8q-.15-.15-.35-.15t-.35.15L3 22zm4 12h3.375q.425 0 .713-.288t.287-.712t-.288-.712t-.712-.288H7q-.425 0-.712.288T6 16t.288.713T7 17m0-4h6.55q.425 0 .713-.288T14.55 12t-.288-.712T13.55 11H7q-.425 0-.712.288T6 12t.288.713T7 13m-2 6.05V5z" />
                                </svg>
                            @endif
                            <span class="ms-2">Order</span>
                        </a>
                        <a class="nav-link d-flex align-items-center {{ request()->is('products*') ? 'bg-nav-active rounded-5 text-white py-3 px-4' : 'py-3 px-4' }}"
                            href="/products">
                            @if (request()->is('products*'))
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M5 21q-.825 0-1.412-.587T3 19V6.525q0-.35.113-.675t.337-.6L4.7 3.725q.275-.35.687-.538T6.25 3h11.5q.45 0 .863.188t.687.537l1.25 1.525q.225.275.338.6t.112.675V19q0 .825-.587 1.413T19 21zm.4-15h13.2l-.85-1H6.25zM16 8H8v6.375q0 .575.475.863t.975.037L12 14l2.55 1.275q.5.25.975-.038t.475-.862z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M5 8v11h14V8h-3v6.375q0 .575-.475.863t-.975.037L12 14l-2.55 1.275q-.5.25-.975-.038T8 14.376V8zm0 13q-.825 0-1.412-.587T3 19V6.525q0-.35.113-.675t.337-.6L4.7 3.725q.275-.35.687-.538T6.25 3h11.5q.45 0 .863.188t.687.537l1.25 1.525q.225.275.338.6t.112.675V19q0 .825-.587 1.413T19 21zm.4-15h13.2l-.85-1H6.25zM10 8v4.75l2-1l2 1V8zM5 8h14z" />
                                </svg>
                            @endif
                            <span class="ms-2">Products</span>
                        </a>
                        <a class="nav-link d-flex align-items-center {{ request()->is('users*') ? 'bg-nav-active rounded-5 text-white py-3 px-4' : 'py-3 px-4' }}"
                            href="{{ route('users.index') }}">
                            @if (request()->is('users*'))
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M1 18q-.425 0-.712-.288T0 17v-.575q0-1.075 1.1-1.75T4 14q.325 0 .625.013t.575.062q-.35.525-.525 1.1t-.175 1.2V18zm6 0q-.425 0-.712-.288T6 17v-.625q0-.8.438-1.463t1.237-1.162T9.588 13T12 12.75q1.325 0 2.438.25t1.912.75t1.225 1.163t.425 1.462V17q0 .425-.287.713T17 18zm12.5 0v-1.625q0-.65-.162-1.225t-.488-1.075q.275-.05.563-.062T20 14q1.8 0 2.9.663t1.1 1.762V17q0 .425-.288.713T23 18zM4 13q-.825 0-1.412-.587T2 11q0-.85.588-1.425T4 9q.85 0 1.425.575T6 11q0 .825-.575 1.413T4 13m16 0q-.825 0-1.412-.587T18 11q0-.85.588-1.425T20 9q.85 0 1.425.575T22 11q0 .825-.575 1.413T20 13m-8-1q-1.25 0-2.125-.875T9 9q0-1.275.875-2.137T12 6q1.275 0 2.138.863T15 9q0 1.25-.862 2.125T12 12" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M1 18q-.425 0-.712-.288T0 17v-.575q0-1.075 1.1-1.75T4 14q.325 0 .625.013t.575.062q-.35.525-.525 1.1t-.175 1.2V18zm6 0q-.425 0-.712-.288T6 17v-.625q0-.8.438-1.463t1.237-1.162T9.588 13T12 12.75q1.325 0 2.438.25t1.912.75t1.225 1.163t.425 1.462V17q0 .425-.287.713T17 18zm12.5 0v-1.625q0-.65-.162-1.225t-.488-1.075q.275-.05.563-.062T20 14q1.8 0 2.9.663t1.1 1.762V17q0 .425-.288.713T23 18zM8.125 16H15.9q-.25-.5-1.388-.875T12 14.75t-2.512.375T8.125 16M4 13q-.825 0-1.412-.587T2 11q0-.85.588-1.425T4 9q.85 0 1.425.575T6 11q0 .825-.575 1.413T4 13m16 0q-.825 0-1.412-.587T18 11q0-.85.588-1.425T20 9q.85 0 1.425.575T22 11q0 .825-.575 1.413T20 13m-8-1q-1.25 0-2.125-.875T9 9q0-1.275.875-2.137T12 6q1.275 0 2.138.863T15 9q0 1.25-.862 2.125T12 12m0-2q.425 0 .713-.288T13 9t-.288-.712T12 8t-.712.288T11 9t.288.713T12 10m0-1" />
                                </svg>
                            @endif
                            <span class="ms-2">Users</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Profile section -->
        <div class="d-flex align-items-center justify-content-center py-3">
            <a href="/profile" class="d-flex align-items-center text-decoration-none text-black flex-column">
                <img src="{{ request()->user()->photo_file ? Storage::url(request()->user()->photo_file) : (filter_var(request()->user()->photo_url, FILTER_VALIDATE_URL) ? request()->user()->photo_url : asset('path/to/default-image.jpg')) }}"
                    alt="Profile" class="rounded-circle me-2" style="width: 64px; height: 64px; object-fit:cover">
                <span class="pt-2">{{ request()->user()->name }}</span>
                <span class="text-secondary">{{ request()->user()->email }}</span>
            </a>
        </div>
    </div>
    <!-- End Sidebar -->

    <!-- Main content -->
    <div class="main-content">
        @php
            $breadcrumbs = [['name' => 'Dashboard', 'url' => '/']];
        @endphp

        @isset($subPage)
            @php
                $subPages = [
                    'User' => '/users',
                    'Category' => '/categories',
                    'Orders' => '/orders',
                    'Product' => '/products',
                ];

                $url = $subPages[$subPage] ?? '#';
                $breadcrumbs[] = ['name' => $subPage, 'url' => $url];
            @endphp
        @endisset

        @isset($action)
            @php
                $actions = [
                    'Add User' => '/users/create',
                    'Edit User' => '/users/edit',
                    'Add Category' => '/categories/add',
                    'Edit Category' => '/categories/edit',
                    'Create Order' => '/orders/create',
                    'Order Details' => '/orders/show',
                ];

                $url = $actions[$action] ?? null;
                $breadcrumbs[] = ['name' => $action, 'url' => $url];
            @endphp
        @endisset

        @isset($subAction)
            @php
                $subActions = [
                    'Add Item' => '/orders/create/order/detail',
                ];

                $url = $subActions[$subAction] ?? null;
                $breadcrumbs[] = ['name' => $subAction, 'url' => $url];
            @endphp
        @endisset

        @isset($edit)
            @php
                $breadcrumbs[] = ['name' => $edit, 'url' => null];
            @endphp
        @endisset

        @if (isset($breadcrumbs))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light stroke px-4 py-3">
                    @foreach ($breadcrumbs as $breadcrumb)
                        @if (!$loop->last)
                            <li class="breadcrumb-item">
                                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        @endif


        @if (isset($title) && isset($subtitle))
            <header class="page-title stroke bg-light px-4 py-3">
                <h2 class="fw-semibold mb-2">{{ $title }}</h2>
                <p class="m-0">{{ $subtitle }}</p>
            </header>
        @endif

        {{ $slot }}
    </div>
    <!-- End Main content -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
