-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2013 at 05:16 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_quizmaker`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groups`
--

CREATE TABLE IF NOT EXISTS `tbl_groups` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `banner` text NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=276 ;

--
-- Dumping data for table `tbl_groups`
--

INSERT INTO `tbl_groups` (`id`, `name`, `description`, `banner`, `date_added`) VALUES
(0, 'God', 'This is an untouchable group. Only devs can see this.', '', '2012-09-29'),
(1, 'Default', 'This is the group by the developers of BundledFun.', '', '2012-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions`
--

CREATE TABLE IF NOT EXISTS `tbl_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(30) NOT NULL,
  `text` text NOT NULL,
  `identification` tinyint(1) NOT NULL DEFAULT '1',
  `difficulty` text NOT NULL,
  `answer` text NOT NULL,
  `choice_a` text NOT NULL,
  `choice_b` text NOT NULL,
  `choice_c` text NOT NULL,
  `file` text NOT NULL,
  `type` text NOT NULL,
  `points` int(30) NOT NULL,
  `timer` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2410 ;

--
-- Dumping data for table `tbl_questions`
--

INSERT INTO `tbl_questions` (`id`, `group_id`, `text`, `identification`, `difficulty`, `answer`, `choice_a`, `choice_b`, `choice_c`, `file`, `type`, `points`, `timer`) VALUES
(4, 1, 'It is the process of exchanging ideas as to transmit message from one person to\nanother.', 0, '', 'communication', 'opinion', 'conclusion', 'communication', '', 'text', 1, 30),
(6, 1, ' It is a word or group of words that expresses a complete thought', 0, '', ' sentence', ' word', ' sentence', ' phrase', '', 'text', 1, 20),
(31, 1, 'Is the 44th and current President of the United States. He is the first African American to hold the office. Obama served as a U.S. Senator representing the state of Illinois from January 2005 to November 2008, when he resigned following his victory in the 2008 presidential election.', 0, '', ' Barrack Obama', ' Bill Clinton', ' John Adams', ' Barrack Obama', 'barrack_obama.jpg', 'image', 1, 30),
(32, 1, 'Is a Filipino professional boxer and politician. He is the first eight-division world champion,[5] in which he has won ten world titles, as well as the first to win the Lineal Championship in four different weight classes.', 0, '', 'Manny Paquiao', 'Manny Paquiao', ' AJ Banal', ' Bobby Pacquiao', 'manny_pacquiao.jpg', 'image', 1, 30),
(61, 1, 'The film''s story is set three years after the events of the second Transformers film', 0, '', 'Dark of the Moon', 'Revenge of the Fallen', 'Megatron Returns', 'Dark of the Moon', 'dark-of-the-moon.mp4', 'video', 1, 60),
(64, 1, 'Is a debut single by American singer-songwriter Bruno Mars, and is the lead single from his debut studio album, Doo-Wops & Hooligans.', 0, 'hard', 'Just the Way You Are', 'The Lazy Song', 'Nothing On You', 'Just the Way You Are', 'just.mp3', 'audio', 1, 30),
(69, 1, 'A song by goteye.', 0, '', 'Somebody That I Used to Know', 'Somebody That You Used to Know', 'Somebody That We Used to Know', 'Somebody That I Used to Know', 'somebody-that-i-used-to-know.mp3', 'audio', 1, 40),
(567, 1, 'Identification Testing Question?', 1, '', 'yes', '', '', '', '', 'text', 23, 23);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scores`
--

CREATE TABLE IF NOT EXISTS `tbl_scores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `time_elapsed` int(11) NOT NULL,
  `correct_answers` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(30) NOT NULL,
  `username` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `password` varchar(30) NOT NULL,
  `name` text NOT NULL,
  `picture` text NOT NULL,
  `access_token` text NOT NULL,
  `email` text NOT NULL,
  `access` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=282 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `group_id`, `username`, `level`, `password`, `name`, `picture`, `access_token`, `email`, `access`) VALUES
(9, 0, 'admin', 0, 'admin', 'Oliver Martinez', 'default.png', 'super_admin_access', 'admin@bundledfun.com', 1),
(15, 1, 'default', 1, 'default', 'Default User', 'default.png', 'acae273a5a5c88b46b36d65a25f5f435', 'nemoryoliver@outlook.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
