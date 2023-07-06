@extends('admin.dashboard')
@section('content2')
<form method="POST" action="{{ route('role.update', ['id'=>$role->id]) }}">
    @csrf
    @method('PUT')
    <div class="relative bottom-40 left-60 w-3/4 h-1/2 overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
      <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Role</th>
            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Id</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
          <tr class="hover:bg-gray-50">
            <td class="flex gap-4 px-6 py-4 font-normal text-gray-900">
              <div class="text-sm">
                <div class="font-medium text-gray-700">
                  <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="name" type="text" id="name" value="{{ $role->name }}">
                </div>
              </div>
            </td>
            <td class="px-4 py-4">
              <div class="text-sm">
                <div class="text-gray-400">
                  <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-70 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="id" type="number" id="id" value="{{ $role->id }}">
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <div class="flex justify-end gap-4">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
</form>
  {{-- <script src="{{ asset('js/users.js') }}"></script> --}}
    @endsection
