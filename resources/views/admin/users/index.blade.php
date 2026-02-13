@extends('layouts.admin')

@section('title', 'Admin | Users')

@section('content')

<h2>User Management</h2>

{{-- KPI CARDS --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <p>Total Guests</p>
            <h2>{{ $totalGuests }}</h2>
        </div>

        <div class="kpi-card highlight">
            <p>VIP Guests</p>
            <h2>{{ $vipGuests }}</h2>
        </div>

        <div class="kpi-card">
            <p>High-Value (&gt;6.5k)</p>
            <h2>{{ $highValueGuests }}</h2>
        </div>

        <div class="kpi-card danger">
            <p>Flagged Guests</p>
            <h2>{{ $flaggedGuests }}</h2>
        </div>
    </div>

    <div class="container">
        <form method="GET" action="{{ route('admin.users.index') }}">
            <div class="row align-items-end g-3">
                {{-- SEARCH Guest --}}
                <div class="col-md-6">
                    <label for="form-label">SEARCH GUEST</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name">
                    </div>
                </div>

                {{-- Guest Tier --}}
                <div class="col-md-3">
                    <label for="tier" class="form-label">GUEST TIER</label>
                    <select name="tier" id="tier" class="form-select">
                        <option value="">All TIERS</option>
                        <option value="vip" {{ request('tier') == 'vip' ? 'selected' : '' }}>VIP</option>
                        <option value="repeat" {{ request('tier') == 'repeat' ? 'selected' : '' }}>Repeat</option>
                        <option value="first-time" {{ request('tier') == 'first-time' ? 'selected' : '' }}>First-time</option>
                    </select>
                </div>

                {{-- Account Status --}}
                <div class="col-md-3">
                    <label for="status" class="form-label">All STATUS</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">ALL STATUS</option>
                        <option value="active" {{ request('status') == 'active' ? : '' }}>Active</option>
                        <option value="inactive" {{request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary mt-2">Filter</button>
                </div>
            
            </div>
        </form>
    </div>

    {{-- USERS TABLE --}}
    <div class="table-card">
        <table class="admin-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Tier</th>
                    <th>Total Spend</th>
                    <th>Last Stay</th>
                    <th>Status</th>
                    <th>Flag</th>
                    <th>Actions</th>
                </tr>
            </thead>

            {{-- stlore data  --}}
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td><span class="badge {{ strtolower($user->tier) }}">{{ $user->tier }}</span></td>
                        <td>${{ number_format($user->total_spend) }}</td>
                        <td>{{ $user->last_stay }}</td>
                        <td><span class="badge {{ strtolower($user->status) }}">{{ $user->status }}</span></td>
                        <td></td>
                        <td class="actions">
                            <div class="dropdown">
                                <button class="btn btn-link text-dark shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal{{ $user->id }}">View Guest Profile</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#memoModal{{ $user->id}}">Add / Edit Memo</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#vipModal{{ $user->id }}">
                                            {{ $user->tier === 'VIP' ? 'Unmark as VIP' : 'Mark as VIP' }}
                                        </button>
                                    </li>
                                    <li><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#restrictModal{{ $user->id }}">Restrict Account</button></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    
                    <div class="modal fade" id="memoModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.users.update_memo', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Admin Memo for {{ $user->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea name="memo" class="form-control" rows="5" placeholder="Enter memo here">{{ $user->admin_memo}}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- view guest profile --}}
                    <div class="modal fade" id="profileModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Guest Profile: {{ $user->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-4">
                                        <label class="text-muted small uppercase">Guest ID</label>
                                        <p class="fw-bold">G{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</p>
                                    </div>

                                    <div class="mb-4">
                                        <label class="text-muted small">Email Address</label>
                                        <p>{{ $user->email }}</p>
                                    </div>

                                    <div class="mb-4">
                                        <label class="text-muted small">Phone Number</label>
                                        <p>{{ $user->phone_number ?? 'Not provided' }}</p>
                                    </div>

                                    <div class="mb-4">
                                        <label class="text-muted small">Registered Date</label>
                                        <p>{{ $user->created_at->format('Y-m-d') }}</p>
                                    </div>

                                    <hr>

                                    <div class="mb-2">
                                        <label class="text-muted small">Admin Memo</label>
                                        <div class="p-3 bg-light border rounded shadow-sm">
                                            {{ $user->admin_memo ?? 'No internal notes found.' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>

        </table>
    </div>

@endsection
