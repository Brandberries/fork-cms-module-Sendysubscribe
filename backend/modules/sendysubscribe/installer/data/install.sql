DROP TABLE IF EXISTS `sendysubscribe_widgets`;
CREATE TABLE IF NOT EXISTS `sendysubscribe_widgets` (
  `widget_id` int(11) NOT NULL AUTO_INCREMENT,
  `extra_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `listId` varchar(100) NOT NULL,
  PRIMARY KEY (`widget_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;
