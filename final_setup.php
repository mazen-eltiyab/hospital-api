<?php
// 1. Delete default AwardSpace index file
$default_html = __DIR__ . '/index.html';
if (file_exists($default_html)) {
    unlink($default_html);
    echo "Deleted default index.html<br>";
}
$default_php = __DIR__ . '/index.php';
// We only delete index.php if it's the Awardspace one, but Laravel doesn't have index.php in root.
if (file_exists($default_php) && filesize($default_php) < 1000) {
    unlink($default_php);
    echo "Deleted default index.php<br>";
}

// 2. Create the correct .htaccess
$htaccess_path = __DIR__ . '/.htaccess';
$htaccess_content = "<IfModule mod_rewrite.c>\n    RewriteEngine On\n    RewriteRule ^(.*)$ public/$1 [L]\n</IfModule>";
// Wait, this caused 500. Let's use the safer one:
$htaccess_content = "<IfModule mod_rewrite.c>\n    RewriteEngine On\n    RewriteCond %{REQUEST_URI} !^/public/\n    RewriteRule ^(.*)$ public/$1 [L]\n</IfModule>";
file_put_contents($htaccess_path, $htaccess_content);
echo "Created safe .htaccess<br>";

echo "<br><b>Try your website now!</b>";
unlink(__FILE__);
?>
