<?php


namespace app\modules\admin\models\forms;


use app\modules\admin\models\User;
use Yii;

/**
 * UserForm model for admin panel.
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class UserForm extends User
{
    const SCENARIO_CREATE = 'create';

    public $message;

    const SEND_MESSAGE = 1;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'lastname', 'password',], 'string'],
            [['email', 'name', 'lastname'], 'required'],
            [['password'], 'required', 'on' => static::SCENARIO_CREATE],
            ['email', 'email'],
            ['email', 'unique'],
            ['message', 'integer'],
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
        ];
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
}