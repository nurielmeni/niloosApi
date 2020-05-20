<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $project
 * @property string $fromMail
 * @property string $toMail
 * @property string $fromName
 * @property string $nsoftSiteId
 * @property string $nsoftApplicationId
 * @property string $categorySupplierId
 * @property string $nlsCardsWsdlUrl
 * @property string $nlsSecurityWsdlUrl
 * @property string $nlsDirectoryWsdlUrl
 * @property string $nlsSecurityDomain
 * @property string $nlsSecurityUsername
 * @property string $nlsSecurityPassword
 * @property string $searchServiceWsdlUrl
 * @property int $languageCode
 * @property string $categoryIDs
 * @property int $trace
 * @property int $exceptions
 * @property int $cacheWsdl
 * @property string $siteAddress
 * @property int $active
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['languageCode', 'trace', 'exceptions', 'cacheWsdl', 'active'], 'integer'],
            [['categoryIDs'], 'string'],
            [['project'], 'string', 'max' => 64],
            [['fromMail', 'toMail', 'fromName', 'nsoftSiteId', 'nsoftApplicationId', 'categorySupplierId', 'nlsCardsWsdlUrl', 'nlsSecurityWsdlUrl', 'nlsDirectoryWsdlUrl', 'nlsSecurityDomain', 'nlsSecurityUsername', 'nlsSecurityPassword', 'searchServiceWsdlUrl', 'siteAddress'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project' => Yii::t('app', 'Project'),
            'fromMail' => Yii::t('app', 'From Mail'),
            'toMail' => Yii::t('app', 'To Mail'),
            'fromName' => Yii::t('app', 'From Name'),
            'nsoftSiteId' => Yii::t('app', 'Nsoft Site ID'),
            'nsoftApplicationId' => Yii::t('app', 'Nsoft Application ID'),
            'categorySupplierId' => Yii::t('app', 'Category Supplier ID'),
            'nlsCardsWsdlUrl' => Yii::t('app', 'Nls Cards Wsdl Url'),
            'nlsSecurityWsdlUrl' => Yii::t('app', 'Nls Security Wsdl Url'),
            'nlsDirectoryWsdlUrl' => Yii::t('app', 'Nls Directory Wsdl Url'),
            'nlsSecurityDomain' => Yii::t('app', 'Nls Security Domain'),
            'nlsSecurityUsername' => Yii::t('app', 'Nls Security Username'),
            'nlsSecurityPassword' => Yii::t('app', 'Nls Security Password'),
            'searchServiceWsdlUrl' => Yii::t('app', 'Search Service Wsdl Url'),
            'languageCode' => Yii::t('app', 'Language Code'),
            'categoryIDs' => Yii::t('app', 'Category I Ds'),
            'trace' => Yii::t('app', 'Trace'),
            'exceptions' => Yii::t('app', 'Exceptions'),
            'cacheWsdl' => Yii::t('app', 'Cache Wsdl'),
            'siteAddress' => Yii::t('app', 'Site Address'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}
