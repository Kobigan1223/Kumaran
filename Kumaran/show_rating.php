<?php
session_start();
$userName = '';
$show = '';
if (!empty($_SESSION['user_id']) && $_SESSION['user_id']) {
	$userName =  $_SESSION['user_id'];
} else {
	$show = 'hidden';
}
?>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>The-palm</title>
	<!--
    <link rel="stylesheet" type="text/css" href="..\CSS\style.css">
    <link rel="stylesheet" type="text/css" href="..\CSS\Sliderstyle.css">
    
	<link rel="stylesheet" type="text/css" href="..\CSS\bookone.css">
	-->

	<!-- Need CSS Files for The-palm-->
	<link rel="stylesheet" type="text/css" href="..\CSS\my.css">
	<link rel="stylesheet" type="text/css" href="..\CSS\default2.css">


	<!-- Site Icons -->
	<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" href="../../images/apple-touch-icon.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="..\CSS\bootstrap.min.css">
	<!-- Site CSS -->
	<link rel="stylesheet" href="..\CSS\style1.css">
	<!-- Responsive CSS -->
	<link rel="stylesheet" href="..\CSS\responsive.css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="..\CSS\custom.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

	<script src="..\js/login.js" type="text/javascript"></script>

	<!-- rating -->


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<!-- end rating style and script -->

</head>

