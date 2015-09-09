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
            'address_detail',
            array(
                'name'=>'price',
                'value'=>function($data){
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
