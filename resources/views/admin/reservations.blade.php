@extends('layouts.admin')

@section('title', 'Admin | Reservations')

@section('content')

    <h2>Reservations</h2>

    <div class="container">
        <form method="GET" action="#">
            <div class="row align-items-end g-3">
                {{-- SEARCH Guest --}}
                <div class="col-md-6">
                    <label for="form-label">SEARCH GUEST</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Search by name">
                    </div>
                </div>

                <div class="col-md-3">
                        <div class="date-input-wrapper">
                            <label>Check-in / Out:</label>
                            <input type="text" id="date_range" name="date_range" placeholder="Select Date" readonly>
                        </div>
                </div>

                {{-- Account Status --}}
                <div class="col-md-3">
                    <label for="status" class="form-label">All STATUS</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">ALL STATUS</option>
                        <option value="active" {{ request('status') == 'confirmed' ?: '' }}>Confirmed</option>
                        <option value="inactive" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="inactive" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary mt-2">Filter</button>
                </div>

            </div>
        </form>
    </div>

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
