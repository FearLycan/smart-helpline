<?php

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <div class="col-md-4 col-lg-offset-4">
        <?= $this->render('_loginForm', [
            'model' => $model,
        ]) ?>
    </div>
</div>
