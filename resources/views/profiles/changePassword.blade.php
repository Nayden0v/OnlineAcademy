@extends('layout')
@section('content')
<div class="flex justify-center items-center relative top-20">
  <div class="w-96 p-6 border border-gray-300 rounded-md bg-white">
    <h2 class="text-center text-2xl mb-6">Change Password</h2>
    <form action="{{ route('changePassword.update') }}" method="POST">
      @csrf
      @method('PUT')
      <!-- Success Message -->
      @if (session('message'))
        <div class="alert alert-success mb-4">
          {{ session('message') }}
        </div>
      @endif
      <!-- Current Password -->
      <div class="mb-4">
        <label for="current_password" class="block font-bold text-gray-700">Current Password</label>
        <input type="password" id="current_password" name="current_password" class="form-input mt-1 block w-full">
        @error('current_password')
          <div class="text-red-600">{{ $message }}</div>
        @enderror
      </div>
      <!-- New Password -->
      <div class="mb-4">
        <label for="new_password" class="block font-bold text-gray-700">New Password</label>
        <input type="password" id="new_password" name="new_password" class="form-input mt-1 block w-full">
        @error('new_password')
          <div class="text-red-600">{{ $message }}</div>
        @enderror
      </div>
      <!-- Confirm New Password -->
      <div class="mb-4">
        <label for="new_password_confirmation" class="block font-bold text-gray-700">Confirm New Password</label>
        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-input mt-1 block w-full">
      </div>
      <!-- Update Password Button -->
      <div>
        <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Change Password</button>
      </div>
    </form>
  </div>
</div>
@endsection
