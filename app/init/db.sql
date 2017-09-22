CREATE DATABASE `mvc`;

USE `mvc`;

CREATE TABLE `product` (
  id INT AUTO_INCREMENT NOT NULL,
  title VARCHAR(255) NOT NULL,
  category VARCHAR(255) NOT NULL,
  price INT NOT NULL COMMENT 'Works at coins level',
  count INT NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

INSERT INTO `product` (title, category, price, count)
VALUES
('iPad', 'Tablet', 20000, 10),
('iPhone 5', 'Phone', 15000, 50),
('iPhone 6', 'Phone', 25000, 40),
('iMac Pro', 'Laptop', 70000, 20),
('Apple Watch', 'Watch', 10000, 100)
;