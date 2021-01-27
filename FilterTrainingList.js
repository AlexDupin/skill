const table = {
	tbody: document.getElementsByTagName('tbody'),
	row: document.querySelectorAll('#TrainingList tbody tr'),
}

var search = {
	input: document.getElementById('trainingSearch'),
	filter: document.getElementById('trainingSearch'),
}

var type = {
    input: document.getElementById('FilterByType'),
    filter: document.getElementById('FilterByType'),
}

var retired = {
    input: document.getElementById("filterRetired"),
    value: "retired",
    filter: document.getElementById("filterRetired"),
}


function filterTable() {
    for (var i = 0; i < table.row.length; i++) {
        if (table.row[i].getElementsByTagName('td')[1].textContent.indexOf(retired.value) > -1 && retired.input.checked == false){
            table.row[i].style.display = "none";
        }
        else if (table.row[i].textContent.toUpperCase().indexOf(search.input.value.toUpperCase()) == -1){
            table.row[i].style.display = "none";
        }
        else {
            table.row[i].style.display = "";
        }
    }
}

search.filter.addEventListener('keyup', filterTable, false);
retired.filter.addEventListener('checked', filterTable, false);
document.addEventListener("DOMContentLoaded", filterTable);

// Table Link

document.addEventListener("DOMContentLoaded", () => {

	const rows = document.querySelectorAll("tr[data-href]");

	rows.forEach( row => {
		row.addEventListener("click", () => {
			window.location.href = row.dataset.href;
			} )
		} )
	} )