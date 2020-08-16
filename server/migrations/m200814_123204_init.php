<?php

use yii\db\Migration;

class m200814_123204_init extends Migration
{
    public function safeUp()
    {
        try {
            $this->createTable('{{%clients}}', [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'love_music' => $this->integer()->notNull(),
                'location' => $this->integer()->notNull(),
                'pub_id' => $this->integer(),
            ]);

            $this->createTable('{{%pubs}}', [
                'id' => $this->primaryKey(),
                'name' => $this->string(),
                'playing_music' => $this->integer(),
            ]);
            
            $this->addForeignKey('fk_clients_pub_id_pubs_id', '{{%clients}}', 'pub_id', '{{%pubs}}', 'id', 'SET NULL', 'CASCADE');
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function safeDown()
    {
        try {
            $this->dropTable('{{%clients}}');
            $this->dropTable('{{%pubs}}');
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
