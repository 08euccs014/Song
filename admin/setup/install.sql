/*it will create app table*/
CREATE TABLE IF NOT EXISTS `#__socialman_app` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL COMMENT 'it will contains group name of the apps',
  `params` text NOT NULL,
  `plublished` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`app_id`)
) AUTO_INCREMENT=1 ;
