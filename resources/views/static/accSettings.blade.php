@extends('layout')
@section('content')
<div class="flex justify-center items-center relative top-20">
  <div class="w-96 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6 text-center">Account Settings</h1>
    <!-- Tab Navigation -->
    <div class="mb-6">
      <ul class="divide-y divide-gray-200">
        <li class="py-2">
          <a href="{{ route('profileInformation.show') }}" class="block text-center py-2 px-4 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">Change Profile Information</a>
        </li>
        <li class="py-2">
          <a href="{{ route('changePassword.show') }}" class="block text-center py-2 px-4 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">Change Password</a>
        </li>
      </ul>
    </div>
  </div>
</div>
@endsection
