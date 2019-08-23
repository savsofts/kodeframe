-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2019 at 02:30 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kodeframe`
--

-- --------------------------------------------------------

--
-- Table structure for table `kodeframe_logs`
--

CREATE TABLE `kodeframe_logs` (
  `id` int(11) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(100) NOT NULL,
  `logged_in_user` varchar(100) NOT NULL,
  `action_path` varchar(100) NOT NULL,
  `action_description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kodeframe_menu`
--

CREATE TABLE `kodeframe_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `module_id` int(11) NOT NULL,
  `parent_menu_id` int(11) NOT NULL,
  `order_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kodeframe_modules`
--

CREATE TABLE `kodeframe_modules` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `col_name` text NOT NULL,
  `col_type` text NOT NULL,
  `col_value` text NOT NULL,
  `validations` text NOT NULL,
  `bg_color_code` varchar(100) NOT NULL DEFAULT '#ffffff',
  `text_color_code` varchar(100) NOT NULL DEFAULT '#212121',
  `show_hide` text NOT NULL,
  `tbl_joins` text NOT NULL,
  `join_modules` varchar(100) NOT NULL DEFAULT 'No',
  `joined_tables` text,
  `extended_query` text,
  `add_permission` varchar(1000) DEFAULT NULL,
  `edit_permission` varchar(1000) DEFAULT NULL,
  `delete_permission` varchar(1000) DEFAULT NULL,
  `view_permission` varchar(1000) DEFAULT NULL,
  `export_permission` varchar(1000) DEFAULT NULL,
  `module_delete_permission` varchar(100) NOT NULL DEFAULT 'Yes',
  `pre_insert` text NOT NULL,
  `post_insert` text NOT NULL,
  `module_redirect` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kodeframe_modules`
--

INSERT INTO `kodeframe_modules` (`module_id`, `module_name`, `table_name`, `col_name`, `col_type`, `col_value`, `validations`, `bg_color_code`, `text_color_code`, `show_hide`, `tbl_joins`, `join_modules`, `joined_tables`, `extended_query`, `add_permission`, `edit_permission`, `delete_permission`, `view_permission`, `export_permission`, `module_delete_permission`, `pre_insert`, `post_insert`, `module_redirect`) VALUES
(16, 'Account users', 'kodeframe_users', 'username,password,email,full_name,group_name', 'varchar(1000),password,varchar(1000),varchar(1000)', '', '', '#ffffff', '', 'show,show,hide,show,show', ',,,,kodeframe_user_group.group_name', 'No', NULL, NULL, 'Super Administrator', 'Super Administrator', 'Super Administrator', 'Super Administrator', 'Super Administrator', 'No', '', '', ''),
(18, 'User group', 'kodeframe_user_group', 'group_name', 'varchar(1000)', '', '', '#ffffff', '', 'show,show', ',', 'No', NULL, NULL, 'Super Administrator', 'Super Administrator', 'Super Administrator', 'Super Administrator', 'Super Administrator', 'No', '', '', ''),
(26, 'Logs', 'kodeframe_logs', 'log_time,ip_address,logged_in_user,action_path,action_description', 'varchar(1000),varchar(1000),varchar(1000),varchar(1000),varchar(1000)', '', '', '#ffffff', '', 'show,show,show,show,show', ',', 'No', NULL, NULL, 'Super Administrator', '', 'Super Administrator', 'Super Administrator', 'Super Administrator', 'No', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kodeframe_users`
--

CREATE TABLE `kodeframe_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_name` varchar(100) NOT NULL,
  `connection_token` varchar(1000) NOT NULL,
  `trashed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kodeframe_users`
--

INSERT INTO `kodeframe_users` (`id`, `username`, `password`, `email`, `full_name`, `user_created_on`, `group_name`, `connection_token`, `trashed`) VALUES
(1, 'superadmin', '21232f297a57a5a743894a0e4a801fc3', 'admin@example.com', 'Administrator', '2019-07-17 12:58:20', 'Super Administrator', '1317491566563241', 0),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin2@example.com', 'Admin', '2019-08-13 07:29:13', 'Admin', '8795631566561918', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kodeframe_user_group`
--

CREATE TABLE `kodeframe_user_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kodeframe_user_group`
--

INSERT INTO `kodeframe_user_group` (`id`, `group_name`) VALUES
(1, 'Super Administrator'),
(2, 'Admin'),
(3, 'Guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kodeframe_logs`
--
ALTER TABLE `kodeframe_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kodeframe_menu`
--
ALTER TABLE `kodeframe_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `kodeframe_modules`
--
ALTER TABLE `kodeframe_modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `kodeframe_users`
--
ALTER TABLE `kodeframe_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kodeframe_user_group`
--
ALTER TABLE `kodeframe_user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kodeframe_logs`
--
ALTER TABLE `kodeframe_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kodeframe_menu`
--
ALTER TABLE `kodeframe_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kodeframe_modules`
--
ALTER TABLE `kodeframe_modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `kodeframe_users`
--
ALTER TABLE `kodeframe_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kodeframe_user_group`
--
ALTER TABLE `kodeframe_user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
