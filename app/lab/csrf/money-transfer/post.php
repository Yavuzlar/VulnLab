<?php

    if( isset($_POST['chat-input']) ){

        $message = $_POST['chat-input'];

        $db = new PDO('sqlite:database.db');

        require("../../../lang/lang.php");
        $strings = tr();

        ////////////////////////////////    ADMIN PAGE START    ////////////////////////////////////

        $_SESSION['authority'] = "admin";
        
        if (filter_var($message, FILTER_VALIDATE_URL)) {

            $url = $message;
            $parts = parse_url($url);
            $query = array();

            error_reporting(0);
            
            parse_str($parts['query'], $query);
            

            if( isset($query['transfer_amount']) && isset($query['receiver']) ){

                $selectUser = $db -> prepare("SELECT * FROM csrf_money_transfer WHERE authority=:authority");
                $selectUser -> execute(array('authority' => $_SESSION['authority']));
                $selectUser_Info = $selectUser -> fetch();   

                if( $query['transfer_amount'] > 0 ){
                    if( $selectUser_Info['money'] >= $query['transfer_amount'] ){

                        $sender_new_money = $selectUser_Info['money'] - $query['transfer_amount'];
            
                        $sender_update = $db -> prepare("UPDATE csrf_money_transfer SET money=:money WHERE authority=:authority");
                        $status_sender_update = $sender_update -> execute(array(
                            'authority' => $_SESSION['authority'],
                            'money' => $sender_new_money 
                        ));
            
                        $selectReceiver = $db -> prepare("SELECT * FROM csrf_money_transfer WHERE authority=:authority");
                        $selectReceiver  -> execute(array('authority' => $query['receiver']));
                        $selectReceiver_Info = $selectReceiver  -> fetch();
            
                        $receiver_new_money = $selectReceiver_Info['money'] + $query['transfer_amount'];
            
                        $receiver_update = $db -> prepare("UPDATE csrf_money_transfer SET money=:money WHERE authority=:authority");
                        $status_receiver_update = $receiver_update -> execute(array(
                            'authority' => $query['receiver'],
                            'money' => $receiver_new_money
                        ));
            
                    }
                }


            }


        }
        ////////////////////////////////    ADMIN PAGE END  ////////////////////////////////////

        
        $insert_s = 'INSERT INTO csrf_chat (authority, message) VALUES ("user", "'.$message.'")';
        $insert_send = $db -> query($insert_s);
    
        $message_reply = $strings['message_reply'];
        $insert_r = 'INSERT INTO csrf_chat (authority, message) VALUES ("admin", "'.$message_reply.'")';
        $insert_reply = $db -> query($insert_r);
        
        $select = $db -> prepare("SELECT * FROM csrf_chat ORDER BY id DESC");
        $select -> execute();
        $db_messages = $select -> fetchAll(PDO::FETCH_ASSOC);
    
        foreach($db_messages as $db_message){
    
            if($db_message['authority'] == "user"){
                echo '<div class="messages__item messages__item--operator">'.$db_message['message'].'</div>';
            }
            if($db_message['authority'] == "admin"){
                echo '<div class="messages__item messages__item--visitor">'.$db_message['message'].' <pre class="m-0 mt-1 text-danger">admin</pre> </div> ';
            }
                
        }


    }else{
        header("Location: index.php");
        exit;
    }
    

?>