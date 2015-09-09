<?php
/* @var $this ManagerController */
/* @var $dataProvider CActiveDataProvider */
?>

<section class="table-data">
    <?php echo CHtml::link('<i class="fa fa-plus"></i> ' . Yii::t('admin', 'Thêm mới'), array('manager/create'), array('class' => 'btn btn-success new-record-link')); ?>
    <?php $this->renderPartial('_search', array(
        'model'=>$model,
    )) ?>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'users-grid',
        'dataProvider' => $model->search(),
        'columns' => array(
            'id',
            'username',
            'email',
            'created',
            array(
                'class' => 'CButtonColumn',
                'htmlOptions' => array('class'=>'align-left button-column'),
                'template'=>'{update}{delete}',
                'buttons' => array(
                    'update' => array(
                        'visible' => '$data->id == Yii::app()->getModule(\'admin\')->user->id || Yii::app()->getModule(\'admin\')->user->id == 1',
                    ),
                    'delete' => array(
                        'visible' => '1 == Yii::app()->getModule(\'admin\')->user->id && $data->id != Yii::app()->getModule(\'admin\')->user->id ',
                    ),
                )
            ),
        ),
    )); ?>
</section>

