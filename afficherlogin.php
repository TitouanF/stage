<html>
  <head>
    <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
      @import url(https://fonts.googleapis.com/css?family=Roboto:300);

      .login-page 
    {
      width: 360px;
      padding: 8% 0 0;
      margin: auto;
    }
    .form 
    {
      position: relative;
      z-index: 1;
      background: #FFFFFF;
      max-width: 360px;
      margin: 0 auto 100px;
      padding: 45px;
      text-align: center;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    .form input 
    {
      font-family: "Roboto", sans-serif;
      outline: 0;
      background: #f2f2f2;
      width: 100%;
      border: 0;
      margin: 0 0 15px;
      padding: 15px;
      box-sizing: border-box;
      font-size: 14px;
    }
    .form button 
    {
      font-family: "Roboto", sans-serif;
      text-transform: uppercase;
      outline: 0;
      background: #76b852;
      width: 100%;
      border: 0;
      padding: 15px;
      color: #FFFFFF;
      font-size: 14px;
      -webkit-transition: all 0.3 ease;
      transition: all 0.3 ease;
      cursor: pointer;
    }
    .form button:hover,.form button:active,.form button:focus 
    {
      background: #76b852;
    }
    .form .message 
    {
      margin: 15px 0 0;
      color: #b3b3b3;
      font-size: 12px;
    }
    .form .message a 
    {
      color: #76b852;
      text-decoration: none;
    }
    .form .register-form 
    {
      display: none;
    }
    .container
    {
      position: relative;
      z-index: 1;
      max-width: 300px;
      margin: 0 auto;
    }
    .container:before, .container:after 
    {
      content: "";
      display: block;
      clear: both;
    }
    .container .info 
    {
      margin: 50px auto;
      text-align: center;
    }
    .container .info h1 
    {
      margin: 0 0 15px;
      padding: 0;
      font-size: 36px;
      font-weight: 300;
      color: #1a1a1a;
    }
    .container .info span 
    {
      color: #4d4d4d;
      font-size: 12px;
    }
    .container .info span a 
    {
      color: #000000;
      text-decoration: none;
    }
    .container .info span .fa 
    {
      color: #EF3B3A;
    }
    body 
    {
      background: #76b852; /* fallback for old browsers */
      background: -webkit-linear-gradient(right, #76b852, #76b852);
      background: -moz-linear-gradient(right, #76b852, #76b852);
      background: -o-linear-gradient(right, #76b852, #76b852);
      background: linear-gradient(to left, #76b852, #76b852);
      font-family: "Roboto", sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;      
    }    
  </style>
  </head>
  <body>
  <div class="login-page">
  <div class="form">
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" action="veriflogin.php" method="post">
    identifiant : <select name="idSalarie" class="">
              <?php
              require_once('connexion.php');

              $req=$connection->query("SELECT * FROM salarie WHERE identifiant <> 'admin'");

              $req->setFetchMode(PDO::FETCH_OBJ);

              while($enregistrement = $req->fetch())
              {
                echo("<option>".$enregistrement->identifiant."</option>");
              }
              ?>
              <BR>
      <input name="Mdp" required type="password" placeholder="mot de passe"/>
      <button>connexion</button>
      <p class="message">Admin ? <a href="afficheradmin.html">Connexion Admin</a></p>
    </form>
  </div>
</div>
  
  </body>
</html>
