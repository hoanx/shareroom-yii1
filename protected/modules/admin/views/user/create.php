<?php
/* @var $this UserController */
/* @var $model Users */

echo CHtml::link('<i class="fa fa-arrow-left"></i> '.Yii::t('app', 'Quay lại'),
    $this->createUrl('index'),
    array(
        'class' => 'btn btn-info back-link'
    ));
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>