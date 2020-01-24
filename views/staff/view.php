<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Staff'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="staff-view">


    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'fullname',
            'jobTitle',
            'description:ntext',
            'email:email',
            'linkedin',
            [
                'attribute' => 'imageUrl',
                'value' => Url::to('@web/' . $model->imageUrl),
                'format' => ['image', [
                    'width'=>'140',
                    'height' => '100',
                    'alt' => 'Employee Image',
                    'style' => 'padding: 5px; border: 3px solid #dddddd; border-radius: 6px;',
                    ]
                ],
            ],
        ],
    ]) ?>

</div>
