<?php
    session_start();
    include "koneksi.php";
    $active = $_GET["email"];
    if (hapusakun($active)>0)
    {
        echo (" <script>
                  alert('Data berhasil dihapus!'); 
                  location.replace('listuser.php');
              </script>");
    }
    else
    {
      echo (mysqli_error($conn));
    }

?>