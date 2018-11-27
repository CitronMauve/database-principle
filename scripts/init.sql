SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_principle`
--

DROP DATABASE IF EXISTS database_principle;

CREATE DATABASE database_principle;

USE database_principle;

-- --------------------------------------------------------

--
-- Table structure for table `Associate`
--

CREATE TABLE `Associate` (
  `id_pizza` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Associate`
--

INSERT INTO `Associate` (`id_pizza`, `id_order`, `id_size`) VALUES
(1, 6, 1),
(5, 5, 3),
(6, 2, 3),
(6, 7, 3),
(8, 1, 3),
(11, 4, 3),
(12, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Clients`
--

CREATE TABLE `Clients` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(255) COLLATE utf8_bin NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Clients`
--

INSERT INTO `Clients` (`id`, `lastname`, `firstname`, `address`, `phone`) VALUES
(1, 'THIAM', 'Moussa', '5 Chicken Street', '0601010101'),
(2, 'BAPTISTE', 'Jean', '48 Rue du bourgeois', '0602020202'),
(3, 'HUYHAI', 'Paul', '1 Boulevard du nem', '0603030303'),
(4, 'COUDJI', 'Indien', '5 Avenue du Curry', '0604040404'),
(5, 'KRIF', 'Soso', '9 Rue jean macé GZ', '0605050505');

-- --------------------------------------------------------

--
-- Table structure for table `Contain`
--

CREATE TABLE `Contain` (
  `id_pizza` int(11) NOT NULL,
  `id_ingredient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Contain`
--

INSERT INTO `Contain` (`id_pizza`, `id_ingredient`) VALUES
(1, 1),
(1, 5),
(1, 21),
(1, 22),
(1, 29),
(2, 2),
(2, 3),
(2, 7),
(2, 30),
(3, 11),
(3, 15),
(3, 29),
(3, 30),
(4, 1),
(4, 14),
(4, 19),
(4, 21),
(4, 28),
(5, 3),
(5, 4),
(5, 7),
(5, 13),
(6, 6),
(6, 7),
(6, 13),
(6, 15),
(6, 21),
(7, 15),
(7, 16),
(7, 19),
(7, 22),
(7, 27),
(7, 29),
(8, 8),
(8, 15),
(8, 24),
(8, 29),
(9, 5),
(9, 7),
(9, 9),
(9, 10),
(9, 18),
(9, 27),
(10, 4),
(10, 5),
(10, 7),
(10, 9),
(10, 19),
(10, 25),
(11, 7),
(11, 9),
(11, 23),
(11, 26),
(11, 30),
(12, 9),
(12, 11),
(12, 12),
(12, 27),
(12, 29);

-- --------------------------------------------------------

--
-- Table structure for table `Deliver`
--

CREATE TABLE `Deliver` (
  `id_order` int(11) NOT NULL,
  `id_driver` int(11) NOT NULL,
  `id_vehicule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Deliver`
--

INSERT INTO `Deliver` (`id_order`, `id_driver`, `id_vehicule`) VALUES
(1, 3, 7),
(2, 1, 3),
(3, 2, 2),
(4, 2, 2),
(5, 2, 2),
(6, 4, 1),
(7, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Drive`
--

CREATE TABLE `Drive` (
  `id_driver` int(11) NOT NULL,
  `id_vehicule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Drive`
--

INSERT INTO `Drive` (`id_driver`, `id_vehicule`) VALUES
(1, 3),
(1, 7),
(2, 2),
(2, 4),
(3, 1),
(3, 6),
(4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Drivers`
--

CREATE TABLE `Drivers` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Drivers`
--

INSERT INTO `Drivers` (`id`, `lastname`, `firstname`) VALUES
(1, 'BENTALHA', 'Malik'),
(2, 'COUNDJIDAPADAME', 'Mourouguesh'),
(3, 'KRIFI', 'Sofiene'),
(4, 'EL BAGHDADI', 'Yassin'),
(5, 'NGUYEN', 'Vincent');

-- --------------------------------------------------------

--
-- Table structure for table `Ingredients`
--

CREATE TABLE `Ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Ingredients`
--

INSERT INTO `Ingredients` (`id`, `name`) VALUES
(1, 'onion'),
(2, 'pepper'),
(3, 'minced meat'),
(4, 'merguez'),
(5, 'egg'),
(6, 'bacon'),
(7, 'tomato'),
(8, 'pineapple'),
(9, 'cheddar'),
(10, 'olive'),
(11, 'goat cheese'),
(12, 'honey'),
(13, 'chorizo'),
(14, 'ham'),
(15, 'mozarella'),
(16, 'chicken'),
(17, 'salmon'),
(18, 'tuna'),
(19, 'mushroom'),
(20, 'chilli pepper'),
(21, 'anchovy'),
(22, 'spinach'),
(23, 'parmesan cheese'),
(24, 'reblochon'),
(25, 'fresh cream'),
(26, 'basil'),
(27, 'raclette'),
(28, 'gruyere'),
(29, 'boursin'),
(30, 'corn');

-- --------------------------------------------------------

--
-- Table structure for table `Members`
--

CREATE TABLE `Members` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `bill` decimal(10,0) NOT NULL,
  `date_order` datetime NOT NULL,
  `date_delivery` datetime NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`id`, `bill`, `date_order`, `date_delivery`, `address`, `id_client`) VALUES
(1, '20', '2018-06-13 11:49:05', '2018-06-13 12:11:05', '48 Rue du bourgeois', 2),
(2, '12', '2018-06-13 11:56:12', '2018-06-13 12:19:15', '5 Avenue du Curry', 4),
(3, '11', '2018-06-13 14:19:38', '2018-06-13 14:42:15', '9 Rue jean macé GZ', 5),
(4, '11', '2018-08-13 14:10:38', '2018-08-13 14:59:15', '9 Rue jean macé GZ', 5),
(5, '11', '2018-09-13 11:10:38', '2018-09-13 12:59:15', '9 Rue jean macé GZ', 5),
(6, '5', '2018-06-13 19:10:13', '2018-06-13 19:24:15', '5 Avenue du poulet', 1),
(7, '12', '2018-07-13 19:10:13', '2018-07-13 19:57:15', '5 Avenue du poulet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Pizzas`
--

CREATE TABLE `Pizzas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `img` varchar(255) COLLATE utf8_bin NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Pizzas`
--

INSERT INTO `Pizzas` (`id`, `name`, `img`, `price`) VALUES
(1, 'Neapolitan', 'img/neapolitan.jpg', '9'),
(2, 'Quattro formaggi', 'img/quattro_formaggi.jpg', '7'),
(3, 'Mexican', 'img/mexican.jpg', '8'),
(4, 'Three hams', 'img/three_hams.jpg', '9'),
(5, 'Farmer', 'img/farmer.jpg', '8'),
(6, 'Hawaiian', 'img/hawaiian.jpg', '15'),
(7, 'Fish', 'img/fish.jpg', '15'),
(8, 'Kebab', 'img/kebab.jpg', '5'),
(9, 'Frutti di mare', 'img/frutti_di_mare.jpg', '9'),
(10, 'Goat & Honey', 'img/goat_honey.jpg', '7'),
(11, 'Hot & Spicy', 'img/hot_spicy.jpg', '8'),
(12, 'Salmon', 'img/salmon.jpg', '8');

-- --------------------------------------------------------

--
-- Table structure for table `Sizes`
--

CREATE TABLE `Sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `ratio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Sizes`
--

INSERT INTO `Sizes` (`id`, `name`, `ratio`) VALUES
(1, 'Dwarf', 0.666666666),
(2, 'Human', 1),
(3, 'Ogre', 1.333333333);

-- --------------------------------------------------------

--
-- Table structure for table `Vehicules`
--

CREATE TABLE `Vehicules` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Vehicules`
--

INSERT INTO `Vehicules` (`id`, `type`) VALUES
(1, 'Bike'),
(2, 'Car'),
(3, 'Car'),
(4, 'Bike'),
(5, 'Bike'),
(6, 'Car'),
(7, 'Bike');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Associate`
--
ALTER TABLE `Associate`
  ADD PRIMARY KEY (`id_pizza`,`id_order`,`id_size`),
  ADD KEY `FK_Associate_id_order` (`id_order`),
  ADD KEY `FK_Associate_id_size` (`id_size`);

--
-- Indexes for table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Contain`
--
ALTER TABLE `Contain`
  ADD PRIMARY KEY (`id_pizza`,`id_ingredient`),
  ADD KEY `FK_Contain_id_ingredient` (`id_ingredient`);

--
-- Indexes for table `Deliver`
--
ALTER TABLE `Deliver`
  ADD PRIMARY KEY (`id_order`,`id_driver`,`id_vehicule`),
  ADD KEY `FK_Deliver_id_driver` (`id_driver`),
  ADD KEY `FK_Deliver_id_vehicule` (`id_vehicule`);

--
-- Indexes for table `Drive`
--
ALTER TABLE `Drive`
  ADD PRIMARY KEY (`id_driver`,`id_vehicule`),
  ADD KEY `FK_Drive_id_vehicule` (`id_vehicule`);

--
-- Indexes for table `Drivers`
--
ALTER TABLE `Drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Ingredients`
--
ALTER TABLE `Ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Members`
--
ALTER TABLE `Members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Orders_id_client` (`id_client`);

--
-- Indexes for table `Pizzas`
--
ALTER TABLE `Pizzas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Sizes`
--
ALTER TABLE `Sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Vehicules`
--
ALTER TABLE `Vehicules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Clients`
--
ALTER TABLE `Clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Drivers`
--
ALTER TABLE `Drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Ingredients`
--
ALTER TABLE `Ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `Members`
--
ALTER TABLE `Members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Pizzas`
--
ALTER TABLE `Pizzas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Sizes`
--
ALTER TABLE `Sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Vehicules`
--
ALTER TABLE `Vehicules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Associate`
--
ALTER TABLE `Associate`
  ADD CONSTRAINT `FK_Associate_id_order` FOREIGN KEY (`id_order`) REFERENCES `Orders` (`id`),
  ADD CONSTRAINT `FK_Associate_id_pizza` FOREIGN KEY (`id_pizza`) REFERENCES `Pizzas` (`id`),
  ADD CONSTRAINT `FK_Associate_id_size` FOREIGN KEY (`id_size`) REFERENCES `Sizes` (`id`);

--
-- Constraints for table `Contain`
--
ALTER TABLE `Contain`
  ADD CONSTRAINT `FK_Contain_id_ingredient` FOREIGN KEY (`id_ingredient`) REFERENCES `Ingredients` (`id`),
  ADD CONSTRAINT `FK_Contain_id_pizza` FOREIGN KEY (`id_pizza`) REFERENCES `Pizzas` (`id`);

--
-- Constraints for table `Deliver`
--
ALTER TABLE `Deliver`
  ADD CONSTRAINT `FK_Deliver_id_driver` FOREIGN KEY (`id_driver`) REFERENCES `Drivers` (`id`),
  ADD CONSTRAINT `FK_Deliver_id_order` FOREIGN KEY (`id_order`) REFERENCES `Orders` (`id`),
  ADD CONSTRAINT `FK_Deliver_id_vehicule` FOREIGN KEY (`id_vehicule`) REFERENCES `Vehicules` (`id`);

--
-- Constraints for table `Drive`
--
ALTER TABLE `Drive`
  ADD CONSTRAINT `FK_Drive_id_driver` FOREIGN KEY (`id_driver`) REFERENCES `Drivers` (`id`),
  ADD CONSTRAINT `FK_Drive_id_vehicule` FOREIGN KEY (`id_vehicule`) REFERENCES `Vehicules` (`id`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `FK_Orders_id_client` FOREIGN KEY (`id_client`) REFERENCES `Clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
