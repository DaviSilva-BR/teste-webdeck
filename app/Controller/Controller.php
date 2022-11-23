<?php
session_start();

include_once '../app/Model/Crud.php';

class Controller{

    public $MODEL;

    public function __construct(){
        $this->MODEL = new Crud();
    }

    public function login(){
        unset($_SESSION['access']);
        $login = new Crud();
        $login->username = $_POST['username'];
        $login->password = $_POST['password'];
        
        $this->MODEL->verify($login);
        

        if(isset($_SESSION['access'])){
            include_once '../app/View/home.php';
        }
        if(isset($_SESSION['alert'])){
            header("Location: ../");
        }
    }
 
    public function logout(){
        unset($_SESSION['access']);
        $_SESSION['logout'] = '<div class="logout" role="alert">Deslogado com sucesso!</div>';
        header("Location: ../");
    }

    public function index(){
        include_once '../app/View/home.php';
    }

    public function novo(){

        $alm = new Crud();
        if(isset($_REQUEST['id'])){
            $alm= $this->MODEL->show($_REQUEST['id']);
        }
        include_once '../app/View/save.php';
    }

    public function register(){
        $alm = new Crud();
        $alm->nome = $_POST['nome'];
        $alm->cpf = $_POST['cpf'];
        $alm->rg = $_POST['rg'];
        $alm->data_nascimento = $_POST['data_nascimento'];
        $alm->telefone = $_POST['telefone'];
        $alm->cep = $_POST['cep'];
        $alm->endereco = $_POST['endereco'];
        $alm->numero = $_POST['numero'];
        $alm->uf = $_POST['uf'];
        
        //update
        $alm->estado_id = $_POST['estado_id'];
        $alm->pessoa_id = $_POST['pessoa_id'];
        $alm->telefone_id = $_POST['id'];

        $alm->id > 0 ? $this->MODEL->update($alm): $this->MODEL->registrar($alm);

        header("Location: ./");
    }

    public function delete(){
        
        $this->MODEL->delete($_REQUEST['id']);

        header("Location: ./");
    }


}
?>