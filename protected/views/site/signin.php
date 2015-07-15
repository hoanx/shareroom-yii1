<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

?>
<?php
//$loginUrl = Yii::app()->facebook->getLoginUrl(Yii::app()->createAbsoluteUrl('site/signup'));
$loginFacebookUrl = $this->loginFacebookUrl;
$loginGplusUrl = $this->loginGplusUrl;
?>

<div id="signin-form">
    <h2><?php echo $this->pageTitle ?></h2>
    <div class="line-gradient">&nbsp;</div>
    <div class="login-container">
        <div class="social-buttons">
            <!--<a class="btn btn-block btn-social btn-md btn-facebook btn-social-custom"
               href="javascript:void(0)">
                <i class="fa fa-facebook"></i>
                Sign in with Facebook
            </a>-->
            <?php echo CHtml::link('<i class="fa fa-facebook"></i>  ' . Yii::t('app', 'Đăng nhập bằng Facebook'), $loginFacebookUrl, array(
                'class' => 'btn btn-block btn-social btn-md btn-facebook btn-social-custom btn-lg'
            )) ?>
            <?php echo CHtml::link('<i class="fa fa-google-plus"></i>  ' . Yii::t('app', 'Đăng nhập bằng Google'), $loginGplusUrl, array(
                'class' => 'btn btn-block btn-social btn-md btn-google btn-social-custom btn-lg'
            )) ?>
        </div>
        <div class="signup-or-separator">
            <h6 class="text signup-or-separator--text"><?php echo(Yii::t('app', 'Hoặc')) ?></h6>
            <hr>
        </div>

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form',
            'action' => $this->createUrl(Yii::app()->controller->id. '/' . Yii::app()->controller->action->id, $_GET).'#signin-form',
//             'enableClientValidation'=>true,
            'clientOptions'=>array(
//                 'validateOnSubmit'=>true,
            ),
        )); ?>

        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-at fa-fw"></i>
                <?php echo $form->textField($model,'email', array(
                    'class'=>'form-control input-lg',
                    'placeholder' => $model->getAttributeLabel('email'),
                    'autofocus' => 'autofocus'
                )); ?>
            </div>
            <?php echo $form->error($model,'email', array('class'=>'help-block error-login')); ?>
        </div>

        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-lock fa-fw"></i>
                <?php echo $form->passwordField($model,'password', array(
                    'class'=>'form-control input-lg',
                    'placeholder' => $model->getAttributeLabel('password'),
                    'autofocus' => 'autofocus'
                )); ?>
            </div>
            <?php echo $form->error($model,'password', array('class'=>'help-block error-login')); ?>
        </div>


        <div class="form-group actions">
            <?php echo CHtml::submitButton(Yii::t("app", "Đăng nhập"), array('class'=>'btn btn-success btn-block btn-submit btn-lg')); ?>
        </div>
        <div class="form-group link-forgotpass">
            <?php echo CHtml::link(Yii::t('app', 'Quên mật khẩu?'), '#', array('data-toggle' => 'modal', 'data-target' => '#myModal')) ?>
        </div>
        
        <div class="form-group">
            Không có tài khoản? <?php echo CHtml::link('Đăng ký tại đây', array('site/signup')) ?>
        </div>

        <?php $this->endWidget(); ?>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Quên mật khẩu?</h4>
					</div>
					<div class="modal-body">
					    <h5>Nhập địa chỉ email liên kết với tài khoản của bạn để nhận liên kết thiết lập lại mật khẩu.</h5>
						<div class="form-group">
							<input type="email" class="form-control" id="email" placeholder="Email">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="send-forgot">Thiết lập lại mật khẩu</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#send-forgot').click(function(){
                var email = jQuery('#email').val();
                if(email) {
                	jQuery.ajax({
                		type: "POST",
                        url: '<?php echo(Yii::app()->createAbsoluteUrl('site/sendforgot')) ?>',
                        data: {"email": email},
                	}).done(function(data) {
                		jQuery(".alert").hide();
                    	if(data == 'success') {
                    		jQuery(".modal-body").append("<p class='alert alert-success'>Một liên kết thiết lập lại mật khẩu đã được gửi đến email của bạn.</p>");
                    	} else {
                    		jQuery(".modal-body").append("<p class='alert alert-danger'>Không thể tạo liên kết thiết lập lại. Hãy thử lại</p>");
                    	}
                	});
                }
            });
        });
    </script>
<?php Yii::app()->clientScript->endScript();?>