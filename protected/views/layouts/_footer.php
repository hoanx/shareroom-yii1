<?php
/**
 * Created by HoaNguyen.
 * Date: 5/23/15
 */
 ?>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <h5><?= Yii::t('app', 'Thông tin công ty') ?></h5>
                <ul>
                    <li><a href="<?php echo(Yii::app()->createUrl('site/about')) ?>"><?php echo(Yii::t('app', 'Giới thiệu shareroom')) ?></a></li>
                    <li><a href="<?php echo(Yii::app()->createUrl('site/baomat')) ?>"><?php echo(Yii::t('app', 'Chính sách bảo mật')) ?></a></li>
                    <li><a href="<?php echo(Yii::app()->createUrl('site/privacy_policies')) ?>"><?php echo(Yii::t('app', 'Chính sách riêng tư')) ?></a></li>
                    <li><a href="<?php echo(Yii::app()->createUrl('site/policy')) ?>"><?php echo(Yii::t('app', 'Điều kiện & điều khoản')) ?></a></li>
                    <li><a href="<?php echo(Yii::app()->createUrl('site/contact')) ?>"><?php echo(Yii::t('app', 'Liên hệ')) ?></a></li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-6">

                <div class="fb-page" data-href="https://www.facebook.com/shareroom.vn" data-hide-cover="false"
                     data-show-facepile="true" data-show-posts="false">
                    <div class="fb-xfbml-parse-ignore">
                        <blockquote cite="https://www.facebook.com/shareroom.vn"><a
                                href="https://www.facebook.com/shareroom.vn">Chia Sẻ Phòng - Shareroom.vn</a>
                        </blockquote>
                    </div>
                </div>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=660895930691237";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    
            </div>
            <div class="col-md-4 col-sm-6 info-company">
                <p>Tên đơn vị: Công ty cổ phần SHARE ROOM</p>
                <p>Người đại diện: <strong>Mạc Ngọc Tuấn</strong></p>
                <p>Địa chỉ: BT02 khu đô thị Vân Canh - Hoài Đức - Hà Nội</p>
                <p>Điện thoại 0931.68.78.66</p>
                <p>Email: <a href="mailto:admin@shareroom.vn">admin@shareroom.vn</a></p>
                <p>Số đăng ký kinh doanh: 0106919643</p>
                <p>Ngày cấp: 30/7/2015</p>
                <p>Nơi cấp: Sở Kế hoạch và Đầu tư Thành phố Hà Nội</p>
                <?php /*
                <h5><?= Yii::t('app', 'Được chứng nhận') ?></h5>
                <div class="col-xs-6">
                    <a href="#">
                        <img src="<?php echo $baseUrl ?>/images/dangkybocongthuong.jpg" class="img-responsive">
                    </a>
                </div>
                */ ?>
            </div>
        </div>
    </div>
</footer>
<!-- <div id="bottom-bar"> -->
    <?php // echo Yii::t('app', 'Hỗ trợ : 0963.117.951 / <a href="mailto:sales@shareroom.vn">sales@shareroom.vn</a>') ?>
<!-- </div> -->