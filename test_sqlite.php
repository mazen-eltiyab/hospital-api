<?php
$db = new PDO('sqlite:database/database.sqlite');
$stmt = $db->query("SELECT id, name, email FROM users WHERE role='doctor'");
echo "Users:\n";
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo print_r($row, true);
}
$stmt = $db->query("SELECT id, first_name, email FROM doctors");
echo "Doctors:\n";
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo print_r($row, true);
}
