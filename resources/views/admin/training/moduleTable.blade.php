@extends('layout')
@section('content')
<h1 class="text-xl font-bold mb-4 ml-10">
    <a class="text-black hover:text-green-500" href="{{ route('training.table')}}">Назад</a>
</h1>
<div class="relative left-60 w-3/4 overflow-hidden rounded-lg border">
  <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
    <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Module Title</th>
            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Module Description</th>
            <th class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($training->modules()->where('training_id', $training->id)->get() as $module)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap">{{ $module->title }}</td>
                <td class="px-6 py-4 whitespace-no-wrap">{{ $module->description }}</td>
                <td class="px-6 py-4 whitespace-no-wrap">
                    <div class="flex gap-4">
                        <a href="{{ route('module.edit', ['module' => $module->id, 'training' => $training->id]) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <form action="{{ route('module.destroy', $module->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash transform hover:scale-110" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>


@endsection