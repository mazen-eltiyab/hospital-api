<?php
$hosts = ['myhospital4.atwebpages.com', 'fdb1029.awardspace.net', 'atwebpages.com'];
$users = ['4769756', 'mazen_4769756', '4769756_mazen', 'myhospital4.atwebpages.com'];
$pass = '2452001Ss';

foreach($hosts as $host) {
    $conn = @ftp_connect($host, 21, 5);
    if($conn) {
        foreach($users as $user) {
            if(@ftp_login($conn, $user, $pass)) {
                echo "SUCCESS! Host: $host, User: $user\n";
                ftp_close($conn);
                exit;
            }
        }
        ftp_close($conn);
    }
}
echo "Failed all.\n";
