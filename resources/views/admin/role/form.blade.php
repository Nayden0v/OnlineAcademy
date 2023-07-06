@extends('Admin.dashboard')
@section('content2')
@include('utils.alert')
<div id="container" class="relative bottom-40 w-1/2 mx-auto p-8 bg-gray-100">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h1 class="text-xl font-bold mb-4">Add Role</h1> <br>
    <form method="POST" action="{{ route('role.create') }}">
      @csrf

      <input type="text" id="name" name="name" placeholder="Role name" required class="w-1/4 px-3 py-2 rounded border border-gray-300 mb-4" value=""><br>
      <button type="submit" class="relative bottom-12 bg-green-500 text-white px-4 py-2 rounded float-right">SAVE</button>
    </form>
  </div>
  @endsection
