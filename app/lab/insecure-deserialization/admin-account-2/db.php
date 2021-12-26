<?php
class db {

  
    private $userlist;

    function __construct() {
        $this->userlist = array(
            0 => array(
                'username' => md5('administrator'),
                'password' => md5('a2T%tq+<=VuLJh8,}fBwU@Qttn+YR{rq'),
                'isAdmin' => 1
            ),
            1 => array(
                'username' => md5('test'),
                'password' => md5('test'),
                'isAdmin' => 0
            )
        );

      }

   

    function getUsersList(){

        return $this->userlist;
    }
}
?>
