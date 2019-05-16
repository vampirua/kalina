<?php

namespace app\modules\variant;

use nullref\core\interfaces\IAdminModule;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module as BaseModule;
use yii\i18n\PhpMessageSource;
use yii\web\Application as WebApplication;

/**
 * shop module definition class
 */
class Module extends BaseModule implements IAdminModule, BootstrapInterface
{

    /**
     * @var array
     */
    public $classMap = [];

    /**
     * @var array
     */
    protected $_classMap = [
        'Variant' => 'app\modules\variant\models\VAriant',
    ];

    /**
     * Item for admin menu
     * @return array
     */
    public static function getAdminMenu()
    {
        return [
            'label' => Yii::t('variant', 'Create Variant'),

            'order' => 2,
            'items' => [
                [
                    'label' => Yii::t('variant', 'variant'),
                    'icon' => 'tags',
                    'url' => ['/variant/variant'],
                ],
                [
                    'label' => Yii::t('color', 'color'),
                    'icon' => 'tags',
                    'url' => ['/color/color'],
                ],

            ]
        ];
    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $classMap = array_merge($this->_classMap, $this->classMap);
        foreach (['variant'] as $item) {
            $className = __NAMESPACE__ . '\models\\' . $item;
            $postClass = $className::className();
            $definition = $classMap[$item];
            Yii::$container->set($postClass, $definition);
        }

        if ($app instanceof WebApplication) {
            if (!isset($app->i18n->translations['variant*'])) {
                $app->i18n->translations['variant*'] = [
                    'class' => PhpMessageSource::className(),
                ];
            }
        }

    }
}