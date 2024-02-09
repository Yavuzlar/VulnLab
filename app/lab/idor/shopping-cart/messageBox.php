<?php
require("../../../lang/lang.php");
$strings = tr();

require 'conn.php';

if (isset($_POST['message'])) {
    $message = $_POST['message'];
	$query = $conn->prepare("INSERT INTO shopMessage(content, corner) VALUES (?, ?)");
	$query->execute(array(
		$message,
		1,
	));
	header("Location: messageBox.php");

}
?>
<!DOCTYPE html>
<html>
	<head>
    <link href="css/style.css" rel="stylesheet">

    <link href="css/messageStyle.css" rel="stylesheet">

	</head>
    <body>
    <main class="content">
    <div class="container p-0">


	<div class="card" style="margin-top: 100px; ">
			<div class="row g-0">
				<div class="col-12 col-lg-5 col-xl-3 border-right">

					<div class="px-4 d-none d-md-block">
						<div class="d-flex align-items-center">
							<div class="flex-grow-1">
                            <h1 class="h3 mb-3 mt-2 ml-5"><?php echo $strings['messages']; ?></h1>
					</div>
						</div>
					</div>

                    <a href="messageBox.php" class="list-group-item list-group-item-action border-0" >
						<div class="badge bg-success float-right"></div>
						<div class="d-flex align-items-start">
							<img src="img/market.png" class="rounded-circle mr-1" width="40" height="40">
							<div class="flex-grow-1 ml-3">
							<?php echo $strings['shop']; ?>
								<div class="small"><span class="fas fa-circle chat-online"></span> <?php echo $strings['online']; ?></div>
							</div>
						</div>
					</a>
                    <a href="messageYavuzlar.php" class="list-group-item list-group-item-action border-0" >
						<div class="badge bg-success float-right"></div>
						<div class="d-flex align-items-start">
							<img src="img/yavuzlar.png" class="rounded-circle mr-1"  width="40" height="40">
							<div class="flex-grow-1 ml-3">
							<?php echo $strings['yavuzlar_expert']; ?>
								<div class="small"><span class="fas fa-circle chat-online"></span> <?php echo $strings['online']; ?></div>
							</div>
						</div>
					</a>
					
					<!-- <a href="#" class="list-group-item list-group-item-action border-0">
												<div class="badge bg-success float-right">2</div>

						<div class="d-flex align-items-start">
							<img src="https://bootdey.com/img/Content/avatar/avatar4.png" class="rounded-circle mr-1" alt="Christina Mason" width="40" height="40">
							<div class="flex-grow-1 ml-3">
								Christina Mason
								<div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>
							</div>
						</div>
					</a>
				 -->

					<hr class="d-block d-lg-none mt-1 mb-0">
				</div>
				<div class="col-12 col-lg-7 col-xl-9">
					<div class="py-2 px-4 border-bottom d-none d-lg-block">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">
								<img src="img/market.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
							</div>
							<div class="flex-grow-1 pl-3">
								<strong><?php echo $strings['shop']; ?></strong>
								<div class="text-muted small"><em><?php echo $strings['online']; ?></em></div>
							</div>
							<div>
							<a href="index.php" class="btn mb-3" style="background-color: #7ca8a6; color:#F8F9FD; margin-right: 15px;"><?php echo $strings['go_back']; ?></a>
							</div>
						</div>
					</div>

					<div class="position-relative">
						<div class="chat-messages p-4">

						

							<div class="chat-message-left pb-4">
								<div>
									<img src="img/market.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
									<div class="font-weight-bold mb-1"><?php echo $strings['shop']; ?></div>
									<?php echo $strings['shop_mess1']; ?>
								</div>
							</div>


							<div class="chat-message-right mb-4">
								<div>
									<img src="img/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1"><?php echo $strings['you']; ?></div>
									<?php echo $strings['you_mess1']; ?>
								</div>
							</div>

                            <?php
                                $productsDB = $conn->prepare("SELECT * FROM shopMessage ORDER BY id");
                                $productsDB->execute();
                                $messages = $productsDB->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($messages as $message) {
                                    if($message["corner"] == 0){
										$name = $strings['shop'];
										$message1 = $strings["shop_mess2"];
                                        echo ' 
                                        <div class="chat-message-left pb-4">
                                            <div>
                                                <img src="img/market.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                <div class="font-weight-bold mb-1">' . $name . '</div>
                                                ' .$message1 .' '. $message["content"]. '
                                            </div>
                                        </div>';
                                    }else if($message["corner"] == 1){
										$name = $strings['you'];
                                        echo ' 
                                        <div class="chat-message-right pb-4">
                                            <div>
                                                <img src="img/avatar1.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            </div>
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                                <div class="font-weight-bold mb-1">' .$name. '</div>
                                                ' . $message["content"]. '
                                            </div>
                                        </div>';
                                    }
                                  
                                }
                                ?>					

<!-- 					

							<div class="chat-message-right mb-4">
								<div>
									<img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
									<div class="text-muted small text-nowrap mt-2">2:40 am</div>
								</div>
								<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
									<div class="font-weight-bold mb-1">You</div>
									Cum ea graeci tractatos.
								</div>
							</div>
	 -->


						</div>
					</div>
					<div class="flex-grow-0 py-3 px-4 border-top">
                <form id="message-form"  action="messageBox.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="message" placeholder="Type your message">
                        <button type="submit" class="btn" style="background-color: #70a08b; color:#F8F9FD;" ><?php echo $strings['send_button']; ?></button>
                    </div>
                </form>
            	</div>

				</div>
			</div>
		</div>
	</div>
</main>
<script id="VLBar" title="<?= $strings["title"]; ?>" category-id="11" src="/public/assets/js/vlnav.min.js"></script>

</body>
</html>