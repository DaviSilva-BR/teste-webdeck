<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

class Crud{

    //crud
    public $conn;
    public $id_zapato;
    public $nome;
    public $cpf;
    public $rg;
    public $data_nascimento;
    public $telefone;
    public $endereco;
    public $numero;
    public $cep;
    public $uf;
    public $estado_id;
    public $pessoa_id;
    public $endereco_id;


    //login
    public $username;
    public $password;

    public function __construct(){
        try{
            $this->conn = Connect::Conn();
        }catch(Exception $e){
            die($e->getMessage);

        }
    }
    public function verify(crud $data){
        try {
 
            $username = $data->username;
            $password = $data->password;
            // password_hash('123', PASSWORD_DEFAULT);

            $login = "SELECT * FROM login WHERE username=?";
            $stmp = $this->conn->prepare($login);
            $stmp->execute(array($username));
            if( ($stmp) AND ($stmp->rowCount() != 0)){

                $row_login = $stmp->fetch(PDO::FETCH_OBJ);
                if(password_verify($password, $row_login->password)){
                    return $_SESSION['access'] = $row_login->id;

                }else{
                    
                    return $_SESSION['alert'] = '<div class="alert" role="alert">Login ou senha estão incorretos!</div>';
                }
            }else{
                return $_SESSION['alert'] = '<div class="alert" role="alert">Login ou senha estão incorretos!</div>';
            }  
            

        } catch (Exception $e) {
           die($e->getMessage());
        }
    }


    public function Listar(){
        try {

            $query = "SELECT * FROM estados AS est INNER JOIN enderecos AS end ON end.estado_id = est.id INNER JOIN pessoas AS pes  ON pes.endereco_id = end.id INNER JOIN telefones AS tel ON tel.pessoa_id = pes.id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return  $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
           die($e->getMessage());
        }
    }

    public function carregarUF(){
        try {
            
            $query = "SELECT * FROM estados";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return  $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (Exception $e) {
           die($e->getMessage());
        }
    }

  

    public function registrar(crud $data){
        try {
            $query = "INSERT INTO enderecos (estado_id,cep,endereco,numero)VALUES(?,?,?,?)";
            $this->conn->prepare($query)->execute(array($data->uf,$data->cep,$data->endereco,$data->numero));
            $endereco_id = $this->conn->lastInsertId();

            try {
                $data_cadastro = date("Y-m-d H:i:s");
                $query = "INSERT INTO pessoas (endereco_id,nome,cpf,rg,data_nascimento,data_cadastro)VALUES(?,?,?,?,?,?)";
                $this->conn->prepare($query)->execute(array($endereco_id,$data->nome,$data->cpf,$data->rg,$data->data_nascimento,$data_cadastro));
                $pessoa_id = $this->conn->lastInsertId();
                
                try {
                    $query = "INSERT INTO telefones (pessoa_id,telefone)VALUES(?,?)";
                    $this->conn->prepare($query)->execute(array($pessoa_id,$data->telefone));
                    $pessoa_id = $this->conn->lastInsertId();
                    
                } catch (Exception $e) {
                    die($e->getMessage());
                }
                
            } catch (Exception $e) {
                die($e->getMessage());
            }
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function show($id){
        try {
            $query = "SELECT * FROM estados AS est INNER JOIN enderecos AS end ON end.estado_id ='$id' INNER JOIN pessoas AS pes  ON pes.endereco_id = end.id INNER JOIN telefones AS tel ON tel.pessoa_id = pes.id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();        
            return $stmt->fetch(PDO::FETCH_OBJ);
        
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function update(crud $data){
        try {
            $query = "UPDATE enderecos SET estado_id=?,cep=?,endereco=?,numero=? WHERE id=?";
            $this->conn->prepare($query)->execute(array($data->uf,$data->cep,$data->endereco,$data->numero,$data->estado_id));

            try {
                $data_modificacao = date("Y-m-d H:i:s");
                $query = "UPDATE pessoas SET nome=?,cpf=?,rg=?,data_nascimento=?,data_cadastro=? WHERE id=";
                $this->conn->prepare($query)->execute(array($data->nome,$data->cpf,$data->rg,$data->data_nascimento,$data_modificacao,$data->pessoa_id));
                
                try {
                    $query = "UPDATE telefones SET pessoa_id=?,id=?";
                    $this->conn->prepare($query)->execute(array($data->pessoa_id,$data->telefone_id));

                } catch (Exception $e) {
                    die($e->getMessage());
                }
                
            } catch (Exception $e) {
                die($e->getMessage());
            }
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function delete($id){
        
        // Consulta Campos
        try {
            $query_consult = "SELECT * FROM estados AS est INNER JOIN enderecos AS end ON end.estado_id ='$id' INNER JOIN pessoas AS pes  ON pes.endereco_id = end.id INNER JOIN telefones AS tel ON tel.pessoa_id = pes.id";
            $stmt = $this->conn->prepare($query_consult);
            $stmt->execute();
            $row_consult = $stmt->fetch(PDO::FETCH_OBJ);
            $pessoa_id = $row_consult->pessoa_id;
            // Remove a tabela enderecos 1/3
            $query = "DELETE FROM enderecos WHERE estado_id ='$id' ";
            $stmt = $this->conn->prepare($query);
            try {
                $stmt->execute();

                // Remove a tabela telefones 2/3
                $query = "DELETE FROM telefones WHERE pessoa_id='$pessoa_id' ";
                $stmt = $this->conn->prepare($query);
                try {
                    $stmt->execute();
                    // Limpa a tabela pessoas 3/3
                    $query = "UPDATE pessoas SET endereco_id='', nome='', cpf='', rg='', data_nascimento=''  WHERE id='$pessoa_id' ";
                    $stmt = $this->conn->prepare($query);
                    try {
                        $stmt->execute();
                        
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                    
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


   
}