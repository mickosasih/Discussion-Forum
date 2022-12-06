-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2022 at 11:49 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_list`
--

CREATE TABLE `comment_list` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `post_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post_list`
--

CREATE TABLE `post_list` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_list`
--

INSERT INTO `post_list` (`id`, `user_id`, `title`, `content`, `date_created`, `date_updated`) VALUES
(5, 6, 'Sample', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2022-12-06 17:46:12', '2022-12-06 17:46:12'),
(6, 6, 'Edit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Urna condimentum mattis pellentesque id nibh tortor. Suspendisse interdum consectetur libero id. Rhoncus mattis rhoncus urna neque viverra justo nec. Viverra maecenas accumsan lacus vel facilisis. Ac turpis egestas integer eget aliquet nibh praesent tristique. Lectus quam id leo in vitae. Egestas purus viverra accumsan in. Leo in vitae turpis massa sed elementum. Adipiscing vitae proin sagittis nisl rhoncus. Quis eleifend quam adipiscing vitae proin sagittis nisl. Sit amet cursus sit amet. Sem integer vitae justo eget. Massa eget egestas purus viverra accumsan in nisl. Morbi tristique senectus et netus et malesuada. Erat velit scelerisque in dictum non consectetur. Nisl pretium fusce id velit ut tortor pretium viverra. Ac placerat vestibulum lectus mauris. Vitae aliquet nec ullamcorper sit amet risus nullam eget. Suspendisse ultrices gravida dictum fusce ut placerat.\r\n\r\nAugue neque gravida in fermentum. Tristique nulla aliquet enim tortor at auctor. Consectetur libero id faucibus nisl tincidunt eget nullam non. Diam vulputate ut pharetra sit amet aliquam id diam maecenas. Sit amet porttitor eget dolor morbi non arcu. Ipsum dolor sit amet consectetur. Dignissim diam quis enim lobortis scelerisque fermentum dui. Eleifend donec pretium vulputate sapien nec. Laoreet non curabitur gravida arcu ac tortor dignissim. Ac orci phasellus egestas tellus rutrum tellus pellentesque. Nulla facilisi morbi tempus iaculis urna id volutpat lacus laoreet. Interdum consectetur libero id faucibus nisl tincidunt. Vulputate dignissim suspendisse in est ante in nibh. Lacus luctus accumsan tortor posuere ac ut consequat semper. Nulla at volutpat diam ut venenatis. Morbi tristique senectus et netus et malesuada fames ac. Volutpat blandit aliquam etiam erat velit scelerisque in. Aliquet porttitor lacus luctus accumsan tortor. Enim tortor at auctor urna nunc id cursus.\r\n\r\nDignissim sodales ut eu sem integer vitae. Maecenas volutpat blandit aliquam etiam erat velit scelerisque. Cras tincidunt lobortis feugiat vivamus at augue eget arcu. Quis hendrerit dolor magna eget est lorem ipsum dolor sit. Volutpat ac tincidunt vitae semper quis. Tortor dignissim convallis aenean et tortor at risus viverra. Arcu odio ut sem nulla pharetra diam sit amet nisl. Et sollicitudin ac orci phasellus egestas tellus rutrum. Erat nam at lectus urna. Quis hendrerit dolor magna eget. Sed cras ornare arcu dui vivamus. Mauris ultrices eros in cursus turpis massa. Nec tincidunt praesent semper feugiat. Adipiscing elit ut aliquam purus sit. Magna fringilla urna porttitor rhoncus dolor.\r\n\r\nTristique senectus et netus et malesuada fames ac turpis egestas. Ultrices in iaculis nunc sed augue lacus. Rhoncus mattis rhoncus urna neque. Vulputate eu scelerisque felis imperdiet proin fermentum leo vel. Venenatis lectus magna fringilla urna. Tincidunt arcu non sodales neque sodales ut. Dignissim diam quis enim lobortis scelerisque fermentum dui faucibus. Eget mauris pharetra et ultrices neque ornare aenean. Nibh nisl condimentum id venenatis a condimentum vitae sapien pellentesque. Nec feugiat in fermentum posuere urna nec tincidunt. Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Nisi porta lorem mollis aliquam ut porttitor. Pretium fusce id velit ut tortor. Lacus luctus accumsan tortor posuere. Non enim praesent elementum facilisis leo vel.', '2022-12-06 17:46:46', '2022-12-06 17:47:19'),
(7, 7, 'Post by User', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Urna condimentum mattis pellentesque id nibh tortor. Suspendisse interdum consectetur libero id. Rhoncus mattis rhoncus urna neque viverra justo nec. Viverra maecenas accumsan lacus vel facilisis. Ac turpis egestas integer eget aliquet nibh praesent tristique. Lectus quam id leo in vitae. Egestas purus viverra accumsan in. Leo in vitae turpis massa sed elementum. Adipiscing vitae proin sagittis nisl rhoncus. Quis eleifend quam adipiscing vitae proin sagittis nisl. Sit amet cursus sit amet. Sem integer vitae justo eget. Massa eget egestas purus viverra accumsan in nisl. Morbi tristique senectus et netus et malesuada. Erat velit scelerisque in dictum non consectetur. Nisl pretium fusce id velit ut tortor pretium viverra. Ac placerat vestibulum lectus mauris. Vitae aliquet nec ullamcorper sit amet risus nullam eget. Suspendisse ultrices gravida dictum fusce ut placerat.\r\n\r\nAugue neque gravida in fermentum. Tristique nulla aliquet enim tortor at auctor. Consectetur libero id faucibus nisl tincidunt eget nullam non. Diam vulputate ut pharetra sit amet aliquam id diam maecenas. Sit amet porttitor eget dolor morbi non arcu. Ipsum dolor sit amet consectetur. Dignissim diam quis enim lobortis scelerisque fermentum dui. Eleifend donec pretium vulputate sapien nec. Laoreet non curabitur gravida arcu ac tortor dignissim. Ac orci phasellus egestas tellus rutrum tellus pellentesque. Nulla facilisi morbi tempus iaculis urna id volutpat lacus laoreet. Interdum consectetur libero id faucibus nisl tincidunt. Vulputate dignissim suspendisse in est ante in nibh. Lacus luctus accumsan tortor posuere ac ut consequat semper. Nulla at volutpat diam ut venenatis. Morbi tristique senectus et netus et malesuada fames ac. Volutpat blandit aliquam etiam erat velit scelerisque in. Aliquet porttitor lacus luctus accumsan tortor. Enim tortor at auctor urna nunc id cursus.\r\n\r\nDignissim sodales ut eu sem integer vitae. Maecenas volutpat blandit aliquam etiam erat velit scelerisque. Cras tincidunt lobortis feugiat vivamus at augue eget arcu. Quis hendrerit dolor magna eget est lorem ipsum dolor sit. Volutpat ac tincidunt vitae semper quis. Tortor dignissim convallis aenean et tortor at risus viverra. Arcu odio ut sem nulla pharetra diam sit amet nisl. Et sollicitudin ac orci phasellus egestas tellus rutrum. Erat nam at lectus urna. Quis hendrerit dolor magna eget. Sed cras ornare arcu dui vivamus. Mauris ultrices eros in cursus turpis massa. Nec tincidunt praesent semper feugiat. Adipiscing elit ut aliquam purus sit. Magna fringilla urna porttitor rhoncus dolor.', '2022-12-06 17:48:53', '2022-12-06 17:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `avatar`, `last_login`, `date_added`, `date_updated`) VALUES
(6, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'uploads/avatars/6.png?v=1670323497', NULL, '2022-12-06 17:44:57', '2022-12-06 17:44:57'),
(7, 'User', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', NULL, NULL, '2022-12-06 17:48:27', '2022-12-06 17:48:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_list`
--
ALTER TABLE `comment_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `post_list`
--
ALTER TABLE `post_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment_list`
--
ALTER TABLE `comment_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post_list`
--
ALTER TABLE `post_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment_list`
--
ALTER TABLE `comment_list`
  ADD CONSTRAINT `comment_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_list_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_list`
--
ALTER TABLE `post_list`
  ADD CONSTRAINT `post_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
