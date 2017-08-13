<?php
/**
 * @category news.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/18 12:52
 * @since
 */
use application\models\base\Articles;
use application\models\base\Categories;
use yii\helpers\Html;
use yii\web\View;

// $this->params['title'] = $categories[$cid]['title'];
$cId = Yii::$app->session->get('category');
if(!in_array($cId,[Categories::CATE_LITERATURE,Categories::CATE_CLINICAL_RESEARCH])){
    $cId = Categories::CATE_LITERATURE;
}
/** @var $list Articles */
?>
    <div class="g-container">
        <div class="m-post-tabs js_post-tabs">
            <ul class="tabs-tit">
                <li class="tabs-tab <?=($cId == Categories::CATE_LITERATURE?'tabs-hover':'');?>">指南共识</li>
                <li class="tabs-tab <?=($cId == Categories::CATE_LITERATURE?'':'tabs-hover');?>">临床研究</li>
            </ul>
            <ul class="tabs-con">
                <li class="tabs-list" <?=($cId == Categories::CATE_LITERATURE?'':'style="display:none"');?>>
                    <ul class="m-post-txt">
                        <?php
                        foreach($newslists->getModels() as $list):
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
                </li>
                <li class="tabs-list" <?=($cId == Categories::CATE_LITERATURE?'style="display:none"':'');?>>
                    <ul class="m-post-txt">
                        <?php
                        foreach($hclists->getModels() as $list):
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
                </li>
            </ul>
        </div>
    </div>
<?php

echo $this->render('__dolike');

/** @var $this View */
$this->registerJs('$(\'.js_post-tabs\').UblueTabs();', View::POS_END);


