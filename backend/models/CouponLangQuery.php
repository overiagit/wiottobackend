<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[CouponLang]].
 *
 * @see CouponLang
 */
class CouponLangQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CouponLang[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CouponLang|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
