<?php
set_time_limit(0); // Prevent timeout
ini_set('memory_limit', '512M');

$zip_file = 'site_part1.zip';
$extract_to = __DIR__;

if (!file_exists($zip_file)) {
    die("Error: $zip_file not found. Please upload it first.");
}

$zip = new ZipArchive;
$res = $zip->open($zip_file);
if ($res === TRUE) {
    echo "Extracting... Please wait, this might take a minute...<br>";
    $zip->extractTo($extract_to);
    $zip->close();
    echo "<b>Success! All files extracted perfectly!</b>";
} else {
    echo "Failed to open the zip file. Error code: " . $res;
}
unlink(__FILE__); // self-destruct
?>
