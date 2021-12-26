<?php
require("../../../lang/lang.php");

$strings = tr();

?>
<html lang="en-US">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= $strings['title'] ?></title>
	<link rel="stylesheet" href="./../bootstrap.min.css">
</head>

<body>
	<div class=container>
		<div class="row pt-5 mt-2" style="margin-left: 390px">



			<h2><?= $strings['title'] ?></h2>

		</div>
		<div class="row pt-3 mt-2">
			<form method="POST">
				<input class="form-control" type="text" name="ip" aria-label="ip" style="margin-top: 30px; margin-left: 400px; width: 500px; ">
				<button type="submit" class="btn btn-primary" style="margin-top: 30px; margin-left: 400px; width: 500px;">Ping</button>
			</form>

		</div>


		<div class="row pt-5 mt-2" style="margin-left: 400px">
			<?php
			if (isset($_POST["ip"])) {


				$input = $_POST["ip"];
				$blacklists = array("ls", "cat", "less", "tail", "more", "whoami", "pwd", "echo", "ps");
				$arraySize = sizeof($blacklists);
				$status = 0;

				foreach ($blacklists as $blacklist) {
					if (!strstr($input, $blacklist)) {
						//$input = str_replace($blacklist,"", $input);

						$status++;
					}
				}

				if ($arraySize == $status) {
					exec("ping -n 3 $input", $out);
					if (!empty($out)) {

						echo '<div class="alert alert-primary" role="alert" style=" width:500px;" > <strong>  <p style="text-align:center;">';
						foreach ($out as $line) {

							echo $line;
							echo "<br>";
						}
						echo ' </p></strong></div>';
					}
				} else {
					echo '<div class="alert alert-danger" role="alert" style=" width:500px;" > <strong>  <p style="text-align:center;">ERROR</p></strong></div>';
				}
			}

			?>


		</div>
	</div>
	<script id="VLBar" title="Title" category-id="4" src="/public/assets/js/vlnav.min.js"></script>
</body>

</html>