<?php
/**
 * @category live.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 01/02/2017 10:38
 * @since
 */
use application\models\base\Videos;
use qiqi\helper\StringHelper;
use yii\bootstrap\Html;
use yii\data\BaseDataProvider;

$this->params['footer'] = 'live';
?>
<div class="g-container">
    <ul class="m-live-list">
        <?php
        /** @var Videos $list */
        /** @var BaseDataProvider $provider */
        foreach($provider->getModels() as $list):
            $isNotopen = $list['begin_time'] > time()
                ? 's-new'
                : "";
            $isLive = ($list['begin_time'] > time() && $list['end_time'] > time())
                ? 's-live'
                : "";
            ?>
            <li class="post-item <?php echo $isNotopen, " ", $isLive; ?> ">
                <?php echo Html::a(StringHelper::substring($list->title, 36, 1), ['video/livedetail', 'id' => $list->id], ['class' => 'title']); ?>
                <p class="meta">
                    <span class="time">时间：<?= date("Y-m-d", $list['dateline']); ?></span>
                </p>
            </li>
            <?php
        endforeach;
        ?>
    </ul>
</div>

