<?php
/**
 * @category __dolike.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/19 15:13
 * @since
 */
use yii\helpers\Url;

?>
<script>
    var viewUrl = '<?=Url::to(['api/views']);?>';
    var aId = '<?=$id;?>';
    var type = '<?=$type;?>';
    $(function () {
        $.post(viewUrl, {id: aId, type: type, _csrf: $('meta[name="csrf-token"]').attr('content')}, function (result) {

        }, 'json')
    })
</script>

