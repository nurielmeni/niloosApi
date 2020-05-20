<?php
    use yii\bootstrap\NavBar;
    use yii\bootstrap\Nav;
    use yii\helpers\Html;
?>
<?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/settings/index']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/settings/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/settings/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
?>