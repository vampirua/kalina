<?php

namespace app\modules\variant\models;

/**
 * This is the ActiveQuery class for [[Variant]].
 *
 * @see Variant
 */
class VariantQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Variant[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Variant|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
