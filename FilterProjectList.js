const table = {
	tbody: document.getElementsByTagName('tbody'),
	row: document.querySelectorAll('#ProjectList tbody tr'),
}

var search = {
	input: document.getElementById('projectSearch'),
	filter: document.getElementById('projectSearch'),
}

var type = {
    input: document.getElementById('FilterByType'),
    filter: document.getElementById('FilterByType'),
}

var desc = {
    input: document.getElementById("proj_desc"),
    value: "show",
    filter: document.getElementById("proj_desc"),
}

function myFunction() {
  var x = document.getElementById("proj_desc");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function filterTable() {
    for (var i = 0; i < table.row.length; i++) {
        if (table.row[i].getElementsByTagName('td')[1].textContent.indexOf(desc.value) > -1 && desc.input.checked == false){
            table.col6.style.display = "none";
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
//desc.filter.addEventListener('checked', filterTable, false);
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