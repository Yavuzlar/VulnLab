<?php

    class User{

        public $username;
        public $password;
 

        function __construct($username,$password) {
            $this->username = $username;
            $this->password = $password;
          }

        function __toString(){

            return "Name : ".$this -> username." Surname : ".$this -> password;
        }

    }


?>