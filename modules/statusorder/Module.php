<?php

namespace app\modules\statusorder;

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
        'StatusOrder' => 'app\modules\statusorder\models\StatusOrder',
    ];

    /**
     * Item for admin menu
     * @return array
     */
    public static function getAdminMenu()
    {
        return [
            'label' => Yii::t('statusorder', 'statusorder'),
            'icon' => 'tags',
            'url' => ['/statusorder/statusorder'],
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
        foreach (['statusorder'] as $item) {
            $className = __NAMESPACE__ . '\models\\' . $item;
            $postClass = $className::className();
            $definition = $classMap[$item];
            Yii::$container->set($postClass, $definition);
        }

        if ($app instanceof WebApplication) {
            if (!isset($app->i18n->translations['statusorder*'])) {
                $app->i18n->translations['statusorder*'] = [
                    'class' => PhpMessageSource::className(),
                ];
            }
        }

    }
}