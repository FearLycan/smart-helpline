<?php

/*
 * This file is part of the lowcygier-bazaar.
 *
 * Copyright (c) 2016 Lowcygier.pl <copy@lowcygier.pl>
 *
 * This source code is proprietary to Lowcygier.pl. All rights reserved.
 * Unauthorized using or copying of this file, via any medium is strictly prohibited.
 */


use app\modules\admin\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $user User */


?>

    <h2>Witaj, <?= Html::encode($user->name) . ' ' . Html::encode($user->lastname); ?></h2>

    <p>
        Twoje konto na portalu Smart Helpline Panle własnie zostało założone. Dane do logowania znajdują się ponieżej.
    </p>

    <table>
        <tr>
            <th>Login: </th>
            <td><?= Html::encode($user->email) ?></td>
        </tr>
        <tr>
            <th>Hasło: </th>
            <td><?= Html::encode($user->password) ?></td>
        </tr>
    </table>

    <p>
        <?= Html::a('Przejdź do strony', Url::to(['/site'], true)) ?>
    </p>

<?= $this->render('_message-footer', ['optional' => true]) ?>