-- Date added: 25/04/2014

ALTER TABLE `user_cart` ADD `date_added` DATETIME NOT NULL AFTER `qty` ,
ADD `cookie_id` VARCHAR( 50 ) NOT NULL AFTER `date_added`;

-- Date added: 16/05/2014
ALTER TABLE `user_cart` ADD `date_modified` DATETIME NOT NULL AFTER `date_added`;