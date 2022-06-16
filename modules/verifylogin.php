<?php
// Arquivo que recebe os dados
session_start();
require('query.php');

class VerifyGet{
    private $user;
    private $password;
    private $valid;
    public function __construct(){
        if(!empty($_GET['user']) && !empty($_GET['pass'])){
            $this->user = $_GET['user'];
            $this->password = $_GET['pass'];
            $this->valid = true;
        }else if(empty($_GET['user']) or empty($_GET['pass'])){
            $this->user = '';
            $this->password = '';
            $this->valid = false;
        }
    }
    public function getUser(){
        return $this->user;
    }
    public function getPass(){
        return $this->password;
    }
    public function getValid(){
        return $this->valid;
    }
}
class Consult{
    private $queryConsult;
    private $con;
    public function __construct($queryConsult , $con){
        $this->queryConsult = $queryConsult;
        $this->con = $con;
    }
    public function consultDB(){
        $result = mysqli_query($this->con, $this->queryConsult) or die ('Não foi possível realizar a consulta');
        $numRows = mysqli_num_rows($result);
        return $numRows;
    }
}
$verifyGetAllUsers = new VerifyGet();
$valid = $verifyGetAllUsers->getValid();
if($valid == true){
    $user = $verifyGetAllUsers->getUser();
    $password = $verifyGetAllUsers->getPass();
}else if($valid == false){
    echo "Credênciais não informadas!";
    exit;
}
if($statusCon){
    $clearInjection = new ClearInjectionBasic($con, CMuser, $user, CMpassword, $password, TABLE);
    $queryUserValid = $clearInjection->getResult();
    // echo $queryUserValid;
    $consult = new Consult($queryUserValid, $con);
    $result = $consult->consultDB();
    echo $result;
    $resultString = $result == 1 ? 'true' : 'false';
    $jsonResult = "{'usuario':'{$user}','login_autorizado':'{$resultString}'}";
    $_SESSION['jsonResult'] = $jsonResult;
    if($result == 1){
        // header("Location: ../apidb?valid={$result}");
        header("Location: ../apidb");
        exit;
    }else if($result == 0){
        header("Location: ../apidb");
        exit;
    }
}


?>