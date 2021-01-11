<?php
    session_start();
    include "koneksi.php";
    $active = $_GET["email"];
    if (hapusakun($active)>0)
    {
        echo (" <script>
                  alert('Data berhasil dihapus!'); 
                  location.replace('loginpage.php');
              </script>");
        $_SESSION=[];
        session_unset();
        session_destroy();
    }
    else
    {
      echo (mysqli_error($conn));
    }

?>