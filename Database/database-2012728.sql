-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for database-2012728
DROP DATABASE IF EXISTS `database-2012728`;
CREATE DATABASE IF NOT EXISTS `database-2012728` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `database-2012728`;

-- Dumping structure for table database-2012728.customers
DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `username` char(12) NOT NULL DEFAULT uuid(),
  `password` char(255) NOT NULL DEFAULT '',
  `firstname` char(20) NOT NULL,
  `lastname` char(20) DEFAULT '',
  `address` varchar(25) NOT NULL,
  `city` char(25) NOT NULL,
  `provience` char(25) NOT NULL,
  `postalcode` varchar(7) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_uuid` varchar(50) NOT NULL DEFAULT uuid(),
  PRIMARY KEY (`user_uuid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database-2012728.customers: ~6 rows (approximately)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`username`, `password`, `firstname`, `lastname`, `address`, `city`, `provience`, `postalcode`, `created_at`, `updated_at`, `user_uuid`) VALUES
	('raahulll', '$2y$10$QY8.z9pqmO7whdueJ7uGKOM5T9szUphea8WB/argtu5LX3GEkLsC.', 'Rahul Pipaliya', 'Pipaliya', '1225 rue saint marc', 'Montreal', 'H3H2E7', 'QC', '2020-12-01 03:49:22', '2020-12-01 03:49:22', '1c3c6920-33b2-11eb-ad1d-144f8ad5c9f0'),
	('adminss', '$2y$10$SRKGCUWuBnjZ.qnvVhnlTeMVTd6tRjKMPa4J4v76v1E8/cx4v5qBu', 'Rahul Pipaliya', 'Pipaliya', '1225 rue saint marc', 'Montreal', 'H3H2E7', 'QC', '2020-12-01 03:51:28', '2020-12-01 03:51:28', '67559483-33b2-11eb-ad1d-144f8ad5c9f0'),
	('oooo', '$2y$10$/6k69wPTT.F7m/fB.Q32fOJgSXBVcraLKryQ1M43X4GLgQ1y/NwGC', 'asasd', 'aararar', 'arrar', 'arararra', 'araarra', 'asd', '2020-12-07 10:36:31', '2020-12-07 10:36:31', '953423a1-3864-11eb-b49b-144f8ad5c9f0'),
	('admin3', '$2y$10$h5J4BEVWTferv39E9hcSW.S69ksmfQ/VwcgAniHBByjOgeTdKKS4K', 'Rahul Pipaliya', 'Pipaliya', '1225 rue saint marc', 'Montreal', 'H3H2E7', 'QC', '2020-12-01 03:53:25', '2020-12-01 03:53:25', 'ad32ee8d-33b2-11eb-ad1d-144f8ad5c9f0'),
	('admin', '$2y$10$sMhm2dJhUIXPN5Yd.kZ0VeWjII7A3ojC2yrstPfAD6cS6sxTB6EmG', 'Rahul', 'Pipaliya', '1225 rue saint marc', 'Montreal', 'H3H2E7', 'QC', '2020-12-08 06:37:24', '2020-12-08 06:37:24', 'ca9b7d8e-334c-11eb-ad1d-144f8ad5c9f0'),
	('rahul2602', '$2y$10$Fg08xUH3n8m83BYgms8XD.Ysl9xTO.njlZRFMws69rsyc3VEDWy/q', 'rahul', 'pipaliya', 'b44', 'surat', 'gj', '395004', '2020-12-08 12:00:54', '2020-12-08 12:00:54', 'e4c007e0-3976-11eb-92b4-144f8ad5c9f0');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Dumping structure for procedure database-2012728.customers_all
DROP PROCEDURE IF EXISTS `customers_all`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `customers_all`()
BEGIN

SELECT * FROM customers
ORDER BY username;

END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.customers_delete
DROP PROCEDURE IF EXISTS `customers_delete`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `customers_delete`(
	IN `p_userid` VARCHAR(50)
)
BEGIN

	DELETE  
	FROM customers 
	WHERE user_uuid = p_userid;

