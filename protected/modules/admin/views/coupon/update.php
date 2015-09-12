<?php
/* @var $this CouponController */
/* @var $model Coupon */

echo CHtml::link('<i class="fa fa-arrow-left"></i> '.Yii::t('app', 'Quay lại'),
    $this->createUrl('index'),
    array(
        'class' => 'btn btn-info back-link'
    ));
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>