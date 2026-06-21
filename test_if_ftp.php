<?php
$host = 'ftpupload.net';
$user = 'if0_42235312';
$pass = 'z84KP0eqzNm';

$conn = @ftp_connect($host, 21, 10);
if($conn) {
    if(@ftp_login($conn, $user, $pass)) {
        echo "SUCCESS! FTP connected.\n";
        $files = ftp_nlist($conn, ".");
        print_r($files);
        ftp_close($conn);
    } else {
        echo "FAILED login.\n";
    }
} else {
    echo "FAILED connect.\n";
}
