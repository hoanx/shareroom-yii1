<?php
/* @var $this UserController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="panel-group filter-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion"
                   href="#collapseOne"><?php echo Yii::t('app', 'Tìm kiếm') ?></a>
            </h4>
        </div>
        <div id="collapseOne"
             class="panel-collapse collapse <?php if (!empty($_GET['Search']) || empty($_GET)) echo 'in' ?>">
            <?php echo CHtml::form(array('user/index'), 'get') ?>
            <div class="panel-body row">
                <div class="col-md-3">
                    <?php echo CHtml::activeTextField($model, 'keyword', array(
                        'class' => 'form-control inline-block',
                    ))?>
                </div>
                <?php echo CHtml::submitButton(Yii::t('app', 'Tìm kiếm'), array(
                    'class' => 'btn btn-default',
                    'name' => 'Search'
                ))?>
            </div>
            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion"
                   href="#collapseTwo"><?php echo Yii::t('app', 'Tìm kiếm nâng cao') ?></a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse <?php if (!empty($_GET['SearchAdv'])) echo 'in' ?>">
            <?php echo CHtml::form(array('user/index'), 'get') ?>
            <div class="panel-body">
                <div class="row">
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]id') ?>
                        <?php echo CHtml::activeTextField($model, '[Search]id', array('class' => 'form-control')) ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]email') ?>
                        <?php echo CHtml::activeTextField($model, '[Search]email', array('class' => 'form-control')) ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]first_name') ?>
                        <?php echo CHtml::activeTextField($model, '[Search]first_name', array('class' => 'form-control')) ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]last_name') ?>
                        <?php echo CHtml::activeTextField($model, '[Search]last_name', array('class' => 'form-control')) ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]gender') ?>
                        <?php echo CHtml::activeDropDownList($model, '[Search]gender',
                            Users::gender(),
                            array('class' => 'form-control'))?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]phone_number') ?>
                        <?php echo CHtml::activeTextField($model, '[Search]phone_number', array('class' => 'form-control')) ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]address') ?>
                        <?php echo CHtml::activeTextField($model, '[Search]address', array('class' => 'form-control')) ?>
                    </div>

                </div>

                <div class="form-group">
                    <?php echo CHtml::submitButton(Yii::t('app', 'Tìm kiếm'), array(
                        'class' => 'btn btn-default pull-right',
                        'name' => 'SearchAdv'
                    ))?>
                </div>
            </div>
            <?php echo CHtml::endForm() ?>
        </div>
    </div>
</div>
