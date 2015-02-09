<?php
	session_start();
	if (!isset($_SESSION["counter"]))
		$_SESSION["counter"] = 0;
	if ($_SESSION["counter"] > 5)
		$spamError = 1;
	else
		$spamError = 0;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Wizzme - IPhone app</title>
		<link rel="stylesheet" media="all" type="text/css" title="index" href="index.css" />
		<link href='http://fonts.googleapis.com/css?family=Fugaz+One' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<header>
			<p class="c5" id="menu"><?php if (isset($_GET["contact"])) echo 'Home'; else echo 'Contact us'; ?></p>
		</header>
		<div id="indexPage" <?php if(isset($_GET["contact"])) echo 'style="display: none"'; ?>>
			<section id="indexSection">
				<img src="img/logo.png" alt="logo" />
				<p>
					<strong>Amazing battle quizzes on awesome movies!</strong><br/><br />
					<em>Challenge your friends and become the master of the week!</em><br />
				</p>
				<center><img src="img/appstore.png" alt="Available on the App Store" style="margin-top: 10px;" /></center>
				<a href="http://twitter.com/wizzmeapp"><img src="img/twitter.png" alt="Follow us on Twitter" style="float: left; margin-right: 10px; margin-left: 149px; margin-top: 25px;" /></a>
				<a href="http://facebook.com/wizzmeapp"><img src="img/facebook.png" alt="Follow us on Facebook" style="margin-top: 25px;" /></a>
			</section>
			<div id="iphones">
				<img src="img/iphone1.png" alt="iphone" id="big" />
				<img src="img/iphone2.png" alt="iphone" id="little" />
				<img src="img/sprite1.png" alt="sprite 1" id="firstSprite" />
				<img src="img/sprite2.png" alt="sprite 2" id="secondSprite" style="display: none;" />
				<img src="img/sprite3.png" alt="sprite 3" id="thirdSprite" style="display: none;" />
				<img src="img/spriteback.png" alt="sprite back" id="backSprite" />
			</div>
			<section id="indexSubSection">
				<h2>caracteristics</h2>
				<p>
					<span class="c5">Challenge your friends</span> with Facebook!<br />
					<span class="c5">Answer quizzes</span> on your favorite movies<br />
					<span class="c5">Enjoy and learn</span> about awesome movies<br />
				</p>
			</section>
		</div>
		<section id="contactSection" <?php if(!isset($_GET["contact"])) echo 'style="display: none;"'; ?>>
			<?php
				if (!empty($_POST["name"]) && !empty($_POST["mail"]) && !empty($_POST["subject"]) && !empty($_POST["content"]) && !$spamError)
				{
					$_SESSION["counter"]++;
					$file = fopen("messages.txt", "a+");
					fputs($file, date("[d/m/Y - H:i]") . " From " . $_POST["name"] . " (" . $_POST["mail"] . ") :\n", 1000);
					fputs($file, "Subject : " . $_POST["subject"] . "\n\n", 1000);
					fputs($file, $_POST["content"], 10000);
					fputs($file, "\n\n--------------------------------------------------------------------------------\n\n");
					fclose($file);
					echo '<p style="color: green;" class="shoutbox">message sent successfully!</p>';
				}
				else
				{
					if ((!empty($_POST["name"]) || !empty($_POST["mail"]) || !empty($_POST["subject"]) || !empty($_POST["content"])) && !$spamError)
					{
						echo '<p style="color: red;" class="shoutbox">Please fill in all fields</p>';
						$error = 1;
					}
				}
				if ($spamError)
					echo '<p style="color: red;" class="shoutbox">You have sent too many messages in too little time. Please try again later.</p>';
				else
				{
					?>
					<form method="post" action="index.php?contact">
						<p>
							<label for="name">Name:</label>
							<input type="text" name="name" id="name" size="25" value="<?php if(isset($_POST["name"])) echo $_POST["name"]; ?>" required autofocus /><br />
							<br />
							<label for="mail">Email:</label>
							<input type="email" name="mail" id="mail" size="25" value="<?php if(isset($_POST["mail"])) echo $_POST["mail"]; ?>" required /><br />
							<br />
							<label for="subject">Topic:</label>
							<input type="text" name="subject" id="subject" size="25" value="<?php if(isset($_POST["subject"], $error)) echo $_POST["subject"]; ?>" required /><br />
							<br />
							<label for="content">Message:</label>
							<textarea name="content" id="content" required><?php if(isset($_POST["content"], $error)) echo $_POST["content"]; ?></textarea><br />
							<br />
							<input type="image" src="img/submit.png" style="margin-left: 20%;" alt="submit" />
						</p>
					</form>
					<?php
				}
			?>
		</section>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="js/pages.js"></script>
		<script src="js/slider.js"></script>
	</body>
</html>