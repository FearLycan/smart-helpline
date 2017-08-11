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
            [['categories_list', 'contract_list'], 'required'],
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
            'name' => 'Imię',
            'lastname' => 'Nazwisko',
            'email' => 'Adres e-mail',
            'password' => 'Hasło',
            'message' => 'Wyślij dane do logowania użytkownikowi',
            'categories_list' => 'Wybierz kategorie dla tego użytkownika1',
            'contract_list' => 'Wybierz kontrakty dla tego użytkownika1',
        ];
    }

    public function canSendNotyfication($attribute)
    {
        if ($this->password == null && $this->message == static::SEND_MESSAGE) {
            $this->addError($attribute, 'Aby, wysłać dane do logowania musisz wpisać nowe hasło.');
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

        foreach ($this->categories_list as $category) {

            $link = new UserCategory();
            $link->category_id = $category;
            $link->user_id = $this->id;
            $link->save();

        }

        UserContract::deleteAllContracts($this->id);

        foreach ($this->contract_list as $contract) {

            $link = new UserContract();
            $link->contract_id = $contract;
            $link->user_id = $this->id;
            $link->save();

        }
    }
}