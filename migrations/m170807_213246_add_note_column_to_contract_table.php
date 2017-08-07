<?php

use yii\db\Migration;

/**
 * Handles adding note to table `contract`.
 */
class m170807_213246_add_note_column_to_contract_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%contract}}', 'note', $this->string()->null());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%contract}}', 'note');
    }
}
