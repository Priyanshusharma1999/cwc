-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2018 at 03:58 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cwcpmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `DIVISION_ID` bigint(20) NOT NULL,
  `DIVISIONNAME` varchar(256) DEFAULT NULL,
  `ORGANIZATION_ID` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`DIVISION_ID`, `DIVISIONNAME`, `ORGANIZATION_ID`, `status`, `created_date`, `updated_date`) VALUES
(2, 'Lower Brahmaputra Division, Jalpaiguri India', 9, 1, '2018-06-04 16:12:15', '2018-06-06 17:53:33'),
(3, 'Middle Brahmaputra Division, Guwahati India', 9, 1, '2018-06-04 16:12:53', '2018-06-06 17:53:30'),
(4, 'Upper Brahmaputra Division, Dibrugarhh', 9, 1, '2018-06-04 16:15:53', '2018-06-07 17:08:08'),
(6, 'North-East Investigation Division-I, Silchar assadsad', 9, 0, '2018-06-04 16:17:39', '2018-06-07 15:55:14'),
(7, 'North-East Investigation Division-II, Aizawl', 9, 0, '2018-06-04 16:18:35', '2018-06-06 17:53:25'),
(8, 'my division new', 18, 1, '2018-06-07 15:54:54', '2018-06-07 15:55:06'),
(9, 'Upper Brahmaputra Division, Dibrugarh011', 9, 1, '2018-06-07 17:08:21', '2018-06-07 17:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EMPLOYEE_ID` bigint(20) NOT NULL,
  `FULLENAME` varchar(256) DEFAULT NULL,
  `ORGANIZATION_ID` bigint(20) DEFAULT NULL,
  `DIVISION_ID` bigint(20) DEFAULT NULL,
  `DESIGNATION` varchar(128) DEFAULT NULL,
  `OFFICENAME` varchar(512) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `MOBILE` varchar(13) DEFAULT NULL,
  `LANDLINE_NO` varchar(13) NOT NULL,
  `CREATEDDATE` datetime DEFAULT NULL,
  `STATUS` varchar(2) DEFAULT NULL,
  `LASTMODIFIED` datetime DEFAULT NULL,
  `MODIFIED_BY` bigint(20) DEFAULT NULL,
  `CLIENT_IP` varchar(20) DEFAULT NULL,
  `OFFICE_ADDRESS` varchar(256) DEFAULT NULL,
  `FILED2` bigint(20) DEFAULT NULL,
  `FILED3` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EMPLOYEE_ID`, `FULLENAME`, `ORGANIZATION_ID`, `DIVISION_ID`, `DESIGNATION`, `OFFICENAME`, `EMAIL`, `MOBILE`, `LANDLINE_NO`, `CREATEDDATE`, `STATUS`, `LASTMODIFIED`, `MODIFIED_BY`, `CLIENT_IP`, `OFFICE_ADDRESS`, `FILED2`, `FILED3`) VALUES
(2, 'bk singh', 9, 2, 'web developer', 'mmm', 'bk@gmail.com', '9540435678', '123123', '2018-06-05 10:58:33', '0', '2018-06-05 10:58:33', NULL, NULL, 'aaaa', NULL, NULL),
(3, 'Abhinav Srivastava', 9, 2, 'web developer', 'mmm', 'abhi@gmail.com', '8893848384', '123456', '2018-06-05 11:01:04', '0', '2018-06-05 11:01:04', NULL, NULL, 'aaaa', NULL, NULL),
(4, 'Brijkishor Singh Rathour', 9, 3, 'web developer', 'Moptra Infotech Pvt Ltd', 'brijkishor.singh@moptra.com', '9540435670', '12214324324', '2018-06-05 12:09:04', '1', '2018-06-05 12:09:04', NULL, NULL, 'G-246, Sec-63 Noida', NULL, NULL),
(5, 'Rahul Kumar', 9, 3, 'web developer', 'Moptra Infotech Pvt Ltd', 'rahul@gmail.com', '9547754323', '12334434', '2018-06-06 18:48:01', '1', '2018-06-06 18:48:01', NULL, NULL, 'G-246, Sec-63 Noida', NULL, NULL),
(6, 'Rahul Kumar', 9, 3, 'web developer', 'demo office', 'rahulrAI@gmail.com', '8945885433', '123214', '2018-06-06 18:43:20', '0', '2018-06-06 18:43:20', NULL, NULL, 'asdadas', NULL, NULL),
(7, 'Narendra Tanwar', 9, 3, 'Java Developer', 'Moptra Infotech Pvt Ltd', 'narendra@gmail.com', '8874374733', '32434234', '2018-06-07 16:29:58', '0', '2018-06-07 16:29:58', NULL, NULL, 'G-246, Sec-63 Noida', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `ORGANIZATION_ID` bigint(20) NOT NULL,
  `ORGNAME` varchar(512) DEFAULT NULL,
  `ORGDESC` varchar(512) DEFAULT NULL,
  `delete_status` tinyint(2) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`ORGANIZATION_ID`, `ORGNAME`, `ORGDESC`, `delete_status`, `created_date`, `updated_date`) VALUES
(6, 'CWC(HQ) - PCP Dte., New Delhi011', NULL, 0, '2018-06-07 17:07:36', '2018-06-07 17:07:36'),
(7, 'CWC(HQ) - TD Dte., New Delhi, India', NULL, 0, '2018-06-04 14:34:28', '2018-06-04 14:34:28'),
(8, 'CWC(HQ) - Training Dte., New Delhi India', NULL, 0, '2018-06-06 17:45:33', '2018-06-06 17:45:33'),
(9, 'Brahmaputra and Barak Basin Organisation, Guhawati', NULL, 0, '2018-06-04 14:35:19', '2018-06-04 14:35:19'),
(10, 'Cauvery and Southern Rivers Organisation, Tamilnadu', NULL, 0, '2018-06-04 14:37:32', '2018-06-04 14:37:32'),
(11, 'Indus Basin Organisation, Chandigarh', NULL, 0, '2018-06-04 13:37:50', '2018-06-04 13:37:50'),
(12, 'Krishna and Godavari Basin Organisation, Hyderabadd', NULL, 0, '2018-06-07 17:07:56', '2018-06-07 17:07:56'),
(14, 'Mahanadi and Eastern Rivers Organisation, Bhubaneswar', NULL, 0, '2018-06-04 13:38:20', '2018-06-04 13:38:20'),
(15, 'Monitoring (Central) Organisation,  Nagpur', NULL, 0, '2018-06-07 15:38:47', '2018-06-07 15:38:47'),
(16, 'Monitoring (South) Organisation, Bengaluru', NULL, 0, '2018-06-04 13:38:35', '2018-06-04 13:38:35'),
(18, 'My Organization', NULL, 0, '2018-06-07 15:37:29', '2018-06-07 15:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `penscontinfo`
--

CREATE TABLE `penscontinfo` (
  `CONTACT_ID` bigint(20) NOT NULL,
  `FULLNAME` varchar(256) DEFAULT NULL,
  `MOBILENO` bigint(20) DEFAULT NULL,
  `EMAILID` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(512) DEFAULT NULL,
  `CONTACTYPE` varchar(5) DEFAULT NULL,
  `STATUS` varchar(5) DEFAULT NULL,
  `GENDER` varchar(10) DEFAULT NULL,
  `RELATIONWITHPENSIONER` varchar(30) DEFAULT NULL,
  `CRATEDDATE` datetime DEFAULT NULL,
  `LASTUPDATE` datetime DEFAULT NULL,
  `FILED1` datetime DEFAULT NULL,
  `FILED2` varchar(256) DEFAULT NULL,
  `FILED3` bigint(20) DEFAULT NULL,
  `PENSION_ID` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penscontinfo`
--

INSERT INTO `penscontinfo` (`CONTACT_ID`, `FULLNAME`, `MOBILENO`, `EMAILID`, `ADDRESS`, `CONTACTYPE`, `STATUS`, `GENDER`, `RELATIONWITHPENSIONER`, `CRATEDDATE`, `LASTUPDATE`, `FILED1`, `FILED2`, `FILED3`, `PENSION_ID`) VALUES
(5, 'Ashish Banarjee', 8689867755, 'ashishban@gmail.com', 'Gurgaon, Haryana India', 'SELF', '1', 'MALE', 'Self', '2018-06-06 15:00:02', '2018-06-06 15:00:02', NULL, NULL, NULL, 5),
(6, 'Rajeshwar Kumar', 9540435789, 'rajeshwar@gmail.com', 'aaaaxcvxcv', 'SELF', '1', 'FEMALE', 'Spouse', '2018-06-06 15:15:22', '2018-06-06 15:15:22', NULL, NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `pensrecoinfo`
--

CREATE TABLE `pensrecoinfo` (
  `PENSION_ID` bigint(20) NOT NULL,
  `PPO_NO` bigint(20) DEFAULT NULL,
  `EMPLY_NAME` varchar(256) DEFAULT NULL,
  `FAMILYMEM_NAME` varchar(256) DEFAULT NULL,
  `DATE_RETIREMENT` datetime DEFAULT NULL,
  `DATE_DEATH` datetime DEFAULT NULL,
  `DIVIS_DEAL_NAME` varchar(256) DEFAULT NULL,
  `PENSION_STATUS` varchar(10) DEFAULT NULL,
  `PENSION_TYPE` varchar(10) DEFAULT NULL,
  `DELETES` tinyint(1) DEFAULT NULL,
  `CREATEDDATE` datetime DEFAULT NULL,
  `LASTMODIDATE` datetime DEFAULT NULL,
  `MODIFIEDBY_ID` bigint(20) DEFAULT NULL,
  `CLIENT_IP` varchar(20) DEFAULT NULL,
  `FIELD1` varchar(256) DEFAULT NULL,
  `FIELD2` bigint(20) DEFAULT NULL,
  `FIELD3` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pensrecoinfo`
--

INSERT INTO `pensrecoinfo` (`PENSION_ID`, `PPO_NO`, `EMPLY_NAME`, `FAMILYMEM_NAME`, `DATE_RETIREMENT`, `DATE_DEATH`, `DIVIS_DEAL_NAME`, `PENSION_STATUS`, `PENSION_TYPE`, `DELETES`, `CREATEDDATE`, `LASTMODIDATE`, `MODIFIEDBY_ID`, `CLIENT_IP`, `FIELD1`, `FIELD2`, `FIELD3`) VALUES
(5, 5656464, 'Ashish Banarjee', NULL, '2019-10-18 00:00:00', NULL, 'demo division', 'demo issue', 'SELF', 0, '2018-06-06 15:00:02', '2018-06-06 15:00:02', 1, '::1', NULL, NULL, NULL),
(6, 2434345, 'Rajeshwar Kumar', 'Demo name', NULL, '2019-03-16 00:00:00', 'xcvcxvcxvx', 'fdsdsada', 'SELF', 1, '2018-06-07 18:39:08', '2018-06-07 18:39:08', 1, '::1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pensrecoremark`
--

CREATE TABLE `pensrecoremark` (
  `REMARK_ID` bigint(20) NOT NULL,
  `DESCRIPTION` varchar(512) DEFAULT NULL,
  `CREATEDDATE` datetime DEFAULT NULL,
  `FILED1` bigint(20) DEFAULT NULL,
  `FILED2` varchar(256) DEFAULT NULL,
  `FILED3` datetime DEFAULT NULL,
  `PENSION_ID` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pensrecoremark`
--

INSERT INTO `pensrecoremark` (`REMARK_ID`, `DESCRIPTION`, `CREATEDDATE`, `FILED1`, `FILED2`, `FILED3`, `PENSION_ID`) VALUES
(5, 'Lorem ipsum is simply dummy text.', '2018-06-06 15:00:02', NULL, NULL, NULL, 5),
(6, 'sdfsdfsdfsdfsdfsdfsfsdf', '2018-06-06 15:15:22', NULL, NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `pensrecostatus`
--

CREATE TABLE `pensrecostatus` (
  `RECORDSTATUS_ID` bigint(20) NOT NULL,
  `ANNUAL_VERIFICATION` tinyint(1) DEFAULT NULL,
  `PENDING_PPO` tinyint(1) DEFAULT NULL,
  `STATUS_PENS_PAPER` varchar(512) DEFAULT NULL,
  `TREMINAL_BENIFIT_GRANT` varchar(512) DEFAULT NULL,
  `WITHDRAWAL_REQ_NSDL` tinyint(1) DEFAULT NULL,
  `STATUS_TERM_BENI_NOT_GRANT` tinyint(1) DEFAULT NULL,
  `MODIFIEDBY_ID` bigint(20) DEFAULT NULL,
  `CLIENT_IP` varchar(20) DEFAULT NULL,
  `CREATEDDATE` datetime DEFAULT NULL,
  `LASTMODIFIED` datetime DEFAULT NULL,
  `FILED1` datetime DEFAULT NULL,
  `FILED2` varchar(256) DEFAULT NULL,
  `FILED3` bigint(20) DEFAULT NULL,
  `STATUS` varchar(5) DEFAULT NULL,
  `PENSION_ID` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pensrecostatus`
--

INSERT INTO `pensrecostatus` (`RECORDSTATUS_ID`, `ANNUAL_VERIFICATION`, `PENDING_PPO`, `STATUS_PENS_PAPER`, `TREMINAL_BENIFIT_GRANT`, `WITHDRAWAL_REQ_NSDL`, `STATUS_TERM_BENI_NOT_GRANT`, `MODIFIEDBY_ID`, `CLIENT_IP`, `CREATEDDATE`, `LASTMODIFIED`, `FILED1`, `FILED2`, `FILED3`, `STATUS`, `PENSION_ID`) VALUES
(5, 0, 0, 'POPSEF', 'demo details lorem ipsum', NULL, NULL, 1, '::1', '2018-06-06 15:00:02', '2018-06-06 15:00:02', NULL, NULL, NULL, '1', 5),
(6, NULL, 0, 'POPSOF', 'sfdsfsdfsf', NULL, NULL, 1, '::1', '2018-06-06 15:15:22', '2018-06-06 15:15:22', NULL, NULL, NULL, '1', 6);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ROLE_ID` bigint(20) NOT NULL,
  `ROLE` varchar(128) DEFAULT NULL,
  `ROLEDESC` varchar(256) DEFAULT NULL,
  `Filed1` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ROLE_ID`, `ROLE`, `ROLEDESC`, `Filed1`) VALUES
(1, 'Super Admin', 'Super Admin will able to add and manage Organisation and other user to manage the whole Portal.', NULL),
(2, 'Organization Admin', 'Organisation Admin user will be able to manage the Pension record add/update.', NULL),
(3, 'PAO Admin', 'PAO Admin user will be able to communicate with Super Admin/Organisation/Division and view the status.', NULL),
(4, 'Division Admin', 'Division Admin user will be able to communicate with Super Admin/Organisation/PAO and view the status.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USERS_ID` bigint(20) NOT NULL,
  `LOGONID` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(512) DEFAULT NULL,
  `ROLE_ID` bigint(20) DEFAULT NULL,
  `FULLNAME` varchar(256) DEFAULT NULL,
  `ORGANIZATION_ID` bigint(20) DEFAULT NULL,
  `DIVISION_ID` bigint(20) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `MOBILE` varchar(13) DEFAULT NULL,
  `STATUS` varchar(2) DEFAULT NULL,
  `PROFILEIMG` varchar(100) DEFAULT NULL,
  `DELETES` tinyint(1) DEFAULT NULL,
  `CREATEDDATE` datetime DEFAULT NULL,
  `LASTSESSION` datetime DEFAULT NULL,
  `CLIENIP` varchar(15) DEFAULT NULL,
  `FILED1` varchar(256) DEFAULT NULL,
  `FILED2` bigint(20) DEFAULT NULL,
  `FILED3` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USERS_ID`, `LOGONID`, `PASSWORD`, `ROLE_ID`, `FULLNAME`, `ORGANIZATION_ID`, `DIVISION_ID`, `EMAIL`, `MOBILE`, `STATUS`, `PROFILEIMG`, `DELETES`, `CREATEDDATE`, `LASTSESSION`, `CLIENIP`, `FILED1`, `FILED2`, `FILED3`) VALUES
(1, 'brij', 'e6e061838856bf47e1de730719fb2609', 1, 'Brijkishor Singh', 0, 0, 'admin@gmail.com', '9540431268', '1', '_1_1528371378_photo_user-06.jpg', 0, '2018-06-07 19:28:24', '2018-06-07 19:28:24', '::1', NULL, NULL, NULL),
(10, 'gaurav', '1e655d4d5c79dda52fc3953bc3af8894', 1, 'Gaurav Katiyar', 0, 0, 'gaurav@gmail.com', '7518818227', '1', NULL, 1, '2018-06-07 13:49:56', '2018-06-07 13:49:56', '::1', NULL, NULL, NULL),
(11, 'pandey', '1de4fec9ca3ea535456218cb5268fd6d', 2, 'Gaurav Pandey', 2, 0, 'pandey@gmail.com', '9837477334', '1', NULL, 1, '2018-06-06 16:59:10', '2018-06-06 16:59:10', '::1', NULL, NULL, NULL),
(12, 'abhinav', 'ba1d63b653b24a565ed436a0cfc5b3c9', 2, 'Abhinav Srivastava', 0, 0, 'abhi@gmail.com', '8774754457', '1', '_1_1528359248_photo_user-06.jpg', 0, '2018-06-07 15:26:57', '2018-06-07 15:26:57', '::1', NULL, NULL, NULL),
(13, 'rishabh', 'c64e8e7b05a6d831605cfe23dd617deb', 3, 'Rishabh Kumar Rai', 15, 4, 'rishabh@gmail.com', '9845775445', '1', '_1_1528358462_photo_user-06.jpg', 0, '2018-06-07 14:21:02', '2018-06-07 14:21:02', '::1', NULL, NULL, NULL),
(14, 'narendra', '1dd1cc8ca1dbb48e4b74cec9c26316fd', 2, 'Narendra Tanwar', 10, 0, 'narendra@gmail.com', '8747574356', '1', NULL, 1, '2018-06-07 16:07:47', '2018-06-07 16:07:47', '::1', NULL, NULL, NULL),
(15, 'rahul', 'ebaaba27b32928a25f2ad6185fc0cc74', 1, 'Rahul Kumar', 0, 0, 'rahul@gmail.com', '7465646564', '1', NULL, 0, '2018-06-07 16:06:48', '2018-06-07 16:06:48', '::1', NULL, NULL, NULL),
(16, 'neha', '74d36c0725346b3b3d0d30cbe0edd219', 2, 'Neha Kumari', 9, 0, 'kumarineha@gmail.com', '8948455475', '1', '_1_1528371417_photo_user-05.jpg', 0, '2018-06-07 17:06:57', '2018-06-07 17:06:57', '::1', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`DIVISION_ID`),
  ADD KEY `ORGANIZATION_ID` (`ORGANIZATION_ID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EMPLOYEE_ID`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`ORGANIZATION_ID`);

--
-- Indexes for table `penscontinfo`
--
ALTER TABLE `penscontinfo`
  ADD PRIMARY KEY (`CONTACT_ID`),
  ADD KEY `PENSION_ID` (`PENSION_ID`);

--
-- Indexes for table `pensrecoinfo`
--
ALTER TABLE `pensrecoinfo`
  ADD PRIMARY KEY (`PENSION_ID`);

--
-- Indexes for table `pensrecoremark`
--
ALTER TABLE `pensrecoremark`
  ADD PRIMARY KEY (`REMARK_ID`),
  ADD KEY `PENSION_ID` (`PENSION_ID`);

--
-- Indexes for table `pensrecostatus`
--
ALTER TABLE `pensrecostatus`
  ADD PRIMARY KEY (`RECORDSTATUS_ID`),
  ADD KEY `PENSION_ID` (`PENSION_ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ROLE_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USERS_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `DIVISION_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EMPLOYEE_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `ORGANIZATION_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `penscontinfo`
--
ALTER TABLE `penscontinfo`
  MODIFY `CONTACT_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pensrecoinfo`
--
ALTER TABLE `pensrecoinfo`
  MODIFY `PENSION_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pensrecoremark`
--
ALTER TABLE `pensrecoremark`
  MODIFY `REMARK_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pensrecostatus`
--
ALTER TABLE `pensrecostatus`
  MODIFY `RECORDSTATUS_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ROLE_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USERS_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `division`
--
ALTER TABLE `division`
  ADD CONSTRAINT `devision_ibfk_1` FOREIGN KEY (`ORGANIZATION_ID`) REFERENCES `organization` (`ORGANIZATION_ID`);

--
-- Constraints for table `penscontinfo`
--
ALTER TABLE `penscontinfo`
  ADD CONSTRAINT `penscontinfo_ibfk_1` FOREIGN KEY (`PENSION_ID`) REFERENCES `pensrecoinfo` (`PENSION_ID`);

--
-- Constraints for table `pensrecoremark`
--
ALTER TABLE `pensrecoremark`
  ADD CONSTRAINT `pensrecoremark_ibfk_1` FOREIGN KEY (`PENSION_ID`) REFERENCES `pensrecoinfo` (`PENSION_ID`);

--
-- Constraints for table `pensrecostatus`
--
ALTER TABLE `pensrecostatus`
  ADD CONSTRAINT `pensrecostatus_ibfk_1` FOREIGN KEY (`PENSION_ID`) REFERENCES `pensrecoinfo` (`PENSION_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
