<?php
session_start();

include 'backend/connection.php';

$users =0;
$paid = 0;
$unpaid=0;
$overDue=0;

$Amount = array();
$BillDate = array();
$DueDate = array();
$CustomerID = array();
$Status = array();


$sql = "SELECT * FROM bills";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {

        $users++;

    array_push($Amount,$row["Amount"]);
    array_push($BillDate,$row["BillingDate"]);
    array_push($DueDate,$row["DueDate"]);
    array_push($CustomerID,$row["CustomerID"]);
    array_push($Status,$row["Status"]);

    if(strcmp($row["Status"],"Paid") == 0)
    {
        $paid++;
    }else if (strcmp($row["Status"],"Unpaid") == 0)
    {
        $unpaid++;
    }else{
        $overDue++;
    }

    }
  }
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
							<a class="active" href="#">View Bills</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Bills</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
			
<table>
  <thead>
    <tr>
      <th scope="col">Customer count</th>
      <th scope="col">Customer ID</th>
      <th scope="col">Billing Date </th>
      <th scope="col">Due Date </th>
      <th scope="col">Amount</th>
      <th scope="col">Status </th>
      
    </tr>
  </thead>
  <tbody>
  <?php

for($x  =0 ; $x < sizeof($CustomerID);$x++)
{

?>
    <tr>
      <th scope="row"> <?php echo $x;?> </th>
      <td> <?php echo $CustomerID[$x]; ?></td>
      <td> <?php echo $BillDate[$x]; ?></td>
      <td> <?php echo $DueDate[$x]; ?></td>
      <td> R<?php echo $Amount[$x]; ?></td>
      <td> <?php echo $Status[$x]; ?></td>
      
    </tr>

    <?php
}
?>
    </tbody>
</table>



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
