
const tds = document.querySelectorAll('td.px-6.py-4.relative');

tds.forEach((td) => {
  td.addEventListener('click', () => {
    const popup = td.querySelector('.resume-popup');
    popup.style.display = 'block';

    setTimeout(() => {
      popup.style.display = 'none';
    }, 3000);
  });
});

document.addEventListener('click', (event) => {
  tds.forEach((td) => {
    const popup = td.querySelector('.resume-popup');
    if (!popup.contains(event.target) && !td.contains(event.target)) {
      popup.style.display = 'none';
    }
  });
});
