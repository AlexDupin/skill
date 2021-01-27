<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/bootstrap.css">
        
        <?php

            if ($_COOKIE['uname'] == NULL){
                
                echo "<meta http-equiv='refresh' content='0 url=../index.html'>";
            }

        ?>
        <style>
            .modal {
				display: none;
				position: fixed;
				z-index: 2;
				left: 0;
				top: 0;
				width: 100%;
				height: 100%;
				overflow: auto;
				background-color: rgb(0,0,0);
				background-color: rgba(0,0,0,0.4);
			}

			.modal-content {
				background-color: #fefefe;
				margin: 3% auto;
				border: 1px solid #888;
				width: 30%;
			}
			.modalContainer {
				padding: 16px;
				}

			.animate {
				-webkit-animation: animatezoom 0.6s;
				animation: animatezoom 0.6s
				}

			@-webkit-keyframes animatezoom {
				from {-webkit-transform: scale(0)} 
				to {-webkit-transform: scale(1)}
				}
				
			@keyframes animatezoom {
				from {transform: scale(0)} 
				to {transform: scale(1)}
				}
			.second-layer {
				z-index: 1;
            }
            th {
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <?php include('Alert.html');?>

        <?php include('jumbotron.html');?>

        <?php include('Navbar/Skills.html');?>

        <br>
        <br>
        <div class="container">
            <div class=row>
                <div class=col-5>
                    <?php
                        include('inc.php');
                        include('functions.php');

                        //      Variables

                        $skillid = $_GET['skillid'];
                        setcookie("skillid",$skillid);
                        $Asql = mysqli_query($con,"SELECT * FROM skill WHERE skill.Id = '$skillid'");
                        $row = mysqli_fetch_assoc($Asql);
                        $skillid = $row['Id'];
                        setcookie("skillid",$skillid);

                        if (mysqli_num_rows($Asql)==0){
                            echo "<div class='alert alert-danger'> <strong>ERROR!</strong> Diesen Skill gibt es nicht. </div>";
                        }
                        else{
                            //      Variables
                            $skillName = $row['name'];
                            $skill_sdesc = $row['s_desc'];

                            setcookie("uname",0);

                            //         Skill Description

                            echo " <h2> Skill $skillName </h2><br>
                                <b> Type: </b> $skill_sdesc <br>
                                <br><br><br>";
                    ?>
                    <button onclick = "document.getElementById('editSkill').style.display='block'" class='btn btn-secondary' > Edit this Skill</button>
                    <a href='SelectEmployee.php' role='button' class='btn btn-secondary' > Assign this Skill</a>
				 </div>
                <div class = col-7>
                	<h2> Assignments </h2>
                	<input type = checkbox class = form-check-input id = 'filterRetired' onchange = "filterTable()" style="margin-left: 72%" checked> <span style="margin-left: 80%;">Show retired </span></input>

				</div>
            </div>
        </div>
        <div class = modal id = "editSkill">
            <form class = "modal-content animate">
                <span onclick="document.getElementById('editAsset').style.display='none'" class="close" title="Close Modal" style="cursor: pointer">×</span>
                <div class = "modalContainer">
                    <h2> Edit Skill </h2>
                    <br>
                    <?php
                        echo"
                        <input type=text class='form-control' placeholder='Name' value='$SkillName' id='SkillName'><br>
                        <input type=text class='form-control' placeholder='Kurzbeschr.' value='$Skill_SDesc'id='Skill_SDesc'><br>
                        <input type=text class='form-control' placeholder='Beschreibung' value='$Skill_Desc'id='Skill_Desc'><br>
                        <br><br>
                        ";
                    ?>
                    <button type=button role=button class='btn btn-primary' id="submit">Submit</button>
                </div>
            </form>
        </div>
        <script src ='sortTable.js'></script>
        <script src="EditSkill.js"></script>
        <script src="CreateSkill.js"></script>
        <script src="HideRetiredEmployees.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", () =>{

                const rows = document.querySelectorAll("tr[data-href]");

                rows.forEach( row => {
                    row.addEventListener("click", () => {
                        window.location.href = row.dataset.href;

                        })
                    })
                })
            var modal = document.getElementById('editSkill');

		
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    }
                }
        </script>
    </body>
</html>
