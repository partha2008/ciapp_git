-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2017 at 06:46 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automationblueprintmailadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `categoryname` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0',
  `date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `categoryname`, `code`, `is_active`, `date_added`) VALUES
(1, 'Labor Price', 'labor-price', '1', 1482340476),
(2, 'Letter Design', 'letter-design', '1', 1482346990),
(3, 'Letter Envelope', 'letter-envelope', '1', 1482347020),
(4, 'Letter Ink Color', 'letter-ink-color', '1', 1482347783),
(5, 'Letter Paper Color', 'letter-paper-color', '1', 1482347802),
(6, 'Letter Postage', 'letter-postage', '1', 1482347810),
(7, 'Postcard Design Large', 'postcard-design-large', '1', 1482347820),
(8, 'Postcard Design Medium', 'postcard-design-medium', '1', 1482347830),
(9, 'Postcard Design Small', 'postcard-design-small', '1', 1482347844),
(10, 'Postcard Ink Color Small', 'postcard-ink-color-small', '1', 1483687334),
(13, 'Postcard Labor Price', 'postcard-labor-price', '1', 1482347901),
(14, 'Postcard Paper Color Small', 'postcard-paper-color-small', '1', 1483686593),
(15, 'Postcard Postage Small', 'postcard-postage-small', '1', 1482347920),
(16, 'Postcard Postage Large', 'postcard-postage-large', '1', 1482347928),
(17, 'Postcard Postage Medium', 'postcard-postage-medium', '1', 1482347936),
(18, 'Postcard Size', 'postcard-size', '1', 1483687489),
(19, 'Postcard Paper Color Medium', 'postcard-paper-color-medium', '1', 1483686642),
(20, 'Postcard Paper Color Large', 'postcard-paper-color-large', '1', 1483686652),
(21, 'Postcard Ink Color Medium', 'postcard-ink-color-medium', '1', 1484207862),
(22, 'Postcard Ink Color Large', 'postcard-ink-color-large', '1', 1483687394);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `cms_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `mode` varchar(255) NOT NULL,
  `date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`cms_id`, `title`, `description`, `mode`, `date_added`) VALUES
(1, 'Terms & Conditions', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'term', 1488725194),
(2, 'Privacy & Policy', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n', 'privacy', 1483126741);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `coupon_code`, `discount`, `is_active`, `date_added`) VALUES
(1, 'test', 12.00, '1', 1486723901),
(2, 'test1', 12.75, '1', 1488395031);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mailing_dates`
--

