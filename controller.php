<!-- Name: Leslie Ibarra -->

<?php
//require_once './model.php';

include 'model.php';

//session_start();
//--------------- Controller Commands ------------------//
//-->DISPLAY ALL QUOTES
if (isset($_GET ['command']) && ($_GET ['command'] === "AllQuotes")) {
    
    $theDBA = new DatabaseAdaptor();
    $quotesArr = $theDBA->getAllQuotations();
    unset($_GET['command']);
    
    $str = "";
    for($i = 0; $i < count($quotesArr); $i++) {
        
        $str .= "<form action='controller.php?' id='QuoteBox' method='get' name='RDform'>'" . htmlspecialchars($quotesArr[$i]['quote']) . "'<br>-- " .
            htmlspecialchars($quotesArr[$i]['author']) .
            "<br><br><input name='increase_rating_button' type='submit' value='+'></input>" . $quotesArr[$i]['rating'] . 
            "<input name='decrease_rating_button' type='submit' value='-'></input>";
            
            //Display delete quote button
            if(isset($_SESSION['loggedIN'])) {
                $str .= "<input name='delete_quote_button' type='submit' value='Delete'></input>
                        <input name='quoteID' type='hidden' value='" . htmlspecialchars($quotesArr[$i]['id']) . "'></input><input name='quoteRating' type='hidden' value='" . htmlspecialchars($quotesArr[$i]['rating']) . "'</input></form>";
            }
            else {
                $str .= "<input name='quoteID' type='hidden' value='" . htmlspecialchars($quotesArr[$i]['id']) . "'></input><input name='quoteRating' type='hidden' value='" . htmlspecialchars($quotesArr[$i]['rating']) . "'</input></form>";
            }
            
    }
    echo $str;
}
//--> ADD QUOTE
if (isset($_GET['add_quote_button'])) {
    $theDBA = new DatabaseAdaptor();
    $theDBA->addQuote(addslashes($_GET['quote']), addslashes(($_GET['author'])));
    
    header ( "Location: view.php" );
}

//-->INCREASE RATING
if (isset($_GET['increase_rating_button'])) {
    $theDBA = new DatabaseAdaptor();
    $theDBA->increaseRating($_GET['quoteID'], $_GET['quoteRating']);
    
    header ( "Location: view.php");
}

//-->DECREASE RATING
if (isset($_GET['decrease_rating_button'])) {
    $theDBA = new DatabaseAdaptor();
    $theDBA->decreaseRating($_GET['quoteID'], $_GET['quoteRating']);
    
    header ( "Location: view.php");
}

//-->DELETE QUOTE
if (isset($_GET['delete_quote_button'])) {
    $theDBA = new DatabaseAdaptor();
    $theDBA->deleteQuote($_GET['quoteID']);
    
    header ( "Location: view.php");
}

//-->REGISTER
if (isset($_GET['register_button'])) {
    $theDBA = new DatabaseAdaptor();
    $username = htmlspecialchars($_GET['username']);
    $password = htmlspecialchars($_GET['password']);
    $hashed_psw = password_hash($password, PASSWORD_DEFAULT);
    $temp = $theDBA->addUser($username, $hashed_psw);
    
    //Successful registration
    if($temp == true) {
        header ( "Location: view.php" );
    }
    //Registration Failed
    else {
        $_SESSION['register_ERROR'] = "Account name has already been taken. <br> Please enter a new account name:";
        header ( "Location: register.php" );
        
    }
   
}

//-->LOGIN
if (isset($_GET['login_button'])) {
    $theDBA = new DatabaseAdaptor();
    $username = addslashes(htmlspecialchars($_GET['username']));
    $password = addslashes(htmlspecialchars($_GET['password']));
    $temp = $theDBA->verifyCredentials($username, $password);
    //Successful login
    if($temp == true) {
        $_SESSION['loggedIN'] = true;
        header ( "Location: view.php" );
    }
    //Login failure
    else {
        $_SESSION['login_ERROR'] = "Incorrect username or password. Please try again:";
        header ( "Location: login.php" );
        
    }  
}
if (isset($_GET ['logout']) && ($_GET ['logout'] === "true")) {
    unset($_SESSION['loggedIN']);
    header ( "Location: view.php" );
}


?>