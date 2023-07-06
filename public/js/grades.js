
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

let trainingsDropdown = document.getElementById('trainings');
let modulesDropdown = document.getElementById('modules');
let lecturesDropdown = document.getElementById('lectures');
let studentsDropdown = document.getElementById('student');
let homeworkTable = document.getElementById('homework-table-body');
let lectureDateElement = document.getElementById('lecture_date');
let absenceContainer = document.getElementById('absence_container');


fetch('/trainings/fetch')
  .then(response => response.json())
  .then(data => {
    console.log(data);
    populateTrainings(trainingsDropdown, data);
  })
  .catch(error => {
    console.error('Error:', error);
  });

function populateTrainings(dropdown, options) {
  dropdown.innerHTML = '';

  let defaultOption = document.createElement('option');
  defaultOption.selected = true;
  defaultOption.textContent = 'Select training';
  dropdown.appendChild(defaultOption);

  options.forEach(function (option) {
    let optionElement = document.createElement('option');
    optionElement.value = option.id;
    optionElement.textContent = option.title;
    dropdown.appendChild(optionElement);
  });
}

//Populate Modules
trainingsDropdown.addEventListener('change', function () {
  let selectedTraining = this.value;

  document.getElementById('training_id').value = selectedTraining;

  studentsDropdown.style.display = 'block';
  lecturesDropdown.style.display = 'none';

  if (selectedTraining === 'Select training') {
    lectureDateElement.innerHTML = '';
    modulesDropdown.style.display = 'none';
    studentsDropdown.style.display = 'none';
    document.getElementById('average-training-grade').textContent = '';
    return;
  }

  modulesDropdown.innerHTML = '<option selected>Select module</option>';
  studentsDropdown.innerHTML = '<option selected>Select student</option>';

  fetch('/modules/fetch', {
    method: 'POST',
    body: JSON.stringify({ training_id: selectedTraining }),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken
    }
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      populateModules(modulesDropdown, data);
      modulesDropdown.style.display = 'block';
    })
    .catch(error => {
      console.error('Error:', error);
    });

  fetch('/trainings/' + selectedTraining + '/students')
    .then(response => response.json())
    .then(data => {
      populateStudents(studentsDropdown, data);
    })
    .catch(error => {
      console.error('Error:', error);
    });
});

function populateModules(dropdown, options) {
  dropdown.innerHTML = '';

  let defaultOption = document.createElement('option');
  defaultOption.selected = true;
  defaultOption.textContent = 'Select module';
  dropdown.appendChild(defaultOption);

  options.forEach(function (option) {
    let optionElement = document.createElement('option');
    optionElement.value = option.id;
    optionElement.textContent = option.title;
    dropdown.appendChild(optionElement);
  });
}

function populateStudents(dropdown, options) {
  dropdown.innerHTML = '';

  let defaultOption = document.createElement('option');
  defaultOption.selected = true;
  defaultOption.textContent = 'Select student';
  dropdown.appendChild(defaultOption);

  options.forEach(function (option) {
    let optionElement = document.createElement('option');
    optionElement.value = option.id;
    optionElement.textContent = option.first_name;
    dropdown.appendChild(optionElement);
  });
}

studentsDropdown.addEventListener('change', function () {
    let selectedStudent = this.value;
    document.getElementById('student_id').value = selectedStudent;
    let selectedTraining = trainingsDropdown.value;

    if (selectedStudent === 'Select student' || selectedTraining === 'Select training') {
      document.getElementById('average-training-grade').textContent = '';
      return;
    }

    fetch('/students/' + selectedStudent + '/trainings/' + selectedTraining + '/average-grade')
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        console.log('trainings:',data)
        document.getElementById('average-training-grade').textContent = data.average_grade_training;
      })
      .catch(error => {
        console.error('Error:', error);
      });
});

// Populate lectures
modulesDropdown.addEventListener('change', function () {
  let selectedModule = this.value;
  let selectedTraining = trainingsDropdown.value;
  let selectedStudent = studentsDropdown.value;
  document.getElementById('module_id').value = selectedModule;

  if (selectedModule == 'Select module') {
    lecturesDropdown.style.display = 'none';
    document.getElementById('average-module-grade').textContent = '';
    document.getElementById('average-lecture-grade').textContent = '';
    return;
  }

  lecturesDropdown.innerHTML = '<option selected>Select lecture</option>';

  fetch('/modules/' + selectedModule + '/trainings/' + selectedTraining + '/students/' + selectedStudent + '/average-grade')
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    console.log('module:',data)
    document.getElementById('average-module-grade').textContent = data.average_grade_module;
    document.getElementById('average-lecture-grade').textContent = '';
  })
  .catch(error => {
    console.error('Error:', error);
  });

  fetch('/lectures/fetch', {
    method: 'POST',
    body: JSON.stringify({ module_id: selectedModule }),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken
    }
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      populateLectures(lecturesDropdown, data);
      lecturesDropdown.style.display = 'block';
    })
    .catch(error => {
      console.error('Error:', error);
    });
});

function populateLectures(dropdown, options) {
  dropdown.innerHTML = '';

  let defaultOption = document.createElement('option');
  defaultOption.selected = true;
  defaultOption.textContent = 'Select lecture';
  dropdown.appendChild(defaultOption);

  options.forEach(function (option) {
    let optionElement = document.createElement('option');
    optionElement.value = option.id;
    optionElement.textContent = option.title;
    optionElement.dataset.date = option.date;
    dropdown.appendChild(optionElement);
  });
}


