<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use app\components\Niloos;

/**
 * This is the model class for Job".
 *
 * @property int $JobId
 */
class Job extends \yii\base\Model {
    private $niloos;
    public $jobId;
    
    public function __construct($config = array()) {
        parent::__construct($config);
        $this->niloos = new Niloos();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jobId'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jobId' => Yii::t('app', 'Job Id'),
        ];
    }
    
    public function getJob() {
        try {
            $jobObj = $this->niloos->jobGetConsideringIsDiscreetFiled($this->jobId);
        } catch (yii\base\UserException $e) {
            return [
                'JobId' => $this->jobId,
                'JobCode' => '',
                'JobTitle' => '',
                'Description' => '',
                'Requiremets' => 'Error: Job data for Job Id: ' . $this->jobId . ' wes not found in Niloos Service!',
                'Skills' => '',
                'UpdateDate' => '',
                'OpenDate' => '',
            ];
        }
        
        return $jobObj;
        
//        return [
//            'JobId' => $jobObj->JobId,
//            'JobCode' => $jobObj->JobCode,
//            'JobTitle' => $jobObj->JobTitle,
//            'Description' => $jobObj->Description,
//            'Requiremets' => $jobObj->Requirements,
//            'Skills' => $jobObj->Skills,
//            'UpdateDate' => $jobObj->UpdateDate,
//            'OpenDate' => $jobObj->OpenDate,
//        ];
    }
}
