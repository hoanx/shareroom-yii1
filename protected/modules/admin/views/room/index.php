<?php
/* @var $this UserController */
/* @var $model Users */
?>
<section class="table-data">
    <?php echo CHtml::link('<i class="fa fa-plus"></i> ' . Yii::t('admin', 'Thêm mới'), array('room/create'), array('class' => 'btn btn-success new-record-link')); ?>
    <?php $this->renderPartial('_search', array(
        'model'=>$model,
    )) ?>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'users-grid',
        'dataProvider' => $model->search(),
        'columns' => array(
            'id',
            'email',
            'first_name',
            'last_name',
            'birthday',
            array(
                'name'=>'gender',
                'value'=>function($data){
                        return is_string(Users::gender($data->gender)) ? Users::gender($data->gender) : '';
                    }
            ),
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
