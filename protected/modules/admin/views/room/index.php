<?php
/* @var $this UserController */
/* @var $model Users */
?>
<section class="table-data">
    <?php $this->renderPartial('_search', array(
        'model'=>$model,
    )) ?>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'enableAjaxValidation' => false,
    ));
    ?>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'users-grid',
        'dataProvider' => $model->search(),
        'columns' => array(
            array(
                'value' => '$data->id',
                'class' => 'CCheckBoxColumn',
                'selectableRows' => 2,
                'checkBoxHtmlOptions' => array(
                    'name' => 'RoomAddressIds[]',
                ),
            ),
            'id',
            array(
                'name'=>'email',
                'value'=>function($data){
                    return $data->Users->email;
                }
            ),
            array(
                'name'=>'first_name',
                'value'=>function($data){
                    return $data->Users->first_name;
                }
            ),
            array(
                'name'=>'last_name',
                'value'=>function($data){
                    return $data->Users->last_name;
                }
            ),
            'name',
            array(
                'name'=>'status_flg',
                'type' => 'raw',
                'htmlOptions' => array('style' => 'text-align:center;vertical-align:middle'),
                'value' => function($data){
                        if($data->status_flg){
                            $_html = '<i class="fa fa-check-circle fa-true fa-lg"></i>';
                        }else{
                            $_html = '<i class="fa fa-times fa-false fa-lg"></i>';
                        }
                        return $_html;
                    },
            ),
            'address_detail',
            array(
                'name'=>'price',
                'value'=>function($data){
                    if(isset($data->RoomPrice->price))
                        return number_format($data->RoomPrice->price);
                }
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => $this->role==Constant::ROLE_ADMIN ? '{view} {delete}' : '{view}',
            ),
        ),
    )); ?>
    <div class="row" style="margin: 0;clear: both">
        <div class="col-md-2" style="padding: 0">
            <?php echo CHtml::dropDownList('status_flg', '', RoomAddress::getListStatus(), array(
                'class' => 'form-control',
            ))?>
        </div>
        <div class="col-md-10">
            <?php echo CHtml::submitButton(Yii::t('app', 'Cập nhật'), array(
                'class' => 'btn btn-success btn-submit'
            )); ?>

        </div>
    </div>
    <?php $this->endWidget(); ?>
</section>
