<?php
 
class db {

    
    private $userlist;

    function __construct() {

        $this->userlist = array(
            0 => array(
                'username' => md5('administrator'),
                'password' => md5('a2T%tq+<=VuLJh8,}fBwU@Qttn+YR{rq')
            ),
            1 => array(
                'username' => 'test',
                'password' => md5('test'),
            )
        );

      }

   

    function getUsersList(){

        return $this->userlist;
    }
}
?>