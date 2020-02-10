<?php
namespace app\widgets\slickCarousel;

use Yii;
use yii\helpers\Url;
use app\widgets\slickCarousel\assets\SlickCarouselAsset;

/**
 * Carousel Widget
 */
class SlickCarousel extends \yii\bootstrap\Widget
{
    /**
     * 
     */
    public $items = [];
    public $folder;
    public $wrapClass;

    public function init() {
        parent::init();
        $folderFiles = \yii\helpers\FileHelper::findFiles($this->folder,[
            'only' => ['*.png','*.jpg'],
            'recursive' => false,
        ]);      
        if ($folderFiles && is_array($folderFiles)) {
            foreach ($folderFiles as $logo) {
                array_push($this->items, ['img' => str_replace ( $this->folder , '' , $logo, 1), 'alt' => 'Customer Logo']);
            }
        }
        
        $this->wrapClass .= strpos($this->wrapClass, 'meni-carousel') !== false ?: ' meni-carousel';
        $this->items = is_array($this->items) ? $this->items : [];
        SlickCarouselAsset::register(\Yii::$app->view);
    }
    
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('slickCarousel', [
            'items' => $this->items,
            'wrapClass' => $this->wrapClass,
        ]);       
    }
}
