<x-layout subPage='Orders' title="Order Tracking" subtitle="Track and manage your customer orders">
    <style>
        .order-content {
            height: 100%;
            overflow-x: hidden;
        }

        .order-body {
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

        .empty-row {
            height: 300px;
        }

        .empty-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 100px 0px;
        }
    </style>
    <div class="order-content">
        <div class="order-body bg-light stroke">
            <div class="w-100">
                <div class="w-100 justify-content-between align-items-center ps-3 py-2 mb-4">
                    <div class="d-flex mb-2 justify-content-between">
                        @if (request()->get('search') && $orders->isEmpty())
                            <h4>No results found for "{{ request()->get('search') }}"</h4>
                        @else
                            <h4>
                                {{ request()->get('search') ? 'Search for "' . request()->get('search') . '"' : 'All Orders' }},
                                <span class="opacity-75">{{ $orders->count() }}</span>
                            </h4>
                        @endif
                        <div class="d-flex gap-2">
                            <form class="d-flex gap-2" method="get">
                                <input type="text" class="form-control" placeholder="Search order..." name="search"
                                    value="{{ request()->search }}">
                            </form>
                            @if (Auth::user()->authority != 'user')
                                <a href="{{ route('orders.create') }}"
                                    class="btn btn-dark rounded-pill d-flex justify-content-center align-items-center px-3 py-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" class="me-1">
                                        <path fill="currentColor"
                                            d="M11 13H6q-.425 0-.712-.288T5 12t.288-.712T6 11h5V6q0-.425.288-.712T12 5t.713.288T13 6v5h5q.425 0 .713.288T19 12t-.288.713T18 13h-5v5q0 .425-.288.713T12 19t-.712-.288T11 18z" />
                                    </svg>
                                    <span>Create New Orders</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    @if ($orders->isEmpty())
                        <div class="empty-content mt-2 d-flex flex-column align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M17 7V5h2v10.8l2 2V5a2 2 0 0 0-2-2h-4.18C14.25 1.44 12.53.64 11 1.2c-.86.3-1.5.96-1.82 1.8H6.2l4 4zm-5-4c.55 0 1 .45 1 1s-.45 1-1 1s-1-.45-1-1s.45-1 1-1m2.2 8l-2-2H17v2zM2.39 1.73L1.11 3L3 4.9V19a2 2 0 0 0 2 2h14.1l1.74 1.73l1.27-1.27zM5 19V6.89L7.11 9H7v2h2.11l2 2H7v2h6.11l4 4z" />
                            </svg>
                            <span class="mt-4 mb-2 fs-5">No orders yet</span>
                        </div>
                    @else
                        <div class="table-responsive pt-3">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Payment</th>
                                        <th>Total</th>
                                        <th>User</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->customer }}</td>
                                            <td>{{ number_format($order->payment) }}</td>
                                            <td>{{ number_format($order->total) }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td style="width: 150px">
                                                <a href="{{ route('orders.show', ['order' => $order->id]) }}"
                                                    class="btn border border-secondary rounded-pill d-flex justify-content-center align-items-center px-4 py-2">
                                                    View Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    {{-- <div class="table-responsive pt-3">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Payment</th>
                                    <th>Total</th>
                                    <th>User</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->customer }}</td>
                                        <td>{{ number_format($order->payment) }}</td>
                                        <td>{{ number_format($order->total) }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td style="width: 150px">
                                            <a href="{{ route('orders.show', ['order' => $order->id]) }}"
                                                class="btn border border-secondary rounded-pill d-flex justify-content-center align-items-center px-4 py-2">
                                                View Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-row">
                                        <td colspan="5">
                                            <div class="empty-content mt-5 d-flex flex-column"> --}}
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5" color="currentColor">
                                                        <path
                                                            d="M8 16h7.263c4.488 0 5.17-2.82 5.998-6.93c.239-1.187.358-1.78.071-2.175s-.837-.395-1.938-.395H19m-13 0h2M10.5 3l3 3m0 0l3 3m-3-3l-3 3m3-3l3-3M8 16L5.379 3.515A2 2 0 0 0 3.439 2H2.5m6.38 14h-.411C7.105 16 6 17.151 6 18.571a.42.42 0 0 0 .411.429H17.5" />
                                                        <circle cx="10.5" cy="20.5" r="1.5" />
                                                        <circle cx="17.5" cy="20.5" r="1.5" />
                                                    </g>
                                                </svg> --}}
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M12.03 8.97a.75.75 0 1 0-1.06 1.06l.97.97l-.97.97a.75.75 0 1 0 1.06 1.06l.97-.97l.97.97a.75.75 0 1 0 1.06-1.06l-.97-.97l.97-.97a.75.75 0 1 0-1.06-1.06l-.97.97z" />
                                                    <path fill="currentColor" fill-rule="evenodd"
                                                        d="M1.293 2.751a.75.75 0 0 1 .956-.459l.301.106c.617.217 1.14.401 1.553.603c.44.217.818.483 1.102.899c.282.412.399.865.452 1.362l.011.108H17.12c.819 0 1.653 0 2.34.077c.35.039.697.101 1.003.209c.3.105.631.278.866.584c.382.496.449 1.074.413 1.66c-.035.558-.173 1.252-.338 2.077l-.01.053l-.002.004l-.508 2.47c-.15.726-.276 1.337-.439 1.82c-.172.51-.41.96-.837 1.308c-.427.347-.916.49-1.451.556c-.505.062-1.13.062-1.87.062H10.88c-1.345 0-2.435 0-3.293-.122c-.897-.127-1.65-.4-2.243-1.026c-.547-.576-.839-1.188-.985-2.042c-.137-.8-.15-1.848-.15-3.3V7.038c0-.74-.002-1.235-.043-1.615c-.04-.363-.109-.545-.2-.677c-.087-.129-.22-.25-.524-.398c-.323-.158-.762-.314-1.43-.549l-.26-.091a.75.75 0 0 1-.46-.957M5.708 6.87v2.89c0 1.489.018 2.398.13 3.047c.101.595.274.925.594 1.263c.273.288.65.472 1.365.573c.74.105 1.724.107 3.14.107h5.304c.799 0 1.33-.001 1.734-.05c.382-.047.56-.129.685-.231c.125-.102.24-.26.364-.625c.13-.385.238-.905.4-1.688l.498-2.42v-.002c.178-.89.295-1.482.322-1.926c.026-.421-.04-.569-.101-.65a.561.561 0 0 0-.177-.087a3.17 3.17 0 0 0-.672-.134c-.595-.066-1.349-.067-2.205-.067zM5.25 19.5a2.25 2.25 0 1 0 4.5 0a2.25 2.25 0 0 0-4.5 0m2.25.75a.75.75 0 1 1 0-1.5a.75.75 0 0 1 0 1.5m6.75-.75a2.25 2.25 0 1 0 4.5 0a2.25 2.25 0 0 0-4.5 0m2.25.75a.75.75 0 1 1 0-1.5a.75.75 0 0 1 0 1.5"
                                                        clip-rule="evenodd" />
                                                </svg> --}}
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M4 18V7.1L2.45 3.75q-.175-.375-.025-.763t.525-.562t.763-.037t.562.512L6.2 7.05h11.6l1.925-4.15q.175-.375.563-.525t.762.05q.375.175.525.563t-.025.762L20 7.1V18q0 .825-.587 1.413T18 20H6q-.825 0-1.412-.587T4 18m6-5h4q.425 0 .713-.288T15 12t-.288-.712T14 11h-4q-.425 0-.712.288T9 12t.288.713T10 13m-4 5h12V9.05H6zm0 0V9.05z" />
                                                </svg> --}}
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M14.1 8.5L12 6.4L9.9 8.5L8.5 7.1L10.6 5L8.5 2.9l1.4-1.4L12 3.6l2.1-2.1l1.4 1.4L13.4 5l2.1 2.1zM7 18c1.1 0 2 .9 2 2s-.9 2-2 2s-2-.9-2-2s.9-2 2-2m10 0c1.1 0 2 .9 2 2s-.9 2-2 2s-2-.9-2-2s.9-2 2-2m-9.8-3.2c0 .1.1.2.2.2H19v2H7c-1.1 0-2-.9-2-2c0-.4.1-.7.2-1l1.3-2.4L3 4H1V2h3.3l4.3 9h7l3.9-7l1.7 1l-3.9 7c-.3.6-1 1-1.7 1H8.1l-.9 1.6z" />
                                                </svg> --}}
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M17 7V5h2v10.8l2 2V5a2 2 0 0 0-2-2h-4.18C14.25 1.44 12.53.64 11 1.2c-.86.3-1.5.96-1.82 1.8H6.2l4 4zm-5-4c.55 0 1 .45 1 1s-.45 1-1 1s-1-.45-1-1s.45-1 1-1m2.2 8l-2-2H17v2zM2.39 1.73L1.11 3L3 4.9V19a2 2 0 0 0 2 2h14.1l1.74 1.73l1.27-1.27zM5 19V6.89L7.11 9H7v2h2.11l2 2H7v2h6.11l4 4z" />
                                                </svg> --}}
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M2.39 1.73L1.11 3L3 4.9V19a2 2 0 0 0 2 2h14.1l1.74 1.73l1.27-1.27zM7 11h2.11l2 2H7zm7 6H7v-2h6.11l.89.89zm3-10v2h-4.8l2 2H17v2h-.8l4.8 4.8V5a2 2 0 0 0-2-2h-4.18C14.4 1.84 13.3 1 12 1s-2.4.84-2.82 2H6.2l4 4zm-5-4c.55 0 1 .45 1 1s-.45 1-1 1s-1-.45-1-1s.45-1 1-1" />
                                                </svg> --}}
                                                {{-- <span class="mt-4 mb-2 fs-5">No orders yet</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-layout>
