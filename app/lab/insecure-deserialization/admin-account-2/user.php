<?php

    class User{

        public $username;
        public $password;
        public $isAdmin;
        
        

        function __construct($username,$password, $isAdmin) {
            $this->username = $username;
            $this->password = $password;
            $this->isAdmin = $isAdmin;
          }

        function __toString(){

            return "Username : ".$this -> username." Password : ".$this -> password. " is admin? : ".$this -> isAdmin;
        }

    }


?>