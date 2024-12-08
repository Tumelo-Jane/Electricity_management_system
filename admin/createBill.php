<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/notification.css">
  <link rel="stylesheet" href="css/form.css">
  <link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

	<title>Admin</title>
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".profile .icon_wrap").click(function(){
			  $(this).parent().toggleClass("active");
			  $(".notifications").removeClass("active");
			});

			$(".notifications .icon_wrap").click(function(){
			  $(this).parent().toggleClass("active");
			   $(".profile").removeClass("active");
			});

			$(".show_all .link").click(function(){
			  $(".notifications").removeClass("active");
			  $(".popup").show();
			});

			$(".close").click(function(){
			  $(".popup").hide();
			});
		});
	</script>
  
</head>
<body>

<?php
include 'includes/sidebar.php';
?>
	


	<!-- CONTENT -->
	<section id="content">
		<?php
		include 'includes/navbar.php';
		?>

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="adminDashboard.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Create Bill</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>
      <div class="container">
		<div class="contact-box">
			<div class="boxleft"></div>
			<div class="boxright">
				<h2>Create Bill</h2>
        <form action="backend/createBill.php" method="POST">
        <input type="text" id="id" name="id" class="field" placeholder="Customer ID" required>
        <input type="text" id="amount" name="amount" class="field" placeholder="Amount to pay" required>
        <input type="text" id="billDate" name="billDate" class="field" placeholder="Bill Date" required>
        <input type="text" id="dueDate" name="dueDate" class="field" placeholder="Due Date" required>
        <input type="text" id="status" name="status" class="field" placeholder="Status " required>
				<button class="btnSend">Update</button>
        </form>
			</div>
		</div>
	</div>

</div>
</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="js/script.js"></script>
	
</body>
</html>
