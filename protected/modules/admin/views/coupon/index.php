<?php
/* @var $this CouponController */
/* @var $dataProvider CActiveDataProvider */
?>

<section class="table-data">
    <?php echo CHtml::link('<i class="fa fa-plus"></i> ' . Yii::t('admin', 'Thêm mới'), array('coupon/create'), array('class' => 'btn btn-success new-record-link')); ?>
    <?php $this->renderPartial('_search', array(
        'model'=>$model,
    )) ?>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'coupon-grid',
        'dataProvider' => $model->search(),
        'columns' => array(
            'id',
            'coupon_code',
            array(
                'name'=>'discount_amount_percent',
                'value'=>'$data->discount_amount_percent."%"',
                //'htmlOptions'=>array('style'=>'text-align:center;')
            ),
            'period',
            'coupon_uses',
            'created',
            'updated',
            array(
                'class' => 'CButtonColumn',
            ),
        ),
    )); ?>
</section>


