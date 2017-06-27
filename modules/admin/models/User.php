<?php

namespace app\modules\admin\models;

use Yii;

/**
 * User model for admin panel.
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.pl>
 */
class User extends \app\models\User
{
    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
                $this->verification_code = \Yii::$app->security->generateRandomString();
                $this->password = $this->hashPassword($this->password);
            }
            return true;
        }
        return false;
    }

    public function sendEmail()
    {
        Yii::$app->mailer
            ->compose("welcome-message", [
                'user' => $this,
            ])
            ->setFrom([Yii::$app->params['site-email'] => Yii::$app->name])
            ->setTo([$this->email => $this->name . ' ' . $this->last_seen])
            ->setSubject('Twoje konto zostało założone')
            ->send();
    }
}