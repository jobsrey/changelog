<?php

use yii\db\Migration;

class m190529_033435_create_table_change_log extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%change_log}}', [
            'id' => $this->primaryKey(),
            'table_name' => $this->string(),
            'model_name' => $this->string(),
            'newvalue' => $this->string(),
            'oldvalue' => $this->string(),
            'messages' => $this->string(),
            'parent_id' => $this->integer(),
            'user_id' => $this->integer(),
            'is_active' => $this->smallInteger()->defaultValue('0'),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime(),
            'createby' => $this->integer(),
            'updateby' => $this->integer(),
            'status' => $this->integer()->notNull()->defaultValue('0'),
            'alias_column_name' => $this->string(),
            'id_record' => $this->integer()->notNull(),
            'column_name' => $this->string(),
            'jns_transaksi' => $this->string(),
        ], $tableOptions);

        $this->createIndex('parent_id', '{{%change_log}}', 'parent_id');
        $this->createIndex('user_id', '{{%change_log}}', 'user_id');
        $this->createIndex('createby', '{{%change_log}}', 'createby');
        $this->createIndex('updateby', '{{%change_log}}', 'updateby');
    }

    public function down()
    {
        $this->dropTable('{{%change_log}}');
    }
}
