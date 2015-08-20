<?php
/* @var $this UserController */
/* @var $model Users */
?>
<section class="table-data">
    <?php echo CHtml::link('<i class="fa fa-plus"></i> ' . Yii::t('admin', 'Thêm mới'), array('user/create'), array('class' => 'btn btn-success new-record-link')); ?>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'users-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            'id',
            'email',
            'first_name',
            'last_name',
            'birthday',
            'gender',
            'phone_number',
            /*
            'address',
            'profile_picture',
            'google_id',
            'facebook_id',
            'created',
            'updated',
            'del_flg',
            'description',
            */
            array(
                'class' => 'CButtonColumn',
            ),
        ),
    )); ?>
</section>
