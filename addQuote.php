<!-- Name: Leslie Ibarra -->
<?php 
    session_start();
?>
<html>
<head>
<link rel='stylesheet' type='text/css' href='styles.css'/>
<title>Add Quote</title>
</head>
<body>

    <h3> Add a Quote </h3>
    
    <form id='AddQuote_box' action='controller.php' method='get' autocomplete='off'>
    
    <textarea name='quote' id='quote' placeholder='Enter new quote' required></textarea>
    <input name='author' type='text' id='author' placeholder='Author' required></input>
    <input name ='add_quote_button' type='submit'></input>
    
    </form>
   
</body>
</html>

