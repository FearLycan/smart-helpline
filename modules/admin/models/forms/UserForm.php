<?php


namespace app\modules\admin\models\forms;


use app\modules\admin\models\User;
use app\modules\admin\models\UserCategory;
use app\modules\admin\models\UserContract;
use Yii;

/**
 * UserForm model for admin panel.
 * @property int $message
 * @property array $contract_list
 * @property array $categories_list
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class UserForm extends User
{
    const SCENARIO_CREATE = 'create';

    public $message;

    public $categories_list;

    public $contract_list;

    const SEND_MESSAGE = 1;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->status = User::STATUS_ACTIVE;
        $this->role = User::ROLE_USER;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'lastname', 'password', 'email'], 'string'],
            [['email', 'name', 'lastname'], 'required'],
            [['password'], 'required', 'on' => static::SCENARIO_CREATE],
            //[['categories_list', 'contract_list'], 'required'],
            ['categories_list', 'each', 'rule' => ['integer']],
            ['contract_list', 'each', 'rule' => ['integer']],
            ['email', 'email'],
            ['email', 'unique'],
            [['message'], 'integer'],
            [['message'], 'canSendNotyfication'],
            [['role'], 'in', 'range' => array_keys(static::getRolesNames())],
            [['status'], 'in', 'range' => array_keys(static::getStatusNames())],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'lastname' => 'Last name',
            'email' => 'E-mail',
            'password' => 'Password',
            'message' => 'Send user his login details',
            'categories_list' => 'Choose category for this user',
            'contract_list' => 'Choose contracts for this user',
        ];
    }

    public function canSendNotyfication($attribute)
    {
        if ($this->password == null && $this->message == static::SEND_MESSAGE) {
            $this->addError($attribute, 'You have to input new password for sending login details.'); 
        }
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * This is invoked after the record is saved.
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        UserCategory::deleteAllCategories($this->id);
        if (!empty($this->categories_list)) {

            foreach ($this->categories_list as $category) {

                $link = new UserCategory();
                $link->category_id = $category;
                $link->user_id = $this->id;
                $link->save();
            }
        }

        UserContract::deleteAllContracts($this->id);
        if (!empty($this->contract_list)) {

            foreach ($this->contract_list as $contract) {

                $link = new UserContract();
                $link->contract_id = $contract;
                $link->user_id = $this->id;
                $link->save();
            }
        }

    }
}