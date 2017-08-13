<?php
use application\models\service\AdvertService;
use common\core\image\ThumbImage;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\web\View;

?>
<div class="g-container">
    <div class="home-wrap">
        <div class="gallery swiper-container" id="js_gallery" data-space-between='10' data-pagination='.swiper-pagination' data-autoplay="1000">
            <div class="swiper-wrapper">
                <?php
                $adlists = AdvertService::getInstance()
                                        ->getLists();
                foreach($adlists as $adlist){
                    echo Html::beginTag('div', ['class' => 'swiper-slide']);
                    echo Html::a(Html::img(ThumbImage::thumb(ThumbImage::options($adlist['image'], [
                        'c' => 'fill',
                        'w' => 700,
                        'h' => 434,
                    ]), 'app')), $adlist['url']
                        ? Url::to($adlist['url'])
                        : 'javascript:;');
                    echo Html::endTag('div');
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <ul class="ui-flexbox banner">
            <li class="item-col">
                <?php
                echo Html::a(Html::img('@web/static/images/home_banner1.jpg'), ['page/meeting']);
                ?>
            </li>
            <li class="item-col">
                <?php
                echo Html::a(Html::img('@web/static/images/home_banner2.jpg'), ['page/tools']);
                ?>
            </li>
        </ul>
        <ul class="ui-flexbox menu">
            <li class="item-col"><a href="<?= Url::to(['page/news']); ?>"><img src="<?= Yii::getAlias('@web/static'); ?>/images/home_menu1.jpg" alt=""></a></li>
            <li class="item-col">
                <a href="<?= Url::to(['page/literature']); ?>"><img src="<?= Yii::getAlias('@web/static'); ?>/images/home_menu2.jpg" alt=""></a></li>
            <li class="item-col">
                <a href="<?= Url::to(['page/angle']); ?>" class="nav-angle"><img src="<?= Yii::getAlias('@web/static'); ?>/images/home_menu3.jpg" alt=""></a>
            </li>
        </ul>
    </div>
</div>
<?php echo Html::jsFile('@web/static/js/weui/swiper.min.js', ['position' => View::POS_END]); ?>
<?php $this->registerJs("
$(function(){
    $('.swiper-container').swiper({
        loop: true,
        autoplay: 3000
    });
});

", View::POS_END); ?>
