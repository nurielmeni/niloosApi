<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Settings'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'project',
                'contentOptions' => ['style' => 'font-weight: bold;']
            ],
            //'fromMail',
            //'toMail',
            //'fromName',
            'nsoftSiteId',
            //'nsoftApplicationId',
            //'categorySupplierId',
            //'nlsCardsWsdlUrl',
            //'nlsSecurityWsdlUrl',
            //'nlsDirectoryWsdlUrl',
            'nlsSecurityDomain',
            'nlsSecurityUsername',
            'nlsSecurityPassword',
            //'searchServiceWsdlUrl',
            //'languageCode',
            //'categoryIDs:ntext',
            //'trace',
            //'exceptions',
            //'cacheWsdl',
            [
                'attribute' => 'siteAddress',
                'format' => 'url',
                'value' => function($data) { return $data->siteAddress; },
            ],
            
            'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
