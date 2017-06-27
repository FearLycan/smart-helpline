<?php

namespace app\components;

use yii\web\User;

/**
 * App WebUser implementation.
 *
 * @property \app\models\User $identity
 *
 */
class WebUser extends User
{
    /**
     * Check if current user has specified status.
     * @param int|array $status Status ID or array of statuses IDs.
     * @return bool
     */
    public function hasStatus($status)
    {
        if ($this->isGuest) {
            return false;
        } elseif (is_array($status)) {
            return in_array($this->identity->status, $status, true);
        } else {
            return $this->identity->status === $status;
        }
    }
}
