SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `associations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `child_id` int(11) NOT NULL,
  `ring` int(11) NOT NULL,
  `creation` datetime NOT NULL,
  `modification` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `association_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `association_id` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `ring` int(11) NOT NULL,
  `creation` datetime NOT NULL,
  `modification` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `contact_email` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `value` varchar(255) NOT NULL,
  `ring` int(11) NOT NULL,
  `creation` datetime NOT NULL,
  `modification` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `object_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `ring` int(11) NOT NULL,
  `creation` datetime NOT NULL,
  `modification` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

