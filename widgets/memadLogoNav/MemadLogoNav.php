<?php
namespace app\widgets\memadLogoNav;

use Yii;
use yii\helpers\Url;
use app\widgets\memadLogoNav\assets\MemadLogoNavAsset;

/**
 * Navbar logo
 */
class MemadLogoNav extends \yii\bootstrap\Widget
{
    /**
     * 
     */
    public $topLine = 'המימד השלישי';
    public $bottomLine = 'גיוס והשמה';
    public $logo;
    public $wrapClass;

    public function init() {
        parent::init();
        $this->logo = !empty($this->logo) ?: Url::to('@web/images/logo.png');
        $this->wrapClass .= strpos($this->wrapClass, 'memad-logo-nav-wrap') !== false ?: ' memad-logo-nav-wrap';
        MemadLogoNavAsset::register(\Yii::$app->view);
    }
    
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('memadLogoNav', [
            'topLine' => $this->topLine,
            'bottomLine' => $this->bottomLine,
            'logo' => $this->logo,
            'wrapClass' => $this->wrapClass,
        ]);       
    }
}
