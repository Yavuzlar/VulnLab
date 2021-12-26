<?php
class DB {

  
    private $userlist;

    function __construct() {
        $this->userlist = array(
            0 => array(
                'username' => 'test',
                'password' => 'test'
            ),
            1 => array(
                'username' => 'admin',
                'password' => 'HRGJFSOORWIEJ^C2341*029!2-3523'
            ),
        );
      }
   

    function getUsersList(){

        return $this->userlist;
    }
}
?>