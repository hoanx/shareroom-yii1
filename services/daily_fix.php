<?php
	/*Description: Daily fix là hình thức hiển thị thông tin mua sắm - hoạt động trong ngày*/
	
	@extract($_GET);
	 /** Kết nối database **/
     /**Ở đây chúng tôi sử dụng PDO để xử lý kết nối cơ sở dữ liệu và hiển thị
	 * Bạn có thể thay đổi cho phù hợp với hệ thống của mình.
	 */
     
     $db = new PDO('mysql:host=localhost;dbname=database;charset=utf8', 'username', 'password');
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
     
     $sql = "
               select *
               from TADPIA
               where YYYYMMDD = ?";

     $stmt = $db->prepare($sql);
     $stmt->execute(array($yyyymmdd));
     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

     if (count($rows) > 0)
     {
          foreach ($rows as $k=>$row)
          {
               $line = $row["HHMISS"]."\t";
               $line .= $row["APINFO"]."\t";
               $line .= $row["ID"]."(".$row["NAME"].")"."\t";
               $line .= $row["ORDER_CODE"]."\t";
               $line .= $row["PRODUCT_CODE"]."\t";
               $line .= $row["ITEM_COUNT"]."\t";
               $line .= $row["PRICE"]."\t";
               $line .= $row["CATEGORY_CODE"]."\t\t";
               $line .= $row["PRODUCT_NAME"]."\t";
               $line .= $row["REMOTE_ADDR"]."\t";

               if (count($rows)- $k != 1)
                    $line .= $row["STATUS"]."\n";
               else
                    $line .= $row["STATUS"];

               echo $line;
          }
     }
?>