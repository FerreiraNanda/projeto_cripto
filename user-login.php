<?php 
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM marca WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
      
        $row = $result->fetch_assoc();
      
        if(!strcmp(md5($_POST["senha"]),$row['senha'])){
          print_r("entrou");
        print_r($row);
          $_SESSION["loggedin"] = true;
            header("Location: moeda-comprar.php");
            exit;
        }

        
    } else {
        $error = "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Login</h3>

          
            <form method="post" action="">
              <div class="form-outline mb-4">
                <input type="email" name="email" id="typeEmailX-2" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX-2">E-mail</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" name="senha" id="typePasswordX-2" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX-2">Senha</label>
              </div>
              <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
              
            </form>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
