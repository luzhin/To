CREATE TABLE `w_to` (
     `id` INT(10) UNSIGNED NOT NULL
     `type_id` INT(10) UNSIGNED DEFAULT NULL,
     `descr` varchar(512) DEFAULT NULL,
     `box` varchar(20) DEFAULT NULL,
     `comment` varchar(512) DEFAULT NULL,
     `article` varchar(100) DEFAULT NULL,
     `search` varchar(100) DEFAULT NULL,
     `brand_id` INT(10) UNSIGNED DEFAULT NULL,
     `seo_title` varchar(200) DEFAULT NULL,
     `seo_kwords` varchar(100) DEFAULT NULL,
     `seo_descr` varchar(512) DEFAULT NULL
) DEFAULT CHARSET=utf8;

