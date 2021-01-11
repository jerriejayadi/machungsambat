<?php
    $conn = mysqli_connect("localhost","root","");
    $dbname = mysqli_query($conn, "CREATE DATABASE machungsambat");
    $conn = mysqli_connect("localhost","root","","machungsambat");
    mysqli_query($conn,"CREATE TABLE profil(
        nama varchar(100),
        nim int(9),
        tanggallahir date,
        fotoprofil varchar(100),
        jurusan varchar(100),
        email varchar(100),
        pswrd varchar(255),
        statususer int(1),
        reputasi int(255),
        question varchar(255),
        answer varchar(255),
        primary key(email)
    )");

    mysqli_query ($conn,"CREATE TABLE categories(
        id varchar(3),
        category varchar(100),
        primary key(id)
    )");

    mysqli_query ($conn, "CREATE TABLE detailpost(
        postID int(255) auto_increment,
        categories varchar(100),
        isi text,
        gambar varchar(255),
        email varchar(100),
        tanggalpost date,
        waktupost datetime,
        likes int(255),
        Comment int(255),
        PRIMARY KEY (postID)	
    )");

    mysqli_query($conn,"CREATE TABLE userlike(
        likesid int(255) auto_increment,
        email varchar(100),
        postID int(255),
        PRIMARY KEY (likesid),
        FOREIGN KEY (postID) REFERENCES detailpost(postID)
    )");

    mysqli_query($conn,"CREATE TABLE usercomment(
        commentid int(255) auto_increment,
        email varchar(100),
        postID int(255),
        comment text,
        waktucomment datetime,
        PRIMARY KEY (commentid),
        FOREIGN KEY (postID) REFERENCES detailpost(postID)
    )");

    mysqli_query($conn,"CREATE TABLE usernotif(
        postID int(255),
        email varchar(100),
        statuspost int(1),
        jenisnotif int(1),
        tanggal date,
        waktunotif datetime,
        FOREIGN KEY (postID) REFERENCES detailpost(postID),
        FOREIGN KEY (email) REFERENCES profil(email)
    )");

    mysqli_query($conn,"INSERT INTO categories VALUES
        ('C01','Administrasi'),
        ('C02','Keuangan'),
        ('C03','Student Center'),
        ('C04','UKM'),
        ('C05','Akademis'),
        ('C06','Jadwal'),
        ('C07','Poin Keaktifan'),
        ('C08','Sertifikat'),
        ('C09','Dosen'),
        ('C10','Mahasiswa'),
        ('C11','Karyawan'),
        ('C12','Tips & Trick')
    ");
    function registrasi($data)
    {
        global $conn;

        $email = strtolower(stripslashes($data["email"]));
        $password = mysqli_real_escape_string($conn,$data["password"]);
        $password2 = mysqli_real_escape_string($conn,$data["password2"]);
        $nama = htmlspecialchars($data['namadepan']." ".$data['namatengah']." ".$data['namabelakang']);
        $jurusan = htmlspecialchars($data['jurusan']);
        $nim = htmlspecialchars($data['nim']);
        $birthdate = htmlspecialchars($data['birthdate']);
        $question = htmlspecialchars($data['question']);
        $answer = htmlspecialchars($data['answer']);

        $useravail = mysqli_query($conn,"SELECT email FROM profil  WHERE email='$email'");
        if (mysqli_fetch_assoc($useravail))
        {
            echo "  <script>
                        alert('Email already registered!');
                    </script>";
            return false;
        }
        if($password !== $password2)
        {
            echo "  <script>
                        alert('konfirmasi password tidak sesuai!');
                    </script>";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $answer = password_hash($answer, PASSWORD_DEFAULT);
        
        mysqli_query($conn, "INSERT INTO profil VALUES('$nama','$nim','$birthdate','res/profile2.png','$jurusan','$email','$password',1,0,'$question','$answer')");
        return mysqli_affected_rows($conn);
    }
    
    function hapusakun($email){
        global $conn;
        mysqli_query($conn,"DELETE FROM profil WHERE email='$email'");
        return mysqli_affected_rows($conn);
    }

    function banakun($email){
        global $conn;
        mysqli_query($conn,"UPDATE profil SET statususer=0 WHERE email='$email' ");
        return mysqli_affected_rows($conn);
    }

    function unbanakun($email){
        global $conn;
        mysqli_query($conn,"UPDATE profil SET statususer=1 WHERE email='$email' ");
        return mysqli_affected_rows($conn);
    }

    function tambahpost($data,$email,$image,$waktupost){
        global $conn;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
		$isiPost = $data['pesan'];
        $category = $data['categories'];

        if($waktupost=='now()'){
            mysqli_query($conn,"INSERT INTO detailpost VALUES('','$category','$isiPost','$image','$email',now(),now(),0,0)");
        }
        else{
            mysqli_query($conn,"INSERT INTO detailpost VALUES('','$category','$isiPost','$image','$email',now(),'$waktupost',0,0)");
        }
        
        return mysqli_affected_rows($conn);
    }

    mysqli_query($conn, "CREATE TABLE calendar(
        Tanggalbulantahun date,
        jumlah int(255)
    )");

    $i=0;
    $j=0;

    $cekisi = mysqli_query($conn,"SELECT * FROM calendar");
    if(mysqli_num_rows($cekisi)==0){
        for ($i=1;$i<=12;$i++){
            for($j=1;$j<=31;$j++){
                mysqli_query($conn,"INSERT INTO calendar VALUES('2021-$i-$j', 0)");
            }
        }
    }

    mysqli_query($conn,"DELETE FROM calendar WHERE tanggalbulantahun='0000-00-00'");
?>