CREATE TABLE `mailing_dates` (
  `mailing_date_id` int(11) NOT NULL,
  `mailer` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `paper` varchar(255) NOT NULL,
  `ink` varchar(255) NOT NULL,
  `envelope` varchar(255) NOT NULL,
  `postage` varchar(255) NOT NULL,
  `per` float NOT NULL,
  `total` float(10,2) NOT NULL,
  `proof_pdf` varchar(255) NOT NULL,
  `date` int(11) NOT NULL COMMENT 'Desired Mail Date',
  `proofapproved_date` int(11) NOT NULL,
  `proofsent_date` int(11) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0: Awaiting Client Proof approval, 1: Proof aproved Awaiting mail Drop, 2: Mail Sent, 3: Refunded'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mailing_dates`
--

INSERT INTO `mailing_dates` (`mailing_date_id`, `mailer`, `order_id`, `quantity`, `type`, `item`, `paper`, `ink`, `envelope`, `postage`, `per`, `total`, `proof_pdf`, `date`, `proofapproved_date`, `proofsent_date`, `status`) VALUES
(1, 'mailer1', 1, 464, 'Postcard - 4.25 x 5.5', 'AO2-S', 'Yellow - $.015', 'Black - $.026', '', 'First Class Stamp - Delivery time: 1-7 days after mail date - $ 0.37 Each', 0.63, 292.32, '', 1486684800, 0, 0, '2'),
(2, 'mailer1', 2, 355, 'Letter', 'Handwritten Stationery Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.89, 315.95, '', 0, 0, 0, '0'),
(3, 'mailer1', 3, 171, 'Letter', 'Typewriter Old Style', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.58, 269.33, '', 1485820800, 1485648000, 0, '2'),
(4, 'mailer1', 4, 474, 'Postcard - 4.25 x 5.5', 'CD11-S', 'Yellow - $.015', 'Black - $.026', '', 'First Class Presort Stamp w/Cancellation - Delivery time: 1-7 days after mail date - $.33 each 500 or more', 0.63, 298.62, '', 1485993600, 0, 0, '2'),
(5, 'mailer1', 5, 100, 'Letter', 'Google Earth House Image Letter', 'White - $.02', 'Color - $.14', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'First Class Stamp - $ 0.49 Each', 2.19, 219.00, '', 1484524800, 0, 0, '2'),
(6, 'mailer1', 6, 250, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '6 X 9 PRIORITY ENVELOPE - $.25<br>(Black Ink, Typed Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.1, 275.00, '', 1486512000, 1486080000, 0, '2'),
(7, 'mailer1', 7, 253, 'Letter', 'Handwritten Yellow Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 1.08, 271.98, '', 1486512000, 0, 0, '2'),
(8, 'mailer1', 7, 253, 'Letter', 'Handwritten Yellow Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 1.08, 271.98, '', 1487116800, 0, 0, '3'),
(9, 'mailer2', 7, 253, 'Postcard - 4.25 x 5.5', 'BA-S', 'Yellow', 'Color', '', 'First Class Presort Indicia - Delivery time: 1-7 days after mail date', 0.58, 147.12, '', 1487721600, 0, 0, '2'),
(10, 'mailer1', 9, 118, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'First Class Stamp - $ 0.49 Each', 1.57, 185.26, '', 4147200, 1487203200, 0, '2'),
(11, 'mailer1', 10, 100, 'Postcard - 5.5 x 8.5', 'GE2-M', 'Astrobright Yellow', 'Black', '', 'First Class Presort Indicia - Delivery Time: 1-7 Days After Mail Date', 0.99, 99.10, '1486502870.pdf', 1486944000, 0, 1486425600, '2'),
(12, 'mailer1', 11, 500, 'Letter', 'Typewriter Old Style', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'Standard Presort Indicia - $. 31 each - 200 or More', 0.81, 402.50, '1486504334.pdf', 1486339200, 0, 1486425600, '0'),
(13, 'mailer1', 12, 100, 'Letter', 'Handwritten Letter on White Lined', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'First Class Stamp - $ 0.49 Each', 1.57, 157.00, '1486499353.pdf', 1486684800, 1486425600, 1486425600, '2'),
(14, 'mailer1', 13, 100, 'Postcard - 5.5 x 8.5', 'GE1-M', 'Astrobright Yellow', 'Color', '', 'First Class Presort Indicia - Delivery Time: 1-7 Days After Mail Date', 1.03, 102.75, '', 1486684800, 1486512000, 1486512000, '2'),
(15, 'mailer1', 14, 2838, 'Postcard - 4.25 x 5.5', 'GE2-S', 'White', 'Color', '', 'First Class Presort Stamp w/Cancellation - Delivery time: 1-7 days after mail date', 0.49, 1394.88, '', 1486944000, 1486512000, 1486512000, '2'),
(16, 'mailer1', 15, 101, 'Letter', 'Handwritten Yellow Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'First Class Stamp - $ 0.49 Each', 1.57, 159.07, '1486500387.pdf', 1486944000, 1486598400, 1486425600, '2'),
(17, 'mailer1', 16, 250, 'Letter', 'Typewriter Old Style', 'Yellow - $.025', 'Black - $.02', 'A8 INVITATION - CREAM - $.13<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.99, 246.25, '1486503745.pdf', 1487894400, 1487635200, 1486425600, '2'),
(18, 'mailer1', 17, 100, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'First Class Stamp - $ 0.49 Each', 1.57, 157.00, '', 1489017600, 0, 0, '0'),
(19, 'mailer2', 17, 100, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'First Class Stamp - $ 0.49 Each', 1.57, 157.00, '', 1487808000, 0, 0, '0'),
(20, 'mailer3', 17, 100, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'First Class Stamp - $ 0.49 Each', 1.57, 157.00, '1486501659.pdf', 1489017600, 0, 1486425600, '0'),
(21, 'mailer1', 18, 227, 'Postcard - 4.25 x 5.5', 'GE2-S', 'White', 'Color', '', 'First Class Stamp - Delivery time: 1-7 days after mail date', 0.93, 211.68, '1486505630.pdf', 1486684800, 1486425600, 1486425600, '2'),
(22, 'mailer1', 19, 270, 'Letter', 'Business Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'First Class Stamp - $ 0.49 Each', 1.07, 290.25, '1486675623.pdf', 1487030400, 1486598400, 1486598400, '2'),
(23, 'mailer2', 19, 270, 'Postcard - 5.5 x 8.5', 'GE1-M', 'Yellow', 'Color', '', 'Standard Presort Indicia - Delivery Time: 2-4 Weeks After Mail Date', 0.61, 164.03, '', 1488499200, 0, 0, '0'),
(24, 'mailer3', 19, 270, 'Postcard - 5.5 x 8.5', 'CD3-M', 'Astrobright Yellow', 'Black', '', 'Standard Presort Indicia - Delivery Time: 2-4 Weeks After Mail Date', 0.57, 154.17, '', 1491177600, 0, 0, '0'),
(25, 'mailer4', 19, 270, 'Postcard - 5.5 x 8.5', 'CD15-M', 'Astrobright Yellow', 'Black', '', 'Standard Presort Indicia - Delivery Time: 2-4 Weeks After Mail Date', 0.57, 154.17, '', 1493769600, 0, 0, '0'),
(26, 'mailer5', 19, 270, 'Postcard - 5.5 x 8.5', 'AO2-M', 'Astrobright Yellow', 'Black', '', 'Standard Presort Indicia - Delivery Time: 2-4 Weeks After Mail Date', 0.57, 154.17, '', 1493769600, 0, 0, '0'),
(27, 'mailer6', 19, 270, 'Postcard - 5.5 x 8.5', 'CD5-M', 'Yellow', 'Black', '', 'Standard Presort Indicia - Delivery Time: 2-4 Weeks After Mail Date', 0.57, 154.17, '', 1496620800, 0, 0, '0'),
(28, 'mailer1', 20, 157, 'Postcard - 4.25 x 5.5', 'GE1-S', 'White', 'Black', '', 'First Class Presort Stamp w/Cancellation - Delivery time: 1-7 days after mail date', 0.86, 134.39, '1486584679.pdf', 1487116800, 1486771200, 1486512000, '2'),
(29, 'mailer1', 21, 137, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', 'A8 INVITATION - CREAM - $.13<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.66, 227.42, '1487025121.pdf', 1486684800, 0, 1486944000, '2'),
(30, 'mailer1', 22, 154, 'Letter', 'Google Earth House Image Letter', 'White - $.02', 'Color - $.14', '6 X 9 PRIORITY ENVELOPE - $.25<br>(Black Ink, Typed Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 2.4, 369.60, '', 1487721600, 1487203200, 0, '2'),
(31, 'mailer2', 22, 154, 'Letter', 'Google Earth House Image Letter', 'White - $.02', 'Black - $.02', '6 X 9 PRIORITY ENVELOPE - $.25<br>(Black Ink, Typed Font)', 'Standard Presort Indicia - $. 31 each - 200 or More', 2.28, 351.12, '', 1487894400, 0, 0, '0'),
(32, 'mailer3', 22, 154, 'Letter', 'Google Earth House Image Letter', 'White - $.02', 'Black - $.02', '6 X 9 PRIORITY ENVELOPE - $.25<br>(Black Ink, Typed Font)', 'Standard Presort Indicia - $. 31 each - 200 or More', 2.28, 351.12, '', 1489104000, 0, 0, '0'),
(33, 'mailer1', 23, 500, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.8, 400.00, '1486676573.pdf', 1487116800, 1486684800, 1486598400, '2'),
(34, 'mailer1', 24, 1025, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.77, 784.13, '', 1487548800, 1487030400, 0, '2'),
(35, 'mailer2', 24, 1025, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.77, 784.13, '', 1487548800, 0, 0, '0'),
(36, 'mailer3', 24, 1025, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.77, 784.13, '', 1488153600, 0, 0, '0'),
(37, 'mailer1', 25, 271, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.89, 241.19, '1486677654.pdf', 1487548800, 1487030400, 1486598400, '2'),
(38, 'mailer2', 25, 271, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.89, 241.19, '', 1487548800, 0, 0, '0'),
(39, 'mailer3', 25, 271, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.89, 241.19, '', 1488153600, 0, 0, '0'),
(40, 'mailer1', 26, 117, 'Letter', 'Custom Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'First Class Stamp - $ 0.49 Each', 1.57, 183.69, '1486678904.pdf', 1487030400, 1486598400, 1486598400, '2'),
(41, 'mailer1', 27, 250, 'Letter', 'Business Letter', 'Cream - $.03', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.9, 225.00, '1486678397.pdf', 1486944000, 0, 1486598400, '0'),
(42, 'mailer1', 28, 143, 'Postcard - 4.25 x 5.5', 'GE2-S', 'Yellow', 'Black', '', 'First Class Stamp - Delivery Time: 1-7 days after mail date $.37 each', 0.9, 128.13, '', 1487030400, 0, 0, '0'),
(43, 'mailer1', 29, 250, 'Letter', 'Business Letter', 'Cream - $.03', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'First Class Stamp - $ 0.49 Each', 1.08, 270.00, '', 1487203200, 0, 0, '2'),
(44, 'mailer1', 30, 250, 'Letter', 'Business Letter', 'Cream - $.03', 'Black - $.02', '6 X 9 PRIORITY ENVELOPE - $.25<br>(Blue Ink, Handwritten Font. Use live stamp for personal look. Select postage type in next section.)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.11, 277.50, '1487021964.pdf', 1487808000, 1487635200, 1486944000, '2'),
(45, 'mailer2', 30, 250, 'Letter', 'Business Letter', 'Cream - $.03', 'Black - $.02', '6 X 9 PRIORITY ENVELOPE - $.25<br>(Blue Ink, Handwritten Font. Use live stamp for personal look. Select postage type in next section.)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.11, 277.50, '', 1487894400, 0, 0, '0'),
(46, 'mailer3', 30, 250, 'Letter', 'Business Letter', 'Cream - $.03', 'Black - $.02', '6 X 9 PRIORITY ENVELOPE - $.25<br>(Blue Ink, Handwritten Font. Use live stamp for personal look. Select postage type in next section.)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.11, 277.50, '', 1488499200, 0, 0, '0'),
(47, 'mailer4', 30, 250, 'Letter', 'Business Letter', 'Cream - $.03', 'Black - $.02', '6 X 9 PRIORITY ENVELOPE - $.25<br>(Blue Ink, Handwritten Font. Use live stamp for personal look. Select postage type in next section.)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.11, 277.50, '', 1489104000, 0, 0, '0'),
(48, 'mailer5', 30, 250, 'Letter', 'Business Letter', 'Cream - $.03', 'Black - $.02', '6 X 9 PRIORITY ENVELOPE - $.25<br>(Blue Ink, Handwritten Font. Use live stamp for personal look. Select postage type in next section.)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.11, 277.50, '', 1487894400, 0, 0, '0'),
(49, 'mailer1', 31, 115, 'Postcard - 4.25 x 5.5', 'BA-S', 'White', 'Color', '', 'First Class Stamp - Delivery Time: 1-7 days after mail date $.37 each', 0.93, 107.24, '', 1487116800, 0, 0, '0'),
(50, 'mailer1', 32, 100, 'Letter', 'Handwritten Yellow Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'First Class Stamp - $ 0.49 Each', 1.57, 157.50, '1487023560.pdf', 1487116800, 0, 1486944000, '0'),
(51, 'mailer1', 33, 100, 'Letter', 'Handwritten Stationery Letter', 'Cream - $.03', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.58, 158.00, '1487018298.pdf', 1487548800, 0, 1486944000, '0'),
(52, 'mailer1', 34, 100, 'Letter', 'Handwritten Yellow Letter', 'Cream - $.03', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 1.58, 158.00, '', 1487721600, 0, 0, '2'),
(53, 'mailer1', 35, 342, 'Postcard - 4.25 x 5.5', 'GE1-S', 'Astrobright Yellow', 'Color', '', 'First Class Stamp - Delivery Time: 1-7 days after mail date $.37 each', 0.65, 222.81, '1487266239.pdf', 1487635200, 1487203200, 1487203200, '2'),
(54, 'mailer1', 36, 232, 'Letter', 'Handwritten Letter on White Lined', 'White - $.02', 'Black - $.02', '6 X 9 PRIORITY ENVELOPE - $.25<br>(Black Ink, Typed Font)', 'Standard Presort Indicia - $. 31 each - 200 or More', 1.78, 412.96, '', 1487116800, 0, 0, '0'),
(55, 'mailer1', 37, 100, 'Letter', 'Typewriter Old Style', 'Yellow - $.025', 'Black - $.02', '#10 WINDOW ENVELOPE - WHITE - $.044<br>(Black Ink, Typed Font for return Address. Letter shows through window with typed font also.)', 'First Class Stamp - $ 0.49 Each', 1.58, 157.90, '', 1487289600, 0, 0, '0'),
(56, 'mailer1', 38, 268, 'Letter', 'Custom Letter', 'White - $.02', 'Black - $.02', 'A8 INVITATION - CREAM - $.13<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.98, 262.64, '1487020774.pdf', 1487203200, 0, 1486944000, '0'),
(57, 'mailer1', 39, 163, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.57, 255.91, '1487019805.pdf', 1487203200, 0, 1486944000, '0'),
(58, 'mailer1', 40, 105, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '6 X 9 AIR EX ENVELOPE - $.25<br>(Black Ink, Typed Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.78, 186.90, '1487019396.pdf', 1487203200, 0, 1486944000, '0'),
(59, 'mailer1', 41, 500, 'Letter', 'Handwritten Letter on White Lined', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presort First Class Indicia - $41 each 500 or more', 0.9, 450.00, '1487346430.pdf', 1487289600, 0, 1487289600, '0'),
(60, 'mailer1', 42, 299, 'Letter', 'Handwritten Yellow Letter', 'Yellow - $.025', 'Black - $.02', 'A8 INVITATION - CREAM - $.13<br>(Red Ink, Handwritten Font)', 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 1.17, 348.34, '1487348229.pdf', 1487548800, 0, 1487289600, '0'),
(61, 'mailer1', 43, 113, 'Postcard - 5.5 x 8.5', 'GE2-M', 'Astrobright Yellow', 'Black', '', 'First Class Forever - Delivery Time:1-7 days after mail date - $ 0.50 Each', 1.06, 119.89, '1487352037.pdf', 1487289600, 0, 1487289600, '0'),
(62, 'mailer1', 44, 500, 'Letter', 'Handwritten Yellow Letter', 'Cream - $.03', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'First Class Stamp - $ 0.49 Each', 0.99, 495.00, '', 1487894400, 0, 0, '2'),
(63, 'mailer1', 45, 171, 'Letter', 'Typewriter Old Style', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.58, 269.33, '1487281979.pdf', 1487548800, 0, 1487203200, '0'),
(64, 'mailer2', 45, 171, 'Postcard - 4.25 x 5.5', 'CD11-S', 'Yellow', 'Black', '', 'First Class Presort Indicia - Delivery Time: 1-7 days after mail date - 500 Min $.30 each', 0.9, 153.22, '1487352060.pdf', 1488153600, 0, 1487289600, '0'),
(65, 'mailer1', 46, 240, 'Postcard - 4.25 x 5.5', 'GE2-S', 'Blue', 'Black', '', 'First Class Stamp - Delivery Time: 1-7 days after mail date $.37 each', 0.9, 215.04, '1487351970.pdf', 1487548800, 0, 1487289600, '0'),
(66, 'mailer1', 47, 250, 'Letter', 'Business Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'Standard Presort Indicia - $. 31 each - 200 or More', 0.9, 223.75, '', 1487894400, 0, 0, '2'),
(67, 'mailer1', 48, 250, 'Letter', 'Streetview Mailers Letter', 'White - $.02', 'Color - $.14', 'A8 INVITATION - CREAM - $.13<br>(Blue Ink, Handwritten Font)', 'First Class Stamp - $ 0.49 Each', 1.63, 407.50, '', 1488240000, 0, 0, '2'),
(68, 'mailer1', 49, 250, 'Postcard - 5.5 x 11', 'GE1-L', 'Blue', 'Black', '', 'First Class Forever - Delivery Time:1-7 days after mail date - $ 0.49 Each', 1.18, 295.25, '', 1488240000, 0, 0, '2'),
(69, 'mailer2', 49, 250, 'Postcard - 5.5 x 8.5', 'CD11-M', 'Yellow', 'Color', '', 'First Class Presort Stamp w/Cancellation - Delivery Time: 1-7 days after mail date - 500 min. - $ 0.44 Each', 0.79, 196.88, '', 1488931200, 0, 0, '2'),
(70, 'mailer1', 50, 100, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'First Class Stamp - $ 0.49 Each', 1.57, 157.00, '1487720739.pdf', 1487808000, 0, 1487635200, '0'),
(71, 'mailer1', 51, 278, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'First Class Stamp - $ 0.49 Each', 1.07, 297.46, '1487720333.pdf', 1487721600, 0, 1487635200, '0'),
(72, 'mailer1', 52, 500, 'Postcard - 4.25 x 5.5', 'BA-S', 'Yellow', 'Black', '', 'First Class Presort Indicia - Delivery Time: 1-7 days after mail date - 500 Min $.30 each', 0.47, 237.50, '1487784782.pdf', 1488153600, 1487721600, 1487721600, '2'),
(73, 'mailer1', 53, 105, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.57, 164.85, '1487719949.pdf', 1487894400, 1487635200, 1487635200, '2'),
(74, 'mailer1', 54, 100, 'Letter', 'Business Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Standard Presort Indicia - $. 31 each - 200 or More', 1.57, 157.50, '', 1488240000, 0, 0, '2'),
(75, 'mailer1', 55, 501, 'Letter', 'Streetview Mailers Letter', 'White - $.02', 'Black - $.02', 'A8 INVITATION - CREAM - $.13<br>(Blue Ink, Handwritten Font)', 'First Class Stamp - $ 0.49 Each', 1.38, 688.88, '1487781379.pdf', 1488153600, 1487808000, 1487721600, '2'),
(76, 'mailer1', 56, 285, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.89, 253.65, '1487719418.pdf', 1487894400, 1487808000, 1487635200, '0'),
(77, 'mailer2', 56, 285, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.89, 253.65, '', 1489104000, 0, 0, '0'),
(78, 'mailer3', 56, 285, 'Letter', 'Business Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Blue Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 0.89, 253.65, '', 1490313600, 0, 0, '0'),
(79, 'mailer1', 57, 100, 'Letter', 'Streetview Mailers Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 2.08, 207.50, '', 1488153600, 0, 0, '0'),
(80, 'mailer1', 58, 100, 'Letter', 'Business Letter', 'Cream - $.03', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.58, 158.00, '', 1488240000, 0, 0, '2'),
(81, 'mailer1', 59, 100, 'Letter', 'Business Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 1.57, 157.50, '', 1488240000, 0, 0, '0'),
(82, 'mailer1', 59, 100, 'Letter', 'Business Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 1.57, 157.50, '', 1488240000, 0, 0, '0'),
(83, 'mailer1', 59, 100, 'Letter', 'Business Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 1.57, 157.50, '', 1488240000, 0, 0, '0'),
(84, 'mailer1', 59, 100, 'Letter', 'Business Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 1.57, 157.50, '', 1488240000, 0, 0, '0'),
(85, 'mailer1', 63, 220, 'Letter', 'Custom Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.57, 345.40, '', 1487894400, 0, 0, '0'),
(86, 'mailer1', 63, 220, 'Letter', 'Custom Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.57, 345.40, '', 1487894400, 0, 0, '0'),
(87, 'mailer1', 65, 220, 'Letter', 'Custom Letter', 'White - $.02', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Black Ink, Typed Font)', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 1.57, 345.40, '1487718879.pdf', 1488153600, 1487721600, 1487635200, '2'),
(88, 'mailer1', 66, 250, 'Letter', 'Streetview Mailers Letter', 'White - $.02', 'Black - $.02', '6 X 9 PRIORITY ENVELOPE - $.25<br>(Black Ink, Typed Font)', 'Presort First Class Indicia - $41 each 500 or more', 1.63, 407.50, '', 1487894400, 0, 0, '0'),
(89, 'mailer1', 67, 250, 'Letter', 'Streetview Mailers Letter', 'White - $.02', 'Black - $.02', '6 X 9 PRIORITY ENVELOPE - $.25<br>(Black Ink, Typed Font)', 'Presort First Class Indicia - $41 each 500 or more', 1.63, 407.50, '1487781668.pdf', 1487894400, 0, 1487721600, '0'),
(90, 'mailer1', 68, 820, 'Postcard - 5.5 x 8.5', 'BA-M', 'White', 'Color', '', 'First Class Forever - Delivery Time:1-7 days after mail date - $ 0.50 Each', 0.75, 612.95, '1487779700.pdf', 1488153600, 1487721600, 1487721600, '2'),
(91, 'mailer1', 69, 100, 'Letter', 'Handwritten Letter on White Lined', 'Cream - $.03', 'Black - $.02', 'A8 INVITATION - CREAM - $.13<br>(Blue Ink, Handwritten Font)', 'First Class Stamp - $ 0.49 Each', 1.67, 167.00, '1487965826.pdf', 1487894400, 0, 1487894400, '0'),
(92, 'mailer1', 70, 100, 'Letter', 'Streetview Mailers Letter', 'Yellow - $.025', 'Black - $.02', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 2.08, 207.50, '', 1488240000, 0, 0, '0'),
(93, 'mailer1', 71, 100, 'Letter', 'Business Letter', 'White - $.02', 'Color - $.14', '#10 ENVELOPE - WHITE - $.04<br>(Red Ink, Handwritten Font)', 'First Class Stamp - $ 0.49 Each', 1.69, 169.00, '1487963296.pdf', 1488240000, 0, 1487894400, '0'),
(94, 'mailer1', 72, 100, 'Postcard - 4.25 x 5.5', 'CB-S', 'Yellow', 'Black', '', 'First Class Presort Stamp w/Cancellation - Delivery Time: 1-7 days after mail date - 500 Min $.33 each', 0.9, 89.60, '', 1, 1, 1, '2'),
(95, 'mailer1', 73, 100, 'Letter', 'Business Letter', 'Cream - $.03', 'Black - $.02', '6x9 ENVELOPE - BLUE - $.20<br>(Red Ink, Handwritten Font)', 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 2.12, 174.00, '', 2, 1, 1, '2'),
(96, 'mailer1', 74, 250, 'Postcard - 4.25 x 5.5', 'GE2-S Streetview Mailers', 'White', 'Color', '', 'First Class Presort Stamp w/Cancellation - Delivery Time: 1-7 days after mail date - 500 Min $.33 each', 0.65, 162.88, '', 1488240000, 0, 0, '0'),
(97, 'mailer1', 74, 250, 'Postcard - 4.25 x 5.5', 'GE2-S Streetview Mailers', 'White', 'Color', '', 'First Class Presort Stamp w/Cancellation - Delivery Time: 1-7 days after mail date - 500 Min $.33 each', 0.65, 162.88, '', 1488240000, 0, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `billingAddress` text NOT NULL,
  `billing_city` varchar(255) NOT NULL,
  `billing_state` varchar(255) NOT NULL,
  `card_no` varchar(255) NOT NULL,
  `card_id` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `orderid` varchar(255) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `comp_name` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `phone_num` varchar(255) NOT NULL,
  `cell_num` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `qnty` int(11) NOT NULL,
  `tel_num` varchar(255) NOT NULL,
  `instruct` text NOT NULL,
  `return_addr` text NOT NULL,
  `grand_total` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: Inactive, 1: Active',
  `date_added` int(11) NOT NULL COMMENT 'Order Created Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `firstName`, `lastName`, `billingAddress`, `billing_city`, `billing_state`, `card_no`, `card_id`, `zip`, `orderid`, `month`, `year`, `first_name`, `last_name`, `comp_name`, `website`, `phone_num`, `cell_num`, `email`, `qnty`, `tel_num`, `instruct`, `return_addr`, `grand_total`, `user_id`, `status`, `date_added`) VALUES
(1, 'Tim', 'Green', '808 Hillendale Dr', 'Hattiesburg', 'Mississippi', '4447962291076135', '769', '39402', 'ORD-v5PIy', 0, 0, 'Tim', 'Green', 'GreenPointe Investment Group', 'gprealestateinvestments.com', '601-270-8911', '601-270-8911', 'gpinvestmentgroup@comcast.net', 464, '601-329-0775', '', '6068 Hwy 98 \r\nSuite 1-334\r\nHattiesburg, MS', 292.32, 14, '1', 0),
(2, 'Tyree', 'Mims', '13-15 Underwood Street', 'Newark', 'New Jersey', '5129925136034025', '727', '07106', 'ORD-4qr9s', 0, 0, 'Tyree', 'Mims', 'Ty''s Custom Homes ', '', '2674440632', '2674440632', 'tyscustomhomes@gmail.com', 355, '2674440632', '', '', 315.95, 13, '1', 0),
(3, 'Douglas', 'Carlton', '9149 Aspen Ave', 'California City', 'California', '5582508641330581', '832', '93505', 'ORD-BtbSw', 0, 0, 'Douglas', 'Carlton', 'Carlton Investments LLC', 'www.CarltonInvestments.org', '6614752747', '6618168417', 'dcarlton@mail.com', 171, '866-404-4800', '', '9149 Aspen Ave\r\nCalifornia City, CA 93505', 269.33, 12, '1', 0),
(4, 'Ywuana', 'Peden', '5115 just street ne', 'washington', 'District Of Columbia', '5148875075588951', '206', '20019', 'ORD-BVJBI', 0, 0, 'Ywuana', 'Peden', 'New Star, LLC', '', '2024090045', '', 'ywuanabuyshouses@gmail.com', 474, '202-409-0045', 'Call in the next 48 hrs and receive a free gift.', 'c/o monica ywuana peden\r\nrural free delivery 6089 central avenue \r\ncapitol heights, maryland republic without US', 298.62, 11, '1', 0),
(5, 'Ywuana', 'Peden', '219 Dateleaf Ave', 'Capitol hts', 'Maryland', '5571253006914504', '', '20743', 'ORD-3ueQ6', 0, 0, 'Ywuana', 'Peden', '', '', '', '2024090045', 'ywuanabuyshouses@gmail.com', 100, '202-409-0045', '', 'Ywuana Peden\r\n12138 Central Ave, 777\r\nMitchelville, MD 20721', 219, 11, '1', 0),
(6, 'Earl', 'Scott', '3253 NW 118th Dr', 'Coral Springs', 'Florida', '4737029061930070', '906', '33065', '198949', 11, 20, 'Earl', 'Scott', 'Score1 Property Solutions', '', '954-756-4585', '', 'score1ps@gmail.com', 250, '954-708-6697', '', '5944 Coral Ridge Dr #105\r\nCoral Springs, FL 33076', 275, 21, '1', 1485820800),
(7, 'Jeff', 'Charlton', '174 Chesterfield Ind. Blvd.', 'Chesterfield', 'Missouri', '4802137544209945', '889', '63005', '199040', 8, 17, 'Jeff', 'Charlton', 'Graphic Connections Group, LLC', 'www.gcfrog.com', '636-519-8320', '', 'jeff@gcfrog.com', 253, '636-519-8320', '', '', 271.98, 2, '1', 1485820800),
(8, 'Jeffrey', 'Charlton', '174Chesterfield Ind Blvd', 'Chesterfield', 'Missouri', '372722485481005', '3296', '63005', '199040', 7, 20, 'Jeffrey', 'Charlton', 'fg', 'dfg', '636-519-8320', '', 'jeff@gcfrog.com', 253, '636-519-8320', 'SDFg', 'DSFsg', 419.1, 2, '1', 1485903706),
(9, 'Gena', 'Horiatis', '1007 Sprague St', 'Edmonds', 'Washington', '376750770831002', '5612', '98020', '199056', 2, 20, 'John', 'Horiatis', 'Victory Ventures, Inc', '', '4259852441', '4259855339', 'jhoriatis@gmail.com', 100, '216-200-6216', '', '', 185.26, 23, '1', 1485907200),
(10, 'Salita', 'Duffy', '420 Clark Ave', 'San Antonio', 'Texas', '4552250031199073', '884', '78203', '199066', 2, 21, 'Salita', 'Duffy', 'Frankly Home Buyers', '', '(210)788-0918', '(210)788-0918', 'salitad323@yahoo.com', 100, '', '', '', 99.1, 24, '1', 1485907200),
(11, 'Aaron', 'Buchanan', '735 Wesley Ave.', 'Evanston', 'Illinois', '4833-1300-3258-2512', '889', '60202', '199412', 1, 20, 'Aaron', 'Buchanan', 'Champion Realty Group ', '', '', '8479620174', 'aaronbuchanan735@gmail.com', 500, '(847) 461-8725', '', '', 402.5, 26, '1', 1485993600),
(12, 'Sigmone', 'George', '7532 Jerez Court Unit 9', 'Carlsbad', 'California', '4120611008779887', '414', '92009', '199464', 6, 20, 'Sigmone', 'George', 'Liberty Real Estate Investments', '', '760-855-5110', '', 'LREINVESTINC@GMAIL.COM', 100, '760-845-5202', '', 'Liberty Real Estate Investments\r\n1140 Wall Street\r\nSuite 466\r\nLa Jolla, CA  92038', 157, 27, '1', 1485993600),
(13, 'Greg', 'Stetz', '10674 SW Westlawn Blvd', 'Port St Lucie', 'Florida', '5456240000626028', '364', '34987', '199635', 1, 18, 'Greg', 'Stetz', 'GoodBuy Houses', '', '5708810541', '5708810541', 'Gstetz2017@yahoo.com', 100, '5708810541', 'Call, text, or e-mail.', '', 102.75, 29, '1', 1486080000),
(14, 'Johnny', 'Stine', '6712 Inverness Dr', 'Fort Wayne', 'Indiana', '5590640000000818', '588', '46804', '199691', 7, 19, 'Johnny', 'Stine', 'Cash For Homes', 'www.FortWayneCashForHomes.com', '2604503115', '2604503115', 'johnnystine@gmail.com', 2838, '2604503115', '', '6712 Inverness Dr\r\nFort Wayne, IN 46804', 1394.88, 31, '1', 1486080000),
(15, 'Elsa', 'Martinez', '5009 S Green Tree', 'Corpus Christi', 'Texas', '4342490108096480', '407', '78405', '199929', 2, 18, 'Elsa', 'Martinez', 'Four Diamonds Innovative Solutions', 'http://connectedinvestors.com/website/four-diamonds-innovative-solutions', '361-510-0182', '', 'elsamartinezcc@gmail.com', 101, '361.287.6020', '', 'P. O. Box 5950\r\nCorpus Christi, Texas 78465-5950', 159.07, 32, '1', 1486166400),
(16, 'Roderick', 'Seward', '668 denisem ct', 'brick', 'New Jersey', '4117744053521477', '103', '08724', '200176', 10, 20, 'Roderick', 'Seward', 'Seward Real Estate Holdings', '', '7329480931', '7329480931', 'Rodseward3@gmail.com', 250, '7329480931', '', '668 Denise CT Brick,NJ 08724', 246.25, 17, '1', 1486339200),
(17, 'Tanner', 'Giffin', '307 S. Lincoln St.', 'Hillsboro', 'Kansas', '4647065133396204', '822', '67063', '200229', 2, 18, 'Tanner', 'Giffin', 'Lapwing Invest', '', '', '316-992-2497', 'tanner.giffin@yahoo.com', 100, '316-992-2497', '', '', 471, 34, '1', 1486339200),
(18, 'Mark', 'Boyd', '4080 BERRYBROOK RD', 'MEMPHIS', 'Tennessee', '379800022341008', '4481', '38115', '200243', 11, 21, 'Mark', 'Boyd', 'AGAPEHOMEBUYERS', 'agapehomebuyer.com', '901-300-6738', '901-568-2149', 'realityinvestments.901@gmail.com', 227, '9013006738', '', 'AGAPE HOMEBUYERS\r\nP.O. BOX 754468\r\nMEMPHIS,TN 38175', 211.68, 19, '1', 1486339200),
(19, 'Theodis', 'Williams', '361 LANGSTON HUGHES DRIVE', 'BURKVILLE', 'Alabama', '4737-0209-7697-6951', '262', '36752', '200402', 11, 19, 'Theodis', 'Williams', 'TR-Williams Properties', 'www.trwilliamsproperties.com', '3342210535', '3342210535', 'trwproperties@gmail.com', 100, '(334) 721-1465', '', 'TR-Williams Properties\r\n3066 Zelda Rd.\r\nPMB-361\r\nMontgomery, AL 36106', 1070.96, 38, '1', 1486425600),
(20, 'Greg', 'Stetz', '10674 SW Westlawn Blvd', 'Port St Lucie', 'Florida', '5178059405864480', '200', '34987', '200524', 10, 19, 'Greg', 'Stetz', 'GoodBuy Houses', '', '5708810541', '5708810541', 'Gstetz2017@yahoo.com', 157, '570-881-0541', '', '10674 SW Westlawn Blvd. Port St Lucie FL 34987', 134.39, 29, '1', 1486425600),
(21, 'DAL', 'Brar', '10555 DURREY CT', 'AURORA', 'Ohio', '4266841505507994', '602', '44202', '200562', 12, 21, 'Jagjit', 'Brar', 'JB VENTURES GROUP LLC.', 'www.linkedin.com/in/jagjit-brar', '2162539487', '2162539487', 'jagjit@jbventuresgroup.com', 137, '866-998-9006', '', 'JB VENTURES GROUP\r\n10555 DURREY CT.\r\nAURORA, OH 44202', 227.42, 39, '1', 1486512000),
(22, 'Joey', 'Mack', '3465 Lochwood Dr, Apt L49', 'Fort Collins', 'Colorado', '4037840078662531', '122', '80525', '200587', 1, 19, 'Joey', 'Mack', 'American Capital Investments LLC', '', '7018701179', '7018701179', 'americancapitalinvestmentsllc@gmail.com', 154, '1-970-372-0770', '', '3465 Lochwood Dr\r\nApt L49', 1071.84, 40, '1', 1486512000),
(23, 'Gregor', 'Destin', '689B Cranbury Cross Rd', 'North Brunswick', 'New Jersey', '4117746007166341', '340', '08902', '200610', 8, 20, 'Gregor', 'Destin', 'G Capital Realty', '', '8459015361', '8459015361', 'gregord30@gmail.com', 500, '', '', '689B Cranbury Cross Rd.\r\nNorth Brunswick NY 08902', 400, 41, '1', 1486512000),
(24, 'Richard', 'Pfadt', '2850 Norco Drive', 'Norco', 'California', '5589550049511449', '554', '92860', 'ORD-W2N09', 6, 20, 'Richard', 'Pfadt', 'High Standard Investments, LLC', 'www.highstandardinvestments.com', '', '714.231.1139', 'rick.hsihomes@gmail.com', 1025, '714.231.1139', '', '2850 Norco Drive,\r\nNorco, CA 92860', 2352.39, 25, '1', 1486512000),
(25, 'Richard', 'Pfadt', '2850 Norco Drive', 'Norco', 'California', '5589550049511449', '554', '92860', '200667', 6, 20, 'Richard', 'Pfadt', 'High Standard Investments, LLC', 'www.highstandardinvestments.com', '', '714.231.1139', 'rick.hsihomes@gmail.com', 271, '714.231.1139', '', '2850 Norco Drive,\r\nNorco, CA 92860', 723.57, 25, '1', 1486512000),
(26, 'Michal', 'Winiarek', '929 S DAKOTA AVE', 'TAMPA', 'Florida', '5196674202905621', '595', '33606', '200693', 8, 20, 'Mike', 'Winiarek', 'LLW Properties,  Inc.', '', '8137870361', '8137870361', 'leomihomes@gmail.com', 117, '', '', '929 S Dakota Ave\r\nTampa FL 33606', 183.69, 43, '1', 1486512000),
(27, 'Will', 'Moya', '2901 W. Busch Blvd, Suite 204', 'Tampa', 'Florida', '6011499487048843', '986', '33618', '200730', 3, 21, 'Will', 'Moya', 'Tampa Invest, LLC', 'www.fairofferfl.com', '813-344-1240', '813-598-8344', 'willmoya@gmail.com', 250, '813-344-1240', 'Please ad the the front of the envelope:\r\n\r\nAddress Service Requested', '2901 W. Busch Blvd\r\nSuite 204\r\nTampa FL 33618', 225, 44, '1', 1486512000),
(28, 'Azia', 'Martin', '7 E Main st', 'St. Charles', 'Illinois', '5348-7000-0082-6599', '333', '60174', '200848', 8, 20, 'Azia', 'Martin', 'Benefitsallproperties, LLC.', 'www.benefitsallproperties.com', '7734464424', '7734464424', 'zee@itbenefitsall@.com   itbenefitsall@gmail.com', 143, '773-446-4424', '', '7239 w 58th st\nSummit, Il 60501\nUnit 1', 128.13, 45, '1', 1486663509),
(29, 'Lauren', 'Klar', '174 Chesterfield ind blvd', 'chesterfield', 'Missouri', '4802137075868952', '094', '63005', 'ORD-aQf3i', 8, 17, 'lauren', 'Klar', 'gcg', 'sajdfklj', '', '', 'aksjfsjad@yahoo.com', 250, 'lkasjflsjal', '', 'asjfsalfjasljflaskjflasj;', 270, 46, '1', 1486598400),
(30, 'Gary', 'Coit', '17432 N 36th Ave.', 'Glendale', 'Arizona', '4750556092624068', '167', '85308', 'ORD-8CZwr', 9, 19, 'Gary', 'Coit', 'Gary Coit', '', '623-523-2840', '', 'garycoit@yahoo.com', 250, '623-523-2850', '5 drop campaign', '17432 N 36th Ave.\r\nGlendale, AZ 85308', 1387.5, 47, '1', 1486598400),
(31, 'Kenneth', 'thall', '777 s federal hwy aptG215', 'pompano beach', 'Florida', '5178059181091613', '644', '33062', '201021', 6, 21, 'Kenneth', 'thall', 'Kat Enterprises Ft Laud, LLC', '', '9545484300', '9545484300', 'gonedeep2@comcast.net', 115, '(754) 307-7536', '', 'Kat Enterprises Ft Laud, LLC\n1950 NE 6th St\nUnit 1175\nPompano Beach, Fl 33061', 107.24, 48, '1', 1486755964),
(32, 'Kenneth', 'Thall', '777 s federal hwy, Apt G215', 'pompano beach', 'Florida', '5178059181091613', '644', '33062', '201036', 6, 21, 'Ken', 'Thall', 'Kat Enterprises Ft Laud, LLC', '', '', '9545484300', 'gonedeep2@comcast.net', 100, '754 307-7536', '', 'Kat Enterprises Ft Laud, LLC\r\n1950 NE 6th St\r\nUnit 1175\r\nPompano Beach, Fl 33061', 157.5, 48, '1', 1486684800),
(33, 'Kevin', 'Coleman', '285 heritage lake dr', 'Faytteville', 'Georgia', '4741653995989060', '341', '30214', '201050', 6, 20, 'Vincent', 'Coleman', 'Siver lining', '', '770-310-0302', '770-310-0302', 'injun77@yahoo.com', 100, '', '', '', 158, 49, '1', 1486684800),
(34, 'Jeffrey', 'Charlton', '18749 Eatherton Valley Road', 'Wildwood', 'Missouri', '5528519103841533', '932', '63005', 'ORD-7dSYX', 1, 20, 'Jeffrey', 'Charlton', 'erf', 'ef', '636-519-8320', '', 'jeff@gcfrog.com', 100, '636-519-8320', 'rg', 'rg', 142.2, 2, '1', 1486684800),
(35, 'Calvin', 'McDaniels', '8612 Belgrove Gardens Ln', 'Gainesville', 'Virginia', '5466160417008115', '063', '20155', '201054', 9, 20, 'Calvin', 'McDaniels', 'CBM Housing Solutions LLC ', '', '703-334-6244', '703-859-2930', 'calvin@cbmholdingsllc.com', 342, '240-343-2100', '', '8612 Belgrove Gardens Ln\r\nGainesville, VA 20155', 222.81, 50, '1', 1486684800),
(36, 'Mark', 'Boyd', '4080 berrybrook rd', 'memphis', 'Tennessee', '379800022341008', '4481', '38115', '201068', 11, 21, 'Mark', 'Boyd', 'HOMES410K', '', '9015682149', '9015682149', 'homes410k.com', 232, '9013006738', '', 'HOMES410K\nP.O. BOX 754468\nMemphis, TN 38175', 412.96, 19, '1', 1486768833),
(37, 'Peterson', 'Sackie', '3822 81st. street', 'Urbandale', 'Iowa', '4744820001845035', '214', '50322', '201179', 1, 21, 'Peterson', 'Sackie', 'Todays Home Solution Pro.', 'www.todayshomesolutionpro.com', '', '(423) 930-5073', 'todayshomesolutionpro.com', 100, '(423)930-5073', 'Please do not put my email address, phone number and website on the outside of the envelope.\nThanks and God bless.', 'Peterson Sackie\n3822 81st.street\nUrbandale, IA  50322', 157.9, 51, '1', 1486850375),
(38, 'Carla', 'Stevenson', 'P.O. Box 1402', 'Norwalk', 'Connecticut', '4135-7710-0179-1660', '367', '06856', '201301', 5, 20, 'Carla', 'Stevenson', 'Keller Williams', '', '2035155119', '', 'cstevenson058@gmail.com', 268, '', '', 'P.O. Box 1402 \r\nNorwalk, CT 06856', 262.64, 52, '1', 1486857600),
(39, 'Anthony', 'Palumbo', '140 clubridge pl', 'Colorado Springs', 'Colorado', '4856200202453083', '880', '80906', '201305', 10, 19, 'Anthony', 'Palumbo', 'Kelton Enterprises LLC', '', '2102741763', '2102741763', 'tpalumbo@gmail.com', 163, '210-274-1763', '', '140 clubridge place\r\nColorado Springs, CO 80906', 255.91, 53, '1', 1486857600),
(40, 'Peterson', 'Sackie', '3822 81st. street', 'Urbandale', 'Iowa', '4744820001845035', '214', '50322', '201337', 1, 21, 'Peterson', 'Sackie', 'Todays Home Solution Pro.', 'www.todayshomesolutionpro.com', '', '', 'nayeelasackie@hotmail.com', 105, '(423) 930-5073', '', 'Peterson Sackie\r\n3822 81st. street\r\nUrbandale, IA 50322', 186.9, 51, '1', 1486944000),
(41, 'Edrick', 'Ward', '290 Needmore Rd  Ste 434', 'Clarksville', 'Tennessee', '4355410701605150', '466', '37040', '201512', 12, 18, 'Daniel', 'Ward', 'Jones United LLC', '', '6159775390', '6159775390', 'contractmoneyinvestments@gmail.com', 500, '(210)816-2271', 'Please put the company name on the envelope.\r\n\r\nPlease call Edrick at (615)977-5390 if you have any questions regarding this order.', '3434 Oakdale St Apt 809\r\nSan Antonio, TX 78229', 450, 37, '1', 1487030400),
(42, 'Mike', 'Cathey', '4108 Olympia Drive', 'Bryant', 'Arkansas', '4494-5055-6387-6583', '839', '72022', '201631', 12, 18, 'Mike', 'Cathey', 'Inspired Property Solutions', '', '5014252258', '5014252258', 'info@InspiredPSLLC.com', 299, '501-503-2341', '', 'Mike Cathey\r\nP.O Box 30471\r\nLittle Rock, AR 72260', 348.34, 59, '1', 1487030400),
(43, 'Chris', 'Lackey', '83 Steuber Road', 'Leasburg', 'Missouri', '4791248653820480', '025', '65535', '201728', 7, 19, 'Chris', 'Lackey', 'WillCloseFast.com', 'www.WillCloseFast.com', '(636) 358-4160', '', 'webuy@willclosefast.com', 113, '(314) 669-6002', '', '83 Steuber Road\r\nLeasburg, MO  65535', 119.89, 60, '1', 1487116800),
(44, 'lauren', 'klar', '174 chesterfield ind blvd', 'chesterfield', 'Missouri', '4802137075868952', '094', '63005', 'ORD-hSeQJ', 8, 17, 'fdgsd', 'klar', '', 'dsgsd', '', '', 'klar.lauren@gmail.com', 100, '', '', 'sgsdfg', 396, 46, '1', 1487116800),
(45, 'John', 'Wiatrak', '10790 Bel Air Dr.', 'Chery Valley', 'California', '5520-3000-8919-9362', '526', '92223', '201917', 10, 19, 'John', 'Wiatrak', 'Wiatrak Holdings LLC', 'http://connectedinvestors.com/website/wiatrak-holdings-llc-3', '', '909-648-8288', 'jwiatrak13@verizon.net', 171, '(909) 648-8288', '', 'Wiatrak Holdings LLC\r\n10790 Bel Air Dr.\r\nCherry Valley. Ca 92223', 422.55, 61, '1', 1487116800),
(46, 'Debbi', 'Rivero', '3301 Fox Valley Dr.', 'WEST FRIENDSHIP', 'Maryland', '4313-0723-3543-9504', '283', '21794', '201996', 12, 18, 'Debbi', 'Rivero', 'Re/Max Advantage', 'www.debbirivero.com', '4433861306', '4433861306', 'debbi.rivero@yourkeyconsultants.com', 240, '443-386-1306', '', '', 215.04, 62, '1', 1487203200),
(47, 'lauren', 'klar', '174 chesterfield ind blvd', 'chesterfield', 'Missouri', '4802137075868952', '094', '63005', '202316', 8, 17, 'Demo', 'klar', 'na', '', '66666544', '', 'demo@thepoweroffreerealestate.com', 250, '', '', '', 223.75, 46, '1', 1487289600),
(48, 'Lauren', 'Klar', '174 Chesterfield ind blvd', 'chesterfield', 'Missouri', '4802137075868952', '094', '63005', '202318', 8, 17, 'Demo', 'Klar', 'na', '', '', '', 'demo@thepoweroffreerealestate.com', 250, '', '', '', 407.5, 46, '1', 1487289600),
(49, 'lauren', 'klar', '174 chesterfield ind blvd', 'chesterfield', 'Missouri', '4802137075868952', '094', '63005', '202319', 8, 17, 'Demo', 'klar', 'na', '', '', '', 'demo@thepoweroffreerealestate.com', 250, '', '', '', 492.13, 46, '1', 1487289600),
(50, 'Rupinder', 'Dulay', '5467 Lake Washington Blvd SE', 'Bellevue', 'Washington', '5197319348003654', '799', '98006', '202369', 8, 19, 'Rupinder', 'Dulay', 'John L. Scott', 'www.dulayhomes.com', '2062716126', '2062716126', 'dulayhomes@yahoo.com', 100, '2062716126', '', '11040 Main St, Suite 200\r\nBellevue, WA, 98004', 157, 65, '1', 1487376000),
(51, 'Tia', 'Harris', '14613 Mcknew Rd', 'Burtonsville', 'Maryland', '4465420330330572', '000', '20866', '202397', 9, 18, 'Tia', 'Harris', 'TMLH Investments', '', '3017759681', '', 'investing4them@gmail.com', 278, '3017759681', '', '14625 Baltimore Ave Unit 347\r\nLaurel, MD 20707', 297.46, 66, '1', 1487376000),
(52, 'Makila', 'Hamilton', '8060 sw 5th st', 'blue springs', 'Missouri', '4120618015151711', '164', '64014', '202405', 6, 21, 'Makila', 'Hamilton', 'TMC Investments ', '', '', '8168782088', 'tmcinvestments0214@gmail.com', 500, '8168782088', '', '8060 sw 5th st\r\nBlue Springs MO 64014', 237.5, 67, '1', 1487376000),
(53, 'Brandon', 'Pettus', '3815 Woodridge Road', 'Cleveland Heights', 'Ohio', '5175461770414425', '596', '44121', '202657', 10, 21, 'Brandon D.', 'Pettus', 'Cardinal State Real Estate Investments LLC', '', '216-331-8480', '', 'cardinalstaterealestate@gmail.com', 105, '216-755-4048', '', 'Cardinal State Real Estate Investments LLC\r\n925 S. Clinton Street Suite #1-1014\r\nDefiance, OH 43512', 164.85, 69, '1', 1487376000),
(54, 'Jeffrey', 'Charlton', '18749 Eatherton Valley Road', 'Wildwood', 'Missouri', '5528519103841533', '932', '63005', 'ORD-FRjAq', 1, 20, 'Jeffrey', 'Charlton', 'aeth', 'tarh', '636-519-8320', '', 'jeff@gcfrog.com', 100, '636-519-8320', 'aht', 'ath', 141.75, 2, '1', 1487376000),
(55, 'Daniel', 'Wright', '133 S 20th St, Suite 1', 'Pittsburgh', 'Pennsylvania', '4034-8600-8825-6093', '522', '15203', 'ORD-VAbQh', 6, 19, 'Michael', 'Wright', '', '', '4124969451', '4124969451', 'michael@steeltownproperties.com', 100, '4123813900', 'In the letter template, please change, "and noticed it appeared to be vacant." to "and it caught my eye!".', 'Michael Wright\r\n133 S. 20th St, Suite 1\r\nPittsburgh, PA 15203', 688.88, 63, '1', 1487548800),
(56, 'Gene', 'Rutzler', '916 Cadogan Ct', 'Fort Mill', 'South Carolina', '4311960101889823', '967', '29708', '202997', 12, 19, 'Gene', 'Rutzler', 'Iconic Home Solutions, LLC', '', '803-567-2851', '803-567-2851', 'info@iconichomesolutions.com', 285, '803-567-2851', '', '', 760.95, 70, '1', 1487635200),
(57, '', '', '', '', '', '4242424242424242', '123', '', 'ORD-8zJPI', 10, 19, '', '', '', '', '', '', 'partha.chowdhury@nettrackers.net', 100, '', '', '', 186.75, 2, '0', 1487680226),
(58, 'Jeff', 'Charlton', '174 Chesterfield Ind. Blvd.', 'Chesterfield', 'Missouri', '4802137544209945', '889', '63005', 'ORD-jO5gc', 8, 17, 'Jeff', 'Charlton', 'Graphic Connections Group, LLC', 'www.gcfrog.com', '636-519-8320', '', 'jeff@gcfrog.com', 100, '636-519-8320', 'WERRFG', 'WEG', 142.2, 2, '1', 1487635200),
(59, 'Jeff', 'Charlton', '', '', '', '5528519103841533', '932', '', '203047', 1, 20, 'Jeff', 'Charlton', '', '', '', '', 'jeff@gcfrog.com', 100, '', '', '', 141.75, 2, '0', 1487685235),
(60, 'Jeff', 'Charlton', '', '', '', '5528519103841533', '932', '', '203047', 1, 20, 'Jeff', 'Charlton', '', '', '', '', 'jeff@gcfrog.com', 100, '', '', '', 141.75, 2, '0', 1487685304),
(61, 'Jeff', 'Charlton', '', '', '', '5528519103841533', '932', '63005', '203047', 1, 20, 'Jeff', 'Charlton', '', '', '', '', 'jeff@gcfrog.com', 100, '', '', '', 141.75, 2, '0', 1487685459),
(62, 'JeffERY-SCOTT', 'Charlton', '18749 eATHERTON vALLEY rOAD', 'WILDWOOD', 'Missouri', '5528519103841533', '932', '63005', '203047', 1, 20, 'JeffERY-SCOTT', 'Charlton', '', '', '', '', 'jeff@gcfrog.com', 100, '', '', '', 141.75, 2, '1', 1487685530),
(63, 'Darren', 'Gray', '1614 Dahlgren Road', 'Middletown', 'Maryland', '5490-3555-2876-2382', '774', '21769', '203056', 11, 2017, 'Darren', 'Gray', 'Grays Home Solutions LLC', '', '2403473141', '2403473141', 'dwman64@aol.com', 220, '240.347.3141', '', '', 345.4, 71, '0', 1487690618),
(64, 'Darren', 'Gray', '1614 Dahlgren Road', 'Middletown', 'Maryland', '5490-3555-2876-2382', '774', '21769', '203056', 11, 2017, '', '', 'Grays Home Solutions LLC', '', '2403473141', '2403473141', 'dwman64@aol.com', 220, '240.347.3141', '', '1614 Dahlgren Road\nMiddletown, MD. 21769', 345.4, 71, '0', 1487690824),
(65, 'Darren', 'Gray', '1614 Dahlgren Road', 'Middletown', 'Maryland', '5490355528762382', '774', '21769', '203062', 11, 17, 'Darren', 'Gray', '', '', '240.347.3141', '', 'dwman64@aol.com', 220, '', '', 'Grays Home Solutions LLC\r\n1614 Dahlgren Road\r\nMiddletown, MD. 21769', 345.4, 71, '1', 1487635200),
(66, 'Jerome', 'Carrothers', '2150 S. Central Expressway Suite 200', 'McKinney', 'Texas', '4357-6092-1943-2316', '216', '75070', '203073', 6, 2020, 'Jerome', 'Carrothers', 'Carrothers Investment Group', '', '214-550-4673', '', 'Jcarrothers@cinvg.com', 250, '214-550-4673', '', 'Carrothers Investment Group\n2150 S. Central Expressway Suite 200\nMcKinney, TX, 75070', 407.5, 72, '0', 1487698626),
(67, 'Jerome', 'Carrothers', '2150 S. Central Expressway Suite 200', 'McKinney', 'Texas', '4357609219432316', '216', '75070', '203080', 6, 20, 'Jerome', 'Carrothers', 'Carrothers Investment Group', 'http://cigwillbuy.com/', '214-550-4673', '', 'Jcarrothers@cinvg.com', 250, '214-550-4673', '', '', 407.5, 72, '1', 1487635200),
(68, 'Roderick', 'Seward', '668 denise ct', 'brick', 'New Jersey', '4117744053521477', '103', '08724', 'ORD-HchWI', 10, 20, 'Roderick', 'Seward', 'SewardRealEstateHoldings', '', '7329480931', '7329480931', 'rodseward3@gmail.com', 820, '7329480931', '', '668 Denise CT\r\nBrick,NJ 08724', 612.95, 17, '1', 1487635200),
(69, 'Salita', 'Duffy', '420 Clark Ave', 'San Antonio', 'Texas', '4552250031199073', '884', '78203', '203177', 2, 21, 'Salita', 'Duffy', 'Frankly Home Buyers', '', '(210)788-0918', '(210)788-0918', 'salita@franklyhomebuyers.com', 100, '(512) 364-0037', '', '2766 Harney Path Ste 227\r\nSan Antonio, Texas 78234', 167, 24, '1', 1487721600),
(70, '', '', '', '', '', '4242424242424242', '123', '', 'ORD-TVDOI', 6, 23, '', '', '', '', '', '', 'partha.chowdhury@nettrackers.net', 100, '', '', '', 186.75, 2, '0', 1487746067),
(71, 'Ann', 'Flood', '210 W Pasadena Blvd', 'Deer Park', 'Texas', '4460-6390-0062-3991', '064', '77536', '203454', 10, 19, 'Ann', 'Flood', 'A.M.I. Real Estate Investors', '', '281-235-2047', '', 'annflood1974@gmail.com', 100, '281-235-2047', '', '210 W Pasadena Blvd\r\nDeer Park, TX 77536', 169, 77, '1', 0),
(72, 'Jeffrey', 'Charlton', '174Chesterfield Ind Blvd', 'Chesterfield', 'Missouri', '372722485481005', '3296', '63005', 'ORD-rZHde', 7, 20, 'Jeffrey', 'Charlton', 'dsffg', 'dfg', '636-519-8320', '', 'jeff@gcfrog.com', 100, '636-519-8320', 'DSf', 'SDFf', 80.64, 2, '1', 1487808000),
(73, 'Jeff', 'Charlton', '174 Chesterfield Ind. Blvd.', 'Chesterfield', 'Missouri', '4802137544209945', '889', '63005', 'ORD-pp27y', 8, 17, 'Jeff', 'Charlton', 'Graphic Connections Group, LLC', 'www.gcfrog.com', '636-519-8320', '', 'jeff@gcfrog.com', 100, '636-519-8320', 'wEF', 'WEF', 156.6, 2, '1', 0),
(74, 'Jerome', 'Carrothers', '2761 Bauer Ct', 'Lucas', 'Texas', '4634048000147053', '059', '75002', '203565', 11, 17, 'Jerome', 'Carrothers', 'Carrothers Investment Group', 'www.cinvg.com', '214-762-0616', '', 'Jcarrothers@cinvg.com', 250, '', '', '', 162.88, 72, '0', 1487895838),
(75, 'Jerome', 'Carrothers', '2761 Bauer Ct', 'Lucas', 'Texas', '4634048000147053', '407', '75002', '203565', 11, 17, 'Jerome', 'Carrothers', 'Carrothers Investment Group', 'www.cinvg.com', '214-762-0616', '', 'Jcarrothers@cinvg.com', 250, '', '', '', 162.88, 72, '1', 1487895905);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(255) NOT NULL,
  `imagename` varchar(255) NOT NULL,
  `imagepathname` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0',
  `date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `productname`, `description`, `code`, `imagename`, `imagepathname`, `price`, `category_id`, `order_id`, `is_active`, `date_added`) VALUES
(1, 'Handwritten Yellow Letter', 'Handwritten Yellow Letter', 'handwritten-yellow-letter', 'handwritten-yellow-letter.png', '/product/handwritten-yellow-letter.png', '0|0|0|0|0|0|0|', 2, 6, '1', 1487951937),
(2, 'Typewriter Old Style', 'Typewriter Old Style', 'typewriter-old-style', 'typewriter-old-style.png', '/product/typewriter-old-style.png', '0|0|0|0|0|0|0|', 2, 9, '1', 1487951961),
(3, '#10 ENVELOPE - WHITE - $.04', '(Red Ink, Handwritten Font)', '-10-envelope-white-04', 'letter-envelope-2.png', '/product/letter-envelope-2.png', '0.04|0.04|0.04|0.04|0.04|0.04|0.04|', 3, 1, '1', 1483122970),
(4, '6 X 9 PRIORITY ENVELOPE - $.25', '(Black Ink, Typed Font)', '6-x-9-priority-envelope-25', 'letter-envelope-5.png', '/product/letter-envelope-5.png', '0.25|0.25|0.25|0.25|0.25|0.25|0.25|', 3, 10, '1', 1483124079),
(5, 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 'Presorted First Class Stamp - $ 0.43 Each 500 or More', 'presorted-first-class-stamp-0-43-each-500-or-more', 'FIRST-CLASS-Presort-Stamp-w-Cancellation_1486710046.png', '/product/FIRST-CLASS-Presort-Stamp-w-Cancellation_1486710046.png', '0.49|0.49|0.42|0.42|0.42|0.42|0.42|', 6, 0, '1', 1486710097),
(6, 'Presort First Class Indicia - $0.41 each 500 or more', 'Presort First Class Indicia - $0.41 each 500 or more', 'presort-first-class-indicia-41-each-500-or-more', 'GCG-Permit-First-Class-PRESORT.png', '/product/GCG-Permit-First-Class-PRESORT.png', '0.49|0.49|0.41|0.41|0.41|0.41|0.41|', 6, 0, '1', 1487964784),
(7, 'Yellow - $.025', 'Yellow - $.025', 'yellow-025', '', '', '0.025|0.025|0.025|0.025|0.025|0.025|0.025|', 5, 0, '1', 1483124883),
(8, 'Cream - $.03', 'Cream - $.03', 'cream-03', '', '', '0.03|0.03|0.03|0.03|0.03|0.03|0.03|', 5, 0, '1', 1483186316),
(9, 'White - $.02', 'White - $.02', 'white-02', '', '', '0.02|0.02|0.02|0.02|0.02|0.02|0.02|', 5, 0, '1', 1483186350),
(10, 'Black - $.02', 'Black - $.02', 'black-02', '', '', '0.02|0.02|0.02|0.02|0.02|0.02|0.02|', 4, 0, '1', 1483186407),
(11, 'Color - $.14', 'Color - $.14', 'color-14', '', '', '0.14|0.14|0.14|0.14|0.14|0.14|0.14|', 4, 0, '1', 1483186444),
(12, 'Business Letter', 'Business Letter', 'business-letter', 'business-letter.png', '/product/business-letter.png', '0|0|0|0|0|0|0|', 2, 5, '1', 1487951023),
(13, 'Handwritten Letter on White Lined', 'Handwritten Letter on White Lined', 'handwritten-letter-on-white-lined', 'handwritten-letter-white-lined.png', '/product/handwritten-letter-white-lined.png', '0|0|0|0|0|0|0|', 2, 8, '1', 1487951953),
(14, 'Handwritten Stationery Letter', 'Handwritten Stationery Letter', 'handwritten-stationery-letter', 'handwritten-stationary-letter.png', '/product/handwritten-stationary-letter.png', '0|0|0|0|0|0|0|', 2, 7, '1', 1487951946),
(15, 'Custom Letter', 'Custom Letter', 'custom-letter', 'custom-letter.png', '/product/custom-letter.png', '0|0|0|0|0|0|0|', 2, 10, '1', 1487951967),
(16, 'Streetview Mailers Letter for Closed face Envelope', 'Streetview Mailers Letter for Closed face Envelope', 'google-earth-house-image-letter', 'GE1-LT.png', '/product/GE1-LT.png', '0.50|0.35|0.30|0.25|0.15|0.10|0.08|', 2, 1, '1', 1487949381),
(17, '6 X 9 AIR EX ENVELOPE - $.25', '(Blue Ink, Handwritten Font. Use live stamp for personal look. Select postage type in next section.)', '6-x-9-air-ex-envelope-25_1', 'letter-envelope-8.png', '/product/letter-envelope-8.png', '0.25|0.25|0.25|0.25|0.25|0.25|0.25|', 3, 11, '1', 1483186968),
(18, '6 X 9 AIR EX ENVELOPE - $.25', '(Black Ink, Typed Font)', '6-x-9-air-ex-envelope-25', 'letter-envelope-7.png', '/product/letter-envelope-7.png', '0.25|0.25|0.25|0.25|0.25|0.25|0.25|', 3, 12, '1', 1483187469),
(19, '6x9 ENVELOPE - BLUE - $.20', '(Red Ink, Handwritten Font)', '6x9-envelope-blue-20_1', 'letter-envelope-11.png', '/product/letter-envelope-11.png', '0.2|0.2|0.2|0.2|0.2|0.2|0.2|', 3, 13, '1', 1483187749),
(20, '6x9 ENVELOPE - BLUE - $.20', '(Blue Ink, Handwritten Font)', '6x9-envelope-blue-20', 'letter-envelope-12.png', '/product/letter-envelope-12.png', '0.2|0.2|0.2|0.2|0.2|0.2|0.2|', 3, 14, '1', 1483187820),
(21, '#10 ENVELOPE - WHITE - $.04', '(Black Ink, Typed Font)', '-10-envelope-white-04_1', 'letter-envelope-1.png', '/product/letter-envelope-1.png', '0.04|0.04|0.04|0.04|0.04|0.04|0.04|', 3, 2, '1', 1483187872),
(22, '#10 ENVELOPE - WHITE - $.04', '(Blue Ink, Handwritten Font)', '-10-envelope-white-04_2', 'letter-envelope-3.png', '/product/letter-envelope-3.png', '0.04|0.04|0.04|0.04|0.04|0.04|0.04|', 3, 3, '1', 1483192504),
(23, '#10 WINDOW ENVELOPE - WHITE - $.044', '(Black Ink, Typed Font for return Address. Letter shows through window with typed font also.)', '-10-window-envelope-white-044', '10 Window Envelope.png', '/product/10 Window Envelope.png', '0.044|0.044|0.044|0.044|0.044|0.044|0.044|', 3, 4, '1', 1483193510),
(24, 'A8 INVITATION - CREAM - $.13', '(Red Ink, Handwritten Font)', 'a8-invitation-cream-13', 'letter-envelope-9.png', '/product/letter-envelope-9.png', '0.13|0.13|0.13|0.13|0.13|0.13|0.13|', 3, 5, '1', 1483193506),
(25, 'A8 INVITATION - CREAM - $.13', '(Blue Ink, Handwritten Font)', 'a8-invitation-cream-13_1', 'letter-envelope-10.png', '/product/letter-envelope-10.png', '0.13|0.13|0.13|0.13|0.13|0.13|0.13|', 3, 6, '1', 1483194080),
(26, '6 X 9 PRIORITY ENVELOPE - $.25', '(Blue Ink, Handwritten Font. Use live stamp for personal look. Select postage type in next section.)', '6-x-9-priority-envelope-25_1', 'letter-envelope-6.png', '/product/letter-envelope-6.png', '0.25|0.25|0.25|0.25|0.25|0.25|0.25|', 3, 9, '1', 1483194167),
(27, 'Labor Price', 'Labor Price', 'labor-price', '', '', '1|0.5|0.41|0.375|0.28|0.24|0.18|', 1, 0, '1', 1483351625),
(28, 'Postcard Labor Price', 'Postcard Labor Price', 'postcard-labor-price', '', '', '0|0|0|0|0|0|0|', 13, 0, '1', 1483194839),
(29, 'small', '4.25 x 5.5', 'small', 'postcard-size1.png', '/product/postcard-size1.png', '.5|0.219|0.149|0.114|0.099|0.089|0.0865|', 18, 0, '1', 1483275937),
(35, 'BA-S', 'BA-S', 'ba-s', 'BA-S.png', '/product/BA-S.png', '0|0|0|0|0|0|0|', 9, 0, '1', 1483354317),
(36, 'GE1-S Streetview Mailers', 'GE1-S Streetview Mailers', 'ge1-s_1', 'GE1-S.png', '/product/GE1-S.png', '.5|.35|.3|.25|.15|.1|.08|', 9, 1, '1', 1487268453),
(37, 'GE2-S Streetview Mailers', 'GE2-S Streetview Mailers', 'ge2-s_1', 'GE2-S.png', '/product/GE2-S.png', '.5|.35|.3|.25|.15|.1|.08|', 9, 2, '1', 1487268487),
(38, 'CB-S', 'CB-S', 'cb-s_1', 'CB-S.png', '/product/CB-S.png', '0|0|0|0|0|0|0|', 9, 0, '1', 1483357541),
(39, 'BP1-S', 'BP1-S', 'bp1-s_1', 'BP1-S.png', '/product/BP1-S.png', '0|0|0|0|0|0|0|', 9, 28, '1', 1487269769),
(40, 'AO2-S', 'AO2-S', 'ao2-s_1', 'AO2-S.png', '/product/AO2-S.png', '0|0|0|0|0|0|0|', 9, 27, '1', 1487269761),
(41, 'BP2-S', 'BP2-S', 'bp2-s', 'BP2-S.png', '/product/BP2-S.png', '0|0|0|0|0|0|0|', 9, 26, '1', 1487269753),
(42, 'AO1-S', 'AO1-S', 'ao1-s', 'AO1-S.png', '/product/AO1-S.png', '0|0|0|0|0|0|0|', 9, 25, '1', 1487269746),
(43, 'CD1-S', 'CD1-S', 'cd1-s', 'CD1-S.png', '/product/CD1-S.png', '0|0|0|0|0|0|0|', 9, 24, '1', 1487269734),
(44, 'CD2-S', 'CD2-S', 'cd2-s', 'CD2-S.png', '/product/CD2-S.png', '0|0|0|0|0|0|0|', 9, 23, '1', 1487269721),
(45, 'CD3-S', 'CD3-S', 'cd3-s', 'CD3-S.png', '/product/CD3-S.png', '0|0|0|0|0|0|0|', 9, 22, '1', 1487269714),
(46, 'CD4-S', 'CD4-S', 'cd4-s', 'CD4-S.png', '/product/CD4-S.png', '0|0|0|0|0|0|0|', 9, 21, '1', 1487269707),
(47, 'CD5-S', 'CD5-S', 'cd5-s', 'CD5-S.png', '/product/CD5-S.png', '0|0|0|0|0|0|0|', 9, 7, '1', 1487268672),
(48, 'CD6-S', 'CD6-S', 'cd6-s', 'CD6-S.png', '/product/CD6-S.png', '0|0|0|0|0|0|0|', 9, 20, '1', 1487269700),
(49, 'CD7-S', 'CD7-S', 'cd7-s', 'CD7-S.png', '/product/CD7-S.png', '0|0|0|0|0|0|0|', 9, 19, '1', 1487269690),
(50, 'CD8-S', 'CD8-S', 'cd8-s', 'CD8-S.png', '/product/CD8-S.png', '0|0|0|0|0|0|0|', 9, 21, '1', 1487269637),
(51, 'CD9-S', 'CD9-S', 'cd9-s', 'CD9-S.png', '/product/CD9-S.png', '0|0|0|0|0|0|0|', 9, 12, '1', 1487269347),
(52, 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 'Presort Standard Stamp w/ Cancellation - $ 0.32 Each - 200 or More', 'presort-standard-stamp-w-cancellation-0-32-each-200-or-more', 'std precan.png', '/product/std precan.png', '0.49|0.31|0.31|0.31|0.31|0.31|0.31|', 6, 0, '1', 1483380624),
(53, 'Standard Presort Indicia - $0.31 each - 200 or More', 'Standard Presort Indicia - $0.31 each - 200 or More', 'standard-presort-indicia-31-each-200-or-more', 'GCG-Permit-Standard-PRESORT.png', '/product/GCG-Permit-Standard-PRESORT.png', '0.49|0.31|0.31|0.31|0.31|0.31|0.31|', 6, 0, '1', 1487964837),
(54, 'First Class Stamp - $ 0.49 Each', 'First Class Stamp - $ 0.49 Each', 'first-class-stamp-0-49-each', 'First Class Forever Stamp.png', '/product/First Class Forever Stamp.png', '0.49|0.49|0.49|0.49|0.49|0.49|0.49|', 6, 0, '1', 1483382352),
(55, 'CD10-S', 'CD10-S', 'cd10-s', 'CD10-S.png', '/product/CD10-S.png', '0|0|0|0|0|0|0|', 9, 20, '1', 1487269626),
(56, 'CD11-S', 'CD11-S', 'cd11-s', 'CD11-S.png', '/product/CD11-S.png', '0|0|0|0|0|0|0|', 9, 18, '1', 1487269618),
(57, 'CD12-S', 'CD12-S', 'cd12-s', 'CD12-S.png', '/product/CD12-S.png', '0|0|0|0|0|0|0|', 9, 18, '1', 1487269610),
(58, 'CD13-S', 'CD13-S', 'cd13-s', 'CD13-S.png', '/product/CD13-S.png', '0|0|0|0|0|0|0|', 9, 17, '1', 1487269601),
(59, 'CD14-S', 'CD14-S', 'cd14-s', 'CD14-S.png', '/product/CD14-S.png', '0|0|0|0|0|0|0|', 9, 16, '1', 1487269586),
(61, 'CD15-S', 'CD15-S', 'cd15-s', 'CD15-S.png', '/product/CD15-S.png', '0|0|0|0|0|0|0|', 9, 15, '1', 1487269575),
(62, 'CD16-S', 'CD16-S', 'cd16-s', 'CD16-S.png', '/product/CD16-S.png', '0|0|0|0|0|0|0|', 9, 15, '1', 1487269414),
(63, 'GE1-M', 'GE1-M', 'ge1-m', 'GE1-M.png', '/product/GE1-M.png', '.5|.35|.3|.25|.15|.1|.08|', 8, 0, '1', 1483429244),
(64, 'GE2-M', 'GE2-M', 'ge2-m', 'GE2-M.png', '/product/GE2-M.png', '.5|.35|.3|.25|.15|.1|.08|', 8, 0, '1', 1483429452),
(65, 'CD17-S', 'CD17-S', 'cd17-s', 'CD17-S.png', '/product/CD17-S.png', '0|0|0|0|0|0|0|', 9, 14, '1', 1487269391),
(66, 'AO1-M', 'AO1-M', 'ao1-m', 'AO1-M.png', '/product/AO1-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483429683),
(67, 'FC1-S', 'FC1-S', 'fc1-s', 'FC1-S.png', '/product/FC1-S.png', '0|0|0|0|0|0|0|', 9, 13, '1', 1487269364),
(68, 'FC2-S', 'FC2-S', 'fc2-s', 'FC2-S.png', '/product/FC2-S.png', '0|0|0|0|0|0|0|', 9, 11, '1', 1487269316),
(69, 'AO2-M', 'AO2-M', 'ao2-m', 'AO2-M.png', '/product/AO2-M.png', '.052|.052|.052|.052|.052|.052|.052|', 8, 0, '1', 1483429852),
(70, 'FCM1-S', 'FCM1-S', 'fcm1-s', 'FCM1-S.png', '/product/FCM1-S.png', '0|0|0|0|0|0|0|', 9, 10, '1', 1487269298),
(71, 'BA-M', 'BA-M', 'ba-m', 'BA-M.png', '/product/BA-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483429965),
(72, 'NH-S', 'NH-S', 'nh-s', 'NH-S.png', '/product/NH-S.png', '0|0|0|0|0|0|0|', 9, 3, '1', 1487268535),
(73, 'BP1-M', 'BP1-M', 'bp1-m', 'BP1-M.png', '/product/BP1-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483430110),
(74, 'BP2-M', 'BP2-M', 'bp2-m', 'BP2-M.png', '/product/BP2-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483430230),
(75, 'CB-M', 'CB-M', 'cb-m', 'CB-M.png', '/product/CB-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483430307),
(76, 'CD2-M', 'CD2-M', 'cd2-m', 'CD2-M.png', '/product/CD2-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483430391),
(77, 'CD1-M', 'CD1-M', 'cd1-m', 'CD1-M.png', '/product/CD1-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483430569),
(78, 'PN1M-S', 'PN1M-S', 'pn1m-s', 'PN1M-S.png', '/product/PN1M-S.png', '0|0|0|0|0|0|0|', 9, 9, '1', 1487269251),
(79, 'CD3-M', 'CD3-M', 'cd3-m', 'CD3-M.png', '/product/CD3-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483433770),
(80, 'CD4-M', 'CD4-M', 'cd4-m', 'CD4-M.png', '/product/CD4-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483433847),
(81, 'CD5-M', 'CD5-M', 'cd5-m', 'CD5-M.png', '/product/CD5-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483433922),
(82, 'CD6-M', 'CD6-M', 'cd6-m', 'CD6-M.png', '/product/CD6-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483434020),
(83, 'CD7-M', 'CD7-M', 'cd7-m', 'CD7-M.png', '/product/CD7-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483434110),
(84, 'CD8-M', 'CD8-M', 'cd8-m', 'CD8-M.png', '/product/CD8-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483434184),
(85, 'CD9-M`', 'CD9-M`', 'cd9-m-', 'CD9-M.png', '/product/CD9-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483434316),
(86, 'CD10-M', 'CD10-M', 'cd10-m', 'CD10-M.png', '/product/CD10-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483434447),
(87, 'PN1-S', 'PN1-S', 'pn1-s', 'PN1-S.png', '/product/PN1-S.png', '0|0|0|0|0|0|0|', 9, 8, '1', 1487269217),
(88, 'PN2-S', 'PN2-S', 'pn2-s', 'PN2-S.png', '/product/PN2-S.png', '0|0|0|0|0|0|0|', 9, 7, '1', 1487269169),
(89, 'PN3-S', 'PN3-S', 'pn3-s', 'PN3-S.png', '/product/PN3-S.png', '0|0|0|0|0|0|0|', 9, 6, '1', 1487268646),
(90, 'PN4-S', 'PN4-S', 'pn4-s', 'PN4-S.png', '/product/PN4-S.png', '0|0|0|0|0|0|0|', 9, 5, '1', 1487268602),
(91, 'TD-S', 'TD-S', 'td-s', 'TD-S.png', '/product/TD-S.png', '0|0|0|0|0|0|0|', 9, 4, '1', 1487268569),
(92, 'CD11-M', 'CD11-M', 'cd11-m', 'CD11-M.png', '/product/CD11-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483436432),
(93, 'CD12-M', 'CD12-M', 'cd12-m', 'CD12-M.png', '/product/CD12-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483436585),
(94, 'CD13-M', 'CD13-M', 'cd13-m', 'CD13-M.png', '/product/CD13-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483436661),
(95, 'CD14-M', 'CD14-M', 'cd14-m', 'CD14-M.png', '/product/CD14-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483436777),
(96, 'CD15-M', 'CD15-M', 'cd15-m', 'CD15-M.png', '/product/CD15-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483436865),
(97, 'CD16-M', 'CD16-M', 'cd16-m', 'CD16-M.png', '/product/CD16-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483436983),
(98, 'CD17-M', 'CD17-M', 'cd17-m', 'CD17-M.png', '/product/CD17-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483437071),
(99, 'FC1-M', 'FC1-M', 'fc1-m', 'FC1-M.png', '/product/FC1-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483437265),
(100, 'FC2-M', 'FC2-M', 'fc2-m', 'FC2-M.png', '/product/FC2-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483437348),
(101, 'FCM1-M', 'FCM1-M', 'fcm1-m', 'FCM1-M.png', '/product/FCM1-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483437417),
(102, 'NH-M', 'NH-M', 'nh-m', 'NH-M.png', '/product/NH-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483437487),
(103, 'PN1M-M', 'PN1M-M', 'pn1m-m', 'PN1M-M.png', '/product/PN1M-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483437566),
(104, 'PN1-M', 'PN1-M', 'pn1-m', 'PN1-M.png', '/product/PN1-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483437683),
(105, 'PN2-M', 'PN2-M', 'pn2-m', 'PN2-M.png', '/product/PN2-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483437821),
(106, 'PN3-M', 'PN3-M', 'pn3-m', 'PN3-M.png', '/product/PN3-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483437903),
(107, 'PN4-M', 'PN4-M', 'pn4-m', 'PN4-M.png', '/product/PN4-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483438072),
(108, 'TD-M', 'TD-M', 'td-m', 'TD-M.png', '/product/TD-M.png', '0|0|0|0|0|0|0|', 8, 0, '1', 1483438311),
(109, 'GE1-L', 'GE1-L', 'ge1-l', 'GE1-L.png', '/product/GE1-L.png', '.5|.35|.3|.25|.15|.1|.08|', 7, 0, '1', 1483439699),
(110, 'GE2-L', 'GE2-L', 'ge2-l', 'GE2-L.png', '/product/GE2-L.png', '.5|.35|.3|.25|.15|.1|.08|', 7, 0, '1', 1483440045),
(111, 'AO1-L', 'AO1-L', 'ao1-l', 'AO1-L.png', '/product/AO1-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483440162),
(112, 'AO2-L', 'AO2-L', 'ao2-l', 'AO2-L.png', '/product/AO2-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483440239),
(113, 'BA-L', 'BA-L', 'ba-l', 'BA-L.png', '/product/BA-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483440344),
(114, 'BP1-L', 'BP1-L', 'bp1-l', 'BP1-L.png', '/product/BP1-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483440417),
(115, 'BP2-L', 'BP2-L', 'bp2-l', 'BP2-L.png', '/product/BP2-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483440528),
(116, 'CB-L', 'CB-L', 'cb-l', 'CB-L.png', '/product/CB-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483440619),
(117, 'CD1-L', 'CD1-L', 'cd1-l', 'CD1-L.png', '/product/CD1-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483440685),
(118, 'CD2-L', 'CD2-L', 'cd2-l', 'CD2-L.png', '/product/CD2-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483440773),
(119, 'CD3-L', 'CD3-L', 'cd3-l', 'CD3-L.png', '/product/CD3-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483440855),
(120, 'CD4-L', 'CD4-L', 'cd4-l', 'CD4-L.png', '/product/CD4-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483440929),
(121, 'CD5-L', 'CD5-L', 'cd5-l', 'CD5-L.png', '/product/CD5-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483441042),
(122, 'CD6-L', 'CD6-L', 'cd6-l', 'CD6-L.png', '/product/CD6-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483441104),
(123, 'medium', '5.5 x 8.5', 'medium', 'postcard-size2.png', '/product/postcard-size2.png', '0.535|0.235|0.185|0.135|0.105|0.105|0.1|', 18, 0, '1', 1483441710),
(124, 'large', '5.5 x 11', 'large', 'postcard-size3.png', '/product/postcard-size3.png', '0.995|0.665|0.545|0.295|0.205|0.195|0.13|', 18, 0, '1', 1483441860),
(125, 'CD7-L', 'CD7-L', 'cd7-l', 'CD7-L.png', '/product/CD7-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483441992),
(126, 'CD8-L', 'CD8-L', 'cd8-l', 'CD8-L.png', '/product/CD8-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483442062),
(127, 'CD9-L', 'CD9-L', 'cd9-l', 'CD9-L.png', '/product/CD9-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483442127),
(128, 'CD10-L', 'CD10-L', 'cd10-l', 'CD10-L.png', '/product/CD10-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483442204),
(129, 'CD11-L', 'CD11-L', 'cd11-l', 'CD11-L.png', '/product/CD11-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483442273),
(130, 'CD12-L', 'CD12-L', 'cd12-l', 'CD12-L.png', '/product/CD12-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483442354),
(131, 'CD13-L', 'CD13-L', 'cd13-l', 'CD13-L.png', '/product/CD13-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483442781),
(132, 'CD14-L', 'CD14-L', 'cd14-l', 'CD14-L.png', '/product/CD14-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483442853),
(133, 'White', 'White', 'white_6', '', '', '0|0|0|0|0|0|0|', 14, 0, '1', 1483442859),
(134, 'Yellow', 'Yellow', 'yellow_2', '', '', '0|0|0|0|0|0|0|', 14, 0, '1', 1483442884),
(135, 'Blue', 'Blue', 'blue_2', '', '', '0|0|0|0|0|0|0|', 14, 0, '1', 1483442906),
(136, 'CD15-L', 'CD15-L', 'cd15-l', 'CD15-L.png', '/product/CD15-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483442915),
(137, 'Astrobright Yellow', 'Astrobright Yellow', 'astrobright-yellow', '', '', '0|0|0|0|0|0|0|', 14, 0, '1', 1483442925),
(138, 'Black', 'Black', 'black_1', '', '', '.026|.026|.026|.026|.026|.026|.026|', 10, 0, '1', 1483442996),
(139, 'Color', 'Color', 'color_1', '', '', '0.0625|0.0625|0.0625|0.0625|0.0625|0.0625|0.0625|', 10, 0, '1', 1483443025),
(140, 'CD16-L', 'CD16-L', 'cd16-l', 'CD16-L.png', '/product/CD16-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483443595),
(141, 'CD17-L', 'CD17-L', 'cd17-l', 'CD17-L.png', '/product/CD17-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483443690),
(142, 'FC1-L', 'FC1-L', 'fc1-l', 'FC1-L.png', '/product/FC1-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483443785),
(143, 'FC2-L', 'FC2-L', 'fc2-l', 'FC2-L.png', '/product/FC2-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483444027),
(144, 'FCM1-L', 'FCM1-L', 'fcm1-l', 'FCM1-L.png', '/product/FCM1-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483444106),
(145, 'NH-L', 'NH-L', 'nh-l', 'NH-L.png', '/product/NH-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483444182),
(146, 'PN1M-L', 'PN1M-L', 'pn1m-l', 'PN1M-L.png', '/product/PN1M-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483444257),
(147, 'PN1-L', 'PN1-L', 'pn1-l', 'PN1-L.png', '/product/PN1-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483444331),
(148, 'PN2-L', 'PN2-L', 'pn2-l', 'PN2-L.png', '/product/PN2-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483444421),
(149, 'PN3-L', 'PN3-L', 'pn3-l', 'PN3-L.png', '/product/PN3-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483444497),
(150, 'PN4-L', 'PN4-L', 'pn4-l', 'PN4-L.png', '/product/PN4-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483444559),
(151, 'TD-L', 'TD-L', 'td-l', 'TD-L.png', '/product/TD-L.png', '0|0|0|0|0|0|0|', 7, 0, '1', 1483444615),
(152, 'First Class Stamp - Delivery Time: 1-7 days after mail date $.37 each', 'small', 'first-class-stamp-delivery-time-1-7-days-after-mail-date', 'FIRST-CLASS-POSTCARD.png', '/product/FIRST-CLASS-POSTCARD.png', '0.37|0.37|0.37|0.37|0.37|0.37|0.37|', 15, 0, '1', 1486569581),
(153, 'First Class Presort Stamp w/Cancellation - Delivery Time: 1-7 days after mail date - 500 Min $.33 each', 'small', 'first-class-presort-stamp-w-cancellation-delivery-time-1-7-days-after-mail-date', 'fc precan.png', '/product/fc precan.png', '0.37|0.37|0.33|0.33|0.33|0.33|0.33|', 15, 0, '1', 1486569610),
(154, 'First Class Presort Indicia - Delivery Time: 1-7 days after mail date - 500 Min $.30 each', 'small', 'first-class-presort-indicia-delivery-time-1-7-days-after-mail-date', 'GCG-Permit-First-Class-PRESORT.png', '/product/GCG-Permit-First-Class-PRESORT.png', '.37|.37|0.3|0.3|0.3|0.3|0.3|', 15, 0, '1', 1486569591),
(155, 'First Class Forever - Delivery Time:1-7 days after mail date - $ 0.50 Each', 'medium', 'first-class-stamp-delivery-time-1-7-days-after-mail-date_1', 'First Class Forever Stamp.png', '/product/First Class Forever Stamp.png', '0.50|0.5|0.5|0.5|0.5|0.5|0.5|', 17, 0, '1', 1486570805),
(156, 'First Class Presort Stamp w/Cancellation - Delivery Time: 1-7 days after mail date - 500 min. - $ 0.44 Each', 'medium', 'first-class-presort-stamp-w-cancellation-delivery-time-1-7-days-after-mail-date_1', 'fc precan.png', '/product/fc precan.png', '0.49|0.49|0.44|0.44|0.44|0.44|0.44|', 17, 0, '1', 1486571365),
(157, 'First Class Presort Indicia - Delivery Time: 1-7 days after mail date - 500 min. - $ 0.43 Each', 'medium', 'first-class-presort-indicia-delivery-time-1-7-days-after-mail-date_1', 'GCG-Permit-First-Class-PRESORT.png', '/product/GCG-Permit-First-Class-PRESORT.png', '0.49|0.49|0.43|0.43|0.43|0.43|0.43|', 17, 0, '1', 1486570471),
(158, 'Standard Presort Stamp W/Cancellation - Delivery Time: 2-4 weeks after mail date - 200 Min. - $. 32 each', 'medium', 'standard-presort-stamp-w-cancellation-delivery-time-2-4-weeks-after-mail-date', 'std precan.png', '/product/std precan.png', '0.49|0.49|0.32|0.32|0.32|0.32|0.32|', 17, 0, '1', 1486570714),
(159, 'Standard Presort Indicia - Delivery Time: 2-4 weeks after mail date - 200 Min. - $. 30 each', 'medium', 'standard-presort-indicia-delivery-time-2-4-weeks-after-mail-date', 'GCG-Permit-Standard-PRESORT.png', '/product/GCG-Permit-Standard-PRESORT.png', '0.50|0.30|0.30|0.30|0.30|0.30|0.30|', 17, 0, '1', 1486570910),
(160, 'First Class Forever - $ 0.47 Each', 'large', 'first-class-forever-0-47-each', 'First Class Forever Stamp.png', '/product/First Class Forever Stamp.png', '0.47|0.47|0.47|0.47|0.47|0.47|0.47|', 7, 0, '1', 1483446953),
(162, 'First Class Presort Indicia - Delivery Time: 1-7 days after mail date - 500 min. - $ 0.43 Each', 'large', 'first-class-presort-indicia-29-each', 'GCG-Permit-First-Class-PRESORT.png', '/product/GCG-Permit-First-Class-PRESORT.png', '0.49|0.49|0.43|0.43|0.43|0.43|0.43|', 16, 0, '1', 1486569522),
(163, 'First Class Presort Stamp w/Cancellation - Delivery Time: 1-7 days after mail date - 500 min. - $ 0.44 Each', 'large', 'first-class-presort-stamp-w-cancellation-0-45-each_1', 'FIRST-CLASS-Presort-Stamp-w-Cancellation_1486725453.png', '/product/FIRST-CLASS-Presort-Stamp-w-Cancellation_1486725453.png', '0.49|0.49|0.44|0.44|0.44|0.44|0.44|', 16, 0, '1', 1486725456),
(164, 'First Class Forever - Delivery Time:1-7 days after mail date - $ 0.49 Each', 'large', 'first-class-forever-0-47-each_1', 'First Class Forever Stamp.png', '/product/First Class Forever Stamp.png', '0.49|0.49|0.49|0.49|0.49|0.49|0.49|', 16, 0, '1', 1486569564),
(165, 'Standard Presort Stamp W/Cancellation - Delivery Time: 2-4 weeks after mail date - 200 Min. - $. 32 each', 'large', 'standard-presort-stamp-w-cancellation-32-each', 'PRESORT-Standard-Stamp-w-Cancellation.png', '/product/PRESORT-Standard-Stamp-w-Cancellation.png', '0.50|0.32|0.32|0.32|0.32|0.32|0.32|', 16, 0, '1', 1486569503),
(166, 'Standard Presort Indicia - Delivery Time: 2-4 weeks after mail date - 200 Min. - $. 30 each', 'large 2-4 weeks after mail date - 200 Min. - $. 30 each', 'standard-presort-indicia-31-each_1', 'GCG-Permit-Standard-PRESORT.png', '/product/GCG-Permit-Standard-PRESORT.png', '0.5|0.30|0.3|0.3|0.3|0.3|0.3|', 16, 0, '1', 1486569483),
(167, 'Astrobright Yellow', 'Astrobright Yellow', 'astrobright-yellow_1', '', '', '0|0|0|0|0|0|0|', 19, 0, '1', 1483686764),
(168, 'Blue', 'Blue', 'blue_3', '', '', '0|0|0|0|0|0|0|', 19, 0, '1', 1483686798),
(169, 'Yellow', 'Yellow', 'yellow_5', '', '', '0|0|0|0|0|0|0|', 19, 0, '1', 1483686829),
(170, 'White', 'White', 'white_7', '', '', '0|0|0|0|0|0|0|', 19, 0, '1', 1483686860),
(171, 'Astrobright Yellow', 'Astrobright Yellow', 'astrobright-yellow_2', '', '', '0|0|0|0|0|0|0|', 20, 0, '1', 1483687054),
(172, 'Blue', 'Blue', 'blue_4', '', '', '0|0|0|0|0|0|0|', 20, 0, '1', 1483687080),
(173, 'Yellow', 'Yellow', 'yellow_7', '', '', '0|0|0|0|0|0|0|', 20, 0, '1', 1483687105),
(174, 'White', 'White', 'white_8', '', '', '0|0|0|0|0|0|0|', 20, 0, '1', 1483687129),
(175, 'Color', 'Color', 'color_2', '', '', '0.0625|0.0625|0.0625|0.0625|0.0625|0.0625|0.0625|', 21, 0, '1', 1483687761),
(176, 'Black', 'Black', 'black_2', '', '', '0.026|0.026|0.026|0.026|0.026|0.026|0.026|', 21, 0, '1', 1483687795),
(177, 'Color', 'Color', 'color_3', '', '', '0.0625|0.0625|0.0625|0.0625|0.0625|0.0625|0.0625|', 22, 0, '1', 1483687978),
(178, 'Black', 'Black', 'black_3', '', '', '0.026|0.026|0.026|0.026|0.026|0.026|0.026|', 22, 0, '1', 1483687869),
(180, 'CB1-S', 'CB1-S', 'cb1-s', 'CB1-S.jpg', '/product/CB1-S.jpg', '.1|.1|.1|.1|.1|.1|.1|', 9, 1, '1', 1484064422),
(182, 'CB1-M', '', 'cb1-m', 'CB1-M.jpg', '/product/CB1-M.jpg', '.1|.1|.1|.1|.1|.1|.1|', 8, 0, '1', 1484064593),
(184, 'CB1-L', '', 'cb1-l', 'CB1-L.jpg', '/product/CB1-L.jpg', '.2|.2|.2|.2|.2|.2|.2|', 7, 1, '1', 1484207971),
(186, 'CB2-S', 'CB2-S', 'cb2-s', 'CB2-S.jpg', '/product/CB2-S.jpg', '.1|.1|.1|.1|.1|.1|.1|', 9, 40, '1', 1487269226),
(187, 'Streetview Mailers Letter for Window Envelope - Handwritten', 'Streetview Mailers Letter for Window Envelope - Handwritten', 'streetview-mailers-letter-for-window-envelope-handwritten', 'GOOGLE STREET view hand written drop shadow_1487950942.png', '/product/GOOGLE STREET view hand written drop shadow_1487950942.png', '.5|.35|.25|.15|.12|.1|.08|', 2, 3, '1', 1487950944),
(188, 'Streetview Mailers Letter for Closed face Envelope- Handwritten', 'Streetview Mailers Letter for Closed face Envelope- Handwritten', 'streetview-mailers-letter-for-closed-face-envelope-handwritten', 'half google letter_1487951774.png', '/product/half google letter_1487951774.png', '.50|.35|.30|.25|.15|.10|.08|', 2, 2, '1', 1487951776),
(189, 'Streetview Mailers Business Letter for Window Envelope', 'Streetview Mailers Letter for Window Envelope- Handwritten', 'streetview-mailers-business-letter-for-window-envelope', 'GOOGLE STREET viewbusiness drop shadow_1487951279.png', '/product/GOOGLE STREET viewbusiness drop shadow_1487951279.png', '.50|.35|.30|.25|.15|.10|.08|', 2, 4, '1', 1487951280),
(190, '#10 WINDOW ENVELOPE for StreetView Letters- WHITE - $.10', '(Black Ink, Typed Font)', '-10-window-envelope-for-streetview-letters-white-10', 'window en_1487961281.png', '/product/window en_1487961281.png', '.10|.10|.10|.10|.10|.10|.10|', 3, 16, '1', 1487961282),
(192, '#10 WINDOW ENVELOPE for StreetView Letters- WHITE - $.10', '(Red Ink, Handwritten Font)', '-10-window-envelope-for-streetview-letters-white-10_2', 'handwritten window en_1487961342.png', '/product/handwritten window en_1487961342.png', '.10|.10|.10|.10|.10|.10|.10|', 3, 15, '1', 1487961343),
(208, 'test test', 'test', 'test-test_2', 'Chrysanthemum.jpg', 'uploads/product/Chrysanthemum.jpg', '0|0|0|0|0|0|0', 18, 0, '1', 1488723359);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `siteaddress` varchar(255) NOT NULL,
  `logoname` varchar(255) NOT NULL,
  `logopathname` varchar(255) NOT NULL,
  `date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `sitename`, `siteaddress`, `logoname`, `logopathname`, `date_added`) VALUES
(1, 'REWWPrintMail', 'https://rewwprintmail.com', 'logo.png', '../uploads/logo/logo.png', 1488314170);

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `up_file_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploaded_files`
--

INSERT INTO `uploaded_files` (`up_file_id`, `filename`, `filepath`, `order_id`) VALUES
(1, 'logo', 'https://www.rewwprintmail.com/uploads/NiOkl/99c146caa5.jpg', 3),
(2, 'signature', 'https://www.rewwprintmail.com/uploads/NiOkl/b4a66fbcb6.jpg', 3),
(3, 'product_url', 'https://kc-userdata.s3.amazonaws.com/29036/FMSN/fmsn-User-29036--S513582-J197027.zip', 3),
(4, 'product_url', 'https://kc-userdata.s3.amazonaws.com/58396/FMSN/fmsn-User-58396--S511412-J196627.zip', 1),
(5, 'signature', 'https://www.rewwprintmail.com/uploads/tcemS/803ead0098.jpg', 1),
(6, 'logo', 'https://www.rewwprintmail.com/uploads/tcemS/db3f17f03d.jpg', 1),
(7, 'mailinglist', 'https://www.rewwprintmail.com/uploads/tcemS/e656210f53.csv', 1),
(8, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62681/REWW/reww-User-62681--S511246-J196653.zip', 2),
(9, 'signature', 'https://www.rewwprintmail.com/uploads/QJCxH/cdb6352097.jpg', 2),
(10, 'logo', 'https://www.rewwprintmail.com/uploads/QJCxH/28ae791c2a.jpg', 2),
(11, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62381/FMSN/fmsn-User-62381--S513662-J197034.zip', 4),
(12, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62381/FMSN/fmsn-User-62381--S506764-J194573.zip', 5),
(13, 'logo', 'https://www.rewwprintmail.com/uploads/v1MPX/2d08f92d37.jpg', 6),
(14, 'signature', 'https://www.rewwprintmail.com/uploads/v1MPX/1c32b7b512.jpg', 6),
(15, 'product_url', 'https://kc-userdata.s3.amazonaws.com/57559/REWW/reww-User-57559--S517934-J198949.zip', 6),
(16, 'product_url', 'https://kc-userdata.s3.amazonaws.com/52825/REWW/reww-User-52825--S518113-J199040.zip', 7),
(17, 'logo', 'https://www.rewwprintmail.com/uploads/jTKwl/820f0e06c1.jpg', 7),
(18, 'mailinglist', 'https://www.rewwprintmail.com/uploads/jTKwl/30fcabfef0.csv', 7),
(19, 'product_url', 'https://kc-userdata.s3.amazonaws.com/52825/REWW/reww-User-52825--S518113-J199040.zip', 7),
(20, 'signature', 'https://www.rewwprintmail.com/uploads/wFgzf/03c75981e0.jpg', 9),
(21, 'letter', 'https://www.rewwprintmail.com/uploads/wFgzf/5f0f0f4891.docx', 9),
(22, 'logo', 'https://www.rewwprintmail.com/uploads/wFgzf/e1095eb4bd.jpg', 9),
(23, 'mailinglist', 'https://www.rewwprintmail.com/uploads/GUTm7/852d7f4819.csv', 10),
(24, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62052/REWW/reww-User-62052--S518180-J199066.zip', 10),
(25, 'logo', 'https://www.rewwprintmail.com/uploads/YKXMw/979edeb3b0.jpg', 11),
(26, 'signature', 'https://www.rewwprintmail.com/uploads/YKXMw/a01272922c.jpg', 11),
(27, 'product_url', 'https://kc-userdata.s3.amazonaws.com/59180/REWW/reww-User-59180--S518982-J199412.zip', 11),
(28, 'signature', 'https://www.rewwprintmail.com/uploads/faL8m/b073de6632.jpg', 12),
(29, 'product_url', 'https://kc-userdata.s3.amazonaws.com/60707/REWW/reww-User-60707--S519079-J199464.zip', 12),
(30, 'logo', 'https://www.rewwprintmail.com/uploads/yyE9z/08f5e67b5a.jpg', 13),
(31, 'signature', 'https://www.rewwprintmail.com/uploads/yyE9z/7dbad4cae4.jpg', 13),
(32, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62763/FMSN/fmsn-User-62763--S519529-J199635.zip', 13),
(33, 'mailinglist', 'https://www.rewwprintmail.com/uploads/bRWDy/818fd4da63.csv', 14),
(34, 'logo', 'https://www.rewwprintmail.com/uploads/bRWDy/98154400e2.jpg', 14),
(35, 'product_url', 'https://kc-userdata.s3.amazonaws.com/51691/FMSN/fmsn-User-51691--S320530-J199691.zip', 14),
(36, 'signature', 'https://www.rewwprintmail.com/uploads/TXMoC/5d502443d6.jpg', 15),
(37, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63015/REWW/reww-User-63015--S517297-J199929.zip', 15),
(38, 'logo', 'https://www.rewwprintmail.com/uploads/ZGTZX/20de2cfd8e.', 16),
(39, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62217/FMSN/fmsn-User-62217--S520950-J200176.zip', 16),
(40, 'logo', 'https://www.rewwprintmail.com/uploads/3J4zU/5e5f3cab53.jpg', 17),
(41, 'signature', 'https://www.rewwprintmail.com/uploads/3J4zU/0ada32bf84.jpg', 17),
(42, 'product_url', 'https://kc-userdata.s3.amazonaws.com/61384/REWW/reww-User-61384--S521169-J200229.zip', 17),
(43, 'logo', 'https://www.rewwprintmail.com/uploads/VF83L/cfcceadf92.jpg', 18),
(44, 'signature', 'https://www.rewwprintmail.com/uploads/VF83L/5ee09aa581.jpg', 18),
(45, 'product_url', 'https://kc-userdata.s3.amazonaws.com/57353/REWW/reww-User-57353--S520563-J200243.zip', 18),
(46, 'mailinglist', 'https://www.rewwprintmail.com/uploads/wj96v/d3b106bf81.numbers', 19),
(47, 'letter', 'https://www.rewwprintmail.com/uploads/wj96v/3f9ed18491.pages', 19),
(48, 'logo', 'https://www.rewwprintmail.com/uploads/wj96v/cfaa965a35.jpg', 19),
(49, 'logo', 'https://www.rewwprintmail.com/uploads/jJUn9/d931efd250.jpg', 20),
(50, 'signature', 'https://www.rewwprintmail.com/uploads/jJUn9/f8db54c14f.jpg', 20),
(51, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62763/FMSN/fmsn-User-62763--S521901-J200524.zip', 20),
(52, 'logo', 'https://www.rewwprintmail.com/uploads/6o6VN/9e891ea31d.jpg', 21),
(53, 'signature', 'https://www.rewwprintmail.com/uploads/6o6VN/31e876ff4f.jpg', 21),
(54, 'product_url', 'https://kc-userdata.s3.amazonaws.com/61568/CCFG/ccfg-User-61568--S521739-J200562.zip', 21),
(55, 'logo', 'https://www.rewwprintmail.com/uploads/junnI/81c933805e.jpg', 22),
(56, 'signature', 'https://www.rewwprintmail.com/uploads/junnI/edf80aa40d.jpg', 22),
(57, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62394/REWW/reww-User-62394--S515733-J200587.zip', 22),
(58, 'logo', 'https://www.rewwprintmail.com/uploads/NaTeD/205eb08171.jpg', 23),
(59, 'signature', 'https://www.rewwprintmail.com/uploads/NaTeD/d4e44c544a.jpg', 23),
(60, 'product_url', 'https://kc-userdata.s3.amazonaws.com/60358/REWW/reww-User-60358--S522066-J200610.zip', 23),
(61, 'logo', 'https://rewwprintmail.com/uploads/7CrwF/23f8a3a766.jpeg', 24),
(62, 'mailinglist', 'https://rewwprintmail.com/uploads/7CrwF/361890ffab.xlsx', 24),
(63, 'signature', 'https://rewwprintmail.com/uploads/7CrwF/247f57c0e3.jpg', 24),
(64, 'logo', 'https://www.rewwprintmail.com/uploads/TmshI/c0505beff2.jpg', 25),
(65, 'signature', 'https://www.rewwprintmail.com/uploads/TmshI/5592b36840.jpg', 25),
(66, 'product_url', 'https://kc-userdata.s3.amazonaws.com/58262/REWW/reww-User-58262--S522277-J200667.zip', 25),
(67, 'logo', 'https://www.rewwprintmail.com/uploads/DzM2F/dc474866d6.jpg', 26),
(68, 'signature', 'https://www.rewwprintmail.com/uploads/DzM2F/c388636c84.jpg', 26),
(69, 'product_url', 'https://kc-userdata.s3.amazonaws.com/49628/REWW/reww-User-49628--S522344-J200693.zip', 26),
(70, 'mailinglist', 'https://www.rewwprintmail.com/uploads/8EGEt/8a0fa49546.csv', 27),
(71, 'logo', 'https://www.rewwprintmail.com/uploads/8EGEt/3d5343a9f7.jpg', 27),
(72, 'product_url', 'https://kc-userdata.s3.amazonaws.com/34909/REWW/reww-User-34909--S522209-J200730.zip', 27),
(73, 'logo', 'https://www.rewwprintmail.com/uploads/moZcs/de10afd2c7.jpg', 28),
(74, 'signature', 'https://www.rewwprintmail.com/uploads/moZcs/814da5ee77.jpg', 28),
(75, 'product_url', 'https://kc-userdata.s3.amazonaws.com/58683/REWW/reww-User-58683--S522334-J200848.zip', 28),
(76, 'logo', 'https://rewwprintmail.com/uploads/ny6MT/5d365317d2.jpg', 29),
(77, 'mailinglist', 'https://rewwprintmail.com/uploads/ny6MT/f43e48c01f.csv', 29),
(78, 'letter', 'https://rewwprintmail.com/uploads/ny6MT/53619a93c2.pdf', 29),
(79, 'mailinglist', 'https://rewwprintmail.com/uploads/9zmjJ/ef559c2699.csv', 30),
(80, 'mailinglist', 'https://rewwprintmail.com/uploads/9zmjJ/ef559c2699.csv', 30),
(81, 'mailinglist', 'https://rewwprintmail.com/uploads/9zmjJ/ef559c2699.csv', 30),
(82, 'logo', 'https://www.rewwprintmail.com/uploads/yyVib/aa2ef76b13.jpg', 31),
(83, 'signature', 'https://www.rewwprintmail.com/uploads/yyVib/afddf9101a.jpg', 31),
(84, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63172/REWW/reww-User-63172--S523277-J201021.zip', 31),
(85, 'logo', 'https://www.rewwprintmail.com/uploads/o2X2n/222877d09c.jpg', 32),
(86, 'signature', 'https://www.rewwprintmail.com/uploads/o2X2n/d41582f5df.jpg', 32),
(87, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63172/REWW/reww-User-63172--S523344-J201036.zip', 32),
(88, 'product_url', 'https://kc-userdata.s3.amazonaws.com/48702/FMSN/fmsn-User-48702--S523239-J201050.zip', 33),
(89, 'logo', 'https://www.rewwprintmail.com/uploads/QSRqe/68822c8b0f.jpg', 34),
(90, 'signature', 'https://www.rewwprintmail.com/uploads/CEfwz/1f19a62f24.jpg', 35),
(91, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63277/REWW/reww-User-63277--S523350-J201054.zip', 35),
(92, 'logo', 'https://www.rewwprintmail.com/uploads/8v9pq/2ddd176add.jpg', 36),
(93, 'signature', 'https://www.rewwprintmail.com/uploads/8v9pq/5268781386.jpg', 36),
(94, 'product_url', 'https://kc-userdata.s3.amazonaws.com/57353/REWW/reww-User-57353--S518550-J201068.zip', 36),
(95, 'logo', 'https://www.rewwprintmail.com/uploads/J060y/39939d6798.jpg', 37),
(96, 'signature', 'https://www.rewwprintmail.com/uploads/J060y/ae36e9d645.jpg', 37),
(97, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63279/REWW/reww-User-63279--S523075-J201179.zip', 37),
(98, 'logo', 'https://www.rewwprintmail.com/uploads/P0SYj/877997b5b4.jpg', 38),
(99, 'product_url', 'https://kc-userdata.s3.amazonaws.com/60108/REWW/reww-User-60108--S524046-J201301.zip', 38),
(100, 'logo', 'https://www.rewwprintmail.com/uploads/PwiQC/ae2d43e723.jpg', 39),
(101, 'signature', 'https://www.rewwprintmail.com/uploads/PwiQC/a313a008da.jpg', 39),
(102, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63358/REWW/reww-User-63358--S524059-J201305.zip', 39),
(103, 'logo', 'https://www.rewwprintmail.com/uploads/Oqy39/c1871a28d7.jpg', 40),
(104, 'signature', 'https://www.rewwprintmail.com/uploads/Oqy39/b359a3b064.jpg', 40),
(105, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63279/REWW/reww-User-63279--S524129-J201337.zip', 40),
(106, 'logo', 'https://www.rewwprintmail.com/uploads/tSStL/5b0d51f6b6.jpg', 41),
(107, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62702/REWW/reww-User-62702--S524568-J201512.zip', 41),
(108, 'mailinglist', 'https://www.rewwprintmail.com/uploads/YzUpW/1f89546860.xlsx', 42),
(109, 'letter', 'https://www.rewwprintmail.com/uploads/YzUpW/4373e427f2.docx', 42),
(110, 'logo', 'https://www.rewwprintmail.com/uploads/YzUpW/7190ef28de.jpg', 42),
(111, 'product_url', 'https://kc-userdata.s3.amazonaws.com/28720/FMSN/fmsn-User-28720--S525103-J201728.zip', 43),
(112, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62690/FMSN/fmsn-User-62690--S525504-J201917.zip', 45),
(113, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62690/FMSN/fmsn-User-62690--S525504-J201917.zip', 45),
(114, 'signature', 'https://www.rewwprintmail.com/uploads/VAPyN/2d47f076c8.jpg', 46),
(115, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63453/REWW/reww-User-63453--S525754-J201996.zip', 46),
(116, 'logo', 'https://www.rewwprintmail.com/uploads/A5u5e/b0a3190903.jpg', 47),
(117, 'signature', 'https://www.rewwprintmail.com/uploads/A5u5e/4ad7f6b60c.jpg', 47),
(118, 'product_url', 'https://kc-userdata.s3.amazonaws.com/38294/CPFR/cpfr-User-38294--S526770-J202316.zip', 47),
(119, 'logo', 'https://www.rewwprintmail.com/uploads/PLpID/8ddfb4599d.jpg', 48),
(120, 'signature', 'https://www.rewwprintmail.com/uploads/PLpID/7ebe133539.jpg', 48),
(121, 'product_url', 'https://kc-userdata.s3.amazonaws.com/38294/CPFR/cpfr-User-38294--S526771-J202318.zip', 48),
(122, 'logo', 'https://www.rewwprintmail.com/uploads/DHGBu/28243695a9.jpg', 49),
(123, 'signature', 'https://www.rewwprintmail.com/uploads/DHGBu/ef07347f5e.jpg', 49),
(124, 'product_url', 'https://kc-userdata.s3.amazonaws.com/38294/CPFR/cpfr-User-38294--S526772-J202319.zip', 49),
(125, 'mailinglist', 'https://www.rewwprintmail.com/uploads/SIe8c/5813c29fdb.xlsx', 50),
(126, 'logo', 'https://www.rewwprintmail.com/uploads/SIe8c/cbc739369c.jpg', 50),
(127, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63159/FMSN/fmsn-User-63159--S526391-J202369.zip', 50),
(128, 'logo', 'https://www.rewwprintmail.com/uploads/BSd5q/7e4381c808.jpg', 51),
(129, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63307/REWW/reww-User-63307--S525574-J202397.zip', 51),
(130, 'logo', 'https://www.rewwprintmail.com/uploads/ygz6v/a80061c7cd.jpg', 52),
(131, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62106/REWW/reww-User-62106--S522060-J202405.zip', 52),
(132, 'logo', 'https://www.rewwprintmail.com/uploads/RhQTq/237f7cf67d.jpg', 53),
(133, 'signature', 'https://www.rewwprintmail.com/uploads/RhQTq/fad657d758.jpg', 53),
(134, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63521/FMSN/fmsn-User-63521--S527409-J202657.zip', 53),
(135, 'mailinglist', 'https://rewwprintmail.com/uploads/hOHlT/07869f3dd6.xlsx', 55),
(136, 'signature', 'https://rewwprintmail.com/uploads/hOHlT/4ba4e2ddb0.jpg', 55),
(137, 'logo', 'https://www.rewwprintmail.com/uploads/kdAIP/d0597ef13f.jpg', 56),
(138, 'signature', 'https://www.rewwprintmail.com/uploads/kdAIP/27f40eb926.jpg', 56),
(139, 'product_url', 'https://kc-userdata.s3.amazonaws.com/46320/REWW/reww-User-46320--S528786-J202997.zip', 56),
(140, 'product_url', 'https://kc-userdata.s3.amazonaws.com/52825/REWW/reww-User-52825--S528948-J203047.zip', 59),
(141, 'product_url', 'https://kc-userdata.s3.amazonaws.com/52825/REWW/reww-User-52825--S528948-J203047.zip', 59),
(142, 'product_url', 'https://kc-userdata.s3.amazonaws.com/52825/REWW/reww-User-52825--S528948-J203047.zip', 59),
(143, 'product_url', 'https://kc-userdata.s3.amazonaws.com/52825/REWW/reww-User-52825--S528948-J203047.zip', 59),
(144, 'logo', 'https://www.rewwprintmail.com/uploads/AsT73/462f3aa057.jpg', 63),
(145, 'signature', 'https://www.rewwprintmail.com/uploads/AsT73/e545aa7b59.jpg', 63),
(146, 'product_url', 'https://kc-userdata.s3.amazonaws.com/23452/FMSN/fmsn-User-23452--S528966-J203056.zip', 63),
(147, 'logo', 'https://www.rewwprintmail.com/uploads/NgmdU/8676e90890.jpg', 63),
(148, 'signature', 'https://www.rewwprintmail.com/uploads/NgmdU/e510737f78.jpg', 63),
(149, 'product_url', 'https://kc-userdata.s3.amazonaws.com/23452/FMSN/fmsn-User-23452--S528966-J203056.zip', 63),
(150, 'logo', 'https://www.rewwprintmail.com/uploads/2WcTC/6da4ca68da.jpg', 65),
(151, 'signature', 'https://www.rewwprintmail.com/uploads/2WcTC/aa424fcd36.jpg', 65),
(152, 'product_url', 'https://kc-userdata.s3.amazonaws.com/23452/FMSN/fmsn-User-23452--S528971-J203062.zip', 65),
(153, 'logo', 'https://www.rewwprintmail.com/uploads/w26IL/9791dcb8b0.jpg', 66),
(154, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63498/REWW/reww-User-63498--S527003-J203073.zip', 66),
(155, 'logo', 'https://www.rewwprintmail.com/uploads/VcNrq/49f30cd105.jpg', 67),
(156, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63498/REWW/reww-User-63498--S527003-J203080.zip', 67),
(157, 'logo', 'https://www.rewwprintmail.com/uploads/kfmJn/4ba2623097.jpg', 68),
(158, 'mailinglist', 'https://www.rewwprintmail.com/uploads/kfmJn/6425ca21cc.csv', 68),
(159, 'mailinglist', 'https://www.rewwprintmail.com/uploads/4RgAv/ef48324de8.csv', 69),
(160, 'product_url', 'https://kc-userdata.s3.amazonaws.com/62052/REWW/reww-User-62052--S529340-J203177.zip', 69),
(161, 'letter', 'https://www.rewwprintmail.com/uploads/VG8Md/cab92fb5e0.docx', 71),
(162, 'logo', 'https://www.rewwprintmail.com/uploads/VG8Md/1fe704dc83.jpg', 71),
(163, 'product_url', 'https://kc-userdata.s3.amazonaws.com/58808/REWW/reww-User-58808--S530325-J203454.zip', 71),
(164, 'logo', 'https://www.rewwprintmail.com/uploads/4JaCw/a9adbaee5f.jpg', 73),
(165, 'logo', 'https://www.rewwprintmail.com/uploads/gXJCv/385f1788f6.jpg', 74),
(166, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63498/REWW/reww-User-63498--S530595-J203565.zip', 74),
(167, 'logo', 'https://www.rewwprintmail.com/uploads/BAuRg/82ae088ac6.jpg', 74),
(168, 'product_url', 'https://kc-userdata.s3.amazonaws.com/63498/REWW/reww-User-63498--S530595-J203565.zip', 74);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `original_password` varchar(255) NOT NULL,
  `user_discount` float NOT NULL,
  `role` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0: Admin, 1: User',
  `is_active` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0: Inactive, 1: Active',
  `date_added` int(11) NOT NULL,
  `last_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `original_password`, `user_discount`, `role`, `is_active`, `date_added`, `last_login`) VALUES
(1, 'admin', 'jc@gcfrog.com', 'JAvlGPq9JyTdtvBO6x2llnRI1+gxwIyPqCKAn3THIKk=', 'admin123', 0, '0', '1', 1488391340, 1488448921),
(2, 'partha', 'partha.chowdhury@nettrackers.net', 'hU3cAGNp63usOLtmkOf5sF0NaGWb4fllZN9AfWU+DfI=', 'tester123', 10, '1', '1', 1488314397, 1488983148),
(3, 'homeremedy', 'homeremedykc@gmail.com', 'LjxxqM85FBJzWDQOzkwjgCCABARMoHGDGh59iv1pDho=', 'Super1man', 0, '1', '1', 1484207743, 1483978267),
(4, 'g7gymwest', 'g7gymwest@yahoo.com', 'Nm3nUU3f/SH5itWVJeddAhhSjtL3dW1EQ0+SVnAbLss=', 'Hubert7&', 0, '1', '1', 1485217507, 1486758695),
(5, 'davidlpatrick', 'davidlpatrick@gmail.com', 'E3bcWfnXHavLXH1D66bZ8/0XYeWsT2mYeKTeJOH1hR0=', 'dp28202820', 0, '1', '1', 1485257955, 1487430614),
(6, 'reisuccesstrain', 'tellisonba@gmail.com', 'TltxDjwyPlk/Cwvanuml2ep2goDJdfyFMLV14Acv3OI=', 'bigpictur3', 0, '1', '1', 1485290094, 1485290094),
(7, 'erans', 'sivanrealtyinvestors@gmail.com', 'yKAu2lZQlyWwscdONRe8iRPjSyTuwCUvLOF+gW0tOsI=', 'Creator57', 0, '1', '1', 1485381976, 1485381976),
(8, 'dmbass3838@gmail.com', 'dmbass3838@gmail.com', 'hcMVDsFN7ySf4G/O4qq2Za3XEQmYOHVBnZL0hK7N7PM=', 'Bass2017', 0, '1', '1', 1485392453, 1485900535),
(9, 'Ryuhanick', 'ryuhanick79@gmail.com', 'uWvZZ4XnUWeaOIbuhMDZGFxye5fZEoGSJyD2eMXi3XE=', '65Skylark', 0, '1', '1', 1485446269, 1485446269),
(10, 'nicolas12', 'starkeyinvesting@yahoo.com', '5IzLLfLiiAigHocBwfSsUwysfiJLux8FojY60AKQQek=', 'maddie12', 0, '1', '1', 1485479657, 1485479657),
(11, 'labellaby', 'ywuanabuyshouses@gmail.com', 'mtuIb1+hTWdC15jXqhTPo9rs3Vtg797Dj4QFrLLID6k=', 'reww@123', 0, '1', '1', 1485516164, 0),
(12, 'cpay2me', 'dcarlton@mail.com', 'mtuIb1+hTWdC15jXqhTPo9rs3Vtg797Dj4QFrLLID6k=', 'reww@123', 0, '1', '1', 1485516202, 0),
(13, 'tyeminent31', 'tyscustomhomes@gmail.com', 'mtuIb1+hTWdC15jXqhTPo9rs3Vtg797Dj4QFrLLID6k=', 'reww@123', 0, '1', '1', 1485516238, 0),
(14, 'tsgreen', 'gpinvestmentgroup@comcast.net', 'mtuIb1+hTWdC15jXqhTPo9rs3Vtg797Dj4QFrLLID6k=', 'reww@123', 0, '1', '1', 1485516270, 0),
(15, 'mcarp03', 'michael@okHouseBuyer.com', 'MZJu323ZODc51yp82WIyXMv/laUXjySCk7r6CDBZiqk=', 'Jumper.03', 0, '1', '1', 1485530808, 1485530808),
(16, 'alp9699@gmail.com', 'alp9699@gmail.com', 'TBEn5Z2yCgzrr7zpTau9Dz3qcIYtbJbo8BZlv+HU7bc=', '331Giants##', 0, '1', '1', 1485614681, 1485614681),
(17, 'rodseward3', 'rodseward3@gmail.com', 'jefNnnInKbSfRspfCmkwGK1+OJx0OmU9SA2h4w/o/6A=', 'Sewardrod321', 0, '1', '1', 1485646746, 1487703035),
(18, 'ltyrone7', 'TrueFaithProperties@gmail.com', 'Ge52NZKJNwUw0oqiwjYY3SXO0/WQ59fvcDxplZ7oq6M=', 'Louise1935', 0, '1', '1', 1485712027, 1485721956),
(19, 'mboyd', 'realityinvestments.901@gmail.com', '52wEBEag1WaliQx4fkafbnXs/p8vnZNVGCkbcXEhdyo=', '2kleen4u', 0, '1', '1', 1485780532, 1486768312),
(20, 'brandon teeples', 'brandonteeples@gmail.com', 'zHTInWfHT4Nx/Bo2F8XbZSzT/ienEmCuQdXN76Vmf1k=', 'tara4138', 0, '1', '1', 1485787186, 1485787186),
(21, 'score1', 'score1ps@gmail.com', 'UTSXexHVTcitrOZ6wYyLkZ2PGqwqi+XkNvhmqvi2eJ0=', 'Score0125', 0, '1', '1', 1485892302, 1485892302),
(22, 'sarchers', 'sue@suearcher.com', 'I3ZNPr89AuWcXliypx24UtS4zAyPGhDEfHJWYkbOPw8=', '6528!Gizmo', 0, '1', '1', 1485901198, 1485901198),
(23, 'jhoriatis', 'jhoriatis@gmail.com', 'PcOB4k6NbtxImfHoTiqOYqbhtxVb5namK0Iz3ZmW4Y4=', '5377422zrO23', 0, '1', '1', 1485908429, 1485908429),
(24, 'Salitad', 'Salita@franklyhomebuyers.com', 'F/5r3KMTbradOAWSjzwUhAsWBpfiDISaNK9jYjAJ2kE=', 'SA42166D$', 0, '1', '1', 1485913585, 1487721638),
(25, 'rpfadt', 'rick.hsihomes@gmail.com', 'lvUvq6hGyOX4M/Fyq6djeIpNktSwQ1ymz7YhQGOLZQo=', 'HomesWanted2', 0, '1', '1', 1485982779, 1486578610),
(26, 'ChampionRealty', 'Aaronbuchanan735@gmail.com', 'L407S/stu9TeIROxEoxEgEiohASYvT6+PUvQk2c28eg=', 'goodtimes1', 0, '1', '1', 1486000762, 1486000762),
(27, 'libertymailer', 'lreinvestinc@gmail.com', 'BLH1gVEfqeeLxFJrzUB27PuLF1Jl4HMK37xfF2Jg/ZE=', 'Moneymaker', 0, '1', '1', 1486019412, 1486019412),
(28, 'abarber', 'abarberiv@gmail.com', '1DyL1Xl6pDpW9do8DzW/flHmQf5Rx5wZSN+j/eBuHgQ=', 'discipline', 0, '1', '1', 1486025541, 1486505535),
(29, 'Gstetz2017', 'Gstetz2017@yahoo.com', 'IB07GaOYeSq25X/tykl98Yqdgiomlcv+PJAWTWk+kC8=', 'Wealthy1', 0, '1', '1', 1486087432, 1486560273),
(30, 'ulmax', 'frontforce2@gmail.com', 'f/Kj4W+ogSqqF94TZ4bxeVF0IW1OaSHZ4ZK1C42iwdA=', 'forestal2', 0, '1', '1', 1486089201, 1486089201),
(31, 'Johnny Stine', 'johnnystine@gmail.com', 'CWmIljIS3v9RurxRZJZoUSO1KjV7H78aKtl5RJtvh1c=', 'pimp1234', 0, '1', '1', 1486142389, 1486142389),
(32, 'ElsaMartinezCC', 'ElsaMartinezCC@gmail.com', 'Z2ovceU+ALThjGW6d+5d92OQ1XxOyQmFI6ZB8zQrciQ=', 'Freedom2017', 0, '1', '1', 1486185020, 1486590897),
(33, 'Kameahle24', 'klphicinc@gmail.com', 'XLFvXXCUM2Xz8+LqsRpaw7trAautGwTURHS0YUGJrRE=', 'Clueless24', 0, '1', '1', 1486248495, 1486248495),
(34, 'tannergiffin', 'tanner.giffin@yahoo.com', 'pO7kY4ulHhDHxXwbCpF8VwJp+WmpMMR6ECIfbshQ6Zk=', 'TGgraphic13', 0, '1', '1', 1486414944, 1486414944),
(35, 'mcboyd', 'agagehomebuyer@gmail.com', '52wEBEag1WaliQx4fkafbnXs/p8vnZNVGCkbcXEhdyo=', '2kleen4u', 0, '1', '1', 1486421841, 1486761791),
(36, 'dhrealty1@netzero.net', 'dhrealty1@netzero.net', '', 'theatrical', 10, '1', '1', 1486449053, 1486758581),
(37, 'CMIrewwprintmail', 'contractmoneyinvestments@gmail.com', 'kZVQ4YX0edqZg8OWAIdViif6cweCnk2DfJF3yr6DVNA=', 'cmimailouts', 0, '1', '1', 1486459343, 1487103095),
(38, 'trwill20mill', 'trwproperties@gmail.com', '/LdXQAx6UxuPmeUkvx90RZAU3/7SsqnPtKf6J9OeVX4=', 'sniper2017', 0, '1', '1', 1486489196, 1486489196),
(39, 'jagjit', 'jagjit@jbventuresgroup.com', 'kPlBbgyDY+5V6znKwcc+tKnKW/yL2+OkjxDHMwXUyS8=', 'Smalsar25/', 0, '1', '1', 1486514019, 1486514019),
(40, 'mack24t', 'joey.l.mack@gmail.com', 'mNrdCAoCrQphI6cOfp9FaLk5/TejU+N2+7TLy4OhamA=', 'Ndsu2014', 0, '1', '1', 1486523283, 1486523283),
(41, 'gregord30', 'gregord30@gmail.com', 'HGVp/wOWAwbd9+Mzk1C5Ojv3k11yZfMKR+2y9YmeGFE=', 'greguy00', 0, '1', '1', 1486526158, 1486527906),
(43, 'leomihomes@gmail.com', 'leomihomes@gmail.com', 'Zgn/FK3VxdSOnWrFo3iugx09HlENqjjCBFtyUDU9YB0=', 'maryjune77', 0, '1', '1', 1486584875, 1486584875),
(44, 'willmoya', 'willmoya@gmail.com', '0S5M/8/qzWO+fT+EgdFwbe99mgM7XhanqdAHlXFlxt0=', 'gianluca07', 0, '1', '1', 1486592990, 1486592990),
(45, 'itbenefitsall', 'itbenefitsall@gmail.com', 'QO2fqqk7hwwn+Uu6DG5NxGCjanC+WcJkdhFzV0N/zIs=', 'Get2$now1116', 0, '1', '1', 1486663364, 1486663364),
(46, 'laurenklartest', 'klar.lauren@gmail.com', 'cdYsQYjuixUtqiNk21XPkF7wUQgze9BkV2M4Bsttt6M=', 'gcg174', 0, '1', '1', 1486679575, 1487362655),
(47, 'garycoit', 'garycoit@yahoo.com', '38tWEeXMjJfj4PAAFJKF3tkBZ5KNKbNZibIc6tjDMDI=', 'garycoit', 0, '1', '1', 1486680666, 1486680955),
(48, 'ktrph', 'gonedeep2@comcast.net', 'UW/ajhUt21oNXvpVSMhTiPI04YXhAeEma2bnsUw9cQQ=', 'bedroom$32', 0, '1', '1', 1486755738, 1486755738),
(49, 'injun', 'injun77@yahoo.com', 'EUsHdoSK6NzB4FEfLhMOSiIviPVIGpeuTxMEkoOw3Qw=', 'injun99', 0, '1', '1', 1486761091, 1486764916),
(50, 'cmcdaniels323', 'calvin@cbmholdingsllc.com', '73l8gRjwLftklgfdXT+MdiMEjJwGPVMsyVxe16iYpk8=', '12345678', 0, '1', '1', 1486762492, 1486764196),
(51, 'REWWPeterson', 'nayeelasackie@hotmail.com', '52a4NaOjSt+xHxqT8dLSdBUeIUiKd8SwkIKpUDA6xAc=', 'yfnr8uxr', 0, '1', '1', 1486849821, 1487963615),
(52, 'cstevenson058', 'cstevenson058@gmail.com', '6aD/ZYm2AmG5e8Q5xYNv0Ww5B8I+zFqADCPBZMXIoAg=', 'sharlene', 0, '1', '1', 1486931554, 1486931554),
(53, 'Tpalumbo1', 'tpalumbo@gmail.com', 'cidFmnFdxN8B8J9R5D3NI5v6PdK7cmAxNs0PL+usRY8=', 'master11', 0, '1', '1', 1486932723, 1487001587),
(55, 'rohit', 'jazzyrohitsharma@yahoo.com', 'hU3cAGNp63usOLtmkOf5sF0NaGWb4fllZN9AfWU+DfI=', 'tester123', 0, '1', '1', 1486998742, 1487660228),
(56, 'rohit12', 'jazzyrohitsharma@gmail.com', 'hU3cAGNp63usOLtmkOf5sF0NaGWb4fllZN9AfWU+DfI=', 'tester123', 0, '1', '1', 1487000822, 1487000990),
(57, 'partha2', 'partha.chowdhury.sit@gmail.com', 'hU3cAGNp63usOLtmkOf5sF0NaGWb4fllZN9AfWU+DfI=', 'tester123', 0, '1', '1', 1487005611, 1487006494),
(58, 'drsordean', 'trc.capital.resources@gmail.com', 'B10SWCuDxZHNa3Wz1KcU5WcFbmu2Z29ejOQ0Q3wEF3s=', 'Redwood3021', 0, '1', '1', 1487031048, 1487635248),
(59, 'mvcathey', 'mvcathey@gmail.com', 'IJzm8fQQv4eiZeVBCcxl2Y9RjIX7uROwu4cUnZWUjik=', 'Savanna1', 0, '1', '1', 1487104094, 1487104094),
(60, 'willclosefast', 'webuy@willclosefast.com', 'e7N9cYjbzSkTv1SPNzHAek9x9RvkiZnDgZWk0dI4fi4=', 'M4rk3t1ng', 0, '1', '1', 1487124365, 1487124365),
(61, 'jwiatrak13@verizon.net', 'jwiatrak13@verizon.net', 'x5/Lf/Ya0wmJ8e6nzPLmFb7atQjiAI42Nx7gvSp9lM4=', 'beaumont1', 0, '1', '1', 1487199692, 1487199692),
(62, 'debbi.rivero@yourkeyconsultants.com', 'debbi.rivero@yourkeyconsultants.com', '3fPx96gzokQwIt69IotwuzxvRPPnXt3FWUSeMdcvSek=', 'pepper4us', 0, '1', '1', 1487218788, 1487250855),
(63, 'steeltownreno', 'info@steeltownproperties.com', 'jrUyo7PyhhI3/hRTWpE33Z45kI7EFhpmpVA8XNIzHVE=', 'Southsideflats1', 0, '1', '1', 1487346042, 1487619111),
(64, 'makeman', 'illinoismidwest@gmail.com', 'Fg4RjfvB+4GBgpDIyxDNn1Qb8K1PQ6DJ94FfoOi7r80=', 'Steelin123', 0, '1', '1', 1487355280, 1488065237),
(65, 'RupinderDulay', 'dulayhomes@yahoo.com', 't+gc3a/Guei8c2l9juNqTiH/PtOBgIjEH9OT5IcwJPI=', 'print28', 0, '1', '1', 1487380899, 1487380899),
(66, 'tmlhinvestments', 'investing4them@gmail.com', 'AStXJLu7k1sfAbS+U0qJiTrQ5nec2OsbtBl5ijkGXgY=', 'Madicey02!', 0, '1', '1', 1487381290, 1487381290),
(67, 'makila1026', 'georne1026@gmail.com', 'QlVWdiX7Z6HXOihCBvpQzOngkuIk1kZFbDPaNjFptN8=', 'Aniyah0515', 0, '1', '1', 1487383552, 1487383552),
(68, 'jonperrypgh', 'jpinvestor@gmail.com', 'MDs1DSO5Wnf0KfhFCwf1YvB+5vkfiyjxcWdRjLhT07M=', 'GoSteelers1', 0, '1', '1', 1487420678, 1487420678),
(69, 'Bpettus123', 'cardinalstaterealestate@gmail.com', 'gZ9PC2NbYv/ITExei8TR+Z++Q6LsKneFR4pBt+cWlec=', 'Beezy216', 0, '1', '1', 1487422934, 1488057165),
(70, 'iconichomesolutions', 'Info@iconichomesolutions.com', 'Ni2yxFXPIwT1f340Ppu5N5X0FF+Xt9wlsDxfQQaa8Z0=', 'Blg02032017', 0, '1', '1', 1487642919, 1487721129),
(71, 'REBigDog', 'dwman64@aol.com', '0xWEN4x3eftnxY3OSOP6rJNJqUmrUFqQyXDp+Vj/LrA=', 'Gypsy64', 0, '1', '1', 1487690575, 1487692022),
(72, 'Jcarrothers', 'jcarrothers@cinvg.com', 'sjoHnHLioZ41erPRHMxZTNrzrukYMz4zjBbsVvdSJrw=', 'Allgood08', 0, '1', '1', 1487698612, 1487895763),
(73, 'dalworth04', 'admin@dal-worthhousebuyers.com', 'KyMWGfpqLlucuo5+NwyB2u3LYZv4/YGqhRxU5uQ+CaQ=', 'Gl@diz04', 0, '1', '1', 1487701899, 1487701899),
(74, 'simplydone', 'harristia724@gmail.com', 'FcF68oRsDRYwCO9l83sbFMOCnRtKy358SCq7YFQd4No=', 'madiceyinvestments', 0, '1', '1', 1487820539, 1487820539),
(75, 'USNAVY2016', 'deddrickbarnes89@gmail.com', '8Y9vPO31yCZPSt2NhG/hYdYV9gQEw99/Q1qMeEtyN74=', 'Capribarnes9!', 0, '1', '1', 1487822400, 1487989990),
(76, 'John Hochstetler', 'dreamscapes82@hotmail.com', 'g4SgD4hk/R0Cwrf/PhH7WN+GiWcdVYANvZhPvPjqhdE=', 'u4f8byb9', 0, '1', '1', 1487867243, 1487975800),
(77, 'abedford', 'annflood1974@gmail.com', 'hD24bxIngXOvjFwHqMmYbHHU8+6MrV2H4BJFHjwA67A=', 'staffing', 0, '1', '1', 1487867978, 1487867978),
(78, 'eric@asdmservices.com', 'eric@asdmservices.com', 'UIbGtPf5HMKDo6i2jR8cPwKdxexVOSiycqRy/TJrzSQ=', '7a5uerk9', 0, '1', '1', 1488002672, 1488002672),
(79, 'bavedikian', 'brandonave2015@gmail.com', '8ofkr6pMevCw4u4ZAcG1BmNFdf+KjEmrS+fphOhXy7o=', 'Brandon0691', 0, '1', '1', 1488056137, 1488056137),
(80, 'thetstuff', 'thetastuff@gmail.com', 'q524BG0gkGo1jRM8/VQ52km1YDjeMatRSxfH+GeVww8=', 'jessie007', 0, '1', '1', 1488069163, 1488069163);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`cms_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `mailing_dates`
--
ALTER TABLE `mailing_dates`
  ADD PRIMARY KEY (`mailing_date_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD PRIMARY KEY (`up_file_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `cms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mailing_dates`
--
ALTER TABLE `mailing_dates`
  MODIFY `mailing_date_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;
--
-- AUTO_INCREMENT for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  MODIFY `up_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
