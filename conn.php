<?php 
	mysqli_report(MYSQLI_REPORT_STRICT);
	$conn = null;
	try {
	    $conn = new mysqli('127.0.0.1','jdc_santos','@tacs123','jdc_tacs');
	} catch (Exception $e) {
		try{
			$conn = new mysqli("127.0.0.1", "root", "", "tacs2");
		}catch(Exception $e){
			try{
				$conn = new mysqli("127.0.0.1", "root", "usbw", "tacs2");
			}catch(Exception $e){
				
			}
		}
	}
	