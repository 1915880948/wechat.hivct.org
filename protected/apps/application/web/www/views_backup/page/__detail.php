<?php
/**
 * @category __detail.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/19 15:10
 * @since
 */
use application\models\base\Articles;
use yii\bootstrap\Html;

/** @var $detail Articles */
$description = trim(strip_tags($detail['description']));
?>
<div class="g-container">
    <div class="article-wrap">
        <h1 class="title"><?= $detail['title']; ?></h1>
        <div class="article-hd"><?= date('Y-m-d', $detail['dateline']); ?></div>
        <div class="article-bd">
            <?php
            if($description != ""){
                echo Html::tag('p', "摘要：" . $description, ['class' => 'summary']);
            }
            echo $detail['content'];
            ?>
        </div>
    </div>
</div>