<body>
	<!-- Start header -->
	<header class="top-navbar">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="../images/3.png" height="70px" width="200px" alt="" />
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbars-rs-food">
					<ul class="navbar-nav ml-auto">

						<li class="nav-item active"><a class="nav-link" href="Home.php">Home</a></li>
						<li class="nav-item"><a class="nav-link" href="Food.php">Food</a></li>
						<li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
						<li class="nav-item"><a class="nav-link" href="Food.php">Rooms</a></li>
						<li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
						<?php if (isset($_SESSION['user_id'])) { ?>
							<button class="button" onclick="document.location='userselector.php'">My Account</button>
							<button class="button" onclick="document.location='Wishlist.php'">Wishlist</button>
							<button class="button" onclick="document.location='My Cart.php'">My Cart</button>
							<button class="button" onclick="document.location='logout.php'" )>Log Out</button>
						<?php } else { ?>

							<button class="button" onclick="document.location='login.php'">Log in</button>
						<?php } ?>


					</ul>
				</div>
			</div>
		</nav>
	</header>
	<!-- End header -->
	<br><br><br><br><br><br>
	<div class="container" style="min-height:500px;">
		<?php
		include 'class/rating.php';
		$rating = new Rating();
		$itemRating = $rating->getItemRating($rating);
		$ratingNumber = 0;
		$count = 0;
		$fiveStarRating = 0;
		$fourStarRating = 0;
		$threeStarRating = 0;
		$twoStarRating = 0;
		$oneStarRating = 0;
		foreach ($itemRating as $rate) {
			$ratingNumber += $rate['ratingNumber'];
			$count += 1;
			if ($rate['ratingNumber'] == 5) {
				$fiveStarRating += 1;
			} else if ($rate['ratingNumber'] == 4) {
				$fourStarRating += 1;
			} else if ($rate['ratingNumber'] == 3) {
				$threeStarRating += 1;
			} else if ($rate['ratingNumber'] == 2) {
				$twoStarRating += 1;
			} else if ($rate['ratingNumber'] == 1) {
				$oneStarRating += 1;
			}
		}
		$average = 0;
		if ($ratingNumber && $count) {
			$average = $ratingNumber / $count;
		}
		?>

		<br>
		<div id="ratingDetails">
			<div class="row">
				<div class="col-sm-3">
					<h4>Rating and Reviews</h4>
					<h2 class="bold padding-bottom-7"><?php printf('%.1f', $average); ?> <small>/ 5</small></h2>
					<?php
					$averageRating = round($average, 0);
					for ($i = 1; $i <= 5; $i++) {
						$ratingClass = "btn-default btn-grey";
						if ($i <= $averageRating) {
							$ratingClass = "btn-warning";
						}
					?>
						<button type="button" class="btn btn-sm <?php echo $ratingClass; ?>" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
					<?php } ?>
				</div>
				<div class="col-sm-3">
					<?php
					$fiveStarRatingPercent = round(($fiveStarRating / 5) * 100);
					$fiveStarRatingPercent = !empty($fiveStarRatingPercent) ? $fiveStarRatingPercent . '%' : '0%';

					$fourStarRatingPercent = round(($fourStarRating / 5) * 100);
					$fourStarRatingPercent = !empty($fourStarRatingPercent) ? $fourStarRatingPercent . '%' : '0%';

					$threeStarRatingPercent = round(($threeStarRating / 5) * 100);
					$threeStarRatingPercent = !empty($threeStarRatingPercent) ? $threeStarRatingPercent . '%' : '0%';

					$twoStarRatingPercent = round(($twoStarRating / 5) * 100);
					$twoStarRatingPercent = !empty($twoStarRatingPercent) ? $twoStarRatingPercent . '%' : '0%';

					$oneStarRatingPercent = round(($oneStarRating / 5) * 100);
					$oneStarRatingPercent = !empty($oneStarRatingPercent) ? $oneStarRatingPercent . '%' : '0%';

					?>
					<div class="pull-left">
						<div class="pull-left" style="width:35px; line-height:1;">
							<div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
						</div>
						<div class="pull-left" style="width:180px;">
							<div class="progress" style="height:9px; margin:8px 0;">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fiveStarRatingPercent; ?>">
									<span class="sr-only"><?php echo $fiveStarRatingPercent; ?></span>
								</div>
							</div>
						</div>
						<div class="pull-right" style="margin-left:10px;"><?php echo $fiveStarRating; ?></div>
					</div>

					<div class="pull-left">
						<div class="pull-left" style="width:35px; line-height:1;">
							<div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
						</div>
						<div class="pull-left" style="width:180px;">
							<div class="progress" style="height:9px; margin:8px 0;">
								<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fourStarRatingPercent; ?>">
									<span class="sr-only"><?php echo $fourStarRatingPercent; ?></span>
								</div>
							</div>
						</div>
						<div class="pull-right" style="margin-left:10px;"><?php echo $fourStarRating; ?></div>
					</div>
					<div class="pull-left">
						<div class="pull-left" style="width:35px; line-height:1;">
							<div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
						</div>
						<div class="pull-left" style="width:180px;">
							<div class="progress" style="height:9px; margin:8px 0;">
								<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $threeStarRatingPercent; ?>">
									<span class="sr-only"><?php echo $threeStarRatingPercent; ?></span>
								</div>
							</div>
						</div>
						<div class="pull-right" style="margin-left:10px;"><?php echo $threeStarRating; ?></div>
					</div>
					<div class="pull-left">
						<div class="pull-left" style="width:35px; line-height:1;">
							<div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
						</div>
						<div class="pull-left" style="width:180px;">
							<div class="progress" style="height:9px; margin:8px 0;">
								<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $twoStarRatingPercent; ?>">
									<span class="sr-only"><?php echo $twoStarRatingPercent; ?></span>
								</div>
							</div>
						</div>
						<div class="pull-right" style="margin-left:10px;"><?php echo $twoStarRating; ?></div>
					</div>
					<div class="pull-left">
						<div class="pull-left" style="width:35px; line-height:1;">
							<div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
						</div>
						<div class="pull-left" style="width:180px;">
							<div class="progress" style="height:9px; margin:8px 0;">
								<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $oneStarRatingPercent; ?>">
									<span class="sr-only"><?php echo $oneStarRatingPercent; ?></span>
								</div>
							</div>
						</div>
						<div class="pull-right" style="margin-left:10px;"><?php echo $oneStarRating; ?></div>
					</div>
				</div>
				<div class="col-sm-3">
					<button type="button" id="rateProduct" class="btn btn-info <?php if (!empty($_SESSION['user_id']) && $_SESSION['user_id']) {
																					echo 'login';
																				} ?>">Rate this product</button>

				</div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<hr />
					<div class="review-block">
						<?php
						$itemRating = $rating->getItemRating($rating);
						foreach ($itemRating as $rating) {
							$date = date_create($rating['created']);
							$reviewDate = date_format($date, "M d, Y");
							$profilePic = "profile.png";
							if ($rating['profImgLoc']) {
								$profilePic = $rating['profImgLoc'];
							}
						?>
							<div class="row">
								<div class="col-sm-3">
									<img src="<?php echo $profilePic; ?>" class="img-rounded user-pic">
									<div class="review-block-name">By <a href="#"><?php echo $rating['userName']; ?></a></div>
									<div class="review-block-date"><?php echo $reviewDate; ?></div>
								</div>
								<div class="col-sm-9">
									<div class="review-block-rate">
										<?php
										for ($i = 1; $i <= 5; $i++) {
											$ratingClass = "btn-default btn-grey";
											if ($i <= $rating['ratingNumber']) {
												$ratingClass = "btn-warning";
											}
										?>
											<button type="button" class="btn btn-xs <?php echo $ratingClass; ?>" aria-label="Left Align">
												<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
											</button>
										<?php } ?>
									</div>
									<div class="review-block-title"><?php echo $rating['title']; ?></div>
									<div class="review-block-description"><?php echo $rating['comments']; ?></div>
								</div>
							</div>
							<hr />
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div id="ratingSection" style="display:none;">
			<div class="row">
				<div class="col-sm-12">
					<form id="ratingForm" method="POST">
						<div class="form-group">
							<h4>Rate this product</h4>
							<button type="button" class="btn btn-warning btn-sm rateButton" aria-label="Left Align">
								<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							</button>
							<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
								<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							</button>
							<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
								<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							</button>
							<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
								<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							</button>
							<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
								<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
							</button>
							<input type="hidden" class="form-control" id="rating" name="rating" value="1">
							<input type="hidden" name="action" value="saveRating">
						</div>
						<div class="form-group">
							<label for="usr">Title*</label>
							<input type="text" class="form-control" id="title" name="title" required>
						</div>
						<div class="form-group">
							<label for="comment">Comment*</label>
							<textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-info" id="saveReview">Save Review</button> <button type="button" class="btn btn-info" id="cancelReview">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="js/rating.js"></script>