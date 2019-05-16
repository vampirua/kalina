<?php
/**
 * Created by PhpStorm.
 * User: Dimon
 * Date: 14.11.2017
 * Time: 18:39
 */

namespace app\modules\admin;

use nullref\admin\Module as BaseModule;
use nullref\core\interfaces\IAdminModule;
use Yii;

class Module extends BaseModule implements IAdminModule
{
    public function setBasePath($path)
    {
        $path = '@vendor/nullref/admin';
        parent::setBasePath($path);
    }
    public static function getAdminMenu()
    {
        return [
            'label' => Yii::t('admin', 'Dashboard'),
            'url' => ['/admin/main'],
            'icon' => 'dashboard',
        ];
    }

}