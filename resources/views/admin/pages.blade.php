@extends('layout')
@section('content')
<div class="container mx-auto py-6 px-3 mt-1">
    <h1 class="text-3xl mb-4 font-bold text-left pr-4">Roles and Menu Items</h1>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="mt-6">
        <label for="role" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Select Role</label>
        <select id="role" class="w-full p-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option selected>Select Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
    </div>
    <h2 class="text-2xl mb-4 font-bold text-left pr-4 mt-6">Menu Items</h2>
    @foreach($menuItems as $menuItem)
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>{{ ucfirst($menuItem->name) }}</div>
                <div>
                    <button onclick="assignMenuToRole(event, {{ $menuItem->id }})" class="btn btn-primary add-menu"><i class="fas fa-plus"></i></button>
                    <button onclick="removeMenuFromRole(event, {{ $menuItem->id }})" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>
    @endforeach
    <form id="newMenuItemForm" onsubmit="event.preventDefault(); createMenuItem(event);">
        <label for="newMenuItem" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Add New Menu Item</label>
        <input type="text" id="newMenuItem" class="w-full p-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <input type="text" id="newRoute" class="w-full p-2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <button type="submit" class="mt-2 btn btn-primary">Create</button>
    </form>
    <h2 class="text-2xl mb-4 font-bold text-left pr-4 mt-6">Assigned Items</h2>
    <div id="rolesTable" class="mt-8">
        <div class="border border-gray-300 rounded-lg p-5">
            @foreach($roles as $role)
                <p><strong>{{ ucfirst($role->name) }}</strong>: <span id="{{ $role->id }}-menu-items">{{ $role->menuItems->pluck('name')->implode(', ') }}</span></p>
            @endforeach
        </div>
    </div>
</div>
<script>
    var create_menu_item_route = "{{ route('create.menu.item') }}";
    var assign_menu_route = "{{ route('assign.menu.to.role') }}";
    var remove_menu_route = "{{ route('remove.menu.from.role') }}";
    var csrf_token = "{{ csrf_token() }}";
</script>
<script src="{{ asset('js/pages.js') }}"></script>
@endsection
