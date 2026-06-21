<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "Running migrations and seeders...<br><br>";

try {
    $status = $kernel->call('migrate:fresh', [
        '--seed' => true,
        '--force' => true
    ]);
    
    echo "<b>Output:</b><br>";
    echo nl2br($kernel->output());
    echo "<br><br><b>Database successfully built and seeded!</b>";
} catch (\Exception $e) {
    echo "<b>Error:</b><br>";
    echo $e->getMessage();
}

unlink(__FILE__);
?>
