<?php
session_start();

include 'connection.php';

// Process login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $readingDate = $_POST['readingDate'];
    $currentReading = $_POST['currentReading'];
    $previousReading = $_POST['previousReading'];
    $unitsConsumed = $previousReading-$currentReading;

    $query = "INSERT  INTO readings(MeterID,ReadingDate,CurrentReading,PreviousReading,UnitsConsumed)
     values('$id','$readingDate','$currentReading','$previousReading','$unitsConsumed')";
        
        if($conn->query($query)===TRUE)
        {
            header("Location: ../adminDashboard.php");			
		
		}else{
			$_SESSION['status'] = "Error creating logins";
			header("Location: error.php");			
		}

}

?>
