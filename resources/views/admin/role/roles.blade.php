@extends('Admin.dashboard')
@section('content2')
@include('utils.alert')
<div class="relative bottom-40 left-60 w-1/2 overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
      <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-4 font-large text-gray-900">
                <a href="{{ route('role.form') }}" class="flex items-center text-green-500 hover:text-green-700">
                    <svg class="h-8 w-8 text-green-600" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
                        <path d="M4 16v2a2 2 0 0 0 2 2h2" />
                        <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                        <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
                        <line x1="9" y1="12" x2="15" y2="12" />
                        <line x1="12" y1="9" x2="12" y2="15" />
                    </svg>
                    <span class="ml-2">Add Role</span>
                </a>
            </th>
          <th scope="col" class="px-6 py-4 font-large text-gray-900">Id</th>
          {{-- <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th> --}}
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 border-t border-gray-100">
        @foreach($roles as $role)
        <tr class="hover:bg-gray-50">
        <td class="px-6 py-4">{{ $role->name }}</td>
          <td class="flex gap-4 px-6 py-4 font-normal text-gray-900">
            <div class="text-sm">
              <div class="font-medium text-gray-700">{{ $role->id }}</div>
            </div>
          </td>
          <td class="px-6 py-4">
            <div class="flex justify-end w-full gap-4">
                <form action="{{ route('role.edit',['id'=>$role->id]) }}" method="GET">
                @csrf
                @method('PUT')
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-7 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                </form>
                <form action="{{ route('role.delete',['id'=>$role->id]) }}" method="POST">
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
    {{ $roles->links() }}
  </div>
@endsection
