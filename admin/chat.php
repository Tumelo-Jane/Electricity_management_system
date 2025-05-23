<?php
session_start();

include 'backend/connection.php';


$sql = "SELECT DISTINCT(CustomerID),names,profile FROM query where CustomerID NOT like 1111" ;
$result = $conn->query($sql);
$count =0;



    if(isset($_GET['CustomerID'] ))
    {
  $CustomerID = $_GET['CustomerID'];

  $_SESSION['CustomerID'] = $CustomerID;
   
  $sql = "SELECT * FROM query where CustomerID='$CustomerID' OR  receiver ='$CustomerID'" ;
  $Messages = $conn->query($sql);

  $query = "UPDATE query SET status = 'Read' WHERE CustomerID='$CustomerID'" ;
  $conn->query($query);


  $sql1 = "SELECT names FROM query where CustomerID='$CustomerID'" ;
  $names = $conn->query($sql1);
  
       
    

    }
 
        $conn->close();

?>





<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">



<title>Chat</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/chat.css" rel="stylesheet">

</head>
<body>
<main class="content">
<div class="container p-0">
<h1 class="h3 mb-3">Messages</h1>
<div class="card">
<div class="row g-0">
<div class="col-12 col-lg-5 col-xl-3 border-right">
<div class="px-4 d-none d-md-block">
<div class="d-flex align-items-center">
<div class="flex-grow-1">
<input type="text" class="form-control my-3" placeholder="Search...">
</div>
</div>
</div>
<?php
include 'backend/connection.php';


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
        $count=0;

       $CustomerID = $row['CustomerID'];

  $queryCount = "SELECT * FROM query where CustomerID='$CustomerID' AND  status ='Unread'" ;
  $statusCount = $conn->query($queryCount);

  
  if ($statusCount->num_rows > 0) {
    // output data of each row
    while($rows = $statusCount->fetch_assoc()) 
    {
        $count =$count+1;
    }

}


?>
<a href="chat.php?CustomerID=<?php echo $CustomerID;?> " class="list-group-item list-group-item-action border-0">

<div class="badge bg-success float-right"> <?php echo $count;?>  </div>
<div class="d-flex align-items-start">
<img src="../images/profiles/<?php echo $row['profile'];?>" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">
<div class="flex-grow-1 ml-3">
    <?php echo $row['names'];?>
<div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
</div>
</div>
</a>

<?php
    }
}
?>
<hr class="d-block d-lg-none mt-1 mb-0">
</div>
<div class="col-12 col-lg-7 col-xl-9">
<div class="py-2 px-4 border-bottom d-none d-lg-block">
<div class="d-flex align-items-center py-1">
<div class="position-relative">
<img src="<?php echo $row['profile'];?>" class="rounded-circle mr-1" alt="IMG" width="40" height="40">
</div>
<div class="flex-grow-1 pl-3">
<strong>
<?php if(isset($names)){

$row = $names->fetch_row(); 

    
    echo $row[0];}
    
    
    else{

        echo "user";
    }?>

   
</strong>
<div class="text-muted small"><em>Typing...</em></div>
</div>
<div>
<button class="btn btn-primary btn-lg mr-1 px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone feather-lg"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></button>
<button class="btn btn-info btn-lg mr-1 px-3 d-none d-md-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video feather-lg"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg></button>
<button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></button>
</div>
</div>
</div>
<div class="position-relative">
<div class="chat-messages p-4">
<?php
if(isset($Messages)){
if ($Messages->num_rows > 0) {
    // output data of each row
    while($row = $Messages->fetch_assoc()) 
    {
    
      if($row['receiver'] == $_SESSION['CustomerID'])
      {
   
?>

<div class="chat-message-right pb-4">

<div>
<img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
<div class="text-muted small text-nowrap mt-2">2:33 am</div>
</div>
<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
<div class="font-weight-bold mb-1">You</div>

<?php echo $row['messages'];?>

</div>
</div>
<?php
      }else{
      ?>

<div class="chat-message-left pb-4">
<div>
<img src="<?php echo $row['profile'];?>" class="rounded-circle mr-1" alt="img" width="40" height="40">
<div class="text-muted small text-nowrap mt-2">2:44 am</div>
</div>
<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
<div class="font-weight-bold mb-1"><?php echo $row['names'];?></div>

<?php echo $row['messages'];?>
</div>
</div>

<?php
      }
}

}else{
?>



<?php } 
}?> 
</div>
</div>
<form action="backend/sendMessage.php" method="POST">
<div class="flex-grow-0 py-3 px-4 border-top">
<div class="input-group">
<input type="text" class="form-control" name="message" placeholder="Type your message">
<button class="btn btn-primary">Send</button>
</div>
</div>

</form>
</div>
</div>
</div>
</div>
</main>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>