<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[BestForyouLang]].
 *
 * @see BestForyouLang
 */
class BestForyouLangQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BestForyouLang[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BestForyouLang|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
