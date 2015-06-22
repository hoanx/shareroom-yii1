ALTER TABLE `tb_room_address` ADD COLUMN `status_flg`  tinyint(1) NULL DEFAULT 0 AFTER `amenities`;
# Update date 19-06-2015
SET FOREIGN_KEY_CHECKS=0;
ALTER TABLE `tb_room_address` DROP PRIMARY KEY;
ALTER TABLE `tb_room_address` ADD PRIMARY KEY (`id`);
SET FOREIGN_KEY_CHECKS=1;

ALTER TABLE `tb_room_address` ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_room_address` MODIFY description TEXT;