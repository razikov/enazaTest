<?php

$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'mysql:host=mysql;dbname=enaza_tests';
$db['username'] = 'root';

return $db;
