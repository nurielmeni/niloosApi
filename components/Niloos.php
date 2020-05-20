<?php

namespace app\components;

use yii\base\Controller;
use yii\helpers\Url;
use SoapHeader;
use SoapVar;
use app\helpers\Helper;
use app\components\NlsSoapClient;
use SimpleXMLElement;
use app\components\Settings;
use yii\base\UserException;


/**
 * 
 */
class Niloos
{
    const LANG_HEB = '1037';
    const LANG_ENG = '1033';
    
    private $format = 'd-m-Y H:i:s';
    private $cache;
    private $settings;
    private $client;
    private $auth;
    
    public function __construct($settings) {
        $this->cache = \Yii::$app->cache;
        
        // Flush cache
        if (key_exists('flushCache', \Yii::$app->params) && \Yii::$app->params['flushCache']) {
            $this->cache->flush();
        }
            
        $this->settings = $settings;
        $this->authenticate();
        $this->settings->languageCode = self::LANG_HEB;
    }
    
    
    private function setClient($service) {
        switch ($service) {
            case 'security':
                /** Define SOAP headers for token authentication **/
                $soap_headers = [
                    new SoapHeader('_', 'NiloosoftCred0', $this->settings->nsoftApplicationId),
                    new SoapHeader('_', 'NiloosoftCred1', $this->settings->nlsSecurityDomain . '\\' . $this->settings->nlsSecurityUsername),
                    new SoapHeader('_', 'NiloosoftCred2', $this->settings->nlsSecurityPassword)
                ];
                $url = $this->settings->nlsSecurityWsdlUrl;
                break;
            case 'sec':
                $soap_headers = [
                    new SoapHeader('_', 'NiloosoftCred1', isset($this->auth) ? $this->auth->UsernameToken : null),
                    new SoapHeader('_', 'NiloosoftCred2', isset($this->auth) ? $this->auth->PasswordToken : null)
                ];
                $url = $this->settings->nlsSecurityWsdlUrl;
                break;
            case 'cards':
                $soap_headers = [
                    new SoapHeader('_', 'NiloosoftCred1', isset($this->auth) ? $this->auth->UsernameToken : null),
                    new SoapHeader('_', 'NiloosoftCred2', isset($this->auth) ? $this->auth->PasswordToken : null)
                ];
                $url = $this->settings->nlsCardsWsdlUrl;
                break;
            case 'directory':
                $soap_headers = [
                    new SoapHeader('_', 'NiloosoftCred1', isset($this->auth) ? $this->auth->UsernameToken : null),
                    new SoapHeader('_', 'NiloosoftCred2', isset($this->auth) ? $this->auth->PasswordToken : null)
                ];
                $url = $this->settings->nlsDirectoryWsdlUrl;
                break;
            default:
                $this->client = null;
                return null;
                break;
        }
        
        $this->client = new NlsSoapClient($url, array(
            'trace' => 1,
            'exceptions' => 1,
            'cache_wsdl' => WSDL_CACHE_BOTH,
            'location' => explode('?', $url)[0],
            'encoding' => 'UTF-8'
        ));

        $this->client->__setSoapHeaders($soap_headers);
    }
    
    /**
     * Authenticate the user against the service and gets an Auth object
     * @return auth object with user data and expiration time
     * @throws \app\modules\niloos\models\Exception
     */
    private function authenticate() 
    {
        $transactionCode = Helper::newGuid();
        try {
            $param[] = new SoapVar($this->settings->nlsSecurityDomain . '\\' . $this->settings->nlsSecurityUsername, XSD_STRING, null, null, 'userName', null);
            $param[] = new SoapVar($this->settings->nlsSecurityPassword, XSD_STRING, null, null, 'password', null);
            $param[] = new SoapVar($transactionCode, XSD_STRING, null, null, 'transactionCode', null);
            $param[] = new SoapVar($this->settings->nsoftSiteId, XSD_STRING, null, null, 'applicationSecret', null);
            $options = new SoapVar($param, SOAP_ENC_OBJECT, null, null);

            $this->auth = \Yii::$app->cache->getOrSet($this->settings->project, function () use ($options){
                $this->setClient('security');
                return $this->client->__soapCall("Authenticate2", array($options));
            }, 60 * 60 * 24);
        } catch (\Exception $ex) {
            $ex->transactionCode = $transactionCode;
            throw $ex;
        }
        //echo '[' . date("Y-m-d H:i:s") . '] UserNameToken: ' . $this->auth->UsernameToken . "\n";
    }
    
    public function testService() {
        $return = false;
        $this->setClient('cards');
        $res = $this->client->isServiceReachable();
        $return = $res->isServiceReachableResult;
        
        $this->setClient('directory');
        $res = $this->client->isServiceReachable();
        return $return && $res->isServiceReachableResult;
    }
    
