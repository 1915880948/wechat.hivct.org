<?php
/**
 * @category main.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/1 23:17
 * @since
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/** @var $this View */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= isset($this->params['title']) ? $this->params['title'] : "康复心干线"; ?></title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no" />
    <meta name="format-detection" content="email=no" />
    <?php
    echo Html::csrfMetaTags();
    echo Html::cssFile('@web/static/css/weui.css?v=20170228');
    echo Html::cssFile('@web/static/css/jquery-weui.css?v=20170228');
    echo Html::cssFile('@web/static/css/common.css?v=20170228');
    echo Html::jsFile('@web/static/js/flexible.js?v=20170228');
    echo Html::jsFile('@web/static/js/jquery-2.1.4.min.js?v=20170228');
    ?>
    <?php echo $this->head(); ?>
    <script>
        var SITE_URL = '<?php echo rtrim(Url::to(['/'], true), '/');?>';
        var CURRENT_URL = '<?php echo Url::toRoute([''], true);?>';
    </script>
</head>
<body>
<?php $this->beginBody();
echo $content;
echo Html::jsFile('@web/static/js/jquery-weui.js?v=20170228');
//echo Html::jsFile('@web/static/js/TouchSlide.1.1.min.js');
echo Html::jsFile('@web/static/js/common.min.js?v=20170228');
$this->endBody();
?>
</body>
<?php $this->endPage(); ?>
</html>
