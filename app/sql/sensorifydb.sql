-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Apr 2023 um 13:46
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `sensorifydb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `addresses`
--

CREATE TABLE `addresses` (
  `zip_code` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `place` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `devices`
--

CREATE TABLE `devices` (
  `device_type` varchar(50) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `sensor_id` int(11) DEFAULT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rooms`
--

CREATE TABLE `rooms` (
  `room_name` varchar(30) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) NOT NULL,
  `room_image` varchar(100) NOT NULL,
  `room_owner` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `rooms`
--

INSERT INTO `rooms` (`room_name`, `user_id`, `room_id`, `room_image`, `room_owner`, `creation_date`) VALUES
('Schlafzimmer', 35, 30, './upload/rooms/644c5c86712ea7.44496283.png', 0, '2023-04-28 23:53:42'),
('Schlafzimmer', 35, 31, './upload/rooms/644c5c8b9df7a8.31934367.png', 0, '2023-04-28 23:53:47'),
('Living room', 36, 34, './upload/rooms/644c5fa0824484.27752271.png', 0, '2023-04-29 00:06:56'),
('Living room', 37, 35, './upload/rooms/644c61ad47ba09.10088095.png', 0, '2023-04-29 00:15:41');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rooms_access`
--

CREATE TABLE `rooms_access` (
  `room_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `rooms_access`
--

INSERT INTO `rooms_access` (`room_id`, `user_id`) VALUES
(22, 32),
(23, 32),
(22, 32),
(22, 33),
(26, 33),
(27, 33),
(26, 33),
(29, 35),
(30, 35),
(30, 35),
(32, 36),
(32, 36),
(32, 36),
(33, 37);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sensors`
--

CREATE TABLE `sensors` (
  `ip_address` varchar(50) NOT NULL,
  `ssid` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `port` int(20) NOT NULL,
  `server_ip` varchar(50) NOT NULL,
  `sensor_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_dest` varchar(100) NOT NULL,
  `phone_number` varchar(100) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip_code` varchar(50) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `house_number` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`name`, `lastname`, `user_name`, `email`, `password`, `creation_date`, `image_dest`, `phone_number`, `country`, `zip_code`, `city`, `house_number`, `street`, `user_id`) VALUES
('Stevan', 'Vlajic', 'stevagmail', 'stevanvlaj5@gmail.com', 'dfghjklößeR', '2023-04-28 23:45:16', './upload/644c5a8c53bf57.58686760.png', NULL, NULL, NULL, NULL, NULL, NULL, 35),
('Stevan', 'Vlajic', 'vfsafan', 'stevanvlajfdagdc5@gmail.com', 'fdsaDFAFDFDG', '2023-04-29 00:09:47', './upload/644c604bb4a7c9.66316348.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 36),
('Stevan', 'Vlajic', 'm_mitch', 'kk@gmail.com', 'hjkSSDSdd', '2023-04-29 00:15:29', './upload/644c61a1534dc1.68399793.png', NULL, NULL, NULL, NULL, NULL, NULL, 37),
('Stevan', 'Vlajic', 'stevan06v', 'stevanvlajic5@gmail.com', 'Stevan-2006', '2023-04-29 12:28:58', './upload/644d0d8ab7faa6.55543406.png', NULL, NULL, NULL, NULL, NULL, NULL, 38);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `addresses`
--
ALTER TABLE `addresses`
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `devices`
--
ALTER TABLE `devices`
  ADD KEY `sensor_id` (`sensor_id`),
  ADD KEY `devices_ibfk_2` (`room_id`);

--
-- Indizes für die Tabelle `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`sensor_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT für Tabelle `sensors`
--
ALTER TABLE `sensors`
  MODIFY `sensor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints der Tabelle `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_ibfk_1` FOREIGN KEY (`sensor_id`) REFERENCES `sensors` (`sensor_id`),
  ADD CONSTRAINT `devices_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);

--
-- Constraints der Tabelle `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints der Tabelle `sensors`
--
ALTER TABLE `sensors`
  ADD CONSTRAINT `sensors_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
