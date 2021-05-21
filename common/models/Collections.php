<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "collections".
 *
 * @property int $collection_id
 * @property string $collection_description
 * @property bool $collection_status
 * @property int|null $user_id
 *
 * @property Images[] $images
 * @property User $user
 */
class Collections extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'collections';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['collection_description'], 'required'],
            [['collection_status'], 'boolean'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['collection_description'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'collection_id' => 'Collection ID',
            'collection_description' => 'Collection Description',
            'collection_status' => 'Collection Status',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery|ImagesQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['collection_id' => 'collection_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return CollectionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CollectionsQuery(get_called_class());
    }

    /**
     * @return int
     */
    public function getCollectionId()
    {
        return $this->collection_id;
    }

    /**
     * @param int $collection_id
     */
    public function setCollectionId($collection_id)
    {
        $this->collection_id = $collection_id;
    }

    /**
     * @return string
     */
    public function getCollectionDescription()
    {
        return $this->collection_description;
    }

    /**
     * @param string $collection_description
     */
    public function setCollectionDescription($collection_description)
    {
        $this->collection_description = $collection_description;
    }

    /**
     * @return bool
     */
    public function isCollectionStatus()
    {
        return $this->collection_status;
    }

    /**
     * @param bool $collection_status
     */
    public function setCollectionStatus($collection_status)
    {
        $this->collection_status = $collection_status;
    }

    /**
     * @return int|null
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int|null $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}
