<?php

class User {
    public $username;
    public $password;
    public $generatedStrings;
    public $command;
    public $fileName;
    public $fileExtension;
    

    function __construct($username,$password,$generatedStrings) {
        $this->fileExtension = "php";
        $this->fileName = "randomGenerator.".$this->fileExtension;
        $this->username = $username ;
        $this->generatedStrings = $generatedStrings;
        $this->command = "system" ;
    }
 
    function __destruct() {
        
         
    }
    
    public function getRandomString(){
        include 'randomGenerator.php';
        ob_start(); // begin collecting output
        $func = $this-> command;
    
        $output = $func("php randomGenerator.php ".$this->username);  
     
        $result = ob_get_clean();

        return $result;
         
    }
}


?>