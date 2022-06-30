<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[PlanTripLang]].
 *
 * @see PlanTripLang
 */
class PlanTripLangQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PlanTripLang[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PlanTripLang|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
