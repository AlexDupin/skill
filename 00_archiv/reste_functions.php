function ProjectRadioList_BAK($sql, $pr_proj_id)
{
	echo "<div class='form-check' id='id_pr_radio' data-toggle='buttons'>";
	while ($row = mysqli_fetch_array($sql)) {
		if ((int)$pr_proj_id == (int)$row['pr_id']) {
			echo "	<label class='form-check-label' active>
					<input class='form-check-input' type='radio' name='projradio' checked='checked' value=".$row['pr_id'].">".$row['cust']." - ".$row['p_name']."</label><hr>";
			}
		else {
			echo "	<label class='form-check-label'>
					<input class='form-check-input' type='radio' name='projradio' value=".$row['pr_id'].">".$row['cust']." - ".$row['p_name']."</label><hr>";
			}
		}
	echo "</div>";
}