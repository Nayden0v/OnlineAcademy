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
