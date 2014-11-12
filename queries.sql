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

CREATE TABLE `w_to_types` (
     `id` INT(10) UNSIGNED NOT NULL,
     `model_id` INT(10) UNSIGNED NOT NULL,
     `name` varchar(100) DEFAULT NULL,
     `sort` INT(10) UNSIGNED DEFAULT NULL,
     `is_active` INT(10) UNSIGNED DEFAULT NULL,
     `content` varchar(100) DEFAULT NULL,
     `title` varchar(100) DEFAULT NULL,
     `kwords` varchar(100) DEFAULT NULL,
     `descr` varchar(100) DEFAULT NULL,
     `img` varchar(100) DEFAULT NULL,
     `mod` varchar(100) DEFAULT NULL,
     `engine` varchar(100) DEFAULT NULL,
     `engine_model` varchar(100) DEFAULT NULL,
     `engine_obj` varchar(100) DEFAULT NULL,
     `engine_horse` varchar(100) DEFAULT NULL,
     `type_year` varchar(100) DEFAULT NULL,
     `seo_text` varchar(100) DEFAULT NULL,
     `tecdoc_url` varchar(100) DEFAULT NULL,
     `tecdoc_id` INT(10) UNSIGNED DEFAULT NULL
) DEFAULT CHARSET=utf8;

CREATE TABLE `w_to_models` (
     `id` INT(10) UNSIGNED NOT NULL,
     `car_id` INT(10) UNSIGNED DEFAULT NULL,
     `name` varchar(100) DEFAULT NULL,
     `sort` INT(10) UNSIGNED DEFAULT NULL,
     `is_active` INT(10) UNSIGNED DEFAULT NULL,
     `content` varchar(100) DEFAULT NULL,
     `title` varchar(100) DEFAULT NULL,
     `kwords` varchar(100) DEFAULT NULL,
     `descr` varchar(100) DEFAULT NULL,
     `img` varchar(300) DEFAULT NULL,
     `seo_text` varchar(100) DEFAULT NULL
) DEFAULT CHARSET=utf8;

CREATE TABLE `w_to_cars` (
     `id` INT(10) UNSIGNED NOT NULL,
     `name` varchar(100) DEFAULT NULL,
     `sort` INT(10) UNSIGNED DEFAULT NULL,
     `is_active` INT(10) UNSIGNED DEFAULT NULL,
     `content` varchar(100) DEFAULT NULL,
     `title` varchar(100) DEFAULT NULL,
     `kwords` varchar(100) DEFAULT NULL,
     `descr` varchar(100) DEFAULT NULL,
     `img` varchar(300) DEFAULT NULL,
     `truck` INT(10) UNSIGNED DEFAULT NULL,
     `seo_text` varchar(100) DEFAULT NULL
) DEFAULT CHARSET=utf8;