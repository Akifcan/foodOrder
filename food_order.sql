-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 10 Eyl 2019, 12:20:27
-- Sunucu sürümü: 5.7.17-log
-- PHP Sürümü: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `food_order`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `registered_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `password`, `registered_date`) VALUES
(1, '202cb962ac59075b964b07152d234b70', '2019-09-08 15:10:58');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `qunatity` int(11) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `drinks`
--

CREATE TABLE `drinks` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `drinks`
--

INSERT INTO `drinks` (`id`, `name`) VALUES
(3, '100% Sıkma Portakal Suyu'),
(1, 'Ayran'),
(2, 'Şalgam Suyu');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `food_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `price` float NOT NULL,
  `description` text COLLATE utf8_turkish_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `foods`
--

INSERT INTO `foods` (`id`, `food_name`, `price`, `description`, `image`, `is_active`, `added_date`) VALUES
(1, 'Ev Yemeği - Tavuk Izgara ve Salatalık', 20, 'Tavuk Salata Ve Belirlediğiniz Bir İçecek', 'https://cdn.yemek.com/mncrop/500/333/uploads/2016/04/izgara-tavuk-gogsu.jpg', 1, '2019-09-07 00:52:53'),
(2, 'Lahmacun', 5, 'Lahmacun Acılı ve Acısız Seçenekleri ve Seçtiğiniz İçecek', 'http://www.tenceretv.com/newsFiles/1/0/1/0/0/0/0/1/0/1/1/1/0/1/file/20666_wide.jpg', 1, '2019-09-07 00:52:53'),
(3, 'Köfte', 25, 'Köfte ekmek arası veya tabakta ve seçtiğiniz içecek', 'http://i2.haber7.net//haber/haber7/photos/2018/43/anne_koftesi_nasil_yapilir_ev_yapimi_kofte_tarifi_1540625943_5174.jpg', 1, '2019-09-07 00:52:53'),
(5, 'Karnıbahar', 12.3, 'karnıbahar', 'images/menu/no-image.png', 0, '2019-09-08 16:35:08'),
(6, 'sebze', 34.44, 'sebze', 'images/menu/sebze1567949874.jpg', 0, '2019-09-08 16:37:54');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `message` text COLLATE utf8_turkish_ci NOT NULL,
  `ip_address` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sent_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `message`
--

INSERT INTO `message` (`id`, `user_id`, `title`, `message`, `ip_address`, `sent_date`) VALUES
(1, 1, 'Özel Sipariş', 'Özel Sipariş', '', '2019-09-10 03:08:14'),
(2, 1, 'Sipariş Hatalı', 'asdf', '::1', '2019-09-10 03:09:31');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1-Order Taken - 2 Preparing 3-Sending 4-Receive By Customer',
  `food_id` int(11) NOT NULL,
  `drink` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `extra_note` text COLLATE utf8_turkish_ci NOT NULL,
  `address` text COLLATE utf8_turkish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`id`, `status`, `food_id`, `drink`, `extra_note`, `address`, `user_id`, `date`) VALUES
(1, 4, 1, '100% Sıkma Portakal ', '', 'Ev', 1, '2019-09-10 14:26:34');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_log`
--

CREATE TABLE `order_log` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1-Order Taken - 2 Preparing 3-Sending 4-Receive By Customer',
  `food_id` int(11) NOT NULL,
  `drink` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `extra_note` text COLLATE utf8_turkish_ci NOT NULL,
  `address` text COLLATE utf8_turkish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `order_log`
--

INSERT INTO `order_log` (`id`, `status`, `food_id`, `drink`, `extra_note`, `address`, `user_id`, `date`) VALUES
(1, 3, 1, '100% Sıkma Portakal ', '', 'Ev', 1, '2019-09-10 14:27:06'),
(2, 3, 1, '100% Sıkma Portakal ', '', 'Ev', 1, '2019-09-10 14:27:31'),
(3, 4, 1, '100% Sıkma Portakal ', '', 'Ev', 1, '2019-09-10 14:28:23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `registered_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `registered_date`, `is_active`) VALUES
(1, 'akif cankara', 'akif@hotmail.com', '202cb962ac59075b964b07152d234b70', '2019-08-30 12:46:47', 1),
(2, 'Akifcan Kara', 'akifcankara11@gmal.com', '202cb962ac59075b964b07152d234b70', '2019-09-07 00:16:43', 1),
(3, 'Akif', 'test@food.com', '202cb962ac59075b964b07152d234b70', '2019-09-07 00:17:26', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_type` varchar(5) COLLATE utf8_turkish_ci NOT NULL,
  `address` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `address_type`, `address`, `added_date`) VALUES
(1, 1, 'Ev', 'bornova bornova test test test', '2019-09-02 17:11:06'),
(2, 1, 'İş', 'bornova bornova test test testa', '2019-09-02 17:12:55'),
(3, 1, 'İş', 'cchfgvsdfgdsfgsdfg', '2019-09-10 02:52:12');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Tablo için indeksler `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `order_log`
--
ALTER TABLE `order_log`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `address` (`address`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Tablo için AUTO_INCREMENT değeri `drinks`
--
ALTER TABLE `drinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `order_log`
--
ALTER TABLE `order_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
