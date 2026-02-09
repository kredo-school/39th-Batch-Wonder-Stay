@extends('layouts.admin')

@section('title', 'Admin | Dashboard')

@section('content')

    <h2>Dashboard</h2>

    {{-- KPI cards --}}
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <p class="text-muted fw-medium">TOTAL USERS</p>
                    <h2 class="fw-bold mt-2">1,000</h2>       
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <p class="text-muted fw-bold">TOTAL RESERVATIONS</p>
                <h2 class="fw-bold mt-2">1,500</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <p class="text-muted fw-bold">TODAY'S RESERVATIONS</p>
                <h2 class="fw-bold mt-2">12</h2>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card shadow-sm border-0 p-3">
                <p class="text-muted fw-bold">TOTAL USERS</p>
                <h2 class="fw-bold mt-2">$487,250</h2>
            </div>
        </div>

    </div>

    {{-- Quick actions --}}
    <div class="mb-4">
        <p class="fw-bold mb-2">Quick Actions</p>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm bg-white">User Management</a>
            <a href="#" class="btn btn-outline-secondary btn-sm bg-white">Reservation List</a>
            <a href="{{ route('admin.paymentmethods.index') }}" class="btn btn-outline-secondary btn-sm bg-white">Payment Methods</a>
            <a href="#" class="btn btn-outline-secondary btn-sm bg-white">Hotel Management</a>
            <a href="#" class="btn btn-outline-secondary btn-sm bg-white">Accommodation Management</a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Upcoming Check-ins --}}
        <div class="col-lg-6">
            <div class="bg-white p-3 shadow-sm rounded">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Upcoming Check-ins</h5>
                </div>

                <table class="table table-hover align middle custmo-table">
                    <thead class="table-light">
                        <tr>
                            <th>Guest</th>
                            <th>Hotel</th>
                            <th>Check-in Date</th>
                            <th>Nights</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($upcomingCheckIns as $reservation)
                            <tr>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->hotel->name }}</td>
                                <td>{{ $reservation->check_in_date }}</td>
                                <td>{{ $reservation->nights }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No upcoming check-ins</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
        
                <div class="text-end">
                    <a href="#" class="text-decoration-none small">View all</a>
                </div>
            </div>
        </div>

        {{-- Recently Created Reservations --}}
        <div class="col-lg-6">
            <div class="bg-white p-3 shadow-sm rounded">
                <h5 class="fw-bold mb-3">Recently Created Reservations</h5>
                <table class="table table-hover align-middle custom-table">
                    <thead class="table-light">
                        <tr>
                            <th>RESERVATION ID</th>
                            <th>GUEST</th>
                            <th>HOTEL</th>
                            <th>Created At</th>
                            <th>Status</th>
                        </tr>                        
                    </thead>
                    <tbody>
                        @forelse ($recentReservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->hotel->name }}</td>
                                <td>{{ $reservation->created_at->format('Y-m-d') }}</td>
                                <td>{{ $reservation->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No recent reservations</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="text-end">
                    <a href="#" class="text-decoration-none small">View all</a>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Footer Status --}}
    <div class="row g-3 mt-3">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 border-start border-danger border-4 p-3">
                <p class="text-muted">CANCELLED (THIS MONTH)</p>
                <h3 class="text-danger fw-bold">8</h3>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 border-start border-danger border-4 p-3">
                <p class="text-muted">REFUNDED (THIS MONTH)</p>
                <h3 class="text-danger fw-bold">3</h3>
            </div>
        </div>
    </div>
  

  
  {{-- Tables
  <h1>Admin Dashboard</h1>

  <form method="POST" action="/logout">
      @csrf
      <button type="submit">Logout</button>
  </form> --}}

@endsection

