DROP TABLE IF EXISTS guestbook;

CREATE TABLE IF NOT EXISTS `guestbook` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`email` varchar(32) NOT NULL DEFAULT 'noemail@test.com',
`comment` varchar(200) NOT NULL,
`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 
