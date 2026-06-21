<?php
// 1. Update .env
$env_path = __DIR__ . '/.env';
if (file_exists($env_path)) {
    $env_content = file_get_contents($env_path);
    $env_content = preg_replace('/DB_HOST=.*\n/', "DB_HOST=sql306.infinityfree.com\n", $env_content);
    $env_content = preg_replace('/DB_DATABASE=.*\n/', "DB_DATABASE=if0_42235312_medicare\n", $env_content);
    $env_content = preg_replace('/DB_USERNAME=.*\n/', "DB_USERNAME=if0_42235312\n", $env_content);
    $env_content = preg_replace('/DB_PASSWORD=.*\n/', "DB_PASSWORD=z84KP0eqzNm\n", $env_content);
    file_put_contents($env_path, $env_content);
    echo "1. .env updated successfully!<br>";
} else {
    echo "1. Error: .env file not found!<br>";
}

// 2. Update index.php paths
$index_php = __DIR__ . '/index.php';
if (file_exists($index_php)) {
    $content = file_get_contents($index_php);
    $content = str_replace("__DIR__.'/../vendor/autoload.php'", "__DIR__.'/vendor/autoload.php'", $content);
    $content = str_replace("__DIR__.'/../bootstrap/app.php'", "__DIR__.'/bootstrap/app.php'", $content);
    file_put_contents($index_php, $content);
    echo "2. index.php updated successfully!<br>";
} else {
    echo "2. Error: index.php not found!<br>";
}

echo "<br><b>All done! Your site configurations are live!</b>";
unlink(__FILE__);
?>
