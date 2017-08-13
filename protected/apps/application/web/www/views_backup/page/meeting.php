<?php
use application\models\base\Meeting;
use yii\helpers\Url;
use yii\web\View;

/**
 * @category metting.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/18 12:52
 * @since
 */
/** @var $this View */
$this->params['title'] = '立即参会';
/** @var $meetings Meeting[] */
?>
<div class="g-container">
    <ul class="m-meeting-list">
        <?php foreach($meetings as $meeting): ?>
            <li class="post-item <?php echo strtotime($meeting['opendate']) > time()
                ? 's-new'
                : ''; ?>">
                <a class="title" href="<?php echo Url::to(['page/mdetail', 'id' => $meeting->id]); ?>"><?php echo $meeting->title; ?></a>
                <p class="meta">
                    <span class="time">时间：<?php echo $meeting['opendate']; ?></span> <span class="city">地址：<?php echo $meeting->opencity; ?></span>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
