<?php
class Rating
{
	private $host  = 'localhost';
	private $user  = 'root';
	private $password   = "";
	private $database  = "vkqube";
	private $itemUsersTable = 'user_details';
	private $itemRatingTable = 'rating';
	private $dbConnect = false;
	public function __construct()
	{
		if (!$this->dbConnect) {
			$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
			if ($conn->connect_error) {
				die("Error failed to connect to MySQL: " . $conn->connect_error);
			} else {
				$this->dbConnect = $conn;
			}
		}
	}
	private function getData($sqlQuery)
	{
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if (!$result) {
			die('Error in query: ' . mysqli_error($sqlQuery));
		}
		$data = array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}
	// private function getNumRows($sqlQuery)
	// {
	// 	$result = mysqli_query($this->dbConnect, $sqlQuery);
	// 	if (!$result) {
	// 		die('Error in query: ' . mysqli_error($sqlQuery));
	// 	}
	// 	$numRows = mysqli_num_rows($result);
	// 	return $numRows;
	// }
	public function getItemRating($ratingId)
	{
		$sqlQuery = "
			SELECT r.ratingId,r.userId, u.userName, u.profImgLoc, r.ratingNumber, r.title, r.comments, r.created, r.modified
			FROM " . $this->itemRatingTable . " as r
			LEFT JOIN " . $this->itemUsersTable . " as u ON (r.userId = u.userId)";
		return  $this->getData($sqlQuery);
	}
	public function getRatingAverage($ratingId)
	{
		$itemRating = $this->getItemRating($ratingId);
		$ratingNumber = 0;
		$count = 0;
		foreach ($itemRating as $itemRatingDetails) {
			$ratingNumber += $itemRatingDetails['ratingNumber'];
			$count += 1;
		}
		$average = 0;
		if ($ratingNumber && $count) {
			$average = $ratingNumber / $count;
		}
		return $average;
	}
	public function saveRating($POST, $userID)
	{
		$insertRating = "INSERT INTO " . $this->itemRatingTable . " (userId, ratingNumber, title, comments, created, modified) VALUES ('" . $userID . "', '" . $POST['rating'] . "', '" . $POST['title'] . "', '" . $POST["comment"] . "', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "')";
		mysqli_query($this->dbConnect, $insertRating);
	}
}
