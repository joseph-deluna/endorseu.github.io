CREATE TABLE `adviser` (
  `adviser_index` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `last` varchar(255) NOT NULL,
  `first` varchar(255) NOT NULL,
  `middle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`adviser_index`)
) AUTO_INCREMENT = 1000;

INSERT INTO `adviser`
   (username, password, last, first, middle)
 VALUES
    ('admin', 'admin', 'Peralta', 'Joan', 'M');