    /**
     * @return categories array
     */
    public function categories($parentId = null)
    {
        if (key_exists('flushCache', \Yii::$app->params) && \Yii::$app->params['flushCache']) {
            $this->cache->flush();
        }
        $languageCode = $this->settings->languageCode;
        
        $res = \Yii::$app->cache->getOrSet('categories', function () use ($parentId, $languageCode){
            $this->setClient('directory');
            $list = [];
            
            try {
                $params = [
                    'transactionCode' => Helper::newGuid(),
                    'parentItemId' => $parentId,
                    'languageId' => $languageCode,
                    'listName' => $parentId === null ? 'ProfessionalCategories' : 'ProfessionalFields',
                ];
                
                $res = $this->client->GetListItems($params)->GetListItemsResult;

                if (!property_exists($res, 'ListItemInfo')) 
                    return $list;

                $res = $res->ListItemInfo;

                foreach ($res as $cat) {
                    $list[] = [
                        'id' => $cat->ListItemId,
                        'text' => $cat->ValueTranslated
                    ];
                }

                return $list;
            } catch (Exception $ex) {
                var_dump($ex);
                echo 'Request ' . $this->client->__getLastRequest();
                echo 'Response ' . $this->client->__getLastResponse();
                die;
            }
        }, 60 * 20);
        
        return $res;
    }
    
    public function jobGetConsideringIsDiscreetFiled($jobId) {
        $res = \Yii::$app->cache->getOrSet('jobGetConsideringIsDiscreetFiled' . $jobId, function () use ($jobId){
            $this->setClient('cards');

            $params = [
                'JobId' => $jobId,
                'transactionCode' => Helper::newGuid(),
            ];

            try{
                $response = $this->client->JobGetConsideringIsDiscreetFiled($params);
                return $response->JobGetConsideringIsDiscreetFiledResult;
            } catch (UserException $ex) {
//                var_dump($ex);
//                echo 'Request ' . $this->client->__getLastRequest();
//                echo 'Response ' . $this->client->__getLastResponse();
//                die;
                throw new UserException($e);
            } catch (\SoapFault $e) {
                throw new UserException($e);
            }
        }, 60 * 10);
        
        return $res;
    }
    
    public function getListByListName($listName) {
        if (key_exists('flushCache', \Yii::$app->params) && \Yii::$app->params['flushCache']) {
            $this->cache->flush();
        }
        $languageCode = $this->settings->languageCode;
        
        $res = \Yii::$app->cache->getOrSet('List_' . $listName, function () use ($listName, $languageCode){
            $this->setClient('directory');
            $List = [];
            
            try {
                $params = [
                    'transactionCode' => Helper::newGuid(),
                    'listName' => $listName,
                    'languageId' => $languageCode,
                ];
                
                $res = $this->client->GetListByListName($params)->GetListByListNameResult;

                if (!property_exists($res, 'HunterListItem')) 
                    return $List;

                foreach ($res->HunterListItem as $listItem) {
                    $list[] = [
                        'id' => $listItem->Value,
                        'text' => $listItem->Text,
                    ];
                }
                
                return $list;
            } catch (Exception $ex) {
                var_dump($ex);
                echo 'Request ' . $this->client->__getLastRequest();
                echo 'Response ' . $this->client->__getLastResponse();
                die;
            }
        }, 60 * 20);
        
        return $res;
    }

    /*
     * @return Jobs by filter
     */
    public function jobsGetByFilter($filter, $cacheKey = 'niloos_search_result') {
        if (key_exists('flushCache', \Yii::$app->params) && \Yii::$app->params['flushCache']) {
            $this->cache->flush();
        }
        return $this->cache->getOrSet($cacheKey, function () use ($filter){
                try {
                    $this->setClient('cards');
                    $jobsXml =  $this->client->JobsGetByFilter($filter)->JobsGetByFilterResult->any;
                    $jobsXml = substr($jobsXml, strpos($jobsXml, '<diffgr:'));
                    $jobsObj = simplexml_load_string($jobsXml);
                    $jobs = json_decode(json_encode($jobsObj), TRUE);                    
                    if (key_exists('DocumentElement', $jobs) && key_exists('Jobs', $jobs['DocumentElement'])) {
                        $jobsArray = $jobs['DocumentElement']['Jobs'];
                        
                        // If only one item place it in an array
                        return key_exists('JobId', $jobsArray) ? [$jobsArray] : $jobsArray;
                    } 
                } catch (\SoapFault $e) {
                    $test = $e;
                }    
                
                // No results or bad result from search
                return [];
            }, 60 * 5);
    }
    
}
