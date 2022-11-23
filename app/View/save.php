<?php 
if(!isset($_SESSION)){ 
    session_start(); 
}
if(!isset($_SESSION['access'])):
  header("Location: ../");
endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <title>Crud Usuários</title>
</head>
<body>
    <div class="container">
        <div class="row div col m12">
            <div class="card black white-text text-center mb-2">
                <h2>Crud Usuários</h2>
            </div>
        </div>
        <a href="./" class="btn btn-info">VOLTAR</a>
        <form action="?c=register" method="post">
        <input type="hidden" name="endereco_id" value="<?php echo $alm->endereco_id?>">
        <input type="hidden" name="pessoa_id" value="<?php echo $alm->pessoa_id?>">
        <input type="hidden" name="telefone_id" value="<?php echo $alm->id?>">
            <div class="row">
                <div class="col m3"></div>
                <div class="col m3">NOME:</div>
                <div class="col m3">
                    <input type="text" name="nome" value="<?php echo $alm->nome?>" class="form-control">
                </div>
                <div class="col m3"></div>
            </div>
            <div class="row">
                <div class="col m3"></div>
                <div class="col m3">CPF:</div>
                <div class="col m3">
                    <input type="text" id="cpf" name="cpf" value="<?php echo $alm->cpf?>" class="form-control">
                </div>
                <div class="col m3"></div>
            </div>
            <div class="row">
                <div class="col m3"></div>
                <div class="col m3">RG:</div>
                <div class="col m3">
                    <input type="text"  name="rg" maxlength="11" value="<?php echo $alm->rg?>" class="form-control">
                </div>
                <div class="col m3"></div>
            </div>
            <div class="row">
                <div class="col m3"></div>
                <div class="col m3">DATA NASCIMENTO:</div>
                <div class="col m3">
                    <input type="date"  name="data_nascimento" value="<?php echo $alm->data_nascimento?>" class="form-control">
                </div>
                <div class="col m3"></div>
            </div>
            <div class="row">
                <div class="col m3"></div>
                <div class="col m3">TELEFONE:</div>
                <div class="col m3">
                    <input type="text" id="telefone" name="telefone" value="<?php echo $alm->telefone?>" class="form-control">
                </div>
                <div class="col m3"></div>
            </div>
            <div class="row">
                <div class="col m3"></div>
                <div class="col m3">ENDEREÇO:</div>
                <div class="col m3">
                    <input type="text" name="endereco" value="<?php echo $alm->endereco?>" class="form-control">
                </div>
                <div class="col m3"></div>
            </div>
            <div class="row">
                <div class="col m3"></div>
                <div class="col m3">CEP:</div>
                <div class="col m3">
                    <input type="text" id="cep" name="cep" value="<?php echo $alm->cep?>" class="form-control">
                </div>
                <div class="col m3"></div>
            </div>
            <div class="row">
                <div class="col m3"></div>
                <div class="col m3">NÚMERO:</div>
                <div class="col m3">
                    <input type="text" id="numero" name="numero" value="<?php echo $alm->numero?>" class="form-control">
                </div>
                <div class="col m3"></div>
            </div>
            <div class="row">
                <div class="col m3"></div>
                <div class="col m3">UF:</div>
                <div class="col m3">
                    <select name="uf" id="" class="form-control">
                        <?php foreach($this->MODEL->carregarUF() as $row_estado): ?>
                            <option value="<?php echo $row_estado->id ?>"  <?php echo $row_estado->id == $alm->estado_id ? 'selected' : ''; ?>><?php echo $row_estado->uf ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col m3"></div>
            </div>
          
            <div class="row">
                <div class="col m3"></div>
                <div class="col m6">
                    <input type="submit" name="ntym" value="ENVIAR" class="btn btn-info">
                </div>
                <div class="col m3"></div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('select').formSelect();
        });
        $(document).ready(function(){
            $('#cpf').mask('00000000000');
        });
        $(document).ready(function(){
            $('#numero').mask("9999999999");
        });
        $(document).ready(function(){
            $('#cep').mask("99999999");
        });
        $(document).ready(function(){
            $('#telefone').mask("(99)99999-9999");
        });
    </script>
</body>
</html>