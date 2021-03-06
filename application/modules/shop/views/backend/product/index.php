<?php
/**
 * Copyright (c) 2015 - 2016. Hryvinskyi Volodymyr
 */

use app\modules\admin\widgets\Button;
use app\modules\shop\models\Category;
use app\modules\shop\models\Price;
use app\modules\shop\models\Producer;
use app\modules\shop\models\ProductOption;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;

\app\modules\shop\assets\BackendAsset::register($this);

$this->params['actions_buttons'] = [
    [
        'tagName'      => 'a',
        'label'        => Yii::t('content', 'Create'),
        'options'      => [
            'href' => Url::to(['create']),
        ],
        'icon'         => 'fa fa-plus',
        'iconPosition' => Button::ICON_POSITION_LEFT,
        'size'         => Button::SIZE_SMALL,
        'disabled'     => false,
        'block'        => false,
        'type'         => Button::TYPE_CIRCLE,
    ],
    [
        'label'    => Yii::t('admin', 'Control'),
        'options'  => [
            'class'             => 'btn blue btn-outline btn-circle btn-sm',
            'data-hover'        => "dropdown",
            'data-close-others' => "true",
        ],
        'dropdown' => [
            'options'      => ['class' => 'pull-right'],
            'encodeLabels' => false,
            'items'        => [
                [
                    'label'       => '<span class="font-red"><i class="fa fa-trash-o"></i> ' . Yii::t('admin', 'Delete') . '</span>',
                    'url'         => 'javascript:void(0)',
                    'linkOptions' => [
                        'onclick' => 'deleteA()',
                    ],
                ],
                [
                    'label'       => '<span class="font-green-turquoise"><i class="fa fa-toggle-on"></i> ' . Yii::t('admin', 'Published') . '</span>',
                    'url'         => 'javascript:void(0)',
                    'linkOptions' => ['onclick' => 'publishedA()'],
                ],
                [
                    'label'       => '<span class="font-blue-chambray"><i class="fa fa-toggle-off"></i> ' . Yii::t('admin', 'Unpublished') . '</span>',
                    'url'         => 'javascript:void(0)',
                    'linkOptions' => ['onclick' => 'unpublishedA()'],
                ],
            ],
        ],
    ],
];
?>
<div class="product-index">
    <?php if ($amount = $dataProvider->query->sum('amount')) { ?>
    <div class="summary">
        Всего остатков: Всего товаров:
        <?= $amount; ?>
    </div>
    на сумму
    <?= Price::find()->joinWith('product')->sum("shop_price.price*shop_product.amount"); ?>
    руб.
</div>
<?php } ?>
<?php
echo \yii\grid\GridView::widget([
    'id' => 'grid',
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table-mt table-mt-striped table-mt-hover table-mt-card'],
    'columns'      => [
        [
            'class' => 'yii\grid\CheckboxColumn',
            'options' => ['style' => 'width:36px']
        ],
        [
            'attribute' => 'name',
            'format'    => 'raw',
            'content'   => function ($model) {
                /** @var  $model \app\modules\shop\models\Product */
                if ($image = $model->getImage()->getUrl('50x50', true)) {
                    return Html::a(
                        "<img src=\"{$image}\" class=\"img-thumbnail pull-left img-circle\" style='margin-right: 10px' /> " .
                        $model->name . ' ' .
                        Html::a('<i class="fa fa-external-link"></i>', $model->getFrontendViewLink(), ['target' => '_blank']),
                        ['update', 'id' => $model->id]
                    );
                }
            },
        ],
        'code',
        [
            'label'   => 'Остаток',
            'content' => function ($model) {
                return "<p>{$model->amount} (" . ($model->amount * $model->price) . ")</p>";
            },
        ],
        [
            'label' => 'Цена',
            'value' => 'price',
        ],
        [
            'attribute' => 'category_id',
            'filter'    => Html::activeDropDownList(
                $searchModel,
                'category_id',
                Category::buildTextTree(),
                ['class' => 'form-control', 'prompt' => 'Категория']
            ),
            'value'     => 'category.name',
        ],
        [
            'attribute' => 'producer_id',
            'filter'    => Html::activeDropDownList(
                $searchModel,
                'producer_id',
                ArrayHelper::map(Producer::find()->all(), 'id', 'name'),
                [
                    'class'  => 'form-control',
                    'prompt' => 'Производитель',
                ]
            ),
            'value'     => 'producer.name',
        ],
        [
            'attribute' => 'id',
            'options'   => ['style' => 'width: 100px;'],
        ],
        [
            'class'        => app\modules\admin\components\grid\DeleteColumn::className()
        ],
    ],
]); ?>

</div>

<script>
    function deleteA() {
        var keys = $('#grid').yiiGridView('getSelectedRows');
        window.location.href = '<?= Url::to(['delete-ids']) ?>?id=' + keys.join();
    }
</script>
