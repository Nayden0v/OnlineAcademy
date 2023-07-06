@extends('layout')
@section('title', 'Потребители')
@section('content')
<body class="antialiased bg-gray-100 dark:bg-gray-900">
    <div class="flex-col w-full md:flex md:flex-row">
        <div class="flex flex-col w-200 text-gray-700 bg-white md:w-64 dark:text-gray-200 dark:bg-gray-800" x-data="{ open: false }">
            <div class="flex-row items-center flex-shrink-0 px-4 py-4">
                <h1 class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">Assets</h1>
            </div>
                <nav class="md:block md:overflow-y-auto">
                    <a class="block px-4 py-2 mt-2 text-sm-50 font-semibold text-gray-900 bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('users.table') }}">Users</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('roles.table') }}">Roles</a>
                </nav>
        </div>
    </div>
    @yield('content2')
</body>
@endsection
