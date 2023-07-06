
// ------------------------------- Sutdents dynamic row -------------------------------
function addLanguageScore() {
var languageInput = document.getElementById('language');
var scoreInput = document.getElementById('languageScore');
var language = languageInput.value;
var score = scoreInput.value;

if (language !== '' && score !== '') {
var listItem = document.createElement('li');
listItem.classList.add('mb-4', 'flex', 'justify-between', 'border-black-500');

var languageContent = document.createElement('div');
languageContent.classList.add('flex', 'flex-col');

var languageElement = document.createElement('h2');
languageElement.textContent = language;
languageElement.classList.add('text-xl', 'font-bold', 'mb-2', 'text-gray-800');
languageContent.appendChild(languageElement);

var scoreElement = document.createElement('p');
scoreElement.textContent = score;
scoreElement.classList.add('mb-4', 'text-gray-600');
languageContent.appendChild(scoreElement);

listItem.appendChild(languageContent);

var deleteButton = document.createElement('button');
deleteButton.textContent = 'Delete';
deleteButton.classList.add('py-2', 'px-4', 'max-h-10', 'rounded', 'border', 'border-gray-300', 'bg-red-500', 'text-white');
deleteButton.addEventListener('click', function() {
listItem.remove();
});

listItem.appendChild(deleteButton);

var languageList = document.getElementById('languageScoreList');
languageList.appendChild(listItem);

languageInput.value = '';
scoreInput.value = '';

// Hide fields by adding hidden inputs
var hiddenLanguageInput = document.createElement('input');
hiddenLanguageInput.type = 'hidden';
hiddenLanguageInput.name = 'language[]';
hiddenLanguageInput.value = language;
listItem.appendChild(hiddenLanguageInput);

var hiddenScoreInput = document.createElement('input');
hiddenScoreInput.type = 'hidden';
hiddenScoreInput.name = 'score[]';
hiddenScoreInput.value = score;
listItem.appendChild(hiddenScoreInput);
}
}

function addRepository() {
  var repositoryInput = document.getElementById('repository');
var repositoryList = document.getElementById('repositoryList');
var repository = repositoryInput.value;

if (repository !== '') {
var listItem = document.createElement('li');
listItem.classList.add('mb-4', 'flex', 'justify-between', 'border-black-500');

var repositoryContent = document.createElement('div');
repositoryContent.classList.add('flex', 'flex-col');

var repositoryElement = document.createElement('h2');
repositoryElement.textContent = repository;
repositoryElement.classList.add('text-xl', 'font-bold', 'mb-2', 'text-gray-800');
repositoryContent.appendChild(repositoryElement);

listItem.appendChild(repositoryContent);

var deleteButton = document.createElement('button');
deleteButton.textContent = 'Delete';
deleteButton.classList.add('py-2', 'px-4', 'max-h-10', 'rounded', 'border', 'border-gray-300', 'bg-red-500', 'text-white');
deleteButton.addEventListener('click', function() {
listItem.remove();
});

listItem.appendChild(deleteButton);

repositoryList.appendChild(listItem);

repositoryInput.value = '';

// Hide fields by adding hidden inputs
var hiddenRepositoryInput = document.createElement('input');
hiddenRepositoryInput.type = 'hidden';
hiddenRepositoryInput.name = 'repository[]';
hiddenRepositoryInput.value = repository;
listItem.appendChild(hiddenRepositoryInput);
}
}

function addWebPage() {
  var webPageInput = document.getElementById('Name');
  var urlInput = document.getElementById('url');
  var webPageName = webPageInput.value;
  var url = urlInput.value;

  if (webPageName !== '' && url !== '') {
    var listItem = document.createElement('li');
    listItem.classList.add('mb-4', 'flex', 'justify-between', 'border-black-500');

    var webPageContent = document.createElement('div');
    webPageContent.classList.add('flex', 'flex-col');

    var webPageElement = document.createElement('h2');
    webPageElement.textContent = webPageName;
    webPageElement.classList.add('text-xl', 'font-bold', 'mb-2', 'text-gray-800');
    webPageContent.appendChild(webPageElement);

    var urlElement = document.createElement('p');
    urlElement.textContent = url;
    urlElement.classList.add('mb-4', 'text-gray-600');
    webPageContent.appendChild(urlElement);

    listItem.appendChild(webPageContent);

    var deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.classList.add('py-2', 'px-4', 'max-h-10', 'rounded', 'border', 'border-gray-300', 'bg-red-500', 'text-white');
    deleteButton.addEventListener('click', function () {
      listItem.remove();
    });

    listItem.appendChild(deleteButton);

    var webPageList = document.getElementById('webPageList');
    webPageList.appendChild(listItem);

    webPageInput.value = '';
    urlInput.value = '';

    // Hide fields by adding hidden inputs
    var hiddenWebPageInput = document.createElement('input');
    hiddenWebPageInput.type = 'hidden';
    hiddenWebPageInput.name = 'name[]';
    hiddenWebPageInput.value = webPageName;
    listItem.appendChild(hiddenWebPageInput);

    var hiddenUrlInput = document.createElement('input');
    hiddenUrlInput.type = 'hidden';
    hiddenUrlInput.name = 'url[]';
    hiddenUrlInput.value = url;
    listItem.appendChild(hiddenUrlInput);
  }
}


