<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Collections]].
 *
 * @see Collections
 */
class CollectionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Collections[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Collections|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }


    public function byUser($userID)
    {
        return $this->where(['collection_status'    => TRUE])
            ->andWhere(['user_id'   => $userID])->all();
    }
}
