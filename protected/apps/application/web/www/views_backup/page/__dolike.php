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
    var likesUrl = '<?=Url::to(['api/likes']);?>';
    $(function () {
        $('.dolike').on('click', function () {
            var self = $(this);
            var currentValue = $.trim(self.text());
            var aId = $(this).data('id');
            if (!aId) {
                return;
            }
            $.post(likesUrl, {id: aId, type: "article", _csrf: $('meta[name="csrf-token"]').attr('content')}, function (result) {
                if (result.status) {
                    currentValue = parseInt(currentValue) + 1;
                    self.html('<i class="icon-praise-red"></i> ' + currentValue);
                }
            }, 'json')
        });
    })
</script>

