<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

echo $this->renderPartial('//profile/_menu_profile');
?>
<div class="profile-edit spaces-edit">

    <!-- Nav tabs -->
    <?php echo $this->renderPartial('_menu_spaces'); ?>

    <!-- Tab panes -->
    <div class="profile-index spaces-index">
        <div class="panel panel-default profile-box message-box">
            <div class="panel-heading box-header">
                <span><?php echo(Yii::t('app', 'Quy định chung về việc hoàn trả tiền')) ?></span>
            </div>
            <div class="panel-body policies">
                <ul class="orange-list">
                    <li>Chúng tôi sẽ giữ 15% tổng giá trị hóa đơn làm phí dịch vụ, 85% tổng giá trị hóa đơn còn lại
                        chúng tôi sẽ gửi lại cho các bạn.
                    </li>
                    <li>Nếu khách bị chuyển sang một địa điểm khác không được đồng ý trước, khách sẽ được hoàn trả một
                        lượng phí thích hợp..
                    </li>
                    <li>Trong trường hợp phòng/nhà cho thuê thiếu bất cứ tiện ích nào cho bất kỳ khoảng thời gian nào
                        khách trọ, HomeAway có toàn quyền khấu trừ một khoảng phí từ phí đặt chỗ trả cho chủ nhà và hoàn
                        trả cho khách. Phí hoàn trả sẽ được tính theo mức độ nghiêm trọng của sự việc, thời gian và cách
                        thức sự việc diễn ra.
                    </li>
                    <li>Những tiện ích cơ bản phải có đối với phòng/nhà cho thuê là điện, nhiệt và hệ thống nước (bao
                        gồm cả nước nóng và lạnh). Bồn rửa, nhà vệ sinh, phòng tắm, bếp (nếu có) và lò nướng (nếu có)
                        đều phải đang ở trong tình trạng hoạt động tốt.
                    </li>
                    <li>HomeAway cũng đảm bảo một phần phí sẽ được hoàn trả cho khách nếu bất cứ vật dụng nào được nhắc
                        đến trong phần mô tả phòng/nhà cho thuê (ví dụ như máy điều hòa, kết nối internet không dây,
                        tivi, máy giặt, máy sấy) không hoạt động; cửa sổ, cửa lớn hoặc khóa bị hỏng; hay bấy cứ giường
                        hoặc khăn tắm không được giặt rửa chu đáo.
                    </li>
                    <li>Bất kỳ công trình xây dựng nào đang diễn ra gần phòng/nhà trọ, đặc biệt là những công trình với
                        tầm cỡ lớn, cần phải được thông báo cho khách trước khi khách đến.
                    </li>
                    <li>Xin lưu ý rằng bạn là một chủ trọ trong cộng đồng HomeAway. Vì vậy xin đảm bảo những thông tin
                        bạn đưa lên trên HomeAway mô tả chân thực phòng/nhà cho thuê của bạn. Hình ảnh của phòng/nhà cho
                        thuê phải là hình ảnh mới và phản ánh tất cả thay đổi trong trang trí nội thất (nếu có). Phần
                        "Mô tả" và "Tiện nghi" chỉ được đề cập đến những tiện nghi thực sự có trong phòng/nhà trọ của
                        bạn.
                    </li>
                    <li>Và nếu có bất kỳ côn trùng, sâu bọ nào trong phòng/nhà trọ, một phần tiền cũng sẽ được hoàn trả
                        lại!
                    </li>
                </ul>
                <br>
                <b style="padding-left: 22px">Xin cảm ơn bạn đã giúp chúng tôi giữ gìn chất lượng của dịch vụ.</b>
            </div>
        </div>
    </div>

</div>

