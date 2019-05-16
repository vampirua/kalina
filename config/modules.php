<?php
$config = require(__DIR__ . '/installed_modules.php');
return array_merge($config, [
    'bootstrap' => [
        \nullref\fulladmin\Bootstrap::class,
    ],
    'admin' => [
        'class' => 'app\modules\admin\Module',
        'components' => ['menuBuilder' => 'app\modules\admin\components\MenuBilder'],
        'controllerMap' => [
            'main' => [
                'class' => 'app\modules\admin\controllers\MainController'

            ]
        ]
    ],
    'category' => [
        'class' => 'nullref\category\Module'
    ],
    'color' => [
        'class' => 'app\modules\color\Module'
    ],
    'favorite' => [
        'class' => 'app\modules\favorite\Module'
    ],
    'order' => [
        'class' => 'app\modules\order\Module'
    ],
    'photoproduct' => [
        'class' => 'app\modules\photoproduct\Module'
    ],
    'product' => [
        'class' => 'app\modules\product\Module'
    ],
    'statusproduct' => [
        'class' => 'app\modules\statusproduct\Module'
    ],
    'statusorder' => [
        'class' => 'app\modules\statusorder\Module'
    ],
    'user' => [
        'class' => 'app\modules\user\Module'
    ],
    'variant' => [
        'class' => 'app\modules\variant\Module'
    ],
    'vendor' => [
        'class' => 'app\modules\vendor\Module'
    ]


]);