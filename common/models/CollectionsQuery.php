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


    public function byID($iD)
    {
        return $this->where(['collection_status'    => TRUE])
            ->andWhere(['collection_id'   => $iD])->one();
    }


    public function byUser($userID)
    {
        return $this->where(['collection_status'    => TRUE])
            ->andWhere(['user_id'   => $userID])->all();
    }


    public function searchQueryUser($params)
    {
        if(!isset($params['user_id'])){
            return $this->joinWith('user')
                ->where(['collection_status'    => TRUE]);
        }else{
            return $this->joinWith('user')
                ->where(['collection_status'    => TRUE])
                ->andWhere(['user_id'    => $params['user_id']]);
        }

    }
}
