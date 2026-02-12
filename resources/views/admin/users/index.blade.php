@extends('layouts.admin')

@section('title', 'Admin | Users')

@section('content')

<h2>User Management</h2>

{{-- KPI CARDS --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <p>Total Guests</p>
            <h2>8</h2>
        </div>

        <div class="kpi-card highlight">
            <p>VIP Guests</p>
            <h2>4</h2>
        </div>

        <div class="kpi-card">
            <p>High-Value (&gt;6.5k)</p>
            <h2>4</h2>
        </div>

        <div class="kpi-card danger">
            <p>Flagged Guests</p>
            <h2>2</h2>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-end g-3">
            {{-- SEARCH Guest --}}
            <div class="col-md-6">
                <label for="form-label">SEARCH GUEST</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>

                        <input type="text" class="form-control" placeholder="Search by name">
                    </div>
            </div>

            {{-- Guest Tier --}}
            <div class="col-md-3">
                <label for="tier" class="form-label">GUEST TIER</label>
                    <select name="tier" id="tier" class="form-select">
                        <option value="">All TIERS</option>

                        <option value="vip">VIP</option>
                        <option value="repeat">Repeat</option>
                        <option value="first-time">First-time</option>
                    </select>
            </div>

            {{-- Account Status --}}
            <div class="col-md-3">
                <label for="status" class="form-label">All STATUS</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">ALL STATUS</option>

                        <option value="active">Active</option>
                        <option value="deactive">Deactive</option>
                    </select>
            </div>
        
        </div>
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

            {{-- dammy data  --}}
            <tbody>
                <tr>
                    <td>001</td>
                    <td>John Smith</td>
                    <td><span class="badge vip">VIP</span></td>
                    <td>$45,000</td>
                    <td>2025-12-02</td>
                    <td><span class="badge active">Active</span></td>
                    <td></td>
                    <td class="actions">⋯</td>
                </tr>

                <tr>
                    <td>002</td>
                    <td>Noah Clark</td>
                    <td><span class="badge vip">VIP</span></td>
                    <td>$32,500</td>
                    <td>2025-12-17/td>
                    <td><span class="badge active">Active</span></td>
                    <td></td>
                    <td class="actions">⋯</td>
                </tr>

                <tr>
                    <td>003</td>
                    <td>Sarah Johnson</td>
                    <td><span class="badge repeat">Repeat</span></td>
                    <td>$4,200</td>
                    <td>2025-12-29</td>
                    <td><span class="badge inactive">Deactive</span></td>
                    <td></td>
                    <td class="actions">⋯</td>
                </tr>

                <tr>
                    <td>004</td>
                    <td>Ava Stone</td>
                    <td><span class="badge first">First-time</span></td>
                    <td>$1,850</td>
                    <td>2026-01-05</td>
                    <td><span class="badge inactive">Deactive</span></td>
                    <td></td>
                    <td class="actions">⋯</td>
                </tr>
            </tbody>

        </table>
    </div>

@endsection
