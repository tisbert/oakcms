<?php
/**
 * Created by Vladimir Hryvinskyy.
 * Site: http://codice.in.ua/
 * Date: 01.06.2016
 * Project: oakcms
 * File name: Editor.php
 */

namespace app\widgets;

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

class Editor extends CKEditor
{
    public function init()
    {
        parent::init();

        $bundle = \yii\bootstrap\BootstrapAsset::register(\Yii::$app->view);

        $this->editorOptions = ElFinder::ckeditorOptions('/admin/file-manager-elfinder', [
            'preset'         => 'full',
            'entities'       => false,
            'allowedContent' => true,
            'baseHref'       => \Yii::$app->homeUrl,
            'filebrowserBrowseUrl' => [\Yii::$app->homeUrl.'admin/menu/item/ckeditor-select'],
        ]);
    }
}
