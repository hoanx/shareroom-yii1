<?php
/* @var $this CouponController */
/* @var $model Coupon */
/* @var $form CActiveForm */
?>

<section class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'coupon-form',
        'enableAjaxValidation' => false,
    )); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'coupon_code'); ?>

                <?php if($model->getIsNewRecord()): ?>
                <div class="row">
                    <div class="col-md-8">
                        <?php echo $form->textField($model, 'coupon_code', array(
                            'class' => 'form-control',
                            'readonly'=>false
                        )); ?>
                    </div>
                    <div class="col-md-4">
                        <a href="javascrip:void(0)" id="generate_coupon" class="btn btn-warning btn-block"><?php echo(Yii::t('app', 'Tạo tự động'))?></a>
                    </div>
                </div>
                <?php else: ?>
                    <?php echo $form->textField($model, 'coupon_code', array(
                        'class' => 'form-control',
                        'readonly'=>true
                    )); ?>
                <?php endif ?>
                <?php echo $form->error($model, 'coupon_code'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'discount_amount_percent'); ?>
                <div class="input-group">
                    <?php echo $form->textField($model, 'discount_amount_percent', array(
                        'class' => 'form-control'
                    )); ?>
                    <span class="input-group-addon">%</span>
                </div>
                <!-- /input-group -->


                <?php echo $form->error($model, 'discount_amount_percent'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'period'); ?>
                <div class="input-group">
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'period',
                        'language'=>'vi',
                        'options' => array(
                            'showAnim' => 'slideDown',
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'class' => 'form-control',
                        ),
                    ));
                    ?>
                    <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                </div>
                <?php echo $form->error($model, 'period'); ?>
            </div>

            <hr>
            <div class="form-actions">
                <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Tạo mới') : Yii::t('app', 'Cập nhật'),
                    array(
                        'class' => 'btn btn-success btn-submit',
                    )); ?>
            </div>

        </div>
    </div>

    <?php $this->endWidget(); ?>

</section><!-- form -->

<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#generate_coupon').click(function(){
            var generate_code = generateCouponCode(<?php echo Constant::COUPON_LENGHT ?>);
            console.log(generate_code);
            jQuery('#Coupon_coupon_code').val(generate_code);
        });
    });

    function generateCouponCode(lenght){
        var text = "";
        var possible = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        for( var i=0; i < lenght; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }
</script>
<?php Yii::app()->clientScript->endScript();?>
