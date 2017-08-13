<?php
/**
 * @category index.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/18 00:04
 * @since
 */
use application\common\api\YxzApi;
use application\web\www\WwwUser;
use qiqi\helper\geo\ProvinceHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/** @var $info WwwUser */
?>
<div class="g-container">
    <div class="user-wrap">
        <div class="card-cover">
            <img src="<?= Yii::getAlias('@web/static/') ?>images/user_cover.jpg" alt="">
            <div class="fr" style="margin-top:-3rem;">
                <a href="<?= Url::to(['site/logout']); ?>" style="color:red">--</a>
            </div>
            <div class="graphic">
                <div class="avatar"><img src="<?= Yii::getAlias('@web/static/') ?>images/avatar.png" alt=""></div>
                <div class="integral">
                    <div class="area">
                        <p> 医米积分</p>
                        <p class="num"><?php echo $info['credits']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-cont">
            <div class="c-desc">
                <dl class="list">
                    <dt class="label"><strong>姓名：</strong></dt>
                    <dd class="desc"><strong><?= $info['realname']; ?></strong></dd>
                </dl>
                <dl class="list">
                    <dt class="label">省份：</dt>
                    <dd class="desc"><?= ProvinceHelper::getProvince($info['district_id'], ProvinceHelper::P_FULL); ?></dd>
                </dl>
                <dl class="list">
                    <dt class="label">医院：</dt>
                    <dd class="desc"><?= $info['hospital']; ?></dd>
                </dl>
                <dl class="list">
                    <dt class="label">医院级别：</dt>
                    <dd class="desc"><?= $info['hospital_level']; ?></dd>
                </dl>
                <dl class="list">
                    <dt class="label">科室：</dt>
                    <dd class="desc"><?= $info['department']; ?></dd>
                </dl>
                <dl class="list">
                    <dt class="label">职业：</dt>
                    <dd class="desc"><?= ArrayHelper::getValue(YxzApi::$types, $info['type'], '其他'); ?></dd>
                </dl>
                <dl class="list">
                    <dt class="label">职称：</dt>
                    <dd class="desc"><?= $info['jobtitle']; ?></dd>
                </dl>
            </div>
            <div class="c-tips">
                <!--<a href="http://mall.yxj.org.cn/ymshop/index1.html?uid=--><?php //echo $info['uid']; ?><!--#!/playRule">医米获取规则</a>-->
                <a href="javascript:;" class="open-popup" data-target=".weui-popup-container">医米获取规则</a>
            </div>
            <div class="c-btn">
                <a class="ui-btn ui-btn-red" href="http://mall.yxj.org.cn/ymshop/index1.html?uid=<?php echo $info['uid']; ?>">兑换医米</a>
            </div>
        </div>
    </div>
    <div id="" class="weui-popup-container">
        <div class="weui-popup-overlay"></div>
        <div class="weui-popup-modal">
            <div class="article-wrap">
                <style>.article-wrap .article-bd p{font-size:0.4rem;}</style>
                <h1 class="title" style="color:red;text-align:center;">绿谷专区医米积分规则</h1>
                <div class="article-bd" style="font-size:0.4rem;">
                    <p> 　　绿谷制药联合医学界开设的《康复心干线》专区为了感谢并鼓励广大用户的参与，现已上线医米奖励系统。凡在《康复心干线》专区内的“看视频、读文献”等学习行为均可获得医米，并在医生站商城兑换实物奖品。</p>
                    <p><b>获取积分规则如下：</b></p>
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>参与项目</th>
                            <th>可获得医米</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>参与调研</td>
                            <td>10医米/次</td>
                        </tr>
                        <tr>
                            <td>阅读新闻资讯、共识文献、专家视角</td>
                            <td>1医米/次</td>
                        </tr>
                        <tr>
                            <td>观看讲座视频、直播回顾视频</td>
                            <td>2医米/次</td>
                        </tr>
                        <tr>
                            <td>观看直播视频</td>
                            <td>50医米/次</td>
                        </tr>
                        </tbody>
                    </table>
                    <p><b>补充说明：</b></p>
                    <ul style="padding-left:0.5rem;">
                        <li>1.讲座视频需观看3分钟后才能获得医米</li>
                        <li>2.一天内重复阅读观看同一篇文章或视频，不重复获得医米</li>
                        <li>3.调研内容将不定期更新，参与不同调研将可再次获得医米</li>
                    </ul>
                </div>
            </div>
            <div class='close-popup '>
                <a href="javascript:;" class="ui-btn ui-btn-red">确认</a>
            </div>
        </div>
    </div>
</div>

