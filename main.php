
<?php 
$memberinfo=getMemberInfo();
$usergroup=$memberinfo['group'];
switch ($usergroup) {
	case 'doctor':
		# code...
	include'docview.php';
	break;
	case 'Class reps':
			# code...
	include'crview.php';
	break;
	
	default:
		# code...
	include'adminview.php';
	break;
}
?>