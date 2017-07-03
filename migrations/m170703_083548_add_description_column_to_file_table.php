<?php

use yii\db\Migration;

/**
 * Handles adding description to table `file`.
 */
class m170703_083548_add_description_column_to_file_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%file}}', 'description', $this->text()->null());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%file}}', 'description');
    }
}
