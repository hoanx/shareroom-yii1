<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

echo $this->renderPartial('//profile/_menu_profile');
?>
<div class="panel panel-default profile-box message-box">
    <div class="panel-heading box-header">
        <span><?php echo(Yii::t('app', 'Hộp tin nhắn')) ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php 
            echo CHtml::dropDownList('read_flg', isset($_GET['read_flg']) ? $_GET['read_flg'] : '',  
                    array('1' => 'Tất cả tin nhắn', '2' => 'Tin nhắn đã đọc', '3' => 'Tin nhắn chưa được trả lời'),
                    array('id' => 'read_flg')
            ); 
        ?>
    </div>
    <div class="panel-body message-index">
    <?php if(!empty($conversations)) : ?>
        <?php foreach($conversations as $conversation) : ?>
            <div class="row">
                <div class="col-xs-3">
                    <?php if(isset($conversation->LastMessage)) : ?>
                        <div class="row">
                            <div class="col-xs-4 hidden-sm hidden-xs" id="img-last-message">
                                <?php $user = $conversation->LastMessage->Users; ?>
                                <?php if(!empty($user->profile_picture)) : ?>
                                    <?php echo CHtml::image($user->profile_picture, '', array('class' => 'img-responsive')) ?>
                                <?php else: ?>
                                    <img src="/profile/image" class="img-responsive">
                                <?php endif; ?>
                            </div>
                            <div class="col-xs-8" id="info-last-message">
                                <p><?php echo CHtml::link($user->first_name . ' ' . $user->last_name, array(''));?></p>
                                <p><?php echo date('d/m/Y', strtotime($conversation->LastMessage->created)); ?></p>
                                <p><?php echo Common::humanTiming(strtotime($conversation->LastMessage->created)); ?></p>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
                <div class="col-xs-7" id="convertation-info">
                    <p><?php echo CHtml::link('Tin nhắn với ' . $conversation->ToUser->first_name . ' ' . $conversation->ToUser->last_name, array('message', 'id' => $conversation->id));?></p>
                    <p><?php echo $conversation->title ?></p>
                    <p>
                        <span><i class="fa fa-calendar-o"></i><?php echo 'Ngày ' . date('d/m/Y' , strtotime($conversation->start_date)) . ' - ' . date('d/m/Y' , strtotime($conversation->end_date)) ?></span>
                        <span><i class="fa fa-moon-o"></i><?php echo floor((strtotime($conversation->end_date) - strtotime($conversation->start_date))/86400) . ' đêm'  ?></span>
                        <span><i class="fa fa-user"></i><?php echo $conversation->qty_guests . ' người'  ?></span>
                    </p>
                    <p><?php if(isset($conversation->LastMessage)) echo mb_substr(strip_tags($conversation->LastMessage->content), 0, 100);?></p>
                </div>
                <div class="col-xs-2" style="text-align: right;">
                    <?php if($conversation->status_flg == Messages::STATUS_WAITING): ?>
                        <button type="button" class="btn btn-default">Đang chờ</button>
                    <?php elseif($conversation->status_flg == Messages::STATUS_ACCEPT) : ?>
                        <button type="button" class="btn btn-success">Được chấp nhận</button>
                    <?php elseif($conversation->status_flg == Messages::STATUS_DENY) : ?>
                        <button type="button" class="btn btn-danger">Bị từ chối</button>
                    <?php endif; ?>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else : ?>
        Không có tin nhắn nào
    <?php endif; ?>
    </div>
</div>
<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
        	jQuery("#read_flg").change(function() {
        	    setGetParameter('read_flg', jQuery(this).val());
        	});

            function setGetParameter(paramName, paramValue) {
                var url = window.location.href;
                if (url.indexOf(paramName + "=") >= 0) {
                    var prefix = url.substring(0, url.indexOf(paramName));
                    var suffix = url.substring(url.indexOf(paramName));
                    suffix = suffix.substring(suffix.indexOf("=") + 1);
                    suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
                    url = prefix + paramName + "=" + paramValue + suffix;
                } else {
                    if (url.indexOf("?") < 0) {
                        url += "?" + paramName + "=" + paramValue;
                    } else {
                    	url += "&" + paramName + "=" + paramValue;
                    }
                }
                window.location.href = url;
            }
                       	
        });
    </script>
<?php Yii::app()->clientScript->endScript();?>