<?php
require_once "apbase64.php";   //File thực hiện mã hóa
/** 
 * B1: Tạo table như mô tả bên dưới
 * B2: Cấu hình chuỗi kết nối
 * Các kết quả phát sinh từ Adpia được quy định bởi cookie APINFO trên trình duyệt người dùng 
 * Sẽ chuyển kết quả đúng thời điểm phát sinh.  
 * **/

/*
 *
 * Function adpia_cps được gọi khi hoàn tất bước thanh toán giỏ hàng của hệ thống. Giỏ hàng truyền vào theo định dạng dưới đây
 *  
      * Định dạng giỏ hàng
      * $cart = array(
      *             array(
      *                  'product_code' => 'MaSP1',
      *                  'item_count' => '2',
      *                  'category_code' => 'category1',
      *                  'price' => '20000',                      -- Đơn giá X Số lượng
      *                  'product_name' => 'Sản phẩm 1',
      *             ),  
      *             array(
      *                  'product_code' => 'MaSP2',
      *                  'item_count' => '3',
      *                  'category_code' => 'category2',
      *                  'price' => '60000',                      -- Đơn giá X Số lượng
      *                  'product_name' => 'Sản phẩm 2',
      *             )
      * 
      * )
  
/**
 * 
 * @param type $cart               -- Giỏ hàng của hệ thống
 * @param type $order_code         -- Mã đơn hàng hệ thống
 * @param type $id                 -- ID của khách hàng (Trong trường hợp khách là thành viên - Tùy chọn)
 * @param type $name               -- Họ tên khách hàng
 * @return type
 */
