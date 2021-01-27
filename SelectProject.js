var search = {
	filter: document.getElementById('projSearch'),
	value: document.getElementById('projSearch')
};

const table = {
	row: document.querySelector('#EmployeeList tbody').rows
};

function filterTable() {
	for (var i = 0; i < table.row.length; i++) 
		if (table.row[i].textContent.toUpperCase().indexOf(search.value.value.toUpperCase()) == -1)
			table.row[i].style.display = 'none';
		else
			table.row[i].style.display = '';
}

search.filter.addEventListener('keyup', filterTable, false);

// AJAX

document.addEventListener('DOMContentLoaded', () => {
	filterTable();
	const rows = document.querySelectorAll('tr[data-id]');

	rows.forEach(row => {
		console.log('click');
		row.addEventListener('click', () => {
			const request = new XMLHttpRequest();

			request.onload = () => {
				let responseObject = null;

				try {
					responseObject = JSON.parse(request.responseText);
				} catch (error) {
					console.error('JSON could not be parsed');
				}
				if (responseObject) {
					handleResponse(responseObject);
				}
			};

			const requestData = `id=${row.dataset.id}`;

			request.open('POST', 'AssignProject.php');
			request.setRequestHeader(
				'Content-type',
				'application/x-www-form-urlencoded'
			);
			request.send(requestData);
		});
	});
});

function handleResponse(responseObject) {
	if (responseObject.ok) {
		alert.relocate = 'AssetLink.php?%20id=' + responseObject.tag;
		alert.text.innerHTML = responseObject.msg;
		alert.show.style.display = 'block';
	} else {
		alert.relocate = 'AssetLink.php?%20id=' + responseObject.tag;
		alert.text.innerHTML = responseObject.msg;
		alert.show.style.display = 'block';
	}
}
