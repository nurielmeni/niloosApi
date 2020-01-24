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
    public $wrapClass;

    public function init() {
        parent::init();
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
