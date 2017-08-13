<?php
/**
 * @category ldetail.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/19 15:04
 * @since
 */
use yii\base\View;

/** @var $this View */
$this->params['title'] = '新闻资讯';
echo $this->render('__detail', ['detail' => $detail]);
echo $this->render('__doview', ['id' => $detail['articleid'], 'type' => 'article']);
