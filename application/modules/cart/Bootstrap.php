<?php
/**
 * @package    oakcms
 * @author     Hryvinskyi Volodymyr <script@email.ua>
 * @copyright  Copyright (c) 2015 - 2016. Hryvinskyi Volodymyr
 * @version    0.0.1
 */

namespace app\modules\cart;

use yii\base\BootstrapInterface;
use yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Yii::$container->set('app\modules\cart\interfaces\CartService', 'app\modules\cart\models\Cart');
        Yii::$container->set('app\modules\cart\interfaces\ElementService', 'app\modules\cart\models\CartElement');
        Yii::$container->set('cartElement', 'app\modules\cart\models\CartElement');
    }
}
