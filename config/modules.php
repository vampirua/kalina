<?php
$config = require(__DIR__ . '/installed_modules.php');
return array_merge($config, [
    'core' => [
        'class' => 'nullref\core\Module'
    ],
]);