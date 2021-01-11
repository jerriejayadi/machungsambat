<?php
    $conn = mysqli_connect("localhost","root","","machungsambat");
    $dbname = "machungsambat";
    $backupAlert = '';
    $tables = array();
    $result = mysqli_query($conn, "SHOW TABLES");
    if (!$result) {
        $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($conn) . 'ERROR NO :' . mysqli_errno($conn);
    } else {
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
        mysqli_free_result($result);

        $return = "CREATE DATABASE machungsambat; \n\n USE machungsambat; \n\n SET FOREIGN_KEY_CHECKS=0; \n\n";
        foreach ($tables as $table) {

            $result = mysqli_query($conn, "SELECT * FROM " . $table);
            if (!$result) {
                $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($conn) . 'ERROR NO :' . mysqli_errno($conn);
            } else {
                $num_fields = mysqli_num_fields($result);
                if (!$num_fields) {
                    $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($conn) . 'ERROR NO :' . mysqli_errno($conn);
                } else {
                    $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
                    $row2 = mysqli_fetch_row(mysqli_query($conn, 'SHOW CREATE TABLE ' . $table));
                    if (!$row2) {
                        $backupAlert = 'Error found.<br/>ERROR : ' . mysqli_error($conn) . 'ERROR NO :' . mysqli_errno($conn);
                    } else {
                        $return .= "\n\n" . $row2[1] . ";\n\n";
                        for ($i = 0; $i < $num_fields; $i++) {
                            while ($row = mysqli_fetch_row($result)) {
                                $return .= 'INSERT INTO ' . $table . ' VALUES(';
                                for ($j = 0; $j < $num_fields; $j++) {
                                    $row[$j] = addslashes($row[$j]);
                                    if (isset($row[$j])) {
                                        $return .= '"' . $row[$j] . '"';
                                    } else {
                                        $return .= '""';
                                    }
                                    if ($j < $num_fields - 1) {
                                        $return .= ',';
                                    }
                                }
                                $return .= ");\n";
                            }
                        }
                        $return .= "\n\n\n";
                    }
                 
                }
            }
        }
        $return .= "SET FOREIGN_KEY_CHECKS=1;" ;
        $backup_file = 'backup_database/'.$dbname . date("Y-m-d-H-i-s") . '.sql';
        $handle = fopen("{$backup_file}", 'w+');
        fwrite($handle, $return);
        fclose($handle);
        $backupAlert = 'Succesfully got the backup!';
    }
    echo (" <script>
                alert('".$backupAlert."');
                location.replace('dashboard.php');
            </script>");
?>