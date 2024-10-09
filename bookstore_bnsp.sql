-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 10:56 AM
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
-- Database: `bookstore_bnsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `nama_penulis` varchar(255) NOT NULL,
  `deskripsi_buku` text NOT NULL,
  `harga` float NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `id_category`, `judul`, `nama_penulis`, `deskripsi_buku`, `harga`, `cover`) VALUES
(1, 1, 'Laskar Pelangi', 'Andrea Hirata', 'Kisah inspiratif tentang sekelompok anak-anak di Belitung yang berjuang untuk mendapatkan pendidikan yang lebih baik.', 90000, 'laskar_pelangi.jpg'),
(3, 4, 'Cara Membuat Katsu', 'Fariz Imam Raditya', 'Ini adalah sebuah buku tentang cara - cara membuat Chicken Katsu', 70000, 'katsu.png'),
(4, 1, 'Batman', 'Raditya Ananda Rohman', 'Batman sang kelelawar malam', 80000, 'download (16).jpeg'),
(6, 2, 'Star Wars', 'Raditya Ananda Rohman', 'Star Wars adalah film Fiksi Ilmiah', 90000, 'download (10).jpeg'),
(8, 4, 'Cara Membuat Nasi Goreng', 'Fajar', 'Ini adalah sebuah buku tentang cara - cara membuat Nasi Goreng', 50000, 'kanye-stare.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `book_id`, `quantity`) VALUES
(5, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nama`, `deskripsi`) VALUES
(1, 'Fiksi', 'Buku-buku yang berisi cerita yang diciptakan dari imajinasi penulis.'),
(2, 'Fiksi Ilmiah', 'Buku-buku yang mengeksplorasi konsep-konsep futuristik dan ilmiah.'),
(3, 'Klasik', 'Buku-buku yang diakui secara luas sebagai contoh atau karya penting dalam sastra.'),
(4, 'Non-Fiksi', 'Buku-buku yang didasarkan pada informasi dan kejadian nyata.'),
(7, 'Horror', 'Serem banget! Aku takut. Ini kategori yang bikin kamu takut');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `message`, `created_at`) VALUES
(1, 2, 'a', '2024-07-24 05:14:10'),
(2, 2, 'mas imam', '2024-07-24 06:17:15'),
(3, 2, 'mas imam', '2024-07-24 06:17:30'),
(4, 2, 'mas imam', '2024-07-24 06:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('pending','completed','cancelled') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `created_at`) VALUES
(1, 2, 'pending', '2024-07-24 02:18:04'),
(2, 2, 'pending', '2024-07-24 02:18:44'),
(3, 2, 'pending', '2024-07-24 02:20:49'),
(4, 2, 'pending', '2024-07-24 02:43:03'),
(5, 2, 'pending', '2024-07-24 02:46:03'),
(6, 2, 'pending', '2024-07-24 02:46:08'),
(7, 2, 'pending', '2024-07-24 02:51:42'),
(8, 2, 'pending', '2024-07-24 02:53:17'),
(9, 2, 'pending', '2024-07-24 02:53:19'),
(10, 2, 'pending', '2024-07-24 03:20:36'),
(11, 2, 'pending', '2024-07-24 03:31:00'),
(12, 2, 'completed', '2024-07-24 03:42:42'),
(13, 5, 'completed', '2024-07-24 03:48:41'),
(14, 5, 'pending', '2024-07-24 04:30:48'),
(15, 6, 'completed', '2024-07-24 08:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `order_id`, `book_id`, `quantity`, `price`) VALUES
(1, 12, 3, 2, 70000),
(2, 12, 4, 1, 80000),
(3, 13, 1, 1, 90000),
(4, 15, 3, 1, 70000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$jyFJucTc9s9kGBzBuO8i/u0ozYgeOBgnUHJUMi1Gszrj6.gaIJf5i', 'admin'),
(2, 'Althaf ', 'Althaf ', 'altaop@gmail.com', '$2y$10$P7HBO8u5ePDn73MJCwl.Ju1wdoxIGy2sCdbg4cpl/Z/WalQJW2EfW', 'user'),
(5, 'Reyval', 'RDZ', 'reyval@gmail.com', '$2y$10$H845LrwYZxphYPubYMDn/.YytuTRVEqSouqXfgsTUgxgG5fq185mi', 'user'),
(6, 'Raditya Ananda Rohman', 'Radit', 'anandarohman2@gmail.com', '$2y$10$IrXEVGf4et9lh8SHwPuct.74leSrthO5lvNsk3kmtB/ZY6vxfja9K', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_detail_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
