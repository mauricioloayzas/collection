<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Collections;

/**
 * CollectionSerach represents the model behind the search form of `common\models\Collections`.
 */
class CollectionSerach extends Collections
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['collection_id', 'user_id'], 'integer'],
            [['collection_description', 'username'], 'safe'],
            [['collection_status'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        //$query = Collections::find();
        $collectionQuery = new CollectionsQuery(new Collections());
        $query = $collectionQuery->searchQueryUser($params);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'collection_id' => $this->collection_id,
            'collection_status' => $this->collection_status,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['ilike', 'collection_description', $this->collection_description]);

        return $dataProvider;
    }
}
