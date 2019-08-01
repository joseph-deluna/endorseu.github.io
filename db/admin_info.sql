CREATE TABLE `admin_info` (
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `admin_index` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`admin_index`)
) AUTO_INCREMENT = 3000;