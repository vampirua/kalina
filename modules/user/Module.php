<?php

namespace app\modules\user;

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
        'User' => 'app\modules\user\models\User',
    ];

    /**
     * Item for admin menu
     * @return array
     */
    public static function getAdminMenu()
    {
        return [
            'label' => Yii::t('user', 'user'),
            'icon' => 'tags',
            'url' => ['/user/user'],
            'order' => 7,
        ];
    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $classMap = array_merge($this->_classMap, $this->classMap);
        foreach (['user'] as $item) {
            $className = __NAMESPACE__ . '\models\\' . $item;
            $postClass = $className::className();
            $definition = $classMap[$item];
            Yii::$container->set($postClass, $definition);
        }

        if ($app instanceof WebApplication) {
            if (!isset($app->i18n->translations['user*'])) {
                $app->i18n->translations['user*'] = [
                    'class' => PhpMessageSource::className(),
                ];
            }
        }

    }
}