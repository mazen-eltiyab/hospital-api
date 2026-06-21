<?php
// 1. Fix .htaccess to avoid infinite loops
$htaccess_path = __DIR__ . '/.htaccess';
$htaccess_content = "<IfModule mod_rewrite.c>\n    RewriteEngine On\n    RewriteCond %{REQUEST_URI} !^/public/\n    RewriteRule ^(.*)$ public/$1 [L]\n</IfModule>";
file_put_contents($htaccess_path, $htaccess_content);
echo "1. .htaccess updated to prevent loops!<br>";

// 2. Fix permissions for Laravel storage and cache
@chmod(__DIR__ . '/storage', 0777);
@chmod(__DIR__ . '/storage/framework', 0777);
@chmod(__DIR__ . '/storage/framework/cache', 0777);
@chmod(__DIR__ . '/storage/framework/sessions', 0777);
@chmod(__DIR__ . '/storage/framework/views', 0777);
@chmod(__DIR__ . '/storage/logs', 0777);
@chmod(__DIR__ . '/bootstrap/cache', 0777);
echo "2. Permissions for storage and cache fixed!<br>";

// 3. Print PHP version to see if it's too old for Laravel
echo "3. PHP Version: " . phpversion() . "<br>";

echo "<br><b>Try opening your site again now!</b>";
unlink(__FILE__); // self-destruct
?>
