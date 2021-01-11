<?php
    session_start();
    include "koneksi.php";

    mysqli_query($conn, "CREATE TABLE calendar(
        Tanggalbulantahun date,
        jumlah int(255)
    )");

    $i=0;
    $j=0;

    for ($i=1;$i<=12;$i++){
        for($j=1;$j<=31;$j++){
            mysqli_query($conn,"INSERT INTO calendar VALUES('2021-$i-$j', 0)");
        }
    }

    mysqli_query($conn,"DELETE FROM calendar WHERE tanggalbulantahun='0000-00-00'")
?>