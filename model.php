<!-- Name: Leslie Ibarra -->
<?php
session_start();

class DatabaseAdaptor {
    private $DB;
    public function __construct() {
        $dataBase =
        'mysql:dbname=quotes;charset=utf8;host=127.0.0.1';
        $user =
        'root';
        $password =
        '';
        try {
            $this->DB = new PDO ( $dataBase, $user, $password );
            $this->DB->setAttribute ( PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $e ) {
            echo ('Error establishing Connection');
            exit ();
        }
    }
    
//---------------- Functions START --------------------------//

    public function getAllQuotations() {
        $stmt = $this->DB->prepare("SELECT * FROM quotations ORDER BY rating DESC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    } //END getAllQuotations() function
 
    public function addQuote($quote, $author) {
        $stmt = $this->DB->prepare("INSERT INTO quotations(quote, added, author, rating, flagged)
                                    VALUES('" . $quote . "', NOW(), '" . $author . "', 0, 0);");
        $stmt->execute();
    } //END addQuote() function
    
   public function deleteQuote($id) {
        $stmt = $this->DB->prepare("DELETE FROM quotations where id = " . $id . ";");
        $stmt->execute();
    } //END deleteQuote() function
    
    public function increaseRating($id, $rating) {
        $rating++;
        $stmt = $this->DB->prepare("UPDATE quotations SET rating = ". $rating . " WHERE id = " . $id . ";");
        $stmt->execute();
    } // END increaseRating() function
    
    public function decreaseRating($id, $rating) {
        $rating--;
        $stmt = $this->DB->prepare("UPDATE quotations SET rating = ". $rating . " WHERE id = " . $id . ";");
        $stmt->execute();
    } // END increaseRating() function
    
    public function addUser($username, $psw) {
        $stmt = $this->DB->prepare("SELECT * FROM users WHERE username = '" . $username . "';");
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
        if ($array == []) {
            $stmt = $this->DB->prepare("INSERT INTO users(username, password) VALUES(:bind_user, :bind_psw);");
            $stmt->bindParam(':bind_user', $username);
            $stmt->bindParam(':bind_psw', $psw);
            $stmt->execute();
            return true;
        }
        
        return false;
    } //END addUser() function
    
    public function getAllUsers() {
        $stmt = $this->DB->prepare("SELECT * FROM users;");
        $stmt->execute();
        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    } //END getAllUsers() function
    
    public function verifyCredentials($username, $psw) {
        $stmt = $this->DB->prepare("SELECT * FROM users WHERE username = :bind_user;");
        $stmt->bindParam(':bind_user', $username);
        //$stmt->bindParam(':bind_psw', $psw);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (password_verify($psw, $user[0]['password'])){
            return true;
        }
        return false;
        
    } //END verifyCredentials() function
 
    
  
 //---------------- Functions END --------------------------// 
    
} //END DatabaseAdaptor class

?>