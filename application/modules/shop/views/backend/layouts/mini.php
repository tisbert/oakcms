<?php
/**
 * Copyright (c) 2015 - 2016. Hryvinskyi Volodymyr
 */

use yii\helpers\Html;
use app\modules\order\assets\Asset;
Asset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=$this->title ?></title>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?=Html::csrfMetaTags() ?>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="columns-container">
        <div id="columns" class="container">
            <?= $content ?>
        </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
