# Database Tables (06/12/2020):

-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `DataTable`;
CREATE TABLE `DataTable` (
  `Sensor ID` int(10) unsigned NOT NULL,
  `Value` decimal(10,0) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `Sensor ID` (`Sensor ID`),
  CONSTRAINT `DataTable_ibfk_1` FOREIGN KEY (`Sensor ID`) REFERENCES `SensorTable` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `SensorTable`;
CREATE TABLE `SensorTable` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `LastTimestamp` varchar(8) NOT NULL,
  `IP` varchar(64) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `SensorTable` (`ID`, `Name`, `LastTimestamp`, `IP`) VALUES
(15,	'Temperatuur Sensor',	'14:52:50',	'192.168.1.8'),
(16,	'Humidity Sensor',	'14:53:12',	'192.168.1.8');

-- 2020-11-08 21:25:53
