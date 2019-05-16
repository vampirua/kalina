<?php

namespace app\modules\photoproduct;

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
        'PhotoProduct' => 'app\modules\photoproduct\models\PhotoProduct',
    ];

    /**
     * Item for admin menu
     * @return array
     */
    public static function getAdminMenu()
    {

    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $classMap = array_merge($this->_classMap, $this->classMap);
        foreach (['photoproduct'] as $item) {
            $className = __NAMESPACE__ . '\models\\' . $item;
            $postClass = $className::className();
            $definition = $classMap[$item];
            Yii::$container->set($postClass, $definition);
        }

        if ($app instanceof WebApplication) {
            if (!isset($app->i18n->translations['photoproduct*'])) {
                $app->i18n->translations['photoproduct*'] = [
                    'class' => PhpMessageSource::className(),
                ];
            }
        }

    }
}