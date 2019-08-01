CREATE TABLE `student` (
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `idnum` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `yr` int(5) NOT NULL,
  `student_index` int(5) NOT NULL AUTO_INCREMENT,
  `adviser` int(5) NOT NULL,
  PRIMARY KEY (`student_index`)) AUTO_INCREMENT = 1000;

INSERT INTO `student`
    (lname, fname, mname, idnum, course, yr, adviser)
VALUES
    ('Juan', 'Dela Cruz', 'D', '16-3917-226', 'BSIT', 3, 1000),
    ('Gardo', 'Jaron', 'F', '16-5631-921', 'BSIT', 3, 1000),
    ('Manuel', 'Ryan', 'G', '16-3342-442', 'BSIT', 3, 1000),
    ('Marrero', 'Dean', 'C', '17-4924-288', 'BSIT', 3, 1000),
    ('Canggat', 'Diane', 'C', '16-7213-242', 'BSIT', 3, 1000);