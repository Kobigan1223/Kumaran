<?php
session_start();
include 'class/rating.php';
$rating = new Rating();
if (
	!empty($_POST['action']) && $_POST['action'] == 'saveRating'
	&& !empty($_SESSION['user_id'])
	&& !empty($_POST['rating'])
) {
	$userID = $_SESSION['user_id'];
	$rating->saveRating($_POST, $userID);
	$data = array(
		"success"	=> 1,
	);
	echo json_encode($data);
}
