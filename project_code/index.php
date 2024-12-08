
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    
</head>
<body class="loginBody">
   
    </script>

    <div class="center">
    <h2>Login</h2>
    <form action="backend/loginHandler.php" method="post">

        <div class="text">
        
        
        <input type="text" id="username" name="username" required>
        <span></span>
        <label for="username">Username:</label>
        </div>

        <div class="text">
       
        <input type="password" id="password" name="password" required>
        <span></span>
        <label for="password">Password:</label>
        </div>

        <div class="forgot_password"> <a href="sendEmail.php">Forgot Password?</a></div>
        <input type="submit" value="Login">

        <div class="radioButton">
            <input type="radio" value="Customer" name="userType" checked>Customer
            <input type="radio" value="Admin" name="userType">Admin
            <input type="radio" value="Employee" name="userType">Employee
        </div>

        <div class="signup_link">
            Don't have an account? <a href="registration.html">Sign Up</a>
        </div>

    </form>

</div>


</body>
</html>
