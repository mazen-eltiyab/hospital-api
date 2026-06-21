<?php
$base_dir = __DIR__;
$public_dir = $base_dir . '/public';

// 1. Delete bad .htaccess
if (file_exists($base_dir . '/.htaccess')) {
    unlink($base_dir . '/.htaccess');
}

// 2. Delete AwardSpace default index
if (file_exists($base_dir . '/index.html')) {
    unlink($base_dir . '/index.html');
}

// 3. Move contents of public to root
if (is_dir($public_dir)) {
    $files = scandir($public_dir);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            rename($public_dir . '/' . $file, $base_dir . '/' . $file);
        }
    }
}

// 4. Update index.php paths
$index_php = $base_dir . '/index.php';
if (file_exists($index_php)) {
    $content = file_get_contents($index_php);
    $content = str_replace("__DIR__.'/../vendor/autoload.php'", "__DIR__.'/vendor/autoload.php'", $content);
    $content = str_replace("__DIR__.'/../bootstrap/app.php'", "__DIR__.'/bootstrap/app.php'", $content);
    file_put_contents($index_php, $content);
}

echo "<h1>Success!</h1>";
echo "Laravel is now running from the root directory!<br>";
echo "Go to your website now.";

unlink(__FILE__);
?>