END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.customers_select
DROP PROCEDURE IF EXISTS `customers_select`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `customers_select`(
	IN `p_userid` VARCHAR(50)
)
BEGIN

	SELECT * 
	FROM customers 
	WHERE user_uuid = p_userid
	ORDER BY firstname;
	

END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.customers_update
DROP PROCEDURE IF EXISTS `customers_update`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `customers_update`(
	IN `p_userid` VARCHAR(50),
	IN `p_username` VARCHAR(50),
	IN `p_password` VARCHAR(255),
	IN `p_firstname` CHAR(50),
	IN `p_lastname` CHAR(50),
	IN `p_address` VARCHAR(50),
	IN `p_city` CHAR(50),
	IN `p_provience` CHAR(50),
	IN `p_postalcode` VARCHAR(50)
)
BEGIN

UPDATE customers
SET username = p_username, firstname = p_firstname , lastname = p_lastname, address = p_address, city = p_city,provience = p_provience,postalcode = p_postalcode , PASSWORD = p_password ,updated_at = NOW()
WHERE user_uuid = p_userid;

END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.customer_insert
DROP PROCEDURE IF EXISTS `customer_insert`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `customer_insert`(
	IN `p_username` CHAR(50),
	IN `p_password` VARCHAR(255),
	IN `p_firstname` CHAR(50),
	IN `p_lastname` CHAR(50),
	IN `p_address` CHAR(50),
	IN `p_city` CHAR(50),
	IN `p_provience` CHAR(50),
	IN `p_postalcode` VARCHAR(50)
)
BEGIN

INSERT INTO customers(username,password,firstname,lastname,address,city,provience,postalcode)
VALUES (p_username , p_password , p_firstname,p_lastname,p_address,p_city,p_provience,p_postalcode);

END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.filter_purchases
DROP PROCEDURE IF EXISTS `filter_purchases`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `filter_purchases`(IN p_date timestamp, IN p_userid varchar(50))
BEGIN

IF p_date IS NOT NULL THEN
    SELECT pu.purchase_id, pr.product_code, cu.firstname , cu.lastname  , cu.city , pu.comments, pr.price ,pu.quantity ,pu.subtotal , pu.taxes_amount ,pu.grand_total
    FROM customers cu , products pr , purchases pu
    WHERE cu.user_uuid = pu.username
      AND pu.product_id = pr.productid
      AND date(p_date) <= pu.created_at
      AND pu.username = p_userid
    ORDER BY pu.created_at;
ELSE
    SELECT  pu.purchase_id, pr.product_code, pr.product_code,cu.firstname , cu.lastname  , cu.city , pu.comments,pr.price ,pu.quantity ,pu.subtotal , pu.taxes_amount ,pu.grand_total
    FROM customers cu , products pr , purchases pu
    WHERE cu.user_uuid = pu.username
    AND pu.product_id = pr.productid
    AND pu.username = p_userid
    ORDER BY pu.created_at;

END IF;
END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.get_password
DROP PROCEDURE IF EXISTS `get_password`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `get_password`(
	IN `p_username` VARCHAR(50)
)
BEGIN

	SELECT firstname , lastname , PASSWORD , user_uuid ,username
	FROM customers
	WHERE username = p_username;

END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.get_product_detail
DROP PROCEDURE IF EXISTS `get_product_detail`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `get_product_detail`(
	IN `p_productid` VARCHAR(50)
)
BEGIN

SELECT * FROM products 
WHERE productid = p_productid
ORDER BY productid;

END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.get_purchase_details
DROP PROCEDURE IF EXISTS `get_purchase_details`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `get_purchase_details`(
	IN `p_purchaseid` VARCHAR(50)
)
BEGIN

SELECT * FROM purchases 
WHERE purchase_id = p_purchaseid;

END//
DELIMITER ;

