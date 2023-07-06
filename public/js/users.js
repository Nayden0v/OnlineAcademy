const roleSelect = document.getElementById('roleSelect');
const trainingSelect = document.getElementById('trainingSelect');

roleSelect.addEventListener('change', function() {
  const selectedRole = roleSelect.value;
  console.log(selectedRole);
  if(selectedRole == 4){
    trainingSelect.classList.remove('hidden');
  }else if(selectedRole == 1 || selectedRole == 5 || selectedRole == 'Select Role'){
    trainingSelect.classList.remove('block');
    trainingSelect.classList.add('hidden');
  }
});
