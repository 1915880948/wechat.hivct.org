<?php
/**
 * @category detail.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/27 12:58
 * @since
 */
use application\common\base\VideoParse;
use application\models\base\Comments;
use application\models\base\UserActionLogs;
use application\models\base\Videos;
use common\core\image\Image;
use yii\helpers\Html;
use yii\helpers\Url;

$this->params['footer'] = 'lecture';
/** @var $info Videos */
/**
 * 获取是否开始
 */
$showVideo = true;
$script = '';
if($info->begin_time > time()){
    $showVideo = false;
    $script = '$.alert("直播还没有开始", "提醒");';
}
if($info->end_time > time() && $info->end_time - time() < getenv('LIVE_VIDEO_TIME')){
    $showVideo = false;
    $script = '$.alert("直播刚结束，还没有转换成视频文件", "自定义的标题");';
}
?>
    <link href="<?php echo Yii::getAlias('@web/static/plugins/videojs'); ?>/video-js.min.css" rel="stylesheet">
    <script src="<?php echo Yii::getAlias('@web/static/plugins/videojs'); ?>/ie8/videojs-ie8.min.js"></script>
    <div class="g-container">
        <div class="details-video">
            <div class="dv-video">
                <?php if($showVideo == true): ?>
                    <video id="video" class="video-js vjs-big-play-centered" controls preload="auto" style="width:100%;height:100%" poster="<?= Image::url($info->coverimage); ?>" data-setup="{}" x-webkit-airplay="true" webkit-playsinline="true">
                        <source src="<?= VideoParse::parse($info->videourl); ?>" type='video/mp4'>
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a web browser that
                            <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                <?php endif; ?>
            </div>
            <div class="dv-tabs js_dv-tabs">
                <!--<a class="updown" href="javascript:;"><i class="icon-praise-gary"></i>--><?php //echo $info->likes; ?><!--</a>-->
                <?php
                $likeBlock = sprintf("%s %s", Html::tag("i", null, [
                    'class' => (in_array($info['id'], $likes)
                        ? 'icon-praise-red2'
                        : "icon-praise-gary")
                ]), (int) $info['likes']);
                echo Html::a($likeBlock, 'javascript:;', [
                    'class' => 'updown dolike',
                    'data'  => [
                        'id' => $info['id']
                    ]
                ])
                ?>
                <ul class="tabs-tit">
                    <li class="tabs-tab tabs-hover">课程介绍</li>
                    <li class="tabs-tab">专家介绍</li>
                    <li class="tabs-tab">评论</li>
                </ul>
                <ul class="tabs-con">
                    <li class="tabs-list">
                        <div class="desc">
                            <?php
                            echo $info->description;
                            ?>
                        </div>
                    </li>
                    <li class="tabs-list">
                        <div class="desc">
                            <?php
                            echo $info->content;
                            ?>
                        </div>
                    </li>
                    <li class="tabs-list  ">
                        <div class="comment">
                            <div class="comment-filter">
                                <div class="cmt-left">
                                    <i class="icons icons-play"></i>评论
                                </div>
                                <div class="cmt-right">
                                    <select class="select">
                                        <option value="dateline" <?= $sort == 'dateline'
                                            ? "selected='selected'"
                                            : "" ?>>最新评论
                                        </option>
                                        <option value="likes" <?= $sort == 'likes'
                                            ? "selected='selected'"
                                            : "" ?>>最热评论
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <ul class="comment-list">
                                <?php
                                /** @var Comments[] $comments */
                                foreach($comments as $comment){
                                    ?>
                                    <li class="cmt-item">
                                        <!--<i class="icon-praise"></i>-->
                                        <div class="cmt-avatar"><img src="<?= Yii::getAlias('@web/static/'); ?>images/avatar_98x98.jpg" alt=""></div>
                                        <div class="cmt-cont">
                                            <h3><?= $comment['username']; ?> <!-- <i class="icon-badge-m1"></i><i class="icon-badge-m2"></i> --></h3>
                                            <p class="time"><?= date("m-d H:i", $comment['dateline']); ?></p>
                                            <p class="text"><?= $comment['content']; ?></p>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php if($showVideo == true):?>
                            <div class="comment-reply">
                                <div class="ui-fixed-bottom reply-area">
                                    <input class="ipt-text" type="text" id="comment"> <a class="submit" href="javascript:;">评论</a>
                                </div>
                            </div>
                            <?php endif;?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script src="<?php echo Yii::getAlias('@web/static/plugins/videojs'); ?>/video.min.js"></script>
    <script>
        $(function () {
            <?php echo $script;?>
            $('.js_dv-tabs').UblueTabs();
            var aId = '<?=$info['id'];?>';
            var commentUrl = '<?=Url::to(['api/comment']);?>';
            var tab = '<?=$tabs;?>';
            // console.log(tab);
            if (tab == 'comment') {
                console.log('test');
                $('.tabs-tab:last').click();
            }
            $('.submit').on('click', function () {
                var comment = $('#comment').val();
                if (comment == "") {
                    $.alert('评论内容不能为空');
                    return
                }
                $.post(commentUrl, {id: aId, content: comment, _csrf: $('meta[name="csrf-token"]').attr('content')}, function (result) {
                    //避免刷新，万一在看片子
                    $.alert(result.info);
                }, 'json')
            });
            $('.select').on('change', function () {
                location.href = CURRENT_URL + '?tabs=comment&id=' + aId + '&sort=' + $(this).val();
            });
            <?php if($showVideo == true):?>
            var video = videojs('video');

            video.on('play', function () {
                var c = setInterval(function () {
                    var t = video.currentTime();
                    if (t > 180) {//3分钟
                        $.post('<?=Url::to(['api/livevideo']);?>', {aid: aId, _csrf: $('meta[name="csrf-token"]').attr('content')}, function (result) {
                            //console.log(result);
                        }, 'json');
                    }
                }, 1000);

            });
            <?php endif;?>
        })
        ;
    </script>
<?php
if($showVideo == true){
    echo $this->render('__dolike');
    echo $this->render('__doview', ['id' => $info['id'], 'type' => UserActionLogs::TYPE_VIDEO]);
}

