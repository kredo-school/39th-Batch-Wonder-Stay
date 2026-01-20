@extends('layouts.admin')

@section('title', 'Admin | Reservations')

@section('content')

<h2>Reservations</h2>

<div class="table-card">

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Guest</th>
                <th>Email</th>
                <th>Hotel</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            {{-- dummy data --}}
            <tr>
                <td>R-2100</td>
                <td>Lisa Anderson</td>
                <td>lisa@example.com</td>
                <td>Grand Plaza Hotel</td>
                <td>2026-01-23</td>
                <td>2026-01-26</td>
                <td class="status confirmed">confirmed</td>
            </tr>

            <tr>
                <td>R-2111</td>
                <td>James Martinez</td>
                <td>james@example.com</td>
                <td>City Central Hotel</td>
                <td>2026-01-24</td>
                <td>2026-01-27</td>
                <td class="status cancelled">cancelled</td>
            </tr>

            <tr>
                <td>R-2155</td>
                <td>Patricia Lee</td>
                <td>patricia@example.com</td>
                <td>Oceanview Resort</td>
                <td>2026-01-25</td>
                <td>2026-01-29</td>
                <td class="status completed">completed</td>
            </tr>
        </tbody>
    </table>

</div>

@endsection