function addSkill() {
  var skillInput = document.getElementById('skill');
  var skillList = document.getElementById('skillsList');
var skill = skillInput.value;

if (skill !== '') {
var listItem = document.createElement('li');
listItem.classList.add('mb-4', 'flex', 'justify-between', 'border-black-500');

var skillContent = document.createElement('div');
skillContent.classList.add('flex', 'flex-col');

var skillElement = document.createElement('h2');
skillElement.textContent = skill;
skillElement.classList.add('text-xl', 'font-bold', 'mb-2', 'text-gray-800');
skillContent.appendChild(skillElement);

listItem.appendChild(skillContent);

var deleteButton = document.createElement('button');
deleteButton.textContent = 'Delete';
deleteButton.classList.add('py-2', 'px-4', 'max-h-10', 'rounded', 'border', 'border-gray-300', 'bg-red-500', 'text-white');
deleteButton.addEventListener('click', function() {
listItem.remove();
});

listItem.appendChild(deleteButton);

skillList.appendChild(listItem);

skillInput.value = '';

// Hide fields by adding hidden inputs
var hiddenSkillInput = document.createElement('input');
hiddenSkillInput.type = 'hidden';
hiddenSkillInput.name = 'skill[]';
hiddenSkillInput.value = skill;
listItem.appendChild(hiddenSkillInput);
}

}


function addHobby() {
var hobbyInput = document.getElementById('hobby');
var hobbyList = document.getElementById('hobbyList');
var hobby = hobbyInput.value;

if (hobby !== '') {
var listItem = document.createElement('li');
listItem.classList.add('mb-4', 'flex', 'justify-between', 'border-black-500');

var hobbyContent = document.createElement('div');
hobbyContent.classList.add('flex', 'flex-col');

var hobbyElement = document.createElement('h2');
hobbyElement.textContent = hobby;
hobbyElement.classList.add('text-xl', 'font-bold', 'mb-2', 'text-gray-800');
hobbyContent.appendChild(hobbyElement);

listItem.appendChild(hobbyContent);

var deleteButton = document.createElement('button');
deleteButton.textContent = 'Delete';
deleteButton.classList.add('py-2', 'px-4', 'max-h-10', 'rounded', 'border', 'border-gray-300', 'bg-red-500', 'text-white');
deleteButton.addEventListener('click', function() {
listItem.remove();
});

listItem.appendChild(deleteButton);

hobbyList.appendChild(listItem);

hobbyInput.value = '';

// Hide fields by adding hidden inputs
var hiddenHobbyInput = document.createElement('input');
hiddenHobbyInput.type = 'hidden';
hiddenHobbyInput.name = 'hobby[]';
hiddenHobbyInput.value = hobby;
listItem.appendChild(hiddenHobbyInput);
}
}


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
  deleteButton.textContent = 'X';
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


function addTraining() {
    const trainingsSelect = document.getElementById('trainings');
    const selectedTrainingId = trainingsSelect.value;

    if (selectedTrainingId) {
      const trainingList = document.getElementById('trainingList');
      const existingTrainingItems = trainingList.getElementsByTagName('li');

      for (let i = 0; i < existingTrainingItems.length; i++) {
        const existingTrainingId = existingTrainingItems[i].dataset.trainingId;
        if (existingTrainingId === selectedTrainingId) {
          return;
        }
      }

      const listItem = document.createElement('li');
      listItem.textContent = trainingsSelect.options[trainingsSelect.selectedIndex].text;
      listItem.classList.add('bg-gray-100', 'p-2', 'mb-2', 'rounded', 'flex', 'items-center');
      listItem.setAttribute('data-training-id', selectedTrainingId);
      trainingList.appendChild(listItem);

      const selectedTrainingsInput = document.getElementById('selectedTrainings');
      const selectedTrainings = selectedTrainingsInput.value;
      const updatedSelectedTrainings = selectedTrainings ? selectedTrainings + ',' + selectedTrainingId : selectedTrainingId;
      selectedTrainingsInput.value = updatedSelectedTrainings;

      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'X';
      deleteButton.classList.add('delete-button', 'ml-auto', 'w-1/8', 'py-2', 'px-4', 'rounded', 'border', 'border-gray-300', 'bg-red-500', 'text-white');
      deleteButton.addEventListener('click', function() {
        listItem.remove();
        const updatedTrainings = selectedTrainingsInput.value.split(',').filter(id => id !== selectedTrainingId).join(',');
        selectedTrainingsInput.value = updatedTrainings;
      });
      listItem.appendChild(deleteButton);
    }

}
bindDeleteButtonEvent(); // Bind event for all delete buttons

  function bindDeleteButtonEvent() {
    const deleteButtons = document.getElementsByClassName('delete-button');
    for (let i = 0; i < deleteButtons.length; i++) {
        const deleteButton = deleteButtons[i];
        deleteButton.addEventListener('click', function() {
          console.log('kor');
        const listItem = deleteButton.parentElement;
        const selectedTrainingId = listItem.dataset.trainingId;
        const selectedTrainingsInput = document.getElementById('selectedTrainings');
        const updatedTrainings = selectedTrainingsInput.value.split(',').filter(id => id !== selectedTrainingId).join(',');
        selectedTrainingsInput.value = updatedTrainings;
        listItem.remove();
      });
    }
  }













