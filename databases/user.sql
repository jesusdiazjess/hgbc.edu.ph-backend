-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 02:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password_hash`) VALUES
(1, 'Jesus', 'jesus.social@proton.me', '$2y$10$ZQoWhcuPDKQYStPp4HDFD.FemVU1m6n68JtvYoYvLyUivhQN6NUu6'),
(34, 'Lance', 'lance@gmail.com', '$2y$10$QKqGvoX85vxv8Orf5X4NGeLZrKGb5IcyF6.g5kGnNy8NgAMFfUnFq'),
(35, 'jess', 'jess@proton.com', '$2y$10$M75peZ2xysMsEwZmPivluO54JOuXOGdCVgzC4/d/OqRQwhZL0JrZO'),
(36, 'bryan', 'bry@g.c', '$2y$10$fqy0r5S3x/uWjERc2lAkRegZS2iwo0juh./ZHV1QHVz150MlZx6Q6'),
(37, 'james', 'j@c.c', '$2y$10$NCZbYmyCaejLRrTbvxGyy.6NQTQPI/hjKxrYwA5Txz8wLpPcU9otK'),
(39, 'Jesus', 'jess@fusasis.org', '$2y$10$dlN4cuqsFwcG0hMU.cV35O1hi0Tn5j3IKR1WrgX.dxSuVOsLgMrZO'),
(40, 'Bryan', 'jesus@fusasis.org', '$2y$10$c48dhG0lyK9OAmYecoewy.Au8b680UwgsWPYsqGP2KeNzxQaxsgMa'),
(48, 'Jesus', 'jesus@g.com', '$2y$10$IoXCVyk01kBqAorTbmNBmeHeVFXbtf7uG2zMogLuE4Pz.gcUrkPCG'),
(49, 'Fusa', 'jesus@fu.com', '$2y$10$V4qhUjO0mizJj7QxOdOMgu21hP2yqG/xnwu4jsS4758PfShVx.exm'),
(54, 'admin', 'admin@admin.com', '$2y$10$lhDgdgLxJMfszEodO3GdweYh8L.6MmNGdqqCem4sRwgDhCbfN.9dy'),
(57, 'Ursula', 'ursula@disney.com', '$2y$10$XTig4j97ZFPELKRKvMqb0..FNLKRtmL1BbiFNlNMxkWe2OdRx/S06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
