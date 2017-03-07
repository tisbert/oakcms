<?php
/**
 * @package    oakcms
 * @author     Hryvinskyi Volodymyr <script@email.ua>
 * @copyright  Copyright (c) 2015 - 2016. Hryvinskyi Volodymyr
 * @version    0.0.1
 */

namespace app\modules\gallery\models;

use Yii;

class PlaceHolder extends Image
{
    private $modelName = '';
    private $itemId = '';
    public $filePath = 'placeHolder.png';
    public $urlAlias = 'placeHolder';

    public function __construct()
    {
        $this->filePath = basename(Yii::getAlias($this->getModule()->placeHolderPath)) ;
    }

    public function getPathToOrigin()
    {

        $url = Yii::getAlias($this->getModule()->placeHolderPath);

        if (!$url) {
            throw new \Exception('PlaceHolder image must have path setting!!!');
        }

        return $url;
    }

    protected  function getSubDir()
    {
        return 'placeHolder';
    }

    public function setMain($isMain = true)
    {
        throw new \yii\base\Exception('You must not set placeHolder as main image!!!');
    }
}

