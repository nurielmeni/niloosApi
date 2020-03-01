<?php
namespace app\widgets;

use Yii;
use yii\bootstrap\Html;
use yii\helpers\Url;

/**

 */
class MemadLogo extends \yii\bootstrap\Widget
{
    public $color = '#ffffff';
    private function getLogo() {
        $logo = Html::beginTag('div', ['class' => 'text-center memad-logo', 'style' => 'color:' . $this->color]);
        $logo .= Html::beginTag('a', ['href' => Yii::$app->homeUrl, 'style' => 'text-decoration: none;']);
        $logo .= Html::img(Url::to('@web/images/logo.png'), ['alt' => 'Memed3 Logo']);
        $logo .= Html::tag('p', 'המימד השלישי', ['style' => 'margin-bottom: 0; font-size: 30px; font-weight: 300;']);
        $logo .= Html::tag('p', 'גיוס והשמה');
        $logo .= Html::endTag('a');
        $logo .= Html::endTag('div');
        
        return $logo;
    }
    
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->getLogo();       
    }
}
