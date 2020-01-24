<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string $fullname
 * @property string $jobTitle
 * @property string $description
 * @property string $email
 * @property string $linkedin
 * @property string $imageUrl
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullname', 'jobTitle'], 'required'],
            ['email', 'email'],
            ['linkedin', 'url'],
            [['description'], 'string'],
            [['fullname'], 'string', 'max' => 64],
            [['jobTitle', 'email', 'linkedin'], 'string', 'max' => 256],
            [['imageUrl'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fullname' => Yii::t('app', 'Fullname'),
            'jobTitle' => Yii::t('app', 'Job Title'),
            'description' => Yii::t('app', 'Description'),
            'email' => Yii::t('app', 'Email'),
            'linkedin' => Yii::t('app', 'In'),
            'imageUrl' => Yii::t('app', 'Image Url'),
        ];
    }
}
