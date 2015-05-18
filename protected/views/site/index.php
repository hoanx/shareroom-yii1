<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<?php //$this->widget('ext.widgets.hybridAuth.SocialLoginButtonWidget', array(
//    'enabled'=>Yii::app()->hybridAuth->enabled,
//    'providers'=>Yii::app()->hybridAuth->getAllowedProviders(),
//    'route'=>'/hybridauth/authenticate',
//));
?>
<?php //$this->widget('ext.hoauth.widgets.HOAuth'); ?>

<div class="box box-location">
    <h3><?php echo Yii::t('app', 'Địa điểm phổ biến') ?></h3>

    <div class="line-gradient">&nbsp;</div>

    <div class="row location">
        <div class="col-sm-4 location-info">
            <a href="#">
                <img src="<?php echo(Yii::app()->baseUrl) ?>/images/location/singapore.jpg" alt="Hà Nội" class="img-responsive">
                <div class="info-text"><?php echo(Yii::t('app', 'Hà Nội')) ?></div>
            </a>
        </div>
        <div class="col-sm-4 location-info">
            <a href="#">
                <img src="<?php echo(Yii::app()->baseUrl) ?>/images/location/hong-kong.jpg" alt="Quảng Ninh" class="img-responsive">
                <div class="info-text"><?php echo(Yii::t('app', 'Quảng Ninh')) ?></div>
            </a>
        </div>
        <div class="col-sm-4 location-info">
            <a href="#">
                <img src="<?php echo(Yii::app()->baseUrl) ?>/images/location/sydney.jpg" alt="Sapa" class="img-responsive">
                <div class="info-text"><?php echo(Yii::t('app', 'Sapa')) ?></div>
            </a>
        </div>
        <div class="col-sm-6 location-info">
            <a href="#">
                <img src="<?php echo(Yii::app()->baseUrl) ?>/images/location/tokyo.jpg" alt="Đà Nẵng" class="img-responsive">
                <div class="info-text"><?php echo(Yii::t('app', 'Đà Nẵng')) ?></div>
            </a>

        </div>
        <div class="col-sm-6 location-info">
            <a href="#">
                <img src="<?php echo(Yii::app()->baseUrl) ?>/images/location/taipei.jpg" alt="Nha Trang" class="img-responsive">
                <div class="info-text"><?php echo(Yii::t('app', 'Nha Trang')) ?></div>
            </a>
        </div>
        <div class="col-sm-4 location-info">
            <a href="#">
                <img src="<?php echo(Yii::app()->baseUrl) ?>/images/location/phuket.jpg" alt="Thành Phố Hồ Chí Minh"
                             class="img-responsive">
                <div class="info-text"><?php echo(Yii::t('app', 'TPHCM')) ?></div>
            </a>
        </div>
        <div class="col-sm-4 location-info">
            <a href="#">
                <img src="<?php echo(Yii::app()->baseUrl) ?>/images/location/bali.jpg" alt="Hội An" class="img-responsive">
                <div class="info-text"><?php echo(Yii::t('app', 'Hội An')) ?></div>
            </a>
        </div>
        <div class="col-sm-4 location-info">
            <a href="#">
                <img src="<?php echo(Yii::app()->baseUrl) ?>/images/location/seoul.jpg" alt="Phú Quốc" class="img-responsive">
                <div class="info-text"><?php echo(Yii::t('app', 'Phú Quốc')) ?></div>
            </a>
        </div>
    </div>
</div>

<div class="box box-advantages">
    <div class="row">
        <div class="col-md-4 advantages-info">
            <i class="fa fa-usd"></i><br>
            <strong>Tiện nghi & Tiết kiệm hơn</strong>
            <p>Nghỉ tại nhà ở địa phương thay vì một khách sạn đắt tiền.</p>
        </div>
        <div class="col-md-4 advantages-info">
            <i class="fa fa-arrows"></i><br>
            <strong>Tận hưởng nhiều không gian hơn</strong>
            <p>Với chi phí tương đương một phòng khách sạn, bạn có thể thuê toàn bộ căn nhà.</p>
        </div>
        <div class="col-md-4 advantages-info">
            <i class="fa fa-users"></i><br>
            <strong>Trải nghiệm như một người bản xứ</strong>
            <p>Trải nghiệm cuộc sống bản địa để có một chuyến du lịch đầy màu sắc.</p>
        </div>
        <div class="col-md-4 advantages-info">
            <i class="fa fa-lock"></i><br>
            <strong>An toàn tuyệt đối</strong>
            <p>Với một hệ thống chi trả trực tuyến an toàn, chúng tôi sẽ giúp bạn đảm trách việc thanh toán.</p>
        </div>
        <div class="col-md-4 advantages-info">
            <i class="fa fa-home"></i><br>
            <strong>Như đang ở nhà</strong>
            <p>Sinh hoạt thoải mái như thể bạn đang ở nhà. </p>
        </div>
        <div class="col-md-4 advantages-info">
            <i class="fa fa-th"></i><br>
            <strong>Nhiều lựa chọn</strong>
            <p>Từ phòng ở ghép, phòng riêng đến căn hộ, biệt thự.</p>
        </div>
    </div>

</div>
