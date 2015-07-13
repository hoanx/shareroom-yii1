ALTER TABLE `tb_room_address` ADD COLUMN `status_flg`  tinyint(1) NULL DEFAULT 0 AFTER `amenities`;
# Update date 19-06-2015
SET FOREIGN_KEY_CHECKS=0;
ALTER TABLE `tb_room_address` DROP PRIMARY KEY;
ALTER TABLE `tb_room_address` ADD PRIMARY KEY (`id`);
SET FOREIGN_KEY_CHECKS=1;

ALTER TABLE `tb_room_address` ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_room_address` MODIFY description TEXT;

/*Update database 30-06-2015*/
ALTER TABLE `tb_booking` ADD COLUMN `time_check_in`  int(255) NOT NULL AFTER `check_out`;
ALTER TABLE `tb_booking` ADD COLUMN `time_check_out`  int(255) NOT NULL AFTER `time_check_in`;
ALTER TABLE `tb_booking` ADD COLUMN `payment_status`  tinyint(2) NOT NULL DEFAULT 1 COMMENT '1: pending; 2: Da thanh toan : 3 thanh toan loi; 4: refund' AFTER `payment_method`;
ALTER TABLE `tb_booking` ADD COLUMN `booking_status`  tinyint(2) NOT NULL DEFAULT 1 AFTER `payment_status`;
ALTER TABLE `tb_booking` DROP COLUMN `status_flg`;

/*Update database 03-07-2015*/

ALTER TABLE `tb_booking` ADD COLUMN `additional_guests`  float NOT NULL COMMENT 'Số khách thêm' AFTER `discount`;
ALTER TABLE `tb_booking` ADD COLUMN `price_additional_guests`  float NOT NULL COMMENT 'Giá cho mỗi khách thêm' AFTER `additional_guests`;

/*Update database 07-07-2015*/
ALTER TABLE `tb_room_price` ADD COLUMN `guest_per_night`  int(11) NOT NULL AFTER `additional_guests`;
ALTER TABLE `tb_room_price` ADD COLUMN `cleaning_fees_day`  tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: phi vs theo 1 lan o; 2: phi vs tinh theo ngay' AFTER `cleaning_fees`;