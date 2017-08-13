<?php
/**
 * @category login.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/17 11:41
 * @since
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Request;

/** @var  $request Request */
?>
<div class="g-container g-bgimg login-wrap">
    <div class="login-form">
        <h1 class="logo"><a href="/"><img src="<?php echo Yii::getAlias('@web/static'); ?>/images/logo.png" alt=""></a></h1>
        <form action="<?= Url::to(['site/login']); ?>" method="post" id="loginform">
            <?php echo Html::hiddenInput('_csrf', $request->getCsrfToken()); ?>
            <div class="ui-cells">
                <input class="ui-input" type="text" name="mobile" id="mobile" placeholder="手机号码">
            </div>
            <div class="ui-cells-btn">
                <a class="ui-btn ui-btn-red" href="javascript:;" id="login">登录</a>
            </div>
        </form>
        <div class="ui-cells-btn">
            <?php echo Html::a('注册', ['site/register'], ['class' => 'ui-btn ui-btn-orange']); ?>
        </div>
        <div class="support">技术支持：《医学界》传媒</div>
    </div>
</div>
<script>
    var loginStatus = '<?=is_array($login_status)?json_encode($login_status):$login_status;?>';
    $(function () {
        if(loginStatus == -1){
            $.alert('对不起，您还不是注册用户，请先注册');
        }else{
            if(loginStatus!=""){
                $.alert(loginStatus);
            }
        }

        $('#login').on('click', function () {
            if (!$('#mobile').val()) {
                $.alert("请输入您的手机号码");
                return;
            }
            var re = new RegExp(/^1[\d]{10}$/);
            if (!re.test($('#mobile').val())) {
                $.alert("手机号码格式不正确");
                return;
            }
            $('#loginform').submit();
        });

    })
</script>
