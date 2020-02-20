<?php
namespace app\widgets;

use Yii;

/**
 * Memad socials (Facebook, Twitter ..)
 */
class Memad3Social extends \yii\bootstrap\Widget
{
    public $socials = [];
    
    private function getSocials() {
        $res = '<ul class="social pull-left nav navbar-nav flex">';
        foreach ($this->socials as $name => $url) {
            if ($name === 'ins') {
                $res .= '<li style="width: 40px; height: 40px; background-image: linear-gradient(to right, #00c0ff 0%, #88ffff 100%); border-radius: 20px; margin: 5px;"><a style="background: url(\'/images/socialShare/instegram-white.png\') no-repeat center center; background-size: cover; margin: 5px; padding: 15px" href="' . $url . '" target="_blank"></a></li>';
            } else {
                $res .= '<li style="width: 40px; height: 40px; background-image: linear-gradient(to right, #00c0ff 0%, #88ffff 100%); border-radius: 20px; margin: 5px;"><a style="padding: 10px 0; text-align: center; color: #fff; font-size: 22px; font-weight: bold;" href="' . $url . '" target="_blank">' . $name . '</a></li>';
            }
        }
        $res .= '</ul>';
        return $res;
    }
    
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->getSocials();       
    }
}