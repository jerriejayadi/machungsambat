<?php
    session_start();
    include "koneksi.php";
    $active = $_GET["email"];
    if (banakun($active)>0)
    {
        echo (" <script>
                  alert('Akun berhasil di ban!'); 
                  location.replace('listuser.php');
              </script>");
    }
    else
    {
      echo (mysqli_error($conn));
    }

?>