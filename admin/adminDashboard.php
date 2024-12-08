<?php
session_start();

include 'backend/connection.php';

$users =0;
$paid = 0;
$unpaid=0;
$overDue=0;


$ContactNumber = array();
$FirstName = array();
$LastName = array();
$CustomerID = array();
$Address = array();



$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {

    $users = $users+1;

    array_push($FirstName,$row["FirstName"]);
    array_push($LastName,$row["LastName"]);
    array_push($Address,$row["Address"]);
    array_push($CustomerID,$row["CustomerID"]);
    array_push($ContactNumber,$row["ContactNumber"]);

    }
  }

  $sql = "SELECT * FROM bills";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
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

$_SESSION['user']= $users;
$_SESSION['paid']= $paid;
$_SESSION['unpaid']= $unpaid;
$_SESSION['overDue']= $overDue;
  $conn->close();
  

?>
<!DOCTYPE html>
<html lang="en">
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
							<a class="active" href="#">Home</a>
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

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
							<th>Customer count</th>
      						<th>Customer ID</th>
      						<th>First Name </th>
      						<th>Last Name </th>
      						<th>Address</th>
      						<th>Contact Number</th>
      
							</tr>
						</thead>
						<tbody>
							  <!--for loop for getting data from database and displaying in table form-->
  <?php

for($x  =0 ; $x < sizeof($FirstName);$x++)
{

?>
    <tr>
      <td> <?php echo ($x+1);?> </td>
      <td> <?php echo $CustomerID[$x]; ?></td>
      <td> <?php echo $FirstName[$x]; ?></td>
      <td> <?php echo $LastName[$x]; ?></td>
      <td> <?php echo $Address[$x]; ?></td>
      <td> <?php echo $ContactNumber[$x]; ?></td>
      
    </tr>

    <?php
}
?>
						</tbody>
					</table>
				</div>
	
				</div>
			</div>
			<div
id="myChart" style="width:100%;max-width:100%; height:600px;">
</div>



<!--a pie chart using google visuals api-->
<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
const data = google.visualization.arrayToDataTable([
  ['Status', 'number'],
  ['Paid',<?php echo $paid;?>],
  ['UnPaid',<?php echo $unpaid;?>],
  ['Overpaid',<?php echo $overDue;?>]
]);

const options = {
  title:'Status',
  is3D:true,
  backgroundColor: '#F9F9F9',
  colors: ['#f2c6de','#c934de','#fd8a8a']

};

const chart = new google.visualization.PieChart(document.getElementById('myChart'));
  chart.draw(data, options);
}
</script>

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="js/script.js"></script>
	

</body>
</html>