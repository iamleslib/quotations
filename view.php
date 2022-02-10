<!-- Name: Leslie Ibarra -->
<?php 
    session_start();
    
?>
<html>
<head>
<link rel='stylesheet' type='text/css' href='styles.css'/>
<title>Quotation Service</title>

</head>

<body onload="JSfunction()">

<h1>Quotation Service</h1><br><hr> 
<?php 
    //Logged IN
    if(isset($_SESSION['loggedIN'])) {
        echo " <a href='addQuote.php'><button id='addQuoteButton'>Add Quote</button></a>
                   <a href='controller.php?logout=true'><button id='logoutButton'>Logout</button></a>";
    }
    //Logged OUT
    else {
        echo " <a href='login.php'><button id='loginButton'>Login</button></a>
                   <a href='register.php'><button id='registerButton'>Register</button></a> ";
        
    }
?>

    <div id='quotations_list'></div>
</body>

</html>

<script>
var divToChange = document.getElementById('quotations_list');

function JSfunction() {
	var ajax = new XMLHttpRequest();
    ajax.open("GET", "controller.php?command=AllQuotes");
    ajax.send();

    ajax.onreadystatechange = function() {
        if((ajax.readyState == 4) && (ajax.status == 200)) {
        	if(ajax.responseText == "[]") {
        		divToChange.innerHTML = "<br>No quotations found.";
				return -1;
			}
        	divToChange.innerHTML = ajax.responseText;
        }
	}
} //END JSfunction()

</script>

