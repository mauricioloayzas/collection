<?php

use yii\db\Migration;

/**
 * Class m210520_163303_image
 */
class m210520_163303_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210520_163303_image cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('images', [
            'image_id'          => $this->primaryKey(),
            'image_unsplash_id' => $this->string(45)->notNull(),
            'image_url'         => $this->string(250)->notNull(),
            'image_order'       => $this->integer(),
            'image_status'      => $this->boolean()->notNull()->defaultValue(TRUE),
            'collection_id'     => $this->integer()
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-images-collection_id',
            'images',
            'collection_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-images-collection_id',
            'images',
            'collection_id',
            'collections',
            'collection_id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('images');
    }
}
