<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\components\Niloos;
use yii\helpers\ArrayHelper;
use app\helpers\Helper;

/**
 * SearchForm is the model behind the contact form.
 */
class SearchForm extends Model
{
    const LANG_HEB = '1037';
    const LANG_ENG = '1033';

    public $location;
    public $profession;
    public $suplierId;
    public $freetext;
    
    private $niloos;
    private $settings;
    
    public function __construct($config = array()) {
        parent::__construct($config);
        $this->settings = new \app\components\Settings();
        $this->settings = $this->settings->getSettings();
        $this->niloos = new Niloos();
        $this->freetext = '';
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // location, profession are required
            [['location', 'profession', 'freetext'], 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {        
        return [
            'location' => 'בחר מיקום',
            'profession' => 'בחר מקצוע',
            'freetext' => 'טקסט חופשי',
        ];
    }

    public function getLocationOptions() {
        $ListName = 'regions';
        return $this->niloosResToOption($this->niloos->getListByListName($ListName));
    }
    
    private function niloosResToOption($res) {
        $options = [];
        if (!is_array($res) || count($res) < 1) return $options;

        foreach ($res as $item) {
            if (is_array($item) && array_key_exists('id', $item) && array_key_exists('text', $item)) {
                $options[$item['id']] = $item['text'];                 
            }
        }
        
        return $options;
    }
    
    public function getProfessionOptions() {
        return $this->niloosResToOption($this->niloos->categories());
    }
    
    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function search($noValidate = false)
    {
        if ($noValidate) {
            return $this->jobsByFreeText('');
        }
        
        if ($this->validate()) {
            // TODO Add the search logic
            $categories = is_array($this->profession) ? $this->profession : [$this->profession];
            $locations = is_array($this->location) ? $this->location : [$this->location];
            return !empty($this->freetext) ? $this->jobsByFreeText($this->freetext) : $this->jobsByCategories($categories, $locations);
        }
        return false;
    }
    
    /**
     * This function will add a where filter to the $obj
     * @author Meni Nuriel
     * @version 1.0 this version tag is parsed
     */
    private function addWhereFilter($condition, $field, $searchPhrase, $values) {
        $JobFilterFields = [];
        is_array($values) ?: $values = [$values];

        foreach ($values as $value) {
            $JobFilterField = [
                'Field' => $field,
                'SearchPhrase' => $searchPhrase,
                'Value' => $value,
            ];
            $JobFilterFields[] = $JobFilterField;
        }
        
        // Then: build the FilterWhere
        $JobFilterWhere = [
            'Filters' => $JobFilterFields,
            'Condition' => $condition
        ];
        
        // Last: add the FilterWhere object above to WhereFilters array of your filter
        return $JobFilterWhere;
    }

    public function jobsByCategories($categories = [], $locations = []) {
        /**
         * Object type of search
         *
            $filter = new stdClass();
            $filter->jobFilter = new stdClass();
            $filter->jobFilter->FromView = "Jobs";
            $filter->jobFilter->NumberOfRows = 10000;
            $filter->jobFilter->OffsetIndex = 0;

            $filter->jobFilter->SelectFilterFields = new stdClass();
            $filter->jobFilter->SelectFilterFields->JobFilterFields = ['JobId, JobTitle'];
            $filter->jobFilter->WhereFilters->JobFilterWhere[] = $this->addWhereFilter('OR', 'CategoryId', 'Exact', $categories);
            $filter->jobFilter->WhereFilters->JobFilterWhere[] = $this->addWhereFilter('AND', 'SupplierId', 'Exact', $this->supplierId);
            $filter->jobFilter->OrderByFilterSort = new stdClass();

            $JobFilterSort = new stdClass();
            $JobFilterSort->Field = 'JobTitle';
            $JobFilterSort->Direction = 'Ascending';

            $filter->jobFilter->OrderByFilterSort->JobFilterSort = [$JobFilterSort];

            $filter->transactionCode = Helper::newGuid();
            $filter->LanguageId = self::LANG_HEB;
         * 
         * End of object
        **/
            
        $filter = [
            'transactionCode' => Helper::newGuid(),
            'LanguageId' => self::LANG_HEB,
            'jobFilter' => [
                'FromView' => 'Jobs',
                'NumberOfRows' => 10000,
                'OffsetIndex' => 0,
                'SelectFilterFields' => [
                    'JobFilterFields' => [
                        'CityId', 
//                        'CountryCodeFIPS', 
                        'Description', 
                        'JobId', 
//                        'JobSeniority', 
                        'JobTitle', 
                        'JobCode',
//                        'OpenDate',
//                        'CategoryId',
//                        'OpenPositions', 
//                        'Rank', 
                        'RegionValue', 
                        'Requiremets', 
//                        'Skills', 
//                        'YearsOfExperience',
//                        'EmployerName',
//                        'JobScope',
//                        'EmployerId',
                        'RegionText',
//                        'EmploymentType',
                        'UpdateDate',
//                        'ExpertiseId',
//                        'ProfessionalFieldId'
                    ],
                ],
                'OrderByFilterSort' => [
                    'JobFilterSort' => [
                        [
                            'Field' => 'JobTitle',
                            'Direction' => 'Ascending',
                        ],
                    ],
                ],
                'WhereFilters' => [
                    'JobFilterWhere' => [
                        $this->addWhereFilter('OR', 'RegionValue', 'Exact', $locations),
                        $this->addWhereFilter('OR', 'CategoryId', 'Exact', $categories),
                        $this->addWhereFilter('AND', 'SupplierId', 'Exact', $this->settings['categorySupplierId']),
                    ],
                ],
            ]
        ];
//                        print '<pre style="direction:ltr;"><code>';
//                        print_r($filter);
//                        print '</code></pre>';
        $cacheKey = $this->settings['categorySupplierId'] . implode('', $categories);
        return $this->niloos->jobsGetByFilter($filter, $cacheKey);
    }
    
    public function jobsByFreeText($freetext = '') {
        //if (empty($freetext)) return [];
        $freetext = preg_split('/[\s,]+/', $freetext);
        /**
         * Object type of search
         *
            $filter = new stdClass();
            $filter->jobFilter = new stdClass();
            $filter->jobFilter->FromView = "Jobs";
            $filter->jobFilter->NumberOfRows = 10000;
            $filter->jobFilter->OffsetIndex = 0;

            $filter->jobFilter->SelectFilterFields = new stdClass();
            $filter->jobFilter->SelectFilterFields->JobFilterFields = ['JobId, JobTitle'];
            $filter->jobFilter->WhereFilters->JobFilterWhere[] = $this->addWhereFilter('OR', 'CategoryId', 'Exact', $categories);
            $filter->jobFilter->WhereFilters->JobFilterWhere[] = $this->addWhereFilter('AND', 'SupplierId', 'Exact', $this->supplierId);
            $filter->jobFilter->OrderByFilterSort = new stdClass();

            $JobFilterSort = new stdClass();
            $JobFilterSort->Field = 'JobTitle';
            $JobFilterSort->Direction = 'Ascending';

            $filter->jobFilter->OrderByFilterSort->JobFilterSort = [$JobFilterSort];

            $filter->transactionCode = Helper::newGuid();
            $filter->LanguageId = self::LANG_HEB;
         * 
         * End of object
        **/
            
        $filter = [
            'transactionCode' => Helper::newGuid(),
            'LanguageId' => self::LANG_HEB,
            'jobFilter' => [
                'FromView' => 'Jobs',
                'NumberOfRows' => 10000,
                'OffsetIndex' => 0,
                'SelectFilterFields' => [
                    'JobFilterFields' => [
                        'CityId', 
//                        'CountryCodeFIPS', 
                        'Description', 
                        'JobId', 
//                        'JobSeniority', 
                        'JobTitle', 
                        'JobCode',
//                        'OpenDate',
//                        'CategoryId',
//                        'OpenPositions', 
//                        'Rank', 
                        'RegionValue', 
                        'Requiremets', 
//                        'Skills', 
//                        'YearsOfExperience',
//                        'EmployerName',
//                        'JobScope',
//                        'EmployerId',
                        'RegionText',
//                        'EmploymentType',
                        'UpdateDate',
//                        'ExpertiseId',
//                        'ProfessionalFieldId'
                    ],
                ],
                'OrderByFilterSort' => [
                    'JobFilterSort' => [
                        [
                            'Field' => 'JobTitle',
                            'Direction' => 'Ascending',
                        ],
                    ],
                ],
                'WhereFilters' => [
                    'JobFilterWhere' => [
                        //$this->addWhereFilter('OR', 'Description', 'Like', $freetext),
                        $this->addWhereFilter('OR', 'JobTitle', 'Like', $freetext),
                        //$this->addWhereFilter('OR', 'JobId', 'Exact', $freetext),
                        $this->addWhereFilter('AND', 'SupplierId', 'Exact', $this->settings['categorySupplierId']),
                    ],
                ],
            ]
        ];
//                        print '<pre style="direction:ltr;"><code>';
//                        print_r($filter);
//                        print '</code></pre>';
        $cacheKey =  'free' . hash('md5', $this->freetext);
        return $this->niloos->jobsGetByFilter($filter, $cacheKey);
    }

}
