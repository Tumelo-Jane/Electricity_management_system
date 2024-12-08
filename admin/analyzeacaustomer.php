<?php
session_start();

include 'backend/connection.php';



$id = array();
$amount = array();
$datapoints = array();


$sql = "SELECT * FROM bills";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {

  

    array_push($id,$row["CustomerID"]);
    array_push($amount,$row["Amount"]);
    array_push($datapoints,array("x"=>$row["CustomerID"],"y"=>$row["Amount"]));
    

    }
  }

  $users =$_SESSION['user'];
  $paid=$_SESSION['paid'];
  $unpaid=$_SESSION['unpaid'];
  $overDue=$_SESSION['overDue'];
$conn->close();
  

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/notification.css">
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
  <script>
  window.onload = function(){

    var chart = new CanvasJS.Chart("chart",{
      animationEnabled:true,
      exportEnabled:true,
      theme:"light1",
      title:{
        text:"Line chart"
      },axisY:{
        title:"Amount"
      },
      axisX:{
        title: "Customer ID"
      },
      data: [{
        type: "line",
        dataPoints: <?php echo json_encode($datapoints,JSON_NUMERIC_CHECK);?>
      }]
    });
    chart.render();
  }
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
							<a class="active" href="#">Analyze Customer</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

<?php

include 'includes/boxes.php';

?>

<div class="wrapper">


<div id="chart" style="width:100%;max-width:80%"></div>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>



</div>
</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="js/script.js"></script>
	

</body>
</html>
