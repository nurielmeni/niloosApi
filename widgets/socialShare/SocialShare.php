<?php
namespace app\widgets\socialShare;

use Yii;
use yii\helpers\Url;
use app\widgets\socialShare\assets\SocialShareAsset;

/**
 * Carousel Widget
 */
class SocialShare extends \yii\bootstrap\Widget
{
    /**
     * 
     */
    public $items = [
        ['name' => 'Twitter', 'url' => 'https://twitter.com/intent/tweet?url=', 'img' => 'twitter.png', 'mobile' => false],
        ['name' => 'LinkedIn', 'url' => 'https://www.linkedin.com/shareArticle?mini=true&url=', 'img' => 'in.png', 'mobile' => false],
        ['name' => 'Facebook', 'url' => 'https://www.facebook.com/dialog/share?app_id=149701323135240&display=popup&href=', 'img' => 'facebook.png', 'mobile' => false],
        ['name' => 'Instegram', 'url' => 'https://instagram.com?url=', 'img' => 'instegram.png', 'mobile' => false],
        ['name' => 'Whatsapp', 'url' => 'https://wa.me/?text=', 'img' => 'whatsapp.png', 'mobile' => false],
    ];
    public $shareUrl = '';
    public $shareText = '';
    public $wrapClass;

    private $imagesFolder;
    
    public function init() {
        parent::init();
        $bundle = SocialShareAsset::register(\Yii::$app->view);
        $this->imagesFolder = Url::to('@web/images/socialShare/');
        $this->shareText = urlencode($this->shareText);
        $this->shareUrl = urlencode($this->shareUrl);
    }
    
    public function shareData($item) {
        switch ($item['name']) {
            case 'Twitter':
                return $item['url'] . $this->shareUrl . '&text=' . $this->shareText;
                break;
            case 'LinkedIn':
            case 'Facebook':
                return $item['url'] . $this->shareUrl;
                break;
            case 'Whatsapp': 
                return $item['url'] . $this->shareText;
                break;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('socialShare', [
            'items' => $this->items,
            'wrapClass' => $this->wrapClass,
            'imagesFolder' => $this->imagesFolder,
        ]);       
    }
}
