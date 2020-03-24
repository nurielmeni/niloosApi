<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ApplyForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $cvFile;
    public $jobId;
    public $jobCode;
    public $jobTitle;
    private $cvFileUrl;

    public function rules()
    {
        return [
            [['cvFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'docx, doc, pdf'],
            [['jobId', 'jobTitle', 'jobCode'], 'safe'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->cvFileUrl = 'uploads/cvFiles/' . $this->cvFile->baseName . '.' . $this->cvFile->extension;
            $this->cvFile->saveAs($this->cvFileUrl, false);
            return true;
        } else {
            return false;
        }
    }
    
    public function sendMail($email) {
        $subject = "התקבלה מועמדות למשרה - $this->jobTitle - מזהה משרה - $this->jobCode";
        if ($this->validate()) {
            $mail = \Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
                ->setBcc([\Yii::$app->params['bccEmail'] => \Yii::$app->params['senderName']])
                ->setSubject($subject)
                ->setTextBody($subject);

            if($this->cvFileUrl) $mail->attach($this->cvFileUrl);
            $mail->send();


            return true;
        }
        return false;
    }
}