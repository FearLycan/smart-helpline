<?php


namespace app\modules\admin\models\forms;


use app\models\UserCategory;
use app\modules\admin\models\User;
use Yii;

/**
 * UserForm model for admin panel.
 * @property int $message
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class UserForm extends User
{
    const SCENARIO_CREATE = 'create';

    public $message;

    public $categories_list;

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
            [['categories_list'], 'required'],
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
            'categories' => 'Wybierz kategorie dla tego użytkownika',
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

        foreach ($this->categories_list as $category) {
            $link = UserCategory::find()->where(['user_id' => $this->id, 'category_id' => $category])->one();

            if (empty($link)) {
                $link = new UserCategory();
                $link->category_id = $category;
                $link->user_id = $this->id;
                $link->save();
            }
            unset($link);
        }
    }
}