<?php

use yii\bootstrap\Nav;

$items = [
    ['label' => 'בית', 'url' => ['/site/index']],
    ['label' => 'עלינו', 'url' => ['/site/about']],
    ['label' => 'לוח המשרות', 'url' => ['/site/jobs']],
    ['label' => 'צרו קשר', 'url' => ['/site/contact']],
    ['label' => 'מעסיקים', 'url' => ['/site/employers'], 'options'=> ['class'=>'nav-item-employers'],],
    isset($user) && $user ? (
        Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
        ) : (
            '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        )
    ) : ''

];


echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left ' . $class],
    'items' => $items,
]);
