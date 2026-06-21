<?php
$file = 'medicare.zip';
$remote_file = '/myhospital4.atwebpages.com/medicare.zip';

$conn_id = ftp_connect('myhospital4.atwebpages.com');
if (!$conn_id) {
    $conn_id = ftp_connect('fdb1029.awardspace.net');
}

$login_result = ftp_login($conn_id, '4769756', '2452001Ss');

if ($login_result) {
    ftp_pasv($conn_id, true);
    if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
        echo "Successfully uploaded $file\n";
    } else {
        echo "There was a problem while uploading $file\n";
    }
} else {
    echo "Could not login\n";
}
ftp_close($conn_id);
