@extends('layouts.admin')

@section('title', 'Admin | Users')

@section('content')

<h2>Users</h2>

<div class="table-card">

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            {{-- dummy data --}}
            <tr>
                <td>1</td>
                <td>John Smith</td>
                <td>john@example.com</td>
                <td>user</td>
                <td class="status active">active</td>
            </tr>

            <tr>
                <td>2</td>
                <td>Admin User</td>
                <td>admin@example.com</td>
                <td>admin</td>
                <td class="status active">active</td>
            </tr>

            <tr>
                <td>3</td>
                <td>Sarah Johnson</td>
                <td>sarah@example.com</td>
                <td>user</td>
                <td class="status inactive">inactive</td>
            </tr>
        </tbody>

    </table>

</div>

@endsection
