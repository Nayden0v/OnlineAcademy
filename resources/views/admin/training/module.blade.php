@extends('layout')
@section('content')
<div id="container" class="max-w-2xl mx-auto p-8 bg-gray-100">
@if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
      @endif
    <h1 class="text-2xl font-bold mb-4">Add/Edit MODULE</h1>
    <h1 class="text-xl font-bold mb-4"><a class="text-black hover:text-green-500" href="{{ route('training.table')}}">Назад </a></h1> <br>
    <form method="POST" action="{{ isset($module) ? route('module.update', ['training' => $training->id, 'module' => $module->id]) : route('module.store', ['id' => $training->id]) }}">
        @csrf
        @if(isset($module))
            <input type="hidden" name="_method" value="PUT">
        @endif
    <h1 class="text-2xl font-bold mb-4">Training title : {{ $training->select('title')->where('id', $training->id)->first()->title }}</h1>
      @csrf
      @if(isset($module))
      @else
      <label for="module_title" class="font-bold mb-2 block bg-green-500 p-2 rounded inline-block" id="add_module_title">+ ADD Module</label><br><br>
      @endif
      @if(isset($module))
    <input type="text" id="module_title" name="module_title" placeholder="Module Title" required class="w-full px-3 py-2 rounded border border-gray-300 mb-4" value="{{ $module->title }}">
      @else
    <input type="text" id="module_title" name="module_title[]" placeholder="Module Title" required class="w-full px-3 py-2 rounded border border-gray-300 mb-4" >
    @endif<br>
    @if(isset($module))
    <textarea id="module_description" name="description" placeholder="Description" required class="w-full px-3 py-2 rounded border border-gray-300 mb-4">{{ $module->description }}</textarea>
    @else
    <textarea id="module_description" name="description[]" placeholder="Description" required class="w-full px-3 py-2 rounded border border-gray-300 mb-4"></textarea>
    @endif
<br><br>
      <ul id="module_list"></ul>
      <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded float-right">SAVE</button>
    </form>
  </div>
  <script>
    var addModuleButton = document.getElementById('add_module_title');
    addModuleButton.addEventListener('click', function() {
    var moduleTitleInput = document.getElementById('module_title');
    var moduleDescriptionInput = document.getElementById('module_description');
    var moduleTitle = moduleTitleInput.value;
    var moduleDescription = moduleDescriptionInput.value;
    if (moduleTitle !== '' && moduleDescription !== '') {
    var listItem = document.createElement('li');
    listItem.classList.add('mb-4', 'flex', 'justify-between', 'border-black-500');
    var moduleContent = document.createElement('div');
    moduleContent.classList.add('flex', 'flex-col');
    var titleElement = document.createElement('h2');
    titleElement.textContent = moduleTitle;
    titleElement.classList.add('text-xl', 'font-bold', 'mb-2', 'text-gray-800');
    moduleContent.appendChild(titleElement);
    var descriptionElement = document.createElement('p');
    descriptionElement.textContent = moduleDescription;
    descriptionElement.classList.add('mb-4', 'text-gray-600');
    moduleContent.appendChild(descriptionElement);
    listItem.appendChild(moduleContent);
    var deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.classList.add('py-2', 'px-4', 'max-h-10', 'rounded', 'border', 'border-gray-300', 'bg-red-500', 'text-white');
    deleteButton.addEventListener('click', function() {
      listItem.remove();
    });
    listItem.appendChild(deleteButton);
    var moduleList = document.getElementById('module_list');
    moduleList.appendChild(listItem);
    moduleTitleInput.value = '';
    moduleDescriptionInput.value = '';
    //скрити полета
    var hiddenTitleInput = document.createElement('input');
    hiddenTitleInput.type = 'hidden';
    hiddenTitleInput.name = 'module_title[]';
    hiddenTitleInput.value = moduleTitle;
    listItem.appendChild(hiddenTitleInput);
    var hiddenDescriptionInput = document.createElement('input');
    hiddenDescriptionInput.type = 'hidden';
    hiddenDescriptionInput.name = 'description[]';
    hiddenDescriptionInput.value = moduleDescription;
    listItem.appendChild(hiddenDescriptionInput);
   }
  });
</script>
  <script src="{{ asset('js/app.js') }}"></script>
@endsection
