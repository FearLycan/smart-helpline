<?php

namespace app\models;

use app\modules\admin\models\UserCategory;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $name
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property int $role
 * @property int $status
 * @property string $registered_at
 * @property string $last_login_at
 * @property string $last_seen
 * @property string $auth_key
 * @property string $verification_code
 * @property UserCategory[] $categories
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class User extends ActiveRecord implements IdentityInterface
{

    //statusy
    const STATUS_INACTIVE = 0; //użytkownik zarejestrował się ale nie potwierdził danych z forum.
    const STATUS_ACTIVE = 1;   //aktywny użytkownik
    const STATUS_BAN = 3;

    //role
    const ROLE_USER = 1;
    const ROLE_ADMIN = 3;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'status'], 'integer'],
            [['registered_at', 'last_login_at', 'last_seen'], 'safe'],
            [['name', 'lastname', 'email', 'password', 'auth_key', 'verification_code'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Imię',
            'lastname' => 'Nazwisko',
            'email' => 'Email',
            'password' => 'Hasło',
            'role' => 'Rola',
            'status' => 'Status',
            'registered_at' => 'Registered At',
            'last_login_at' => 'Last Login At',
            'auth_key' => 'Auth Key',
            'verification_code' => 'Verification Code',
        ];
    }

    /**
     * @return string[]
     */
    public static function getStatusNames()
    {
        return [
            static::STATUS_ACTIVE => 'Aktywny',
            static::STATUS_INACTIVE => 'Nieaktywny',
            static::STATUS_BAN => 'BAN',
        ];
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return User::getStatusNames()[$this->status];
    }

    /**
     * @return string[]
     */
    public static function getRolesNames()
    {
        return [
            static::ROLE_USER => 'Użytkownik',
            static::ROLE_ADMIN => 'Administrator',
        ];
    }

    /**
     * @return string
     */
    public function getRoleName()
    {
        return static::getRolesNames()[$this->role];
    }

    /**
     * @return array
     */
    public static function getAdministratorRoles()
    {
        return [
            static::ROLE_ADMIN,
        ];
    }

    /**
     * @return bool
     */
    public function isAdministrator()
    {
        return in_array($this->role, static::getAdministratorRoles()) && $this->isActive();
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == static::STATUS_ACTIVE;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(UserCategory::className(), ['user_id' => 'id']);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public static function hashPassword($password)
    {
        return Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @param int $category_id
     * @return bool
     */
    public function canSeeThisCategory($category_id)
    {
        $can = UserCategory::find()
            ->where(['user_id' => $this->id, 'category_id' => $category_id])
            ->exists();

        return $can;
    }
}
