@extends('layouts.admin')

@section('content')
    <h2 class="h3 mb-4 text-gray-800" style="font-family: 'Playfair Display', serif;">Orders</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>#Order</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1025</td>
                            <td>Oct 26, 2023</td>
                            <td>Yara M.</td>
                            <td><span class="badge bg-secondary">Pending</span></td>
                            <td>250 JOD</td>
                            <td><button class="btn btn-sm btn-outline-dark">Manage</button></td>
                        </tr>
                        <tr>
                            <td>#1024</td>
                            <td>Oct 26, 2023</td>
                            <td>Rana Kh</td>
                            <td><span class="badge bg-warning text-dark">Processing</span></td>
                            <td>45 JOD</td>
                            <td><button class="btn btn-sm btn-outline-dark">Manage</button></td>
                        </tr>
                        <tr>
                            <td>#1023</td>
                            <td>Oct 25, 2023</td>
                            <td>Sara Ahmed</td>
                            <td><span class="badge bg-success">Shipped</span></td>
                            <td>120 JOD</td>
                            <td><button class="btn btn-sm btn-outline-dark">Manage</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection