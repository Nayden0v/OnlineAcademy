@extends('Admin.dashboard')
@section('content2')
@include('utils.alert')
<div class="relative bottom-40 left-60 w-3/4 overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-4 font-large text-gray-900">Id</th>
          <th scope="col" class="px-6 py-4 font-large text-gray-900">Username</th>
          <th scope="col" class="px-6 py-4 font-large text-gray-900">Role</th>
          <th scope="col" class="px-6 py-4 font-large text-gray-900">Account Created On</th>
          <th scope="col" class="px-6 py-4 font-large text-gray-900"></th>
          {{-- <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th> --}}
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 border-t border-gray-100">
        @foreach($users as $user)
        <tr class="hover:bg-gray-50">
        <td class="px-6 py-4">{{ $user->id }}</td>
          <td class="flex gap-4 px-6 py-4 font-normal text-gray-900">
            <div class="text-sm">
              <div class="font-medium text-gray-700">{{ $user->name }}</div>
              <div class="text-gray-400">{{ $user->email }}</div>
            </div>
          </td>
          <td class="px-6 py-4">{{ $user->role()->first()->name }}</td>
          <td class="px-6 py-4">
            <div class="flex gap-1">
                {{ $user->created_at }}
            </div>
          </td>
          <td class="px-6 py-4">
            <div class="flex justify-end gap-4">
                <form action="{{ route('users.edit',['id'=>$user->id]) }}" method="GET">
                @csrf
                @method('PUT')
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-7 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                </form>
                <form action="{{ route('user.delete',['id'=>$user->id]) }}" method="POST">
                 @csrf
                @method('DELETE')
                    <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Delete</button>
                </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $users->links() }}
  </div>
@endsection