function adpia_cps($cart, $order_code = "", $id = "", $name = "")
{
    
     if(isset($_COOKIE["APINFO"])) //Khách hàng đến từ adpia
     {
          /** Kết nối database **/
          $db = new PDO('mysql:host=localhost;dbname=database;charset=utf8', 'username', 'password');
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          
          /* Lưu kết quả Adpia vào DB 
           * Kết quả sẽ được lưu vào một table riêng đặt tên là TADPIA. 
           * Công việc này giúp dễ dàng thống kê kết quả đồng thời thực hiện những nhiệm vụ sau:
           * 1. Phục hồi những kết quả bị lỗi do lỗi kết nối server, Adpia không ghi nhận kết quả ngay lập tức được
           * 2. Các đơn hàng được lưu vào DB này đều ở trạng thái chờ - Khi đơn hàng đó bị hủy hoặc hoàn thành, cần cập nhật ngay vào trong table này. 
           *  Adpia sẽ ghi nhận được tình trạng của đơn hàng
           * (Mỗi một Record trong table lưu trữ một mã sản phẩm của đơn hàng - không phải cả đơn hàng. Vì vậy, một đơn hàng có thể được lưu trữ thành nhiều Record)
           *  
           * Để lưu được ở DB phải tạo bảng Adpia. Có thể bổ sung thêm field vào dữ liệu của công ty.
           * Đồng thời,bắt buộc phải lưu cùng với giá trị APINFO cookie khi lưu kết quả. Thực hiện bằng varchar(300).
           *
           * Tạo bảng trên CSDL của hệ thống,
           * (Ví dụ: hệ thống  sử dụng MySql)
           * 	create table TADPIA (
           * 		APINFO         varchar(300),
           * 		YYYYMMDD       varchar(8),
           * 		HHMISS         varchar(6),
           * 		ORDER_CODE     varchar(100),  // Mã hóa đơn(o_cd).	Primary Key
           * 		PRODUCT_CODE   varchar(100),  // Mã sản phẩm(p_cd). Primary Key
           * 		ITEM_COUNT     Int(5),      // Số lượng(it_cnt).
           * 		PRICE          Float(8),      // Giá sản phẩm (Đơn giá X Số lượng)
           * 		PRODUCT_NAME   varchar(100),  //Tên sản phẩm
           * 		CATEGORY_CODE  varchar(100),  // Mã category
           * 		ID             varchar(10),   // ID người dùng - có thể null
           * 		NAME           varchar(10),   // Tên người dùng
           * 		REMOTE_ADDR    varchar(100)   // IP người dùng
           * 		STATUS		   varchar(3)     //Trạng thái đơn hàng. NOR: normal, FIN: finish, CAN: cancel. Mặc định là NOR.
           * 	)
           */
          $ymd = date("Ymd");
          $his = date("His");
          
          $p_cd_ar = $it_cnt_ar = $c_cd_ar = $sales_ar = $p_nm_ar = array();
          foreach($cart as $c)
          {
               $p_cd_ar[] = $c['product_code']; //Mã sản phẩm thứ 
               $it_cnt_ar[] = $c['item_count']; //Số lượng sản phẩm
               $c_cd_ar[] = $c['category_code']; //Category sản phẩm 
               $sales_ar[] = $c['price'];     //Giá sản phẩm = Đơn giá  X  Số lượng
               $p_nm_ar[] = $c['product_name']; //Tên sản phẩm
               //Data insert,
               //VD:
               $sql = "
						insert into TADPIA
							(
								APINFO, YYYYMMDD, HHMISS,
								ORDER_CODE, PRODUCT_CODE, ITEM_COUNT, PRICE, PRODUCT_NAME, CATEGORY_CODE,
								ID, NAME, REMOTE_ADDR
							)
						values
							(
								?, ?, ?,
								?, ?, ?, ?, ?, ?,
								?, ?, ?
							)
							";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($_COOKIE['APINFO'], $ymd, $his, $order_code, $c['product_code'], $c['item_count'], $c['price'], $c['product_name'], $c['category_code'], $id, $name, $_SERVER['REMOTE_ADDR']));
          }

          /*
           * a_id   : Mã cookie APINFO . Dùng nguyên mã.
           * m_id   : Giá trị Id của công ty. Dùng nguyên mã (Merchant ID).
           * mbr_id : Thông tin người dùng mua hàng. Đặt dưới hình thức'Tên người dùng(Tên)' .
           *         Có thể sửa $id, $name thành giá trị phù hợp với hệ thống của công ty .
           * o_cd   : Mã đặt mua hàng. Đặt giá trị mã đặt hàng vào $order_code.  
           */

          $adpia_url = "http://purchase.adpia.vn/purchase.php";     // Không được sửa.
          $adpia_url.= "?a_id=".$_COOKIE["APINFO"];                 // Không được sửa.
          $adpia_url.= "&m_id=shareroom";                     // Không được sửa.
          $adpia_url.= "&mbr_id=".$id."(".$name.")";                // $id = Giá trị ID người dùng, $name = Giá trị tên người dùng, nếu không có giá trị nào trong 2 giá trị thì chỉ đặt giá trị đang tồn tại.
          $adpia_url.= "&o_cd=".$order_code;                        // $order_code = Giá trị số đặt hàng.
          $adpia_url.= "&p_cd=".implode("||", $p_cd_ar);            // Không được sửa. $p_cd_ar là giá trị được tạo ở phần xử lý giỏ hàng ở trên.
          $adpia_url.= "&it_cnt=".implode("||", $it_cnt_ar);        // Không được sửa. $it_cnt_ar là giá trị được tạo ở phần xử lý giỏ hàng ở trên.
          $adpia_url.= "&sales=".implode("||", $sales_ar);          // Không được sửa. $sales_ar là giá trị được tạo ở phần xử lý giỏ hàng ở trên.
          $adpia_url.= "&c_cd=".implode("||", $c_cd_ar);            // Không được sửa. $c_cd_ar là giá trị được tạo ở phần xử lý giỏ hàng ở trên.
          $adpia_url.= "&p_nm=".implode("||", $p_nm_ar);            // Không được sửa. $p_nm_ar là giá trị được tạo ở phần xử lý giỏ hàng ở trên.
          $adpia_url .= "&remote_addr=".$_SERVER['REMOTE_ADDR'];
          /*
           * Mã hóa ADPia data 
           *
           * Nếu thay đổi phải đặt theo đường dẫn chính xác
           *
           * Tuyệt đối không sửa giá trị code, pad. Chỉ sử dụng nguyên nội dung mã code.
           */

          $code = "00054";
          $pad = "SBz*drMbZeQCuDxpNjqsAImkHaEYoLG7X4163FOf0Ji.Pnh9yRwgWK52tTVlUc8v";

          $adpia_url = ap_url_trt($adpia_url, $code, $pad);
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $adpia_url);
          curl_setopt($ch, CURLOPT_HEADER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
          $result = curl_exec($ch);
          curl_close($ch);
     }
     return;
}

?>
