<?php
use application\models\base\Votes;
use application\models\base\VoteSpecial;
use common\core\image\ThumbImage;
use yii\bootstrap\Html;
use yii\helpers\Url;

/**
 * @category detail.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/19 21:21
 * @since
 */
/** @var $info VoteSpecial */
/** @var $votes Votes[] */
if(!$info){
    ?>
    <div class="g-container g-bgimg login-wrap">
        <div class="login-form">
            <h1 class="logo"><img src="<?php echo Yii::getAlias('@web/static'); ?>/images/logo.png" alt=""></h1>
            <?php
            echo Html::tag('h3', '调研活动不存在，请返回重新尝试', ['class' => 'ui-fs30']);
            ?>
            <div class="support">技术支持：《医学界》传媒</div>
        </div>
    </div>
    <?php
    return;
}
if(time() < strtotime($info['begin_date']) || time() > strtotime($info['end_date'])){
    ?>
    <div class="g-container  g-bgimg login-wrap" style="padding:0">
        <div class="research-warp">
            <div class="r-cover">
                <?= Html::img(ThumbImage::thumb(ThumbImage::options($info['cover_image'], [
                    'c' => 'fill',
                    'w' => 700,
                    'h' => 290,
                ]), 'app')); ?></div>
            <h2 class="r-title"><?= $info['title']; ?></h2>
            <div class="r-cont" style="padding-top:2rem">
                <dl>
                    <dt style="text-align:center;background:none;">
                        <?php
                        if(time() < strtotime($info['begin_date'])):
                            ?>
                            调研尚未开始<br />开始时间为：<?= $info['begin_date'];
                        endif;
                        if(time() > strtotime($info['end_date'])): ?>
                            调研已经结束
                        <?php endif; ?>
                    </dt>
                </dl>
            </div>
        </div>
    </div>
    <?php
    return;
}
// echo Html::cssFile('@web/static/plugins/icheck/skins/square/blue.css');
// echo Html::jsFile('@web/static/plugins/icheck/icheck.min.js');
?>
<div class="g-container g-bgimg">
    <div class="research-warp">
        <div class="r-cover">
            <?= Html::img(ThumbImage::thumb(ThumbImage::options($info['cover_image'], [
                'c' => 'fill',
                'w' => 700,
                'h' => 290,
            ]), 'app')); ?></div>
        <h2 class="r-title"><?= $info['title']; ?></h2>
        <form method="post" id="vote-detail">
            <div class="r-cont">
                <?php
                echo Html::hiddenInput('_csrf', Yii::$app->request->getCsrfToken());
                echo Html::hiddenInput('special', $info['id']);
                $k = 1;
                foreach($votes as $vote){
                    echo Html::beginTag("dl");
                    echo Html::beginTag("dt");
                    echo sprintf("%s、%s(%s)", $k, $vote->title, $vote->is_multi ? '多选' : '单选');
                    echo Html::endTag("dt");
                    foreach(range(1, 6) as $rangeId){
                        $optionId = "option_{$rangeId}";
                        if(isset($vote[$optionId]) && $vote[$optionId]){
                            echo Html::beginTag("dd");
                            echo Html::beginTag("label", ['for' => "v-{$vote['id']}-{$optionId}"]);
                            if($vote->is_multi){
                                echo Html::checkbox("vote[{$vote['id']}][]", false, [
                                    'class' => 'ipt-checkbox',
                                    'value' => $optionId,
                                    'id'    => "v-{$vote['id']}-{$optionId}"
                                ]);
                            } else{
                                echo Html::radio("vote[{$vote['id']}]", false, [
                                    'class' => 'ipt-radio',
                                    'value' => $optionId,
                                    'id'    => "v-{$vote['id']}-{$optionId}"
                                ]);
                            }
                            echo $vote[$optionId];
                            echo Html::endTag("label");
                            echo Html::endTag("dd");
                        }
                    }
                    echo Html::endTag("dl");
                    $k++;
                }
                ?>
            </div>
        </form>
        <div class="r-btn">
            <a class="ui-btn ui-btn-red ui-btn-submit" href="javascript:;">提交</a>
        </div>
    </div>
</div>
<script>
    var submitUrl = '<?= Url::to(['vote/submit']); ?>';
    $(function () {
        // $('input').iCheck({
        //     checkboxClass: 'icheckbox_square-blue',
        //     radioClass: 'iradio_square-blue'
        // });

        $('.ui-btn-submit').on('click', function () {
            $.showLoading("正在提交数据...");
            $.post(submitUrl, $('#vote-detail').serialize(), function (result) {
                $.hideLoading();
                if (0 == result.status) {
                    $.alert(result.info, '警告');
                    return;
                } else {
                    $.alert(result.info, '恭喜');
                    return ;
                }
            }, 'json');
        });
    })
</script>

