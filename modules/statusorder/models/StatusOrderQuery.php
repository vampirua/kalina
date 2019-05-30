<?php

namespace app\modules\statusorder\models;

/**
 * This is the ActiveQuery class for [[StatusOrder]].
 *
 * @see StatusOrder
 */
class StatusOrderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StatusOrder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StatusOrder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
