<?php
    ob_start();
    session_start();

    if( isset($_POST['chat-input']) ){

        $message = $_POST['chat-input'];

        $db = new PDO('sqlite:database.db');

        require("../../../lang/lang.php");
        $strings = tr();

        ////////////////////////////////    ADMIN PAGE START    ////////////////////////////////////
        if($_SESSION['authority'] == "user"){
                $session = "admin";
        }
        if($_SESSION['authority'] == "admin"){
            $session = "user";
    }
        if (filter_var($message, FILTER_VALIDATE_URL)) {

            $url = $message;
            $parts = parse_url($url);
            $query = array();

            error_reporting(0);
            
            parse_str($parts['query'], $query);

            if( isset($query['new_password']) && isset($query['confirm_password']) ){
                if( $query['new_password'] == $query['confirm_password'] ){

                    $insert = $db -> prepare("UPDATE csrf_changing_password SET password=:password WHERE authority=:authority");
                    $status_insert = $insert -> execute(array(
                        'authority' => $session,
                        'password' => $query['new_password']
                    ));
    
                }
            }

        }
        ////////////////////////////////    ADMIN PAGE END  ////////////////////////////////////

        if($_SESSION['authority'] == "user"){
            $insert_s = 'INSERT INTO csrf_chat (authority, message) VALUES ("user", "'.$message.'")';
            $insert_send = $db -> query($insert_s);
    
            $message_reply = $strings['message_reply'];
            $insert_r = 'INSERT INTO csrf_chat (authority, message) VALUES ("admin", "'.$message_reply.'")';
            $insert_reply = $db -> query($insert_r);
        }

        if($_SESSION['authority'] == "admin"){
            $insert_s = 'INSERT INTO csrf_chat (authority, message) VALUES ("admin", "'.$message.'")';
            $insert_send = $db -> query($insert_s);
    
            $message_reply = $strings['message_reply'];
            $insert_r = 'INSERT INTO csrf_chat (authority, message) VALUES ("user", "'.$message_reply.'")';
            $insert_reply = $db -> query($insert_r);
        }


        $select = $db -> prepare("SELECT * FROM csrf_chat ORDER BY id DESC");
        $select -> execute();
        $db_messages = $select -> fetchAll(PDO::FETCH_ASSOC);
    
        foreach($db_messages as $db_message){
    
            if($_SESSION['authority'] == "user"){
                if($db_message['authority'] == "user"){
                    echo '<div class="messages__item messages__item--operator">'.$db_message['message'].'</div>';
                }
                if($db_message['authority'] == "admin"){
                    
                    echo '<div class="messages__item messages__item--visitor">'.$db_message['message'].' <pre class="m-0 mt-1 text-danger">admin</pre> </div> ';

                }
            }

            if($_SESSION['authority'] == "admin"){
                if($db_message['authority'] == "admin"){
                    echo '<div class="messages__item messages__item--operator">'.$db_message['message'].'</div>';
                }
                if($db_message['authority'] == "user"){
                    
                    echo '<div class="messages__item messages__item--visitor">'.$db_message['message'].'<pre class="m-0 mt-1 text-danger">user</pre></div> ';

                }
            }

            
                
        }




    }else{
        header("Location: index.php");
        exit;
    }
    

?>