		var pers_skill = {
			skill: document.getElementById('id_skill'),  
			skill_lvl: document.getElementById('id_skill_lvl'),
			skill_comm: document.getElementById('id_comment'),
			skill_sdate: document.getElementById('id_pr_sdate'),
			skill_edate: document.getElementById('id_pr_sdate'),
			submit: document.getElementById('btn-submit')
			}
		
		pers_skill.submit.addEventListener("click", () => {
			const request = new XMLHttpRequest();

			request.onload = () => {
				let responseObject = null;

				try {  
					responseObject = JSON.parse (request.responseText);
				}
				catch (error) {
					console.error('JSON could not be parsed');
					}
				if (responseObject){
					handleResponse(responseObject);
				}
			}
			const requestData = `
				skill=${pers_skill.skill.options[skill.selectedIndex].id}&
				level=${pers_skill.skill_lvl.options[skill_lvl.selectedInded].id}&
				comment=${pers_skill.skill_comm.value}&
				sdate=${pers_skill.skill_sdate.value}&
				edate=${pers_skill.skill_edate.value}`;

			request.open("POST", "SavePersSkill.php");
			request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			request.send(requestData);
		})

		function handleResponse(responseObject){
			modal.style.display = 'none';
			alert.text.innerHTML = responseObject.msg;
			alert.show.style.display = 'block';
		}

