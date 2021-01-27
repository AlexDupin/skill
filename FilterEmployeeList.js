var retired = {
  filter: document.getElementById('filterRetired'),
  value: 'retired'
};

var search = {
  filter: document.getElementById('employeeSearch'),
  value: document.getElementById('employeeSearch')
};

const table = {
  row: document.querySelector('#EmployeeList tbody').rows
};

function filterTable() {
  for (var i = 0; i < table.row.length; i++) {
    if (
      table.row[i].textContent.indexOf(retired.value) > -1 &&
      retired.filter.checked == false
    ) {
      table.row[i].style.display = 'none';
    } else if (
      table.row[i].textContent
        .toUpperCase()
        .indexOf(search.value.value.toUpperCase()) == -1
    ) {
      table.row[i].style.display = 'none';
    } else {
      table.row[i].style.display = '';
    }
  }
}

retired.filter.addEventListener('checked', filterTable);
search.filter.addEventListener('keyup', filterTable, false);

document.addEventListener('DOMContentLoaded', () => {
  filterTable();
  const rows = document.querySelectorAll('tr[data-href]');

  rows.forEach(row => {
    row.addEventListener('click', () => {
      console.log('click');
      window.location.replace(row.dataset.href);
    });
  });
});
