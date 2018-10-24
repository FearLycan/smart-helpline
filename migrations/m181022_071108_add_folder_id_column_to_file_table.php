<?php

use yii\db\Migration;

/**
 * Handles adding folder_id to table `file`.
 */
class m181022_071108_add_folder_id_column_to_file_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%file}}', 'folder_id', $this->integer()->null());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%file}}', 'folder_id');
    }
}
