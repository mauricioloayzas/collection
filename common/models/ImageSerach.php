<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Images;

/**
 * ImageSerach represents the model behind the search form of `common\models\Images`.
 */
class ImageSerach extends Images
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id', 'collection_id'], 'integer'],
            [['image_unsplash_id'], 'safe'],
            [['image_status'], 'boolean'],
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
        //$query = Images::find();
        $imageQuery = new ImagesQuery(new Images());
        $query = $imageQuery->searchQueryCollection($params);

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
            'image_id' => $this->image_id,
            'image_status' => $this->image_status,
            'collection_id' => $this->collection_id,
        ]);

        $query->andFilterWhere(['ilike', 'image_unsplash_id', $this->image_unsplash_id]);

        return $dataProvider;
    }
}
