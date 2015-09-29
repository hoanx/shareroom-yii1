<?php
/* @var $this UserController */
/* @var $model Users */
?>
<section class="table-data">
    <?php $this->renderPartial('_search', array(
        'model'=>$model,
    )) ?>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'users-grid',
        'dataProvider' => $model->search(),
        'columns' => array(
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
                'template' => '{view}{delete}',
            ),
        ),
    )); ?>
</section>
