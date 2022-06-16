<?php
// Arquivo que manipula os dados
require('../config/config.php');
class QueryUser{
    protected $selectUser;
    protected function selectBasicUser($userName, $user, $pass, $passUser, $table){
        $this->selectBasic = "Select * From {$table} where {$userName} = '{$user}' and {$pass} = md5('{$passUser}');";
        return $this->selectBasic;
    }
}
class ClearInjectionBasic extends QueryUser{
    private $con;
    private $table;
    private $userName;
    private $user;
    private $passUser;
    private $pass;
    private $return;
    public function __construct($con, $userName, $user, $pass, $passUser, $table){
        $QueryClass = new QueryUser();
        $this->con = $con;
        $this->user = mysqli_real_escape_string($this->con, $user);
        $this->pass = mysqli_real_escape_string($this->con, $pass);
        $this->userName = $userName;
        $this->passUser = $passUser;
        $this->table = $table;
        $this->return = $QueryClass->selectBasicUser($this->userName, $this->user, $this->pass, $this->passUser, $this->table);
    }
    public function getResult(){
        return $this->return;
    }
}
?>