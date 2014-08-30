SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Table structure for app intance table
--

CREATE TABLE IF NOT EXISTS `#__custom_app` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Table structure for reource table
--

CREATE TABLE IF NOT EXISTS `#__custom_resource` (
  `resource_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `applied_on` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `used` varchar(255) NOT NULL,
  UNIQUE KEY `resource_id` (`resource_id`),
  KEY `resource_id_2` (`resource_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
