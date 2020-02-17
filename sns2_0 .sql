-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2020 at 05:37 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sns2.0`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments_tbl`
--

CREATE TABLE `comments_tbl` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `comment_img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cover_img_tbl`
--

CREATE TABLE `cover_img_tbl` (
  `cover_img_id` int(11) NOT NULL,
  `img_name` varchar(100) DEFAULT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `followed_users`
--

CREATE TABLE `followed_users` (
  `follow_id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `followed_user_id` int(100) NOT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `followed_users`
--

INSERT INTO `followed_users` (`follow_id`, `user_id`, `followed_user_id`, `status`) VALUES
(2, 3, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_tbl`
--

CREATE TABLE `login_tbl` (
  `login_id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_tbl`
--

INSERT INTO `login_tbl` (`login_id`, `user_email`, `user_password`) VALUES
(1, 'kjmojado21@gmail.com', 'admin'),
(2, 'justin@gmail.com', 'mirror'),
(3, 'avicii@gmail.com', 'avicii');

-- --------------------------------------------------------

--
-- Table structure for table `posts_tbl`
--

CREATE TABLE `posts_tbl` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_content` varchar(1000) NOT NULL,
  `post_image` varchar(100) DEFAULT NULL,
  `time_posted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts_tbl`
--

INSERT INTO `posts_tbl` (`post_id`, `user_id`, `post_content`, `post_image`, `time_posted`) VALUES
(1, 0, 'becuase youre just like my mirror', NULL, '2020-02-12 02:34:46'),
(2, 1, 'hey there', NULL, '2020-02-12 02:34:46'),
(3, 1, '', '56400594_680421635707403_9168812778194845881_n.jpg', '2020-02-12 02:34:46'),
(4, 1, '', '1200px-Star_Wars_Logo.svg.png', '2020-02-12 02:34:46'),
(5, 1, 'fuck\r\n', NULL, '2020-02-12 02:34:46'),
(6, 1, 'no way no!', NULL, '2020-02-12 02:34:46'),
(7, 3, 'shiro toby\r\n', NULL, '2020-02-12 02:34:46'),
(8, 3, 'hey there brother\r\n', NULL, '2020-02-12 02:35:11'),
(9, 3, 'another one\r\n', NULL, '2020-02-12 04:16:05'),
(10, 3, 'sample new date\r\n', NULL, '2020-02-12 04:38:02'),
(11, 1, 'hey\r\n', NULL, '2020-02-17 01:23:07'),
(12, 3, '', '1200px-Star_Wars_Logo.svg.png', '2020-02-17 01:37:29'),
(13, 3, '', '1200px-Star_Wars_Logo.svg.png', '2020-02-17 01:37:36'),
(14, 3, '', NULL, '2020-02-17 02:02:53'),
(15, 3, 'asdasd', NULL, '2020-02-17 02:02:55'),
(16, 3, '', '1200px-Star_Wars_Logo.svg.png', '2020-02-17 02:13:10'),
(17, 3, 'hey there brother', '1200px-Star_Wars_Logo.svg.png', '2020-02-17 02:15:45'),
(18, 3, 'kimi kawaii yo ne', 'yuka.jpg', '2020-02-17 02:18:42'),
(19, 3, 'hey there', NULL, '2020-02-17 02:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `user_id` int(11) NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `user_age` varchar(100) NOT NULL,
  `user_bdate` date NOT NULL,
  `user_location` varchar(100) NOT NULL,
  `user_img` varchar(100) DEFAULT NULL,
  `login_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`user_id`, `user_fullname`, `user_age`, `user_bdate`, `user_location`, `user_img`, `login_id`) VALUES
(1, 'Kurt John Mojado', '', '0000-00-00', '', NULL, 1),
(2, 'Justin Timberlake', '23', '2020-02-12', 'Tokyo,Shibuya', NULL, 2),
(3, 'Avicii', '', '0000-00-00', '', NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `cover_img_tbl`
--
ALTER TABLE `cover_img_tbl`
  ADD PRIMARY KEY (`cover_img_id`);

--
-- Indexes for table `followed_users`
--
ALTER TABLE `followed_users`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `login_tbl`
--
ALTER TABLE `login_tbl`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `posts_tbl`
--
ALTER TABLE `posts_tbl`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cover_img_tbl`
--
ALTER TABLE `cover_img_tbl`
  MODIFY `cover_img_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followed_users`
--
ALTER TABLE `followed_users`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_tbl`
--
ALTER TABLE `login_tbl`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts_tbl`
--
ALTER TABLE `posts_tbl`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
