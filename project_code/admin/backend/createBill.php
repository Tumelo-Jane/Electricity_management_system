<?php
session_start();

include 'connection.php';

// Process login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $amt = $_POST['amount'];
    $billDate = $_POST['billDate'];
    $dueDate = $_POST['dueDate'];
    $status = $_POST['status'];

    $query = "INSERT  INTO bills(CustomerID,Amount,BillingDate,DueDate,Status)
     values('$id','$amt','$billDate','$dueDate','$status')";
        
        if($conn->query($query)===TRUE)
        {
            header("Location: ../adminDashboard.php");			
		
		}else{
			$_SESSION['status'] = "Error creating logins";
			header("Location: error.php");			
		}

}

?>
