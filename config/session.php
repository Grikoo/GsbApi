<?php
class Session{
        
    // specify your own database credentials
    public $user;
    public $pwd;
    public $timer;
    public $token;
    public $valid;

    public function login($user, $pwd, $token ,$timer){
        $clefprivee = '1234';
        if($user!='gsb'){
            echo json_encode(
                array("login" => "Erreur login")
            );
            die;
        }
        if($pwd!='gsb'){
            echo json_encode(
                array("login" => "Erreur login")
            );
            die;
        }
        
        if((time()-$timer)>1200){
            echo json_encode(
                array("login" => "Token exipré")
            );
            die;
        }
        if(sha1($user.$timer.$pwd.$clefprivee)!=$token){
            echo json_encode(
                array("login" => "Erreur Token")
            );
            die;
        }
        $this->$user = $user;
        $this->$pwd = $pwd;
        $tok_timer = array();
        $tok_timer_item=array(
        "token"=>$token,
        "valid"=>$timer
        );
        array_push($tok_timer,$tok_timer_item);
    }
}