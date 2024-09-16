<x-layout subPage="Welcome {{ request()->user()->name }}" title="Dashboard Overview"
    subtitle="Overview of your activities and performance.">
    <style>
        .dashboard-content {
            height: 100%;
            overflow-x: hidden;
        }

        .dashboard-body {
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
    {{-- total customer --}}
    {{-- <div class="dashboard-content mb-2">
        <div class="dashboard-body stroke bg-light">
            <div class="w-100">
                <div class="w-100 justify-content-between align-items-center ps-3 pt-2">
                    <div class="d-flex mb-2 justify-content-between">
                        <h4>Total Customers, <span> {{ $totalCustomers }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- best seller --}}
    <div class="dashboard-content">
        <div class="dashboard-body stroke bg-light">
            <div class="w-100">
                <div class="w-100 justify-content-between align-items-center ps-3 pt-2">
                    <div class="d-flex mb-2 justify-content-between">
                        <h4>3 Best seller Product</h4>
                        <a href="{{ route('products.index') }}"
                            class="btn btn-dark rounded-pill d-flex justify-content-center align-items-center px-4 py-2">
                            <span>View All Products</span>
                        </a>
                    </div>
                    <div class="dashboard-content my-1 mb-2">
                        <div class="d-flex gap-3 w-100 justify-content-center">
                            @forelse ($bestSellers as $item)
                                @if ($item->product)
                                    <div class="dashboard-content bg-light stroke p-3 my-3"
                                        style="min-width: 320px;max-width: 320px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                                        <img src="{{ Storage::url($item->product->image) }}"
                                            class="card-img-top img-thumbnail bg-light rounded-lg"
                                            alt="{{ $item->product->name }}"
                                            style="width: 100%; height:300px; object-fit:cover; border-radius:10px">
                                        <div class="">
                                            <h5 class="fw-medium fs-5 mt-2">{{ $item->product->name }}</h5>
                                            <p class="fs-6">Sold: {{ $item->total }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-4">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <p>null</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="dashboard-content my-3">
                                    <div class="alert alert-warning text-center" role="alert">
                                        Perusahaan lagi sepi.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <p class="fs-5 fw-medium">Total Customers, <span> {{ $totalCustomers }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- monthly sales --}}
    <div class="dashboard-content mb-2 mt-2">
        <div class="dashboard-body stroke bg-light">
            <div class="w-100">
                <div class="w-100 justify-content-between align-items-center ps-3 pt-2">
                    <div class="mb-2">
                        <h4 class="mb-2">Monthly Sales</h4>
                        <canvas id="monthlySalesChart"></canvas>
                        <div class="d-flex justify-content-center mt-3">
                            <p class="fw-medium fs-5">Total Sales Last Month:</p>
                            <p class="fw-medium fs-5">Rp.{{ number_format($totalSales, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="dashboard-content mb-2">
        <div class="dashboard-body stroke bg-light">
            <div class="w-100">
                <div class="w-100 justify-content-between align-items-center ps-3 pt-2">
                    <div class="d-flex mb-2 justify-content-between">
                        <p class="fw-medium fs-4">Total Sales Revenue:</p>
                        <p class="fw-medium fs-4">Rp.{{ number_format($totalSales, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- task --}}
    <div class="task-content">
        <div class="task-body bg-light stroke">
            {{-- title --}}
            <div class="d-flex w-100 justify-content-between p-3">
                <div class="d-flex flex-column">
                    <div class="fs-2 fw-medium">Last tasks</div>
                    <p class="fw-light fs-6"><strong>9 Total, </strong>selesaikan tugas yang masih ada</p>
                </div>
                <div class="d-flex gap-5">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <h2>4</h2>
                        <p class="fw-light">done</p>
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <h2>5</h2>
                        <p class="fw-light">in progress</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="bg-light">
                <div class="d-flex w-100 justify-content-between align-items-center ps-3 py-2">
                    <!-- Search bar -->
                    <input type="text" class="form-control" placeholder="Search task..." name="search">

                    <!-- Date text and Dropdown -->
                    <div class="date">
                        <div class="dropdown">
                            <button class="btn btn-transparent dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Tuesday, 8th July
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">Monday, 9th July</a></li>
                                <li><a class="dropdown-item" href="#">Tuesday, 10th July</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- list --}}
            <div class="table-responsive px-3 pt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input type="checkbox">
                            </th>
                            <th scope="col">Nama Tugas</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status Tugas</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Pembagian sertifikat</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Presentasi final project.</td>
                            <td>27 Juli</td>
                            <td>Proses</td>
                            <td>27 Juli</td>
                            <td>27 Juli</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Pengumpulan final project.</td>
                            <td>21 Juli</td>
                            <td>Selesai</td>
                            <td>21 Juli</td>
                            <td>21 Juli</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Pengembangan Aplikasi Berbasis Proyek.</td>
                            <td>20 Juli</td>
                            <td>Selesai</td>
                            <td>20 Juli</td>
                            <td>20 Juli</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Pengelolaan Autentikasi dan Otorisasi.</td>
                            <td>14 Juli</td>
                            <td>Selesai</td>
                            <td>14 Juli</td>
                            <td>14 Juli</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Pengembangan Back-End dengan Laravel.</td>
                            <td>13 Juli</td>
                            <td>Selesai</td>
                            <td>13 Juli</td>
                            <td>13 Juli</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Pembuatan Front-End dengan Blade dan Bootstrap.</td>
                            <td>7 Juli</td>
                            <td>Selesai</td>
                            <td>11 Juli</td>
                            <td>8 Juli</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Pengenalan Laravel dan MVC</td>
                            <td>6 Juli</td>
                            <td>Selesai</td>
                            <td>6 Juli</td>
                            <td>6 Juli</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>Welcome Party</td>
                            <td>5 Juli</td>
                            <td>Selesai</td>
                            <td>5 Juli</td>
                            <td>5 Juli</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        const monthlySalesData = @json($monthlySales);

        const labels = Object.keys(monthlySalesData);
        const data = Object.values(monthlySalesData);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Monthly Sales',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Sales (Rp)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-layout>
