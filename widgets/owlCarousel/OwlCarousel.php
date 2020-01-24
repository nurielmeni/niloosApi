<?php
namespace app\widgets\owlCarousel;

use Yii;
use yii\helpers\Url;
use app\widgets\owlCarousel\assets\OwlCarouselAsset;

/**
 * Carousel Widget
 */
class OwlCarousel extends \yii\bootstrap\Widget
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
        OwlCarouselAsset::register(\Yii::$app->view);
    }
    
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('owlCarousel', [
            'items' => $this->items,
            'wrapClass' => $this->wrapClass,
        ]);       
    }
}
