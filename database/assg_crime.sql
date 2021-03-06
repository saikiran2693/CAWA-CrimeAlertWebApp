SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

-- Database: `assg_crime`

-- Table structure for table `admin`
CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Dumping data for table `admin`
INSERT INTO `admin` (
  `username`,
  `password`,
  `email`
  )
VALUES (
  'admin',
  '123',
  'admin@yahoo.com'
  );

-- Table structure for table `crime_report`
CREATE TABLE `crime_report` (
  `crid` int(11) NOT NULL,
  `user_email` varchar(60) CHARACTER SET utf8mb4 NOT NULL,
  `dateofcrime` date NOT NULL,
  `timeofcrime` time NOT NULL,
  `typeofactivity` varchar(50) NOT NULL,
  `typeofcrime` varchar(50) NOT NULL,
  `crimedetails` text NOT NULL,
  `reported_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(40) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

-- Dumping data for table `crime_report`
INSERT INTO `crime_report` (
    `crid`,
    `user_email`,
    `dateofcrime`,
    `timeofcrime`,
    `typeofactivity`,
    `typeofcrime`,
    `crimedetails`,
    `reported_at`,
    `status`
  )
VALUES (
    1,
    'kiran@gmail.com',
    '2021-09-14',
    '12:40:00',
    'Actual Crime',
    'Domestic abuse',
    'This is a crimen reported by kiran.',
    '2021-09-01 11:09:15',
    'verified'
  ),
  (
    2,
    's@gmail.com',
    '2021-09-12',
    '16:40:00',
    'Actual Crime',
    'Stalking and harassment',
    'This is a crime reported by sai.',
    '2021-09-02 11:10:16',
    'verified'
  );

-- Table structure for table `users`
CREATE TABLE `users` (
  `email` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `address` varchar(300) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Dumping data for table `users`
INSERT INTO `users` (
    `email`,
    `password`,
    `name`,
    `gender`,
    `mobileno`,
    `address`,
    `photo`,
    `status`
  )
VALUES (
    'kiran@gmail.com',
    '123456',
    'Kiran',
    'Male',
    '1234567890',
    'Lasalle',
    'userPhotos/avatar-1.jpg',
    'active'
  ),
  (
    's@gmail.com',
    '123456',
    'Sai',
    'Male',
    '1234567891',
    'Lasalle',
    'uploads/avatar.png',
    'active'
  ),
  (
    'vash@gmail.com',
    '123456',
    'vash',
    'Male',
    '1234567895',
    'Lasalle',
    'uploads/avatar.png',
    'inactive'
  );

-- Table structure for table `user_emails`
CREATE TABLE `user_emails` (
  `id` int(11) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `contact_email` varchar(60) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Dumping data for table `user_emails`
INSERT INTO `user_emails` (`id`, `user_email`, `contact_email`)
VALUES (1, 's@gmail.com', 'guncha97@gmail.com');

-- Indexes for table `admin`
ALTER TABLE `admin`
ADD PRIMARY KEY (`username`);

-- Indexes for table `crime_report`
ALTER TABLE `crime_report`
ADD PRIMARY KEY (`crid`);

-- Indexes for table `users`
ALTER TABLE `users`
ADD PRIMARY KEY (`email`);

-- Indexes for table `user_emails`
ALTER TABLE `user_emails`
ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT for table `crime_report`
ALTER TABLE `crime_report`
MODIFY `crid` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 11;

-- AUTO_INCREMENT for table `user_emails`
ALTER TABLE `user_emails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;

COMMIT;