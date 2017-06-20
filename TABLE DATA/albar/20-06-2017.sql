ALTER TABLE `tourism_place` ADD `picture_4` VARCHAR( 100 ) NOT NULL AFTER `picture_3` ,
ADD `picture_5` VARCHAR( 100 ) NOT NULL AFTER `picture_4` 

ALTER TABLE `tour_review` ADD `tanggal_berkunjung` DATETIME AFTER `edited` ;