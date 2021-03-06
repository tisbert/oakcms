<?php
/**
 * @package    oakcms
 * @author     Hryvinskyi Volodymyr <script@email.ua>
 * @copyright  Copyright (c) 2015 - 2017. Hryvinskyi Volodymyr
 * @version    0.0.1-beta.0.1
 */

namespace app\modules\menu;

use app\components\module\ModuleEventsInterface;
use app\modules\admin\widgets\events\MenuItemsEvent;
use app\modules\admin\widgets\Menu;
use Yii;

/**
 * Class Module
 * @package oakcms
 * @author Volodumur Hryvinskiy <script@email.ua>
 */

class Module extends \app\components\module\Module implements ModuleEventsInterface
{
    const EVENT_MENU_ITEM_LAYOUTS = 'menuItemLayouts';

    public $controllerNamespace = 'app\modules\menu\controllers';
    public $defaultRoute = 'menu/item';

    public static $urlRulesBackend = [];

    public $settings = [];

    private $_menuItemLayouts = [];

    /**
     * @param $event MenuItemsEvent
     */
    public function addAdminMenuItem($event)
    {
        $event->items['menu'] = [
            'label' => Yii::t('menu', 'Menu'),
            'icon' => '<i class="fa fa-bars"></i>',
            'items' => [
                [
                    'label' => \Yii::t('menu', 'Menus'),
                    'icon' => '<i class="fa fa-bars"></i>',
                    'url' => ['/admin/menu/type']

                ],
                [
                    'label' => \Yii::t('menu', 'Menus Items'),
                    'icon' => '<i class="icon-list" style="width: 20px;display: inline-block;"></i>',
                    'url' => ['/admin/menu/item']
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            Menu::EVENT_FETCH_ITEMS => 'addAdminMenuItem'
        ];
    }

    /**
     * @return array
     */
    public function getMenuItemLayouts()
    {
        $themeClass = '\app\templates\frontend\\'.Yii::$app->keyStorage->get('themeFrontend').'\Theme';
        return $themeClass::$menuItemLayouts;
    }

    /**
     * @param array $items
     */
    public function setMenuItemLayouts($items)
    {
        $this->_menuItemLayouts = $items;
    }
}
