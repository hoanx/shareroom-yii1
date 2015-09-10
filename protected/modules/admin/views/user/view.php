<?php
/* @var $this UserController */
/* @var $model Users */
?>
<style>
table.table th {
    text-align: right;
    width: 160px;
}
</style>

<section class="user-view">
    <div class="row">
        <div class="col-md-2">
            <div class="picture">
                <img src="<?php echo Yii::app()->createUrl('/profile/image', array('id'=>$model->id))?>" class="img-responsive" style="width: 100%;">
            </div>
        </div>
        <div class="col-md-10">
            <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'attributes'=>array(
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
                    'address',
                    array(
                        'header' => Yii::t('app', 'Mô tả bản thân'),
                        'name' =>  'description'
                    )
                ),
                'htmlOptions' => array(
                    'class' => 'table table-striped'
                ),
            )); ?>
        </div>
    </div>
</section>

