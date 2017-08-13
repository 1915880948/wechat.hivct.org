<?php
/**
 * @category index.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/27 12:49
 * @since
 */
use application\models\base\Videos;
use common\core\image\ThumbImage;
use qiqi\helper\StringHelper;
use yii\data\BaseDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->params['footer'] = 'lecture';
?>
<div class="g-container">
    <div class="lecture-wrap">
        <ul class="m-videolist">
            <?php
            /** @var Videos $list */
            /** @var BaseDataProvider $provider */
            foreach($provider->getModels() as $list):
                ?>
                <li class="video-item">
                    <a class="cover" href="<?php echo Url::to(['video/detail', 'id' => $list->id]); ?>">
                        <p class="thumb"> <?= Html::img(ThumbImage::thumb(ThumbImage::options($list['coverimage'], [
                                'c' => 'fill',
                                'w' => 328,
                                'h' => 165
                            ]), 'app')); ?>
                        <p class="title"><?php echo StringHelper::substring($list->title,36,1); ?></p>
                        <p class="meta">
                            <span class="tag"><?= date("m-d", $list['dateline']); ?></span> <span class="tag">阅读 : <?= $list['views']; ?> &nbsp;</span>
                            <?php
                            $likeBlock = sprintf("%s %s", Html::tag("i", null, [
                                'class' => (in_array($list['id'], $likes) ? 'icon-praise-red2' : "icon-praise")
                            ]), $list['likes']);
                            echo Html::a($likeBlock, 'javascript:;', [
                                'class' => 'tag dolike',
                                'data'  => [
                                    'id' => $list['id']
                                ]
                            ])
                            ?>
                        </p>
                    </a>
                </li>
                <?php
            endforeach;
            ?>
        </ul>
    </div>
</div>
<?php
echo $this->render('__dolike');

