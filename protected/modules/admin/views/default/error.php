<style>
    .icon-error {
        font-size: 8em;
        float: right;
        color: #aaa;
    }
    
    .error-page .status {
        font-weight: bold;
    }
</style>

<div class="error-page row">
    <div class="col-lg-3">
        <i class="fa fa-meh-o icon-error"></i>
        <div class="clearfix"></div>
    </div>
    <div class="col-lg-9">
        <h1 class="status">Error <?php echo $code; ?></h1>
        <h4 class="message"><?php echo CHtml::encode($message); ?></h4>
    </div>
</div>