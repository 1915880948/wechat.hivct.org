<?php
/**
 * @category literature.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/18 12:52
 * @since
 */
use application\models\base\Articles;
use yii\helpers\Html;

$this->params['title'] = "工具量表";
/** @var $list Articles */
?>
    <div class="g-container">
        <div class="m-post-tabs js_post-tabs">
            <ul class="m-post-txt">
                <?php
                foreach($lists->getModels() as $list):
                    ?>
                    <li class="post-item">
                        <?= Html::a($list['title'], ['page/ldetail', 'id' => $list['articleid']], ['class' => 'title']); ?>
                        <p class="meta">
                            <span class="tag"><?= date("m-d", $list['dateline']); ?></span> <span class="tag">阅读 : <?= $list['views']; ?></span>
                            <?php
                            $likeBlock = sprintf("%s %s", Html::tag("i", null, [
                                'class' => (in_array($list['articleid'], $likes)
                                    ? 'icon-praise-red2'
                                    : "icon-praise")
                            ]), $list['likes']);
                            echo Html::a($likeBlock, 'javascript:;', [
                                'class' => 'tag dolike',
                                'data'  => [
                                    'id' => $list['articleid']
                                ]
                            ])
                            ?>
                        </p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php
echo $this->render('__dolike');
