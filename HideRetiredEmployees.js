const tbody = document.getElementsByTagName('tbody');
const row = document.querySelectorAll('tbody tr');

const retired = {
    value: "retired",
    checkbox: document.getElementById('filterRetired'),
}

function filterTable () {
    for (let i = 0; i < row.length;i++){
        if (retired.checkbox.checked == false){
            let col = row[i].getElementsByTagName('td')[0];
            if (col.textContent.indexOf(retired.value) > -1){
                row[i].style.display = 'none';
            }
            else {
                row[i].style.display = '';
            }
        }
        else{
            row[i].style.display = '';
        }
    }
}

retired.checkbox.addEventListener("checked", filterTable, false);
document.addEventListener("DOMContentLoaded", filterTable,)