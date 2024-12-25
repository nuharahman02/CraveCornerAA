// script.js
// Add interactive functionality if needed, like search or dynamic data
document.querySelector('.search-bar input').addEventListener('input', function (e) {
    const searchValue = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
      const customerName = row.children[3].textContent.toLowerCase();
      if (customerName.includes(searchValue)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
  