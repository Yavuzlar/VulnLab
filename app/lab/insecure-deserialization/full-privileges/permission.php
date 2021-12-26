<?php

class Permission{

    public $canDelete;
    public $canUpdate;
    public $canAdd;

    

    function __construct($canDelete,$canUpdate, $canAdd) {
        $this->canDelete = $canDelete;
        $this->canUpdate = $canUpdate;
        $this->canAdd =  $canAdd;
      }

 
  

    function __toString(){

        return "Can delete ? : ".$this -> canDelete." Can update : ".$this -> canUpdate. " Can add : ".$this -> canAdd;
    }

}



?>