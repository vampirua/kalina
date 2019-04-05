<?php
$config = require(__DIR__ . '/installed_modules.php');
return array_merge($config, [
    'bootstrap' => [
        \nullref\fulladmin\Bootstrap::class,
    ],
    'core' => [
        'class' => 'nullref\core\Module'
    ],
    'category' => [
        'class' => 'nullref\category\Module'
    ],
]);