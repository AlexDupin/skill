	<div class=modal id="createEmployee">
	<form class="modal-content animate">
		<span onclick="document.getElementById('createEmployee').style.display='none'" class="close" title="Close Modal">×</span>
		<div class="modalContainer">
		<h2> Create Employee </h2>
		<br>
		<input type="text" class="form-control" placeholder="Vorname" id="firstname">
		<br>
		<input type="text" class="form-control" placeholder="Nachname" id="lastname">
		<br>
		<input type="text" class="form-control" placeholder="User Name" id="username">
		<br>
		<select id="organization" class="custom-select">
			<option value=''>Firma</option>
			<option>NOC</option>
			<option>SoSy</option>
		</select>
		<br>
		<br>
		<select id="accesslevel" class="custom-select">
			<option value=''>Zugriffsrechte</option>
			<option>Administrator</option>
			<option>Benutzer</option>
		</select>
		<br>
		<br>
		<input type="text" class="form-control" placeholder="Kennwort" id="password">
		<br>
		<button type='button' id="btn-submit" class="btn btn-primary"> Mitarbeiter anlegen </button>
		</div>
	</form>
	</div>




	<script src="CreateEmployee.js"></script>
	<script>
	var modal = document.getElementById('createEmployee');


	window.onclick = function(event) {
		if (event.target == modal) {
		modal.style.display = "none";
		}
	}
	</script>
