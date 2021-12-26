<?php

    class User{

        public $username;
        public $password;
        public $isAdmin;
        public $permissions;
        

        function __construct($username,$password, $isAdmin,$permissions) {
            $this->username = $username;
            $this->password = $password;
            $this->isAdmin = $isAdmin;
            $this->permissions =  $permissions;
          }

        function __toString(){

            return "Username : ".$this -> username." Password : ".$this -> password. " is admin? : ".$this -> isAdmin." Permissions ".$this->permissions;
        }

    }


?>