-- Dumping structure for table database-2012728.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productid` varchar(50) NOT NULL DEFAULT uuid(),
  `product_code` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL DEFAULT '',
  `price` decimal(7,2) NOT NULL DEFAULT 0.00,
  `cost_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database-2012728.products: ~3 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`productid`, `product_code`, `description`, `price`, `cost_price`, `created_at`, `updated_at`) VALUES
	('933d3da5-346b-11eb-ad1d-144f8ad5c9f0', 'pr01', 'Table', 30.00, 25.00, '2020-12-02 01:56:58', '2020-12-02 01:56:58'),
	('933fbc56-346b-11eb-ad1d-144f8ad5c9f0', 'pr02', 'Mirror', 20.00, 10.00, '2020-12-02 01:56:58', '2020-12-02 01:56:58'),
	('93412b24-346b-11eb-ad1d-144f8ad5c9f0', 'pr03', 'Chair', 15.00, 8.00, '2020-12-02 01:56:58', '2020-12-02 01:56:58');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for procedure database-2012728.products_delete
DROP PROCEDURE IF EXISTS `products_delete`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `products_delete`(
	IN `p_productid` VARCHAR(12)
)
BEGIN

DELETE FROM products
WHERE product_code = p_productid;

END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.products_insert
DROP PROCEDURE IF EXISTS `products_insert`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `products_insert`(IN p_productid varchar(50),
                                                                 IN p_description varchar(100),
                                                                 IN p_price decimal(4, 2),
                                                                 IN p_costprice decimal(10, 2))
BEGIN

INSERT INTO products (product_code,description,price,cost_price) VALUES 
(p_productid,p_description,p_price,p_costprice);

END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.products_select
DROP PROCEDURE IF EXISTS `products_select`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `products_select`()
BEGIN

SELECT * FROM products
ORDER BY product_code;

END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.products_update
DROP PROCEDURE IF EXISTS `products_update`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `products_update`(
	IN `p_productid` VARCHAR(12),
	IN `p_description` VARCHAR(100),
	IN `p_price` DECIMAL(4,2),
	IN `p_cost_price` DECIMAL(10,2)
)
BEGIN

UPDATE products 
SET description = p_description ,price = p_price ,cost_price = p_cost_price , updated_at = NOW()
WHERE product_code = p_productid ;

END//
DELIMITER ;

-- Dumping structure for table database-2012728.purchases
DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `purchase_id` varchar(50) NOT NULL DEFAULT uuid(),
  `product_id` varchar(50) NOT NULL DEFAULT uuid(),
  `username` varchar(50) NOT NULL DEFAULT uuid(),
  `quantity` int(3) NOT NULL DEFAULT 0,
  `subtotal` decimal(7,2) NOT NULL DEFAULT 0.00,
  `taxes_amount` decimal(7,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(7,2) NOT NULL DEFAULT 0.00,
  `comments` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`purchase_id`),
  KEY `FK_purchases_products` (`product_id`),
  KEY `FK_purchases_customers` (`username`),
  CONSTRAINT `FK_purchases_customers` FOREIGN KEY (`username`) REFERENCES `customers` (`user_uuid`),
  CONSTRAINT `FK_purchases_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database-2012728.purchases: ~6 rows (approximately)
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` (`purchase_id`, `product_id`, `username`, `quantity`, `subtotal`, `taxes_amount`, `grand_total`, `comments`, `created_at`, `updated_at`) VALUES
	('06b34492-3977-11eb-92b4-144f8ad5c9f0', '933fbc56-346b-11eb-ad1d-144f8ad5c9f0', 'e4c007e0-3976-11eb-92b4-144f8ad5c9f0', 74, 1480.00, 224.96, 1704.96, 'no', '2020-12-08 12:01:34', '2020-12-08 12:01:34'),
	('38e218b8-389d-11eb-b49b-144f8ad5c9f0', '933fbc56-346b-11eb-ad1d-144f8ad5c9f0', '953423a1-3864-11eb-b49b-144f8ad5c9f0', 90, 1800.00, 27360.00, 29160.00, 'ghg', '2020-12-07 10:02:26', '2020-12-07 10:02:26'),
	('6a0c6f41-3bc2-11eb-92b4-144f8ad5c9f0', '933d3da5-346b-11eb-ad1d-144f8ad5c9f0', 'ca9b7d8e-334c-11eb-ad1d-144f8ad5c9f0', 5, 150.00, 22.80, 172.80, 'e', '2020-12-11 10:06:13', '2020-12-11 10:06:13'),
	('6dc130f7-3bc2-11eb-92b4-144f8ad5c9f0', '933d3da5-346b-11eb-ad1d-144f8ad5c9f0', 'ca9b7d8e-334c-11eb-ad1d-144f8ad5c9f0', 69, 2070.00, 314.64, 2384.64, 'd', '2020-12-11 10:06:20', '2020-12-11 10:06:20'),
	('9f9fca16-389c-11eb-b49b-144f8ad5c9f0', '933fbc56-346b-11eb-ad1d-144f8ad5c9f0', '953423a1-3864-11eb-b49b-144f8ad5c9f0', 56, 1120.00, 17024.00, 18144.00, '56', '2020-12-07 09:58:09', '2020-12-07 09:58:09'),
	('ecd48377-3bc0-11eb-92b4-144f8ad5c9f0', '933fbc56-346b-11eb-ad1d-144f8ad5c9f0', 'ca9b7d8e-334c-11eb-ad1d-144f8ad5c9f0', 56, 1120.00, 170.24, 1290.24, 'dsf', '2020-12-11 09:55:34', '2020-12-11 09:55:34');
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;

-- Dumping structure for procedure database-2012728.purchases_delete
DROP PROCEDURE IF EXISTS `purchases_delete`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `purchases_delete`(
	IN `p_purchase_id` VARCHAR(50)
)
BEGIN

DELETE FROM purchases
WHERE purchase_id = p_purchase_id;

END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.purchases_insert
DROP PROCEDURE IF EXISTS `purchases_insert`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `purchases_insert`(
	IN `p_product_code` varchar(50),
	IN `p_username` VARCHAR(50),
	IN `p_quantity` int,
	IN `p_comments` varchar(200),
	IN `p_subtotal` DECIMAL(7,2),
	IN `p_taxes_amount` DECIMAL(7,2),
	IN `p_grand_total` DECIMAL(7,2)
)
BEGIN

INSERT INTO purchases (product_id,username,quantity,comments,subtotal,taxes_amount,grand_total)
VALUES (p_product_code,p_username,p_quantity,p_comments,p_subtotal,p_taxes_amount,p_grand_total);

END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.purchases_select
DROP PROCEDURE IF EXISTS `purchases_select`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `purchases_select`(
	IN `p_username` VARCHAR(12)
)
BEGIN
SELECT * FROM purchases
WHERE username = p_username
ORDER BY purchase_id;
END//
DELIMITER ;

-- Dumping structure for procedure database-2012728.purchases_update
DROP PROCEDURE IF EXISTS `purchases_update`;
DELIMITER //
CREATE DEFINER=`user-2012728`@`localhost` PROCEDURE `purchases_update`(
	IN `p_purchase_id` varchar(50),
	IN `p_product_id` varchar(12),
	IN `p_user_id` char(12),
	IN `p_quantity` int,
	IN `p_comments` varchar(200),
	IN `p_subtotal` decimal(7, 2),
	IN `p_taxes_amount` decimal(7, 2),
	IN `p_grand_total` decimal(7, 2)
)
BEGIN
UPDATE purchases 
SET product_id = p_product_id,username = p_user_id ,quantity = p_quantity,comments =p_comments,subtotal = p_subtotal , taxes_amount = p_taxes_amount , grand_total = p_grand_total ,updated_at = NOW()
WHERE purchase_id = p_purchase_id;
END//
DELIMITER ;

-- Dumping structure for view database-2012728.view-2012728
DROP VIEW IF EXISTS `view-2012728`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view-2012728` (
	`productid` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`description` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`price` DECIMAL(7,2) NOT NULL,
	`cost_price` DECIMAL(10,2) NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view database-2012728.view-2012728
DROP VIEW IF EXISTS `view-2012728`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view-2012728`;
CREATE ALGORITHM=MERGE DEFINER=`user-2012728`@`localhost` SQL SECURITY DEFINER VIEW `view-2012728` AS select `products`.`productid` AS `productid`,`products`.`description` AS `description`,`products`.`price` AS `price`,`products`.`cost_price` AS `cost_price`,`products`.`created_at` AS `created_at`,`products`.`updated_at` AS `updated_at` from `products` order by `products`.`productid`;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
