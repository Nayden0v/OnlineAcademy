@extends('layout')
@section('content')
<div class="flex justify-center items-center relative top-20">
  <div class="w-96 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6 text-center">Profile Information</h1>
    <form action="{{ route('profileInformation.update') }}" method="POST">
      @csrf
      @method('PUT')
      <!-- Success Message -->
      @if (session('message'))
        <div class="alert alert-success mb-4">
          {{ session('message') }}
        </div>
      @endif
      <!-- First Name -->
      <div class="mb-4">
        <label for="first_name" class="block font-bold text-gray-700">First Name</label>
        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', optional($user->profile)->first_name) }}" class="form-input mt-1 block w-full">
      </div>
      <!-- Last Name -->
      <div class="mb-4">
        <label for="last_name" class="block font-bold text-gray-700">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', optional($user->profile)->last_name) }}" class="form-input mt-1 block w-full">
      </div>
      <!-- Email Address -->
      <div class="mb-4">
        <label for="email" class="block font-bold text-gray-700">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-input mt-1 block w-full">
      </div>
      <!-- Address -->
      <div class="mb-4">
        <label for="address" class="block font-bold text-gray-700">Address</label>
        <input type="text" id="address" name="address" value="{{ old('address', optional($user->profile)->address) }}" class="form-input mt-1 block w-full">
      </div>
      <!-- Phone Number -->
      <div class="mb-4">
        <label for="phone_number" class="block font-bold text-gray-700">Phone Number</label>
        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', optional($user->profile)->phone_number) }}" class="form-input mt-1 block w-full">
      </div>
      <!-- Update Profile Button -->
      <div>
        <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Profile</button>
      </div>
    </form>
  </div>
</div>
@endsection
