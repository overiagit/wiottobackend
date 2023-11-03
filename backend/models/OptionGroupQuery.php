<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[OptionGroup]].
 *
 * @see OptionGroup
 */
class OptionGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OptionGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OptionGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
