<?php 
if(!isset($_SESSION)){ 
    session_start(); 
}
if(!isset($_SESSION['access'])):
  header("Location: ../");
endif;
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="icon" type="image/png" href="../public/assets/img/webdec-home.png"/>
  <link rel="icon" type="image/png" href="../public/assets/img/webdec-home.png"/>
  <title>WEBDECK | Crud</title>
</head>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>
    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <img
          src="../public/img/webdec-home.png" height="25" alt="WebDec" loading="lazy"/>
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-1 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="./"><i class="bi bi-house-door"></i> Dashboard</a>
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->
    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
      <a class="text-white me-3 btn btn-danger btn-sm" href="?logout=1" data-bs-toggle="modal" data-bs-target="#exit"><i class="bi bi-box-arrow-left"></i> Sair</a>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->

<div class="modal fade" id="exit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white" id="exampleModalLabel">Encerrar sessão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> 
      <div class="modal-body">
      <div class="alert alert-warning text-center" role="alert">Tem certeza que deseja sair?</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="?c=logout" type="button" class="btn btn-danger">Confirmar</a>
      </div>
    </div>
  </div>
</div>
    <div class="container">
        <div class="row div col m12">
            <div class="card black white-text text-center mb-2">
                <h2>Crud Usuários</h2>
            </div>
        </div>
        <div class="text-center">
            <a href="?c=novo" class="btn btn-primary">NOVO USUÁRIO</a>
        </div>
        <div class="row">
            <div class="col m12">
                <table class="table display table-sm" style="width:100%" id="myTable">
                    <thead>
                        <tr>
                            <th>NOME</th>
                            <th>CPF</th>
                            <th>RG</th>
                            <th>DATA NASC.</th>
                            <th>UF</th>
                            <th>TELEFONE</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($this->MODEL->Listar() as $row): ?>
                        <tr>
                            <td><?php echo $row->nome; ?></td>
                            <td><?php echo $row->cpf; ?></td>
                            <td><?php echo $row->rg; ?></td>
                            <td><?php echo $row->data_nascimento; ?></td>
                            <td><?php echo $row->uf; ?></td>
                            <td><?php echo $row->telefone; ?></td>
                            <td>
                                <a href="?c=novo&id=<?php echo $row->estado_id?>" class="btn btn-info">ALTERAR</a>
                                <a href="?c=delete&id=<?php echo $row->estado_id?>" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn btn-danger">REMOVER</a>
                            </td>
                            
                        </tr>
                    </tbody>
                    <?php endforeach ?>
                </table>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready( function () {
        $('#myTable').dataTable( {
            "pageLength": 8
        } );
    } );

    </script>

</body>
</html>