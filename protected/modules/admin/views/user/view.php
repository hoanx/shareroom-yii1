<?php
/* @var $this UserController */
/* @var $model Users */
?>

<section class="user-view">
    <div class="row">
        <div class="col-md-3">
            <div class="picture">
                <img src="<?php echo Yii::app()->createUrl('/profile/image', array('id'=>$model->id))?>" class="img-responsive">
            </div>
        </div>
        <div class="col-md-9">
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
            )); ?>
        </div>
    </div>
</section>

