<?php
// 1. Edit .env
$env_path = __DIR__ . '/.env';
if (file_exists($env_path)) {
    $env_content = file_get_contents($env_path);
    // Replace DB credentials
    $env_content = preg_replace('/DB_HOST=.*\n/', "DB_HOST=fdb1029.awardspace.net\n", $env_content);
    $env_content = preg_replace('/DB_DATABASE=.*\n/', "DB_DATABASE=4769756_mazen\n", $env_content);
    $env_content = preg_replace('/DB_USERNAME=.*\n/', "DB_USERNAME=4769756_mazen\n", $env_content);
    $env_content = preg_replace('/DB_PASSWORD=.*\n/', "DB_PASSWORD=2452001Ss\n", $env_content);
    file_put_contents($env_path, $env_content);
    echo ".env updated successfully!<br>";
} else {
    echo ".env not found!<br>";
}

// 2. Create .htaccess
$htaccess_path = __DIR__ . '/.htaccess';
$htaccess_content = "<IfModule mod_rewrite.c>\n    RewriteEngine On\n    RewriteRule ^(.*)$ public/$1 [L]\n</IfModule>";
file_put_contents($htaccess_path, $htaccess_content);
echo ".htaccess created successfully!<br>";

echo "<br><b>All done! Your site is live!</b>";
unlink(__FILE__); // self-destruct
?>
