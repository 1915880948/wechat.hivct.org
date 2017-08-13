<?php
/**
 * @category footer.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/17 11:42
 * @since
 */
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\web\View;

/** @var $this View */

$this->beginContent(__DIR__ . "/main.php");
echo $content;
?>
<footer class="m-footer">
    <nav class="ui-fixed-bottom ui-flexbox ft-menu">
        <?php
        $footerMenus = [
            ['icon' => 'icons-home', 'title' => '首页', 'link' => ['site/index'], 'type' => 'main'],
            ['icon' => 'icons-lecture', 'title' => '讲座', 'link' => ['video/index'], 'type' => 'lecture'],
            // ['icon' => 'icons-lecture', 'title' => '讲座', 'link' => 'javascript:;', 'type' => 'lecture'],
            ['icon' => 'icons-live', 'title' => '直播', 'link' => ['video/live'], 'type' => 'live'],
            ['icon' => 'icons-account', 'title' => '个人', 'link' => ['user/index'], 'type' => 'user'],
        ];
        $currentUrl = Url::toRoute([''], true);
        foreach($footerMenus as $menu){
            echo Html::a("<i class='icons {$menu['icon']}'></i> <span class='title'>{$menu['title']}</span>", $menu['link'], [
                'class' => 'item-col ' . (($this->params['footer'] == $menu['type'] || (!$this->params['footer'] && $menu['type'] == 'main')) ? 'on' : ''),
                'id'    => 'nav-' . $menu['type']
            ]);
        } ?>
    </nav>
</footer>
<script>
    $(function () {
        $('#nav-live').on('click', function () {
            // $.alert('模块正在建设中', '提示');
        });
    })
</script>
<?php $this->endContent(); ?>
