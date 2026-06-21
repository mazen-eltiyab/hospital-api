<?php
echo "Starting extraction...<br>";

function extractZip($file) {
    if (file_exists($file)) {
        $zip = new ZipArchive;
        if ($zip->open($file) === TRUE) {
            $zip->extractTo(__DIR__);
            $zip->close();
            echo "Successfully extracted: $file<br>";
            unlink($file); // Delete the file after extraction to save space
        } else {
            echo "Failed to open: $file<br>";
        }
    } else {
        echo "File not found: $file<br>";
    }
}

extractZip('site_part1.jpg');
extractZip('site_part2.jpg');

echo "<br><b>All done! You can delete this extract.php file now.</b>";
?>
