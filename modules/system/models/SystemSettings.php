<?php

namespace app\modules\system\models;

use Yii;
use yii\bootstrap\Html;

/**
 * This is the model class for table "{{%system_settings}}".
 *
 * @property integer $id
 * @property string $param_name
 * @property string $param_value
 * @property string $type
 */
class SystemSettings extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%system_settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param_name', 'param_value', 'type'], 'required'],
            [['param_name'], 'string', 'max' => 100],
            [['param_value', 'type'], 'string', 'max' => 255],
            [['param_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => Yii::t('seoitems', 'ID'),
            'param_name'        => Yii::t('seoitems', 'Param Name'),
            'param_value'       => Yii::t('seoitems', 'Param Value'),
            'type'              => Yii::t('seoitems', 'Type'),
        ];
    }

    /**
     * @return string
     */
    public function renderField()
    {
        if($this->type == 'textInput') {
            return Html::textInput($this->param_name, $this->param_value, ['class' => 'form-control']);
        } elseif($this->type == 'textarea') {
            return Html::textarea($this->param_name, $this->param_value, ['class' => 'form-control']);
        } elseif($this->type == 'checkbox') {
            $html = Html::hiddenInput($this->param_name, 0) . Html::checkbox($this->param_name, $this->param_value, ['class' => 'form-control']);
            return $html;
        }
    }
}