<?php
  session_start();
  if ($_SESSION['verif'] == "admin")
  {
    session_unset();
    session_destroy();
    header("Location: afficheradmin.html");
  }
  elseif ($_SESSION['verif'] == "salarie")
  {
    session_unset();
    session_destroy();
    header("Location: afficherlogin.php");
  }
  else
  {
    session_unset();
    session_destroy();
    header("Location: afficherlogin.php");
  }
  
?>
