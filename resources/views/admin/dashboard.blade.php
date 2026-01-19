@extends('layouts.admin')

@section('title', 'Admin | Dashboard')

@section('content')
  {{-- KPI cards --}}

  {{-- Quick actions --}}
  
  {{-- Tables --}}
  <h1>Admin Dashboard</h1>

  <form method="POST" action="/logout">
      @csrf
      <button type="submit">Logout</button>
  </form>

@endsection

