@extends('layouts.admin')

@section('title', 'Admin | Dashboard')

@section('content')

<nav class="bg border ">

</nav>
{{-- KPI cards --}}
  <div class="card">
    <p>TOTAL USERS</p>
    <h2>1,000</h2>
  </div>

  <div class="card">
    <p>TOTAL RESERVATIONS</p>
    <h2>1,500</h2>
  </div>

  <div class="card">
      <p>TODAY'S RESERVATIONS</p>
  </div>

  <div class="card">
      <p>TOTAL USERS</p>
  </div>


{{-- Quick actions --}}
<div class="dashboard-tables">

    {{-- Upcoming Check-ins --}}
    <section class="table-card">
        <h3>Upcoming Check-ins</h3>

        <table>
            <thead>
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
    </section>

    {{-- Recently Created Reservations --}}
    <section class="table-card">
        <h3>Recently Created Reservations</h3>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Guest</th>
                    <th>Hotel</th>
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
    </section>

</div>

  

  
  {{-- Tables --}}
  <h1>Admin Dashboard</h1>

  <form method="POST" action="/logout">
      @csrf
      <button type="submit">Logout</button>
  </form>

@endsection

