<x-layout subPage='Orders' title="Order Summary" subtitle="Overview of the order information" action="Order Details">
    <style>
        .order-content {
            height: 100%;
            overflow-x: hidden;
        }

        .order-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: white;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .order-body img {
            max-width: 150px;
            max-height: 150px;
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
    <div class="order-content">
        <!-- Header Section -->
        <div class="order-body bg-light stroke p-3">
            <h4>Total Items, {{ $order->details->count() }}</h4>
            <a href="{{ route('orders.index') }}"
                class="btn border border-secondary rounded-pill d-flex justify-content-center align-items-center px-3 py-2"
                style="width: 100px">Back</a>
        </div>

        <!-- Content Section -->
        <div class="d-flex flex-wrap gap-2 w-100">
            <!-- Items Details Column -->
            <div class="flex-grow-1">
                @foreach ($order->details as $detail)
                    <div class="order-body bg-light stroke p-3">
                        <div class="d-flex flex-column flex-md-row">
                            <div class="me-md-3">
                                <img src="{{ asset('storage/' . $detail->product->image) }}"
                                    alt="{{ $detail->product->name }}" class="img-thumbnail"
                                    style="width: 150px; height:150px; object-fit:cover">
                            </div>
                            <div>
                                <h5 class="fw-medium mb-3">{{ $detail->product->name }}</h5>
                                <div class="fs-6 mb-2">Price: Rp{{ number_format($detail->price) }}</div>
                                <div class="fs-6 mb-2">Count: {{ $detail->quantity }}</div>
                                <div class="fs-6 mb-2">Subtotal:
                                    Rp{{ number_format($detail->quantity * $detail->price) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary Column -->
            <div class="order-body bg-light p-3 stroke order-summary d-flex flex-column" style="width: 400px">
                <div class="w-100">
                    <h5 class="fw-medium  fs-4 mb-3">Summary</h5>
                    @foreach ($order->details as $index => $detail)
                        <div class="d-flex justify-content-between">
                            <div class="fs-6 mb-2">
                                Subtotal {{ $index + 1 }} :
                            </div>
                            <div>
                                Rp. {{ number_format($detail->quantity * $detail->price) }}
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <div>Total :</div>
                        <div class="fw-semibold">Rp{{ number_format($order->total) }}</div>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <div>Payment :</div>
                        <div>Rp{{ number_format($order->payment) }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <div>Change :</div>
                        <div>Rp{{ number_format($order->payment - $order->total) }}</div>
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
