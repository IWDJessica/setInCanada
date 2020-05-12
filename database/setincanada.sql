DROP DATABASE IF EXISTS `setincanada`;
CREATE DATABASE IF NOT EXISTS `setincanada`;
-- CREATE USER IF NOT EXISTS 'setincanada_user'@'localhost' IDENTIFIED BY 'Setincanada_us3r!';

-- GRANT ALL PRIVILEGES ON setincanada.* TO 'setincanada_user'@'localhost' identified by 'Setincanada_us3r!';
use setincanada;

CREATE TABLE IF NOT EXISTS `user`(
    `id` INT(6) NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(200) NOT NULL,
    `lastName` VARCHAR(200) NOT NULL,
    `password` VARCHAR(200) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `created` DATETIME NOT NULL,
    `lastAccess` DATETIME NOT NULL,
    `status` VARCHAR(1) NOT NULL,
    PRIMARY KEY (`id`)    
);


INSERT INTO user (firstName, lastName, email, password, created, lastAccess, status) VALUES('Renan', 'Miranda', 'r_miranda@fanshaweonline.ca', '1234', NOW(), NOW(), '1');
INSERT INTO user (firstName, lastName, email, password, created, lastAccess, status) VALUES('Mohamad', 'Arafat', 'moe@fanshaweonline.ca', '1234', NOW(), NOW(), '1');



CREATE TABLE IF NOT EXISTS `category` (
  `catId` int(2) NOT NULL AUTO_INCREMENT,
  `catName` varchar(50) NOT NULL,
  `catIcon` varchar(50),
  `catStatus` int(1) NOT NULL,
  `catOrder` int(2),
PRIMARY KEY(`catId`)
);


INSERT INTO `category` (`catId`, `catName`, `catIcon`, `catStatus`, `catOrder`) VALUES
(1, 'Settlement', NULL, 1, 1),
(2, 'Government', NULL, 1, 2),
(3, 'Trasportation', NULL, 1, 3);



CREATE TABLE IF NOT EXISTS `location` (
  `locId` int(2) NOT NULL AUTO_INCREMENT,
  `locCity` varchar(50) NOT NULL,
  `locProvince` varchar(2) NOT NULL,
  `locStatus` int(1) NOT NULL,
PRIMARY KEY (`locId`)
);



CREATE TABLE IF NOT EXISTS `privileges` (
  `priId` int(3) NOT NULL AUTO_INCREMENT,
  `priName` varchar(50) NOT NULL,
  `priDescription` varchar(255),
PRIMARY KEY (`priId`)
);



CREATE TABLE IF NOT EXISTS `managers` (
  `manId` int(3) NOT NULL AUTO_INCREMENT,
  `manFirstName` varchar(80) NOT NULL,
  `manLastName` varchar(80) ,
  `manEmail` varchar(80) NOT NULL,
  `priId` int(3) NOT NULL COMMENT 'Forein key - Privileges',
  `manJoinDate` date NOT NULL,
  `manStatus` int(1) NOT NULL,
  `manFone` varchar(15),
  `manPwd` varchar(255) NOT NULL,
PRIMARY KEY (`manId`),
FOREIGN KEY (`priId`) REFERENCES `privileges` (`priId`)
) ;


CREATE TABLE IF NOT EXISTS `subcategory` (
  `subId` int(4) NOT NULL AUTO_INCREMENT,
  `catId` int(2) NOT NULL,
  `subName` varchar(50) NOT NULL,
  `subStatus` varchar(50) NOT NULL,
  `subDescription` text,
  `subImage` varchar(50) ,
  `subContent` int(1) NOT NULL,
  PRIMARY KEY (`subId`),
FOREIGN KEY (`catId`) REFERENCES `category` (`catId`)
);


-- INSERT INTO `subcategory` (`subId`, `catId`, `subName`, `subStatus`, `subDescription`, `subImage`, `subContent`) VALUES
-- (1, 1, 'Temporary Accomodation', '1', NULL, NULL, NULL),
-- (2, 1, 'Rent a House', '1', NULL, NULL, NULL),
-- (3, 1, 'Buy a House', '1', NULL, NULL, NULL),
-- (4, 1, 'Banking', '1', NULL, NULL, NULL),
-- (5, 1, 'Telecommunication', '1', NULL, NULL, NULL),
-- (6, 1, 'Utilities', '1', NULL, NULL, NULL),
-- (7, 1, 'Pick up from airport', '1', NULL, NULL, NULL);



CREATE TABLE IF NOT EXISTS `content` (
  `conId` int(8) NOT NULL AUTO_INCREMENT,
  `catId` int(2) NOT NULL,
  `subId` int(4),
  `conTitle` varchar(150) NOT NULL,
  `conDescription` varchar(255),
  `conText` text,
  `conLink` varchar(255),
  `conImage` varchar(50),
  `conStatus` int(1) NOT NULL,
PRIMARY KEY (`conId`),
FOREIGN KEY (`subId`) REFERENCES `subcategory` (`subId`)
);



CREATE TABLE IF NOT EXISTS `vendors` (
  `venId` int(6) NOT NULL AUTO_INCREMENT,
  `venName` varchar(80) NOT NULL ,
  `serId` int(3) COMMENT 'Forein key - Id or service',
  `priId` int(3) NOT NULL COMMENT 'Privileges',
  `venEmail` varchar(50) DEFAULT NULL,
  `venSite` varchar(50) DEFAULT NULL,
  `venAddress` varchar(100) NOT NULL,
  `venAddress2` varchar(100),
  `venPostalCode` varchar(7) NOT NULL,
  `locId` int(2) NOT NULL,
  `venPhone` varchar(15),
  `venStatus` int(1) NOT NULL,
  `vemLogo` varchar(80),
  `venPwd` varchar(80) DEFAULT NULL,
  `venContactPerson` varchar(80) DEFAULT NULL,
  `venInfo` text, 
PRIMARY KEY (`venId`),
FOREIGN KEY (`priId`) REFERENCES `privileges` (`priId`),
FOREIGN KEY (`locId`) REFERENCES `location` (`locId`)
);


CREATE TABLE IF NOT EXISTS `vendorplaces` (
  `plaId` int(6) NOT NULL AUTO_INCREMENT,
  `venId` int(6) NOT NULL,
  `plaName` varchar(50) NOT NULL,
  `plaAddress` varchar(80),
  `plaAddress2` varchar(30),
  `plaPostalCode` varchar(7),
  `locId` int(2) NOT NULL,
  `plaPhone` varchar(12),
PRIMARY KEY (`plaId`),
FOREIGN KEY (`venId`) REFERENCES `vendors` (`venId`)
);

CREATE TABLE IF NOT EXISTS  `advertisement` (
  `advId` int(20) NOT NULL AUTO_INCREMENT,
  `venId` int(10) NOT NULL,
  `advTitle` varchar(150) NOT NULL,
  `advDescription` varchar(255) NOT NULL,
  `advImage` varchar(50),
  `advPrice` decimal(10,2),
  `advType` int(2) NOT NULL,
  `advPosition` int(3),
  `advInsertData` date NOT NULL,
  `advFinalData` date,
  `advLastUpdate` date NOT NULL,
  `advEmail` varchar(50),
  `advPhone` varchar(100) NOT NULL,
  `advStatus` int(11) NOT NULL,
PRIMARY KEY(`advId`),
FOREIGN KEY (`venId`) REFERENCES `vendors`(`venId`)
);
