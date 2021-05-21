<?php

use yii\db\Migration;

/**
 * Class m210520_162609_collection
 */
class m210520_162609_collection extends Migration
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
        echo "m210520_162609_collection cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('collections', [
            'collection_id'             => $this->primaryKey(),
            'collection_description'    => $this->string(45)->notNull(),
            'collection_status'         => $this->boolean()->notNull()->defaultValue(TRUE),
            'user_id'                   => $this->integer()
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-collections-user_id',
            'collections',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-collections-user_id',
            'collections',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('collections');
    }
}