lecturesDropdown.addEventListener('change', function () {
    let selectedLecture = this.value;
    document.getElementById('lecture_id').value = selectedLecture;

    let selectedModule = modulesDropdown.value;
    let selectedTraining = trainingsDropdown.value;
    let selectedStudent = studentsDropdown.value;

    // Check if the selected lecture is the default "Select lecture" option
    if (selectedLecture == 'Select lecture') {
      homeworkTable.style.display = 'none';
      absenceContainer.style.display = 'none';
      document.getElementById('average-lecture-grade').textContent = '';
      return;
    }

    // Hide the homework table
    homeworkTable.style.display = 'none';
    absenceContainer.style.display = 'none';

    fetch('/lectures/' + selectedLecture + '/modules/' + selectedModule + '/trainings/' + selectedTraining + '/students/' + selectedStudent + '/average-grade')
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        console.log('lectures:', data);
        document.getElementById('average-lecture-grade').textContent = data.average_grade_lecture;


        if (data.average_grade_lecture !== null) {

          homeworkTable.style.display = 'none';
          absenceContainer.style.display = 'none';
        } else {

          homeworkTable.style.display = 'table-row-group';
          absenceContainer.style.display = 'block';
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });

  fetch('/homework/fetch', {
    method: 'POST',
    body: JSON.stringify({ lecture_id: selectedLecture }),
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken
    }
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      updateHomeworkTable(homeworkTable, data);
      let selectedOption = lecturesDropdown.options[lecturesDropdown.selectedIndex];
      let lectureDate = selectedOption.dataset.date;
      lectureDateElement.innerHTML ='Lecture date:' + '<br>' + lectureDate;
    })
    .catch(error => {
      console.error('Error:', error);
    });
});



function updateHomeworkTable(table, data) {
    table.innerHTML = '';

    let homeworkIds = [];
    let gradeInputs = [];

    data.forEach(function (row) {
      homeworkIds.push(row.id);
      let newRow = document.createElement('tr');
      newRow.classList.add('bg-white', 'border-b', 'dark:bg-gray-800', 'dark:border-gray-700');

      let titleCell = document.createElement('td');
      titleCell.setAttribute('scope', 'row');
      titleCell.classList.add('px-6', 'py-4', 'font-medium', 'text-gray-900', 'whitespace-nowrap', 'dark:text-white');
      titleCell.textContent = row.title;
      newRow.appendChild(titleCell);

      let actionCell = document.createElement('td');
      actionCell.classList.add('px-6', 'py-4');

      let actionDiv = document.createElement('div');
      actionDiv.classList.add('flex');

      let hasHomeworkDiv = createCheckboxDiv('has_homework', 'has_homework', row.id);
      let notWorkingDiv = createCheckboxDiv('not_working', 'not_working', row.id);
      let onTimeDiv = createCheckboxDiv('on_time', 'on_time', row.id);

      actionDiv.appendChild(hasHomeworkDiv);
      actionDiv.appendChild(notWorkingDiv);
      actionDiv.appendChild(onTimeDiv);

      newRow.setAttribute('data-homework-id', row.id);
      actionCell.appendChild(actionDiv);
      newRow.appendChild(actionCell);

      let gradeCell = document.createElement('td');
      gradeCell.classList.add('px-6', 'py-4');

      let gradeInput = document.createElement('input');
      gradeInput.classList.add('w-20', 'h-10', 'bg-gray-100', 'border-gray-300', 'rounded', 'focus:ring-blue-500');
      gradeInput.setAttribute('type', 'number');
      gradeInput.setAttribute('step', 'any');
      gradeInput.setAttribute('name', 'grade[]');

      gradeInputs.push(gradeInput);

      gradeCell.appendChild(gradeInput);
      newRow.appendChild(gradeCell);

      table.appendChild(newRow);
    });

    document.getElementById('homework_id').value = homeworkIds;

    gradeInputs.forEach(function (gradeInput) {
      gradeInput.addEventListener('input', calculateAverage);
    });
  }

  function calculateAverage() {
    let sum = 0;
    let count = 0;

    let gradeInputs = document.getElementsByName('grade[]');

    gradeInputs.forEach(function (input) {
      if (input.value !== '') {
        sum += parseFloat(input.value);
        count++;
      }
    });

    let average = count > 0 ? sum / count : 0;

    document.getElementById('lectureGrade').textContent = average.toFixed(2);
  }


  function createCheckboxDiv(name, label, id) {
    let div = document.createElement('div');
    div.classList.add('flex-1', 'items-center', 'pl-4');

    let checkbox = document.createElement('input');
    checkbox.setAttribute('id', name + '_' + id);
    checkbox.setAttribute('type', 'checkbox');
    checkbox.setAttribute('value', 'false');
    checkbox.setAttribute('name', name + '_' + id);
    checkbox.classList.add('w-4', 'h-4', 'text-blue-600', 'bg-gray-100', 'border-gray-300', 'rounded', 'focus:ring-blue-500', 'dark:focus:ring-blue-600', 'dark:ring-offset-gray-800', 'focus:ring-2', 'dark:bg-gray-700', 'dark:border-gray-600');

    let checkboxLabel = document.createElement('label');
    checkboxLabel.setAttribute('for', name + '_' + id);
    checkboxLabel.classList.add('w-full', 'py-4', 'ml-2', 'text-sm', 'font-medium', 'text-gray-900', 'dark:text-gray-300');
    checkboxLabel.textContent = label;

    div.appendChild(checkbox);
    div.appendChild(checkboxLabel);

    return div;
  }
