<x-layout title="Dashboard">

    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col">
                <p>Ini adalah dashboard saya</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text">1,234</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text">$12,345</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">New Orders</h5>
                        <p class="card-text">123</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Support Tickets</h5>
                        <p class="card-text">45</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Quick Link
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <a href="/users" class="btn btn-primary">Manage Users</a>
                        <a href="/orders" class="btn btn-primary">Manage Orders</a>
                        <a href="/products" class="btn btn-primary">View Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
