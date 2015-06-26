<div>
    <?php echo $this->renderPartial('//layouts/_form_search', array());?>
</div>
<hr>
<div id="data">
    <?php echo $this->renderPartial('_search', array('model' => $model), true, true);?>
</div>
