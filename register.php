<!-- Name: Leslie Ibarra -->
<?php 
    session_start();
?>
<html>
<head>
<link rel='stylesheet' type='text/css' href='styles.css'/>
<title>Register</title>
</head>
<body>


    <h3> Register </h3>
    
        <form id='Register_box' action='controller.php' method='get' autocomplete='off'>
        
        Enter a username:<br>
        <input name='username' type='text' id='username' placeholder='Username' required></input><br>
        Enter a password:<br>
        <input name='password' type='password' id='password' placeholder='Password' required></input><br>
        <input name='register_button' type='submit'></input>
        
        </form>
<?php 
    if(isset($_SESSION ['register_ERROR']))
    echo $_SESSION ['register_ERROR'];
    unset($_SESSION ['resiter_ERROR']); 
?>

</body>
</html>
