<?php
require("../../../lang/lang.php");
$strings = tr();

$mysqli = new mysqli('localhost', 'sql_injection', '', 'sql_injection');

if ($mysqli->connect_errno) {
printf("Connect failed: %s\n", $mysqli->connect_error);
exit();
}

session_start();

if(isset($_POST['username']) && isset($_POST['password']) ){
	
	$usr=$_POST['username'];
	$pwd=$_POST['password'];

	$sql = "SELECT username,password FROM users WHERE username='" . $usr . "' AND password='" . $pwd . "'";


if ($result = $mysqli->query($sql)) {
while($obj = $result->fetch_object()){
	$_SESSION['username'] = $usr;
	header("Location: admin.php");
	exit;
}
}

elseif($mysqli->error){
print($mysqli->error);
}		
	}	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">   	
	<title>
	<?php
        echo isset($page_title) ?$page_title:"Challenge_Basic";     

        ?>
	</title>
	 <style>
		.btn{
			border:none;
			outline:none;
			height:50px;
			width:100%;
			background-color:#4285F4;
			color:white;
			border-radius:4px;
			font-weight:bold;
		}

	</style>
</head>
<body>
<script src="scipt.js"></script>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center pt-1 my-5">						
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4"><?php echo $strings['title2'] ?></h1>
							<form method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">									
									<input type="text" name="username" class="form-control" placeholder="Email Address">
								</div>
									<div class="mb-3">
									<div class="mb-2 w-100">									
									</div>
									<input type="password" name="password" class="form-control" placeholder="********">								    
								</div>
								<div class="mb-3">									
									<button type="submit" class="btn"><?php echo $strings['title3'] ?></button>
								</div>								
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	<script id="VLBar" title="<?= $strings['title'] ?>" category-id="2" src="/public/assets/js/vlnav.min.js"></script>
	<script src="js/login.js"></script>
</body>
</html>
