<?php

// Date Conversion Functions

	function date_etog($date)
	{
		if ($date=='' || $date==NULL)
			$date='1998-02-01';
		$tmp_date=date_create($date);
		return date_format($tmp_date,"d.m.Y");
	}

	function date_gtoe($date)
	{
		if ($date=='' || $date==NULL)
			$date='01.02.1998';
		list($tag, $monat, $jahr) = explode(".", $date);
		return sprintf("%04d-%02d-%02d", $jahr, $monat, $tag);
	}
?>
