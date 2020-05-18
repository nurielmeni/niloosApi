<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%staff}}`.
 */
class m200105_233105_create_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'project' => $this->string(64),
            'fromMail' => $this->string(), //nurielme@gmail.com
            'toMail' => $this->string(), //nurielme@gmail.com
            'fromName' => $this->string()->defaultValue('NilooSoft'),
            'nsoftSiteId' => $this->string(), //1bec8d3d-0072-42d4-b591-d3307172ee22
            'nsoftApplicationId' => $this->string(), //1bec8d3d-0072-42d4-b591-d3307172ee22
            'categorySupplierId' => $this->string(), //c30b69a4-594a-49da-b78a-ce4c961597db
            'nlsCardsWsdlUrl' => $this->string()->defaultValue('https://huntercards.hunterhrms.com/HunterCards.svc?wsdl'),
            'nlsSecurityWsdlUrl' => $this->string()->defaultValue('https://hunterdirectory.hunterhrms.com/SecurityService.svc?wsdl'),
            'nlsDirectoryWsdlUrl' => $this->string()->defaultValue('https://hunterdirectory.hunterhrms.com/DirectoryManagementService.svc?wsdl'),
            'nlsSecurityDomain' => $this->string(), //memad3
            'nlsSecurityUsername' => $this->string(), //Jobsite
            'nlsSecurityPassword' => $this->string(), //Pass2020!
            'searchServiceWsdlUrl' => $this->string()->defaultValue('https://huntercards.hunterhrms.com/HunterCards.svc?wsdl'),
            'languageCode' => $this->integer()->defaultValue(1033),
            'categoryIDs' => $this->text(),
            'trace' => $this->integer()->defaultValue(1),
            'exceptions' => $this->integer()->defaultValue(1),
            'cacheWsdl' => $this->integer()->defaultValue(3),
            'siteAddress' => $this->string()->defaultValue('https://jobsite.hunterhrms.com'),
            'active' => $this->boolean()->defaultValue(true),
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
