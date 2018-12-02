-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2018 at 08:35 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `law_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllOrders` (IN `CLIENT_ID` INT, OUT `statusname` VARCHAR(200))  BEGIN
 select status INTO statusname from invoice where client_id = CLIENT_ID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `actionplans`
--

CREATE TABLE `actionplans` (
  `id` int(11) NOT NULL,
  `action_plan` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrator', '14', '2016-10-18 01:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('add-contribution', 1, 'add a contribution', NULL, NULL, NULL, NULL),
('add-recovery', 1, 'add a recovery item', NULL, NULL, NULL, NULL),
('administrator', 1, 'admin', NULL, NULL, NULL, NULL),
('approval-one', 1, 'approval-one', NULL, NULL, NULL, NULL),
('approval-two', 1, 'approval-two', NULL, NULL, NULL, NULL),
('assign-rights', 1, 'assign rights', NULL, NULL, NULL, NULL),
('change_credit_profile', 1, 'change_credit_profile', NULL, NULL, NULL, NULL),
('coder', 1, 'coder', NULL, NULL, NULL, NULL),
('delete-claim', 1, 'delete a claim', NULL, NULL, NULL, NULL),
('delete-contribution', 1, 'delete contribution', NULL, NULL, NULL, NULL),
('delete-payments', 1, 'delete-payments', NULL, NULL, NULL, NULL),
('delete-recovery', 1, 'delete recovery', NULL, NULL, NULL, NULL),
('index-claim', 1, 'index-claims', NULL, NULL, NULL, NULL),
('index-contribution', 1, 'index contribution', NULL, NULL, NULL, NULL),
('index-payments', 1, 'index payments', NULL, NULL, NULL, NULL),
('index-recovery', 1, 'index recovery', NULL, NULL, NULL, NULL),
('make-payments', 1, 'make a payments', NULL, NULL, NULL, NULL),
('payments-module', 1, 'payments-module', NULL, NULL, NULL, NULL),
('send-sms', 1, NULL, NULL, NULL, NULL, NULL),
('update-claim', 1, 'update a claim', NULL, NULL, NULL, NULL),
('update-contribution', 1, 'update a contribution', NULL, NULL, NULL, NULL),
('update-payments', 1, 'update payments', NULL, NULL, NULL, NULL),
('update-recovery', 1, 'update a recovery item', NULL, NULL, NULL, NULL),
('view-claim', 1, 'view claims', NULL, NULL, NULL, NULL),
('view-contribution', 1, 'view contributions', NULL, NULL, NULL, NULL),
('view-payments', 1, 'view payments', NULL, NULL, NULL, NULL),
('view-recovery', 1, 'view recovery items', NULL, NULL, NULL, NULL),
('view-rights', 1, 'view-rights', NULL, NULL, NULL, NULL),
('VIEWCLAIMS_APPROVE_ADDMEMBER_MAKE_PAYMENTS', 1, 'VIEWCLAIMS_APPROVE_ADDMEMBER_MAKE_PAYMENTS', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('administrator', 'add-contribution'),
('administrator', 'add-recovery'),
('administrator', 'delete-claim'),
('VIEWCLAIMS_APPROVE_ADDMEMBER_MAKE_PAYMENTS', 'delete-claim'),
('administrator', 'delete-contribution'),
('administrator', 'delete-payments'),
('payments-module', 'delete-payments'),
('VIEWCLAIMS_APPROVE_ADDMEMBER_MAKE_PAYMENTS', 'delete-payments'),
('administrator', 'delete-recovery'),
('administrator', 'index-claim'),
('VIEWCLAIMS_APPROVE_ADDMEMBER_MAKE_PAYMENTS', 'index-claim'),
('administrator', 'index-contribution'),
('administrator', 'index-payments'),
('payments-module', 'index-payments'),
('VIEWCLAIMS_APPROVE_ADDMEMBER_MAKE_PAYMENTS', 'index-payments'),
('administrator', 'index-recovery'),
('administrator', 'make-payments'),
('payments-module', 'make-payments'),
('VIEWCLAIMS_APPROVE_ADDMEMBER_MAKE_PAYMENTS', 'make-payments'),
('administrator', 'update-claim'),
('administrator', 'update-contribution'),
('administrator', 'update-payments'),
('administrator', 'update-recovery'),
('administrator', 'view-claim'),
('VIEWCLAIMS_APPROVE_ADDMEMBER_MAKE_PAYMENTS', 'view-claim'),
('administrator', 'view-contribution'),
('administrator', 'view-payments'),
('payments-module', 'view-payments');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `client_phone` varchar(20) NOT NULL,
  `client_email` varchar(128) NOT NULL,
  `location` varchar(100) NOT NULL,
  `town` varchar(100) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `id_path` varchar(100) NOT NULL,
  `id_no` int(11) NOT NULL,
  `client_full_names` varchar(70) NOT NULL,
  `gender` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `created_at`, `client_phone`, `client_email`, `location`, `town`, `created_by`, `f_name`, `l_name`, `m_name`, `id_path`, `id_no`, `client_full_names`, `gender`) VALUES
(11, '2017-12-10 06:39:27', '0716663833', 'mutindamike@gmail.c.om', 'sdgsdfg', 'gsdgs', 'admin', 'michael', 'ahsdfjkh', 'mutinda', 'IDUPLOADS/28349287New client pin change on Instapay.jpg', 28349287, 'michael mutinda makau', 'MALE'),
(12, '2017-12-19 09:11:05', '0716630770', 'mutindamike@gmial.com', 'sags', 'asdafsdf', 'admin', 'sdfhsd', 'nmbmnbnmb', 'jhbnbmn', 'IDUPLOADS/2856261220171210_172434.jpg', 28562612, '', 'FEMALE'),
(14, '2017-12-22 08:15:52', '0716630770', 'mutindamike@gmail.c.om', 'ASFSDF', 'FASFA', 'admin', 'Carol', 'Akjfk', 'Mutinda', 'IDUPLOADS/28563612E-lawyer.png', 28563612, 'Carol  Mutinda  Akjfk', 'FEMALE'),
(15, '2017-12-28 01:19:14', '0716630770', 'mutindamike@gmail.com', 'Kisumu', 'Eldoret', 'admin', 'John', 'Mutinda', 'Doe', 'IDUPLOADS/285636236BA28AAB-6E32-48D8-914A-C441664E4FE3.png', 28563623, 'John  Doe  Mutinda', 'FEMALE');

-- --------------------------------------------------------

--
-- Table structure for table `contact_persons`
--

CREATE TABLE `contact_persons` (
  `id` int(11) NOT NULL,
  `names` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `clients_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_persons`
--

INSERT INTO `contact_persons` (`id`, `names`, `phone`, `email`, `clients_id`) VALUES
(1, 'Mr. Michael Mutinda', '0710166920', 'mutindamike@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `paths` varchar(300) NOT NULL,
  `parent` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `size` int(11) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `paths`, `parent`, `created_by`, `created_at`, `size`, `type`) VALUES
(2, 'root', 'main', 'admin', '0000-00-00 00:00:00', 0, 'folder'),
(4, 'log', 'var', 'admin', '0000-00-00 00:00:00', 0, 'folder'),
(43, 'Mikestuff', 'Mike   Stuff', 'admin', '0000-00-00 00:00:00', 0, 'folder'),
(44, 'New Folder', 'Mike   Stuff', 'admin', '0000-00-00 00:00:00', 0, 'folder'),
(69, 'nicki minaj', 'main', 'adminf', '0000-00-00 00:00:00', 0, 'folder'),
(72, 'alkf', 'nicki minaj', 'admin', '0000-00-00 00:00:00', 0, 'folder'),
(75, 'mike', 'main', 'admin', '0000-00-00 00:00:00', 1, 'folder'),
(77, 'unkownn', 'main', 'admin', '2018-01-03 08:04:14', 1, 'folder'),
(78, 'no', 'main', 'admin', '2018-01-03 08:07:28', 1, 'folder'),
(79, 'kekek', 'main', 'admin', '2018-01-03 08:09:11', 1, 'folder'),
(80, 'mm', 'main', 'admin', '2018-01-03 08:13:29', 1, 'folder'),
(81, 'response.pdf', 'main', 'admin', '2018-01-03 08:22:08', 45442, 'pdf'),
(84, 'ksjd', 'main', 'admin', '2018-01-03 09:46:51', 1, 'folder'),
(92, 'response.pdf', 'mm', 'admin', '2018-01-02 22:53:01', 45442, 'pdf'),
(93, 'response.pdf', 'kekek', 'admin', '2018-01-02 22:56:50', 45442, 'pdf'),
(94, 'sheri', 'main', 'admin', '2018-01-03 00:27:53', 1, 'folder'),
(95, 'mikeversion', 'main', 'admin', '2018-01-03 00:28:02', 1, 'folder'),
(96, 'law archives', 'main', 'admin', '2018-01-03 00:28:14', 1, 'folder'),
(97, 'baby', 'main', 'admin', '2018-01-03 00:28:21', 1, 'folder'),
(98, 'slwwp', 'main', 'admin', '2018-01-03 00:33:19', 1, 'folder'),
(99, 'mike', 'no', 'admin', '2018-01-03 00:43:55', 1, 'folder'),
(100, 'law archives', 'no', 'admin', '2018-01-03 00:45:21', 1, 'folder'),
(101, 'slwwp', 'sheri', 'admin', '2018-01-03 00:47:16', 1, 'folder'),
(102, 'chep', 'main', 'admin', '2018-01-03 04:53:08', 1, 'folder'),
(103, 'tess', 'main', 'admin', '2018-01-07 22:38:51', 1, 'folder'),
(104, 'Active Cases(5).xlsx', 'main', 'admin', '2018-01-08 00:58:26', 28300, 'xlsx'),
(107, 'Active Cases(5).xlsx', 'root', 'admin', '2018-01-08 02:22:20', 28300, 'xlsx'),
(108, '285636236BA28AAB-6E32-48D8-914A-C441664E4FE3.png', 'tess', 'admin', '2018-01-08 02:25:48', 376085, 'png'),
(109, '&&Product_Deployment_Sign Off_v1.4.docx', 'baby', 'admin', '2018-01-08 02:29:38', 50450, 'docx'),
(110, 'Import_BF_payroll_sample.xlsx', 'unkownn', 'admin', '2018-01-08 02:33:02', 15766, 'xlsx'),
(111, 'INSTAPAY ESB V3-R15_Product_Deployment_Sign Off.docx', 'mike', 'admin', '2018-01-08 02:34:03', 46872, 'docx'),
(112, 'HSBF_MOBILEAPP_PROPOSAL.docx', 'sheri', 'admin', '2018-01-08 02:36:22', 1598294, 'docx'),
(113, 'ceaserDOc.docx', 'kekek', 'admin', '2018-01-08 02:37:52', 18928, 'docx'),
(114, 'Kiuwan Eclipse Integration Guide V3.0.pdf', 'unkownn', 'admin', '2018-01-08 02:38:57', 660960, 'pdf'),
(115, 'hjhfasjf', 'main', 'admin', '2018-04-20 06:20:57', 1, 'folder');

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_dropdown`
--

CREATE TABLE `dynamic_dropdown` (
  `id` int(11) NOT NULL,
  `product` varchar(128) NOT NULL,
  `monthNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dynamic_dropdown`
--

INSERT INTO `dynamic_dropdown` (`id`, `product`, `monthNumber`) VALUES
(1, '4', 1),
(2, '5', 1),
(3, '5', 2),
(4, '5', 3),
(5, '5', 4),
(6, '5', 5),
(7, '5', 6),
(8, '5', 7),
(9, '5', 8),
(10, '5', 9),
(11, '5', 10),
(12, '5', 11),
(13, '5', 12);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `sent_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sent_to` varchar(40) NOT NULL,
  `sent_by` varchar(40) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `email_message` varchar(300) NOT NULL,
  `attach_direc` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `sent_time`, `sent_to`, `sent_by`, `subject`, `email_message`, `attach_direc`) VALUES
(1, '2017-12-17 04:12:26', 'mutindamike@gmail.com', 'admin', 'mike', '<p><em>michaek mutinda</em></p>\r\n\r\n<p><em><s>asdfajksdhfjkaf</s></em></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em><s>ashfsjkdhfkajsdhfjkjkahsdjkfhasjkdf</s></em></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', ''),
(2, '2017-12-17 07:12:06', 'mutindamike@gmail.com', 'admin', 'hello there', '<p>The original email</p>\r\n', 'http://localhost:8080/lawyer/assets/Emailatachments/HELB01914-Oct-2017Payslips9.pdf'),
(3, '2017-12-17 07:12:13', 'mutindamike@gmail.com', 'admin', 'Testing ', '<p>Testing</p>\r\n', ''),
(4, '2017-12-17 07:12:05', 'mutindamike@gmail.com', 'admin', 'tess', '<p>Testing</p>\r\n', ''),
(5, '2017-12-17 23:12:52', 'mutindamike@gmail.com', 'admin', 'sdgdfg', '<p>sgsdfgdf</p>\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `case_ref` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `amount` varchar(20) NOT NULL,
  `account` varchar(40) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `case_ref`, `date`, `created_by`, `created_at`, `amount`, `account`, `description`) VALUES
(2, '453645', '2017-02-01', 'admin', '2017-12-19 09:26:12', '536', 'TRANSPORT', 'Transport expenses'),
(3, '453645', '2017-03-09', 'admin', '2017-12-31 07:53:50', '10000', 'TRANSPORT', 'internet expenses'),
(4, '453645', '2017-03-09', 'admin', '2017-12-31 07:54:38', '5000', 'TRANSPORT', 'research expenses'),
(5, '001', '2017-12-08', 'admin', '2017-12-31 06:07:20', '900', 'TELEPHONE', 'some descrition here...'),
(6, '323665', '2017-12-06', 'admin', '2017-12-31 08:08:17', '6000', 'TRANSPORT', 'paid by mike'),
(7, '001', '2017-12-07', 'admin', '2017-12-31 08:16:24', '904', 'TELEPHONE', 'bla bla bla'),
(8, '323665', '2017-12-13', 'admin', '2017-12-31 08:39:04', '3000', 'TRANSPORT', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `firebase`
--

CREATE TABLE `firebase` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE `installments` (
  `id` int(11) NOT NULL,
  `order_number_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(20) NOT NULL,
  `orderNumber` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `service_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `due_date` date NOT NULL,
  `case_ref` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `location` varchar(30) NOT NULL,
  `assigned_staff` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `client_id`, `amount`, `service_id`, `status`, `created_at`, `created_by`, `due_date`, `case_ref`, `description`, `location`, `assigned_staff`) VALUES
(1, 14, '9090', 5, 'CLOSED', '2017-12-21 23:14:37', 'admin', '2018-12-15', '09209', 'kasjdkfasjdf', 'unkown', 3),
(2, 11, '3434', 3, 'OPEN', '2017-12-22 05:01:48', 'admin', '2018-12-08', '323665', '252345', 'sdgsdfg', 3),
(3, 11, '3434', 3, 'OPEN', '2017-12-22 05:03:52', 'admin', '2018-12-13', '323665', '252345', 'sdgsdfg', 3),
(4, 11, '3434', 3, 'OPEN', '2018-01-08 09:51:10', 'admin', '2018-01-03', '323665', '252345', 'sdgsdfg', 3),
(5, 15, '8000', 4, 'OPEN', '2018-01-08 09:52:29', 'admin', '2018-01-18', 'somewierdrefno', 'alhfklasd', 'Kisumu', 2);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1512637438),
('m130524_201442_init', 1512637448),
('m140209_132017_init', 1512640021),
('m140403_174025_create_account_table', 1512640023),
('m140504_113157_update_tables', 1512640032),
('m140504_130429_create_token_table', 1512640033),
('m140830_171933_fix_ip_field', 1512640033),
('m140830_172703_change_account_table_name', 1512640034),
('m141222_110026_update_ip_field', 1512640034),
('m141222_135246_alter_username_length', 1512640035),
('m150614_103145_update_social_account_table', 1512640038),
('m150623_212711_fix_username_notnull', 1512640038),
('m151218_234654_add_timezone_to_profile', 1512640039),
('m160929_103127_add_last_login_at_to_user_table', 1512640040);

-- --------------------------------------------------------

--
-- Table structure for table `new_case`
--

CREATE TABLE `new_case` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `opening_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `service` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `ref_no` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_case`
--

INSERT INTO `new_case` (`id`, `client_id`, `opening_date`, `status`, `staff_id`, `amount`, `location`, `service`, `description`, `ref_no`, `created_by`, `created_at`) VALUES
(1, 11, '2018-12-09', 'CLOSED', 2, '25345', '245325', '3', '252345', '001', 'admin', '2017-12-19 00:48:37'),
(2, 11, '2018-11-02', 'OPEN', 3, '3434', '43434', '3', '252345', '323665', 'admin', '2017-12-19 00:49:06'),
(3, 15, '2018-01-09', 'OPEN', 2, '8000', 'nrb', '4', 'alhfklasd', 'somewierdrefno', 'admin', '2018-01-08 08:59:38'),
(4, 15, '2018-01-23', 'CLOSED', 3, '678', 'rdfxdfas', '2', 'shgdfsh', 'wertwert', 'admin', '2018-01-08 09:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quotation_amount` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_number` varchar(60) NOT NULL,
  `deposit` varchar(40) NOT NULL,
  `payment_option` varchar(40) NOT NULL,
  `number_of_installment` int(11) DEFAULT NULL,
  `date_of_order` date NOT NULL,
  `sla_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `product_id`, `quotation_amount`, `quantity`, `order_number`, `deposit`, `payment_option`, `number_of_installment`, `date_of_order`, `sla_status`, `created_at`, `created_by`) VALUES
(1, 1, 1, '300000', 1, 'CRY/OD/', '0.00', 'one', NULL, '2017-12-20', 1, '2017-12-03 00:12:31', 'admin'),
(2, 1, 1, '300000', 1, 'CRY/OD/', '0.00', 'one', NULL, '2017-12-20', 1, '2017-12-03 00:12:11', 'admin'),
(3, 1, 1, '34343', 1, 'CRY/OD/', '0.00', 'one', NULL, '2017-12-13', 0, '2017-12-03 00:12:52', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `organaizationdetails`
--

CREATE TABLE `organaizationdetails` (
  `id` int(11) NOT NULL,
  `orgname` varchar(40) NOT NULL,
  `contacts` varchar(50) NOT NULL,
  `building` varchar(40) NOT NULL,
  `location` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contactPerson` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organaizationdetails`
--

INSERT INTO `organaizationdetails` (`id`, `orgname`, `contacts`, `building`, `location`, `email`, `contactPerson`) VALUES
(1, 'Michael and Mutinda Advocates', '0716630770', 'Utawala house', 'Nairobi,Kenya', 'mutindamike@gmail.com', '0716630770');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `p_amount` varchar(30) NOT NULL,
  `pay_date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `client_id`, `product_id`, `p_amount`, `pay_date`, `description`, `created_by`, `created_at`) VALUES
(3, 14, 1, '40000', '2018-12-15', 'this is the secondpayment', 'admin', '2017-12-16 05:12:17'),
(2, 11, 1, '8000', '2018-10-04', 'this is the first payment', 'admin', '2017-12-16 05:12:17'),
(4, 11, 3, '2929', '2018-01-01', 'some comments  here', 'admin', '2017-12-31 23:01:34'),
(5, 15, 0, '0804', '2018-01-02', 'sgsdfg', 'admin', '2018-01-08 08:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `pipeline`
--

CREATE TABLE `pipeline` (
  `id` int(11) NOT NULL,
  `clients_id` int(11) NOT NULL,
  `comments` varchar(300) NOT NULL,
  `status` varchar(200) NOT NULL,
  `weaknesses` varchar(300) NOT NULL,
  `action_plan` varchar(300) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `action_plan_date` date NOT NULL,
  `action_plan_status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `payment_option` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `payment_option`) VALUES
(1, 'lawyer package one', 'one'),
(2, 'Commercial', 'one'),
(3, 'Criminal', ''),
(4, 'Family', ''),
(5, 'Insuarance', ''),
(6, 'Commercial', 'one'),
(7, 'Family law', 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int(11) NOT NULL,
  `from_` varchar(128) DEFAULT NULL,
  `to_` varchar(128) DEFAULT NULL,
  `message` varchar(128) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms`
--

INSERT INTO `sms` (`id`, `from_`, `to_`, `message`, `timestamp`) VALUES
(850, 'M-Lawyer', '0716630770', 'hi mike', '2018-01-14 07:01:30'),
(851, 'M-Lawyer', '0716630770', 'drty', '2018-01-14 07:01:54'),
(852, 'M-Lawyer', 'All members', 'jhdfj', '2018-01-14 07:01:13'),
(853, 'M-Lawyer', 'All members', 'hkgsdfjkd', '2018-01-14 07:01:16'),
(854, 'M-Lawyer', 'All members', 'asfadf', '2018-01-14 07:01:53'),
(855, 'M-Lawyer', 'All members', 'fdafa', '2018-01-14 07:01:02'),
(856, 'M-Lawyer', 'All members', 'sdfsdg', '2018-01-14 07:01:31'),
(857, 'M-Lawyer', 'All members', 'sgdfg', '2018-01-14 07:01:28'),
(858, 'M-Lawyer', 'All members', 'sdfsdf', '2018-01-14 07:01:12'),
(859, 'M-Lawyer', 'All members', 'csfmsf', '2018-01-14 07:01:04'),
(860, 'M-Lawyer', 'All members', 'sfgsg', '2018-01-14 08:01:44'),
(861, 'M-Lawyer', 'All members', 'fsdfsd', '2018-01-14 08:01:42'),
(862, 'M-Lawyer', 'All members', 'djshfsj', '2018-01-14 08:01:55'),
(863, 'M-Lawyer', 'All clients', 'hselleajflksd ni kusime', '2018-01-14 08:01:58'),
(864, 'M-Lawyer', 'OFFICIALS', 'asgas', '2018-01-14 08:01:34'),
(865, 'M-Lawyer', '0716630770', '5345', '2018-01-14 09:01:55'),
(866, 'M-Lawyer', 'All clients', 'uigyu', '2018-01-13 23:01:25'),
(867, 'M-Lawyer', '0716630770', 'fefdg', '2018-01-14 02:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `id` int(11) NOT NULL,
  `class_code` varchar(128) NOT NULL,
  `class_desc` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cust`
--

CREATE TABLE `tbl_cust` (
  `cust_no` int(11) NOT NULL,
  `cust_Idno` int(11) NOT NULL,
  `cust_F_Name` varchar(64) NOT NULL,
  `cust_M_Name` varchar(64) NOT NULL,
  `cust_L_Name` varchar(64) NOT NULL,
  `cust_Email_Address` varchar(128) NOT NULL,
  `cust_Telephone` varchar(20) NOT NULL,
  `cust_Mpesa_Telephone` varchar(20) NOT NULL,
  `c_Gender` enum('MALE','FEMALE') NOT NULL,
  `Staffno` varchar(10) NOT NULL,
  `c_Marital_Status` enum('MARRIED','DIVORCED','SEPERATED','SINGLE') NOT NULL,
  `designation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cust`
--

INSERT INTO `tbl_cust` (`cust_no`, `cust_Idno`, `cust_F_Name`, `cust_M_Name`, `cust_L_Name`, `cust_Email_Address`, `cust_Telephone`, `cust_Mpesa_Telephone`, `c_Gender`, `Staffno`, `c_Marital_Status`, `designation`) VALUES
(1, 23563612, 'MICHAEL', 'MUTINDA', 'MAKAU', 'mutindamike@gmail.com', '0716630770', '0716630770', 'MALE', 'admin', 'MARRIED', 'fasgdfsggf'),
(2, 12345678, 'mike', 'mike', 'mike', 'mutindamike@gmail.com', '0716630770', '0716630770', 'FEMALE', '7606', 'MARRIED', 'dsfgdfg'),
(3, 9876543, 'mihfasjk', 'mahami', 'lasrname', 'mutindamike@gmail.com8', '0716630770', '0716630770', 'FEMALE', '908023', 'MARRIED', 'sdfgsdg'),
(4, 44364545, 'dhrdhdfh', 'hdfghdh', 'dhfghd', 'hert@gsfd.vo', '0716630770', '0716630770', 'MALE', '878', 'MARRIED', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE `tbl_event` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `created_date` date NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `assigned_to` varchar(30) NOT NULL,
  `allDay` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`id`, `title`, `description`, `created_date`, `start_time`, `end_time`, `assigned_to`, `allDay`) VALUES
(9, 'nyeri meeting', 'help a client solve a case', '2017-12-09', '2017-12-09 00:45:44', '2017-12-11 02:45:44', 'admin', 1),
(10, 'asfdf', 'asdfasdf', '2017-12-09', '2017-12-14 07:50:38', '2017-12-06 07:30:38', 'admin', 1),
(11, 'akajhfak', 'khakfhdsk', '2017-12-09', '2017-12-13 23:55:41', '2017-12-21 00:50:41', 'admin', 0),
(12, 'some ', 'mkfskn', '2018-01-14', '2018-01-10 07:50:02', '2018-01-16 23:35:02', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_file`
--

CREATE TABLE `uploaded_file` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `path` varchar(256) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uploaded_file`
--

INSERT INTO `uploaded_file` (`id`, `name`, `path`, `size`, `type`) VALUES
(1, 'Applications.png', 'C:/wamp64/www/lawyer/frontend/web/assets/profile/admin.png', 45350, 'png'),
(2, 'Applications.png', '/assets/profile/admin.png', 45350, 'png'),
(3, 'Applications.png', '/assets/profile/admin.png', 45350, 'png'),
(4, '20171210_172434.jpg', '/assets/profile/admin.jpg', 70582, 'jpg'),
(5, 'homeimage.jpg', '/assets/profile/admin.jpg', 90578, 'jpg'),
(6, 'sky.jpg', '/assets/profile/admin.jpg', 108979, 'jpg'),
(7, 'homeimage.jpg', '/assets/profile/admin.jpg', 90578, 'jpg'),
(8, '20171210_172434.jpg', '/assets/profile/admin.jpg', 70582, 'jpg'),
(9, 'anniversaryjpg.jpg', '/assets/profile/admin.jpg', 52471, 'jpg'),
(10, 'Klaus.jpg', '/assets/profile/admin.jpg', 112601, 'jpg'),
(11, '20171210_172434.jpg', '/assets/profile/admin.jpg', 70582, 'jpg'),
(12, 'DSC_0951.jpg', '/assets/profile/admin.jpg', 112385, 'jpg'),
(13, 'DSC_0951.jpg', '/assets/profile/admin.jpg', 112385, 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`) VALUES
(14, 'admin', 'mutindamike@gmail.com', '$2y$13$w6MquzWSxBODUlRFbbBwFOgyAyyO4i7IdHjJdagWci5.bOTCLBuWC', '1LM9x_PmUfUBv24u_F7dIHGZP5L5UOee', 1512647137, NULL, NULL, '::1', 1512646865, 1512917586, 0, 1527097225);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actionplans`
--
ALTER TABLE `actionplans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firebase`
--
ALTER TABLE `firebase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `new_case`
--
ALTER TABLE `new_case`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Indexes for table `tbl_cust`
--
ALTER TABLE `tbl_cust`
  ADD PRIMARY KEY (`cust_no`);

--
-- Indexes for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Indexes for table `uploaded_file`
--
ALTER TABLE `uploaded_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_username` (`username`),
  ADD UNIQUE KEY `user_unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `firebase`
--
ALTER TABLE `firebase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `new_case`
--
ALTER TABLE `new_case`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=868;
--
-- AUTO_INCREMENT for table `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_cust`
--
ALTER TABLE `tbl_cust`
  MODIFY `cust_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_event`
--
ALTER TABLE `tbl_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `uploaded_file`
--
ALTER TABLE `uploaded_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
