<?php
    session_start();
    include "koneksi.php";
    $active = $_GET["email"];
    if (unbanakun($active)>0)
    {
        echo (" <script>
                  alert('Akun berhasil di unban!'); 
                  location.replace('listuser.php');
              </script>");
    }
    else
    {
      echo (mysqli_error($conn));
    }

?>