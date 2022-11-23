<?php
session_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="slide navbar style.css">
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">  
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="icon" type="image/png" href="public/img/webdec-home.png"/>
  <link rel="icon" type="image/png" href="public/img/webdec-home.png"/>
  <title>WEBDECK | Login</title>
</head>
<body>
<body>
  
	<div class="main">
        <?php
        if(isset($_SESSION['alert'])):
            echo $_SESSION['alert'];
            unset($_SESSION['alert']);
        endif;
        if(isset($_SESSION['logout'])):
          echo $_SESSION['logout'];
          unset($_SESSION['logout']);
      endif;
        ?>	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form method="POST" action="admin/?c=login">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" name="username" placeholder="Usuario:" required="">
					<input type="password" name="password" placeholder="Senha:" required="">
					<input type="submit" value="ACESSAR">
				</form>
			</div>

			
	</div>
</body>
</html>
