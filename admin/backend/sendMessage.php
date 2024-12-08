<?php
session_start();
include 'connection.php';


   $CustomerID = 1111;
   $msg = $_POST['message'];
   $receiver = $_SESSION["CustomerID"];
   $profile_img = "images/admin";
   $names = "Admin";

   
        $sql = "INSERT  INTO query(messages,receiver,CustomerID,names) values('$msg','$receiver','$CustomerID','$names')";
		
		if($conn->query($sql)===TRUE){
            header("Location: ../chat.php");	
			 
		}else{
			$_SESSION['status'] = "Error Inserting Message";
			header("Location: ../error.php");			
		}
	

    ?>
   
   
       