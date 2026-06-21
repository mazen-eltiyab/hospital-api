<?php
$vendor_zip_url = 'https://transfer.sh/vendor.zip'; // Will update later
$local_zip = 'vendor.zip';

echo "Downloading vendor.zip...<br>";
file_put_contents($local_zip, fopen($vendor_zip_url, 'r'));

echo "Extracting vendor.zip...<br>";
$zip = new ZipArchive;
if ($zip->open($local_zip) === TRUE) {
    $zip->extractTo(__DIR__);
    $zip->close();
    echo "Extracted successfully!<br>";
    unlink($local_zip);
    echo "Deleted zip file.<br>";
    echo "<h2>Deployment Complete! You can now visit your site.</h2>";
} else {
    echo "Failed to extract zip file.<br>";
}
