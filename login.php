<!-- Name: Leslie Ibarra -->
<?php 
    session_start();
?>
<html>
<head>
<link rel='stylesheet' type='text/css' href='styles.css'/>
<title>Login</title>
</head>
<body>

    <h3> Login </h3>
    
    <form id='Box' action='controller.php' method='get' autocomplete='off'>
    
    <input name='username' type='text' id='username' placeholder='Username' required></input>
    <input name='password' type='password' id='password' placeholder='Password' required></input>
    <input name='login_button' type='submit'></input>
    </form>
<?php 
    if(isset($_SESSION ['login_ERROR']))
    echo $_SESSION ['login_ERROR'];
    unset($_SESSION ['login_ERROR']); 
?>

</body>
</html>

