<div bgcolor="#FFFFFF" style="margin:0;padding:0;font-family:'Helvetica Neue','Helvetica',Arial,sans-serif;min-height:100%;width:100%">

<table style="width: 100% !important" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td style="margin: 0; padding: 0">&nbsp;</td>
			<td style="margin: 0 auto; padding: 0; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; display: block; max-width: 600px; clear: both">
				<div style="margin: 0 auto; padding: 15px; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; max-width: 600px; display: block">
					<h3 style="margin: 0 0 15px 0; padding: 0; font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; line-height: 1.1; color: #111111; font-weight: 500; font-size: 27px">
					    Xin chào <?php echo $user->first_name . ' ' . $user->last_name ?>
					</h3>
					<p style="margin: 15px 0; padding: 10px; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-weight: normal; font-size: 14px; line-height: 1.6; background-color: #c7eddd; color: #111111">Chúng
						tôi nhận được một yêu cầu lấy lại mật khẩu cho tài khoản Shareroom của bạn.</p>
					<div style="margin: 0; padding: 10px; font-family: 'Helvetica Neue', 'Helvetica', Arial, sans-serif; font-weight: normal; font-size: 14px; line-height: 1.6; background-color: #ebebeb; color: #111111">
						Để thiết lập lại mật khẩu, nhấn vào đường dẫn dưới (hoặc sao chép và dán URL vào trình duyệt của bạn):
						<br><br>
						<a href="<?php echo Yii::app()->createAbsoluteUrl('site/forgotpass', array('token' => Common::encrypt($user->email . ',' . date('YmdHis')))) ?>" style="color:#2ba6cb" target="_blank">
						<?php echo Yii::app()->createAbsoluteUrl('site/forgotpass', array('token' => Common::encrypt($user->email . ',' . date('YmdHis')))) ?></a>
					</div>
					<br> <br>
					<p style="margin:15px 0;padding:10px;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;margin-bottom:15px;font-weight:normal;font-size:14px;line-height:1.6;background-color:#ecf8ff;color:#111111"><b>Chú ý:</b> Vui lòng bỏ qua email này nếu bạn không thực hiện các yêu cầu đặt lại mật khẩu, tài khoản của bạn sẽ không bị thay đổi.</p>
				</div>

			</td>
			<td style="margin: 0; padding: 0">&nbsp;</td>
		</tr>
	</tbody>
</table>