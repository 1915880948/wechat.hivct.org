<?php
use application\models\base\Meeting;
use common\core\image\Image;
use yii\web\View;

/**
 * @category metting.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/18 12:52
 * @since
 */
/** @var $detail Meeting */
/** @var $this View */
$this->params['title'] = '会议预告';
$weeks = ['周日', '周一', '周二', '周三', '周四', '周五', '周六', '周日'];

?>
<div class="g-container g-bgimg">
    <div class="details-meeting">
        <div class="cover"><img src="<?= Image::url($detail['coverimage']) ?>" alt=""></div>
        <h2 class="title"><?= $detail->title; ?></h2>
        <dl class="instance">
            <dt><strong>会议时间：</strong><?= $detail->opendate; ?>（<?= $weeks[date("w", strtotime($detail->opendate))]; ?>）</dt>
            <dt><strong>会议地点：</strong><?= $detail->opencity; ?></dt>
            <dt><strong>会议介绍：</strong></dt>
            <dd class="intro">
                <?= $detail->intro; ?>
            </dd>
            <dt><strong>会议日程：</strong></dt>
            <dd class="timeline">
                <?= $detail->schedule; ?>
            </dd>
            <dt><strong>会议地点：</strong></dt>
            <dd class="address">
                <?= $detail->address; ?>
            </dd>
        </dl>
    </div>
</div>
