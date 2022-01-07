<?php

session_start();
include('includes /config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Bangkok');
$currentTime = date( 'd-m-Y h:i:s A', time () );

}
?>