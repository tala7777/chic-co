@extends('layouts.admin')

@section('content')
    <h2 class="h3 mb-4 text-gray-800" style="font-family: 'Playfair Display', serif;">User Management</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Style Profile</th>
                            <th>Joined</th>
                            <th>Orders</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Sarah Johnson</td>
                            <td>sarah@example.com</td>
                            <td><span class="badge badge-soft">Soft Girl 🌸</span></td>
                            <td>2023-01-15</td>
                            <td>5</td>
                            <td><button class="btn btn-sm btn-outline-dark">View</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Muna Ali</td>
                            <td>muna@example.com</td>
                            <td><span class="badge badge-alt">Alt Girl 🖤</span></td>
                            <td>2023-02-20</td>
                            <td>2</td>
                            <td><button class="btn btn-sm btn-outline-dark">View</button></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Dana White</td>
                            <td>dana@example.com</td>
                            <td><span class="badge badge-luxury">Luxury ✨</span></td>
                            <td>2023-03-10</td>
                            <td>12</td>
                            <td><button class="btn btn-sm btn-outline-dark">View</button></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Noor H.</td>
                            <td>noor@example.com</td>
                            <td><span class="badge badge-soft">Clean Girl 🤍</span></td>
                            <td>2023-03-12</td>
                            <td>0</td>
                            <td><button class="btn btn-sm btn-outline-dark">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection