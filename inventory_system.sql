create database inventory_system;
use inventory_system;
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100),
    password VARCHAR(100)
);
INSERT INTO users(email,password)
VALUES('admin@gmail.com','12345');


CREATE TABLE products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(100),
    price INT,
    quantity INT
);
ALTER TABLE products
ADD supplier_id INT;

CREATE TABLE suppliers (
    supplier_id INT PRIMARY KEY AUTO_INCREMENT,
    supplier_name VARCHAR(100),
    phone VARCHAR(20)
);



SELECT product_name, supplier_id FROM products;

ALTER TABLE users
ADD COLUMN name VARCHAR(100) NOT NULL AFTER user_id;
UPDATE users
SET name = 'Admin'
WHERE name IS NULL;
INSERT INTO products (product_name, price, quantity) VALUES
('Keyboard', 2000, 15),
('Mouse', 1000, 25),
('Monitor 24 inch', 25000, 8),
('Laptop Dell i5', 120000, 5),
('USB Cable', 300, 50),
('HDMI Cable', 500, 40),
('Wireless Mouse', 1500, 30),
('Gaming Keyboard', 3500, 20),
('SSD 512GB', 9000, 12),
('HDD 1TB', 8000, 10),

('Mobile Charger', 700, 60),
('Power Bank', 2500, 35),
('Earbuds', 1200, 45),
('Headphones', 3000, 18),
('Smart Watch', 6000, 22),
('Tablet Samsung', 45000, 6),
('Printer HP', 28000, 4),
('Ink Cartridge', 1500, 30),
('Router TP-Link', 4000, 14),
('Extension Board', 1200, 25),

('LED Bulb', 200, 100),
('Ceiling Fan', 6000, 10),
('Air Conditioner 1.5 Ton', 90000, 3),
('Room Heater', 5000, 8),
('Iron Press', 3500, 12),
('Blender', 4000, 15),
('Microwave Oven', 30000, 6),
('Refrigerator', 85000, 4),
('Water Dispenser', 15000, 7),
('Electric Kettle', 2500, 20),

('Notebook', 100, 200),
('Pen Pack', 150, 300),
('Marker Set', 250, 150),
('File Folder', 200, 180),
('Stapler', 300, 90),
('Scissors', 250, 80),
('Glue Stick', 100, 120),
('Calculator', 1200, 50),
('White Board', 3500, 25),
('Marker Board Stand', 5000, 10),

('Shoes Nike', 8000, 20),
('Shoes Adidas', 7500, 18),
('T-Shirt', 1200, 60),
('Jeans Pant', 2500, 40),
('Jacket Winter', 5000, 25),
('Cap', 600, 70),
('Watch Rolex Copy', 3000, 15),
('Wallet Leather', 1500, 50),
('Belt Leather', 1000, 45),
('Socks Pack', 500, 100),

('Rice 5kg', 2000, 80),
('Sugar 1kg', 180, 200),
('Flour 10kg', 1200, 90),
('Oil 1L', 500, 150),
('Tea Pack', 900, 120),
('Milk Pack', 150, 300),
('Biscuits Pack', 120, 400),
('Chocolate', 100, 350),
('Juice Pack', 200, 250),
('Water Bottle', 80, 500),

('Bike Helmet', 2500, 40),
('Bike Oil', 600, 70),
('Car Tyre', 8000, 30),
('Car Battery', 12000, 20),
('Car Mirror', 1500, 25),
('Seat Cover', 3000, 15),
('Car Wax', 700, 50),
('Wiper Blades', 500, 60),
('Air Freshener', 300, 100),
('Car Charger', 900, 80),

('Books Set', 1500, 40),
('Physics Book', 600, 100),
('Math Book', 700, 90),
('Chemistry Book', 800, 85),
('English Book', 500, 120),
('Urdu Book', 450, 110),
('History Book', 650, 70),
('Islamic Studies Book', 400, 150),
('Dictionary', 1200, 50),
('Atlas', 2000, 30),

('Camera DSLR', 85000, 5),
('Tripod Stand', 2500, 25),
('Memory Card 64GB', 1500, 60),
('Memory Card 128GB', 2500, 40),
('Ring Light', 3000, 30),
('Microphone', 4000, 20),
('Webcam', 5000, 15),
('Laptop Stand', 2000, 35),
('Cooling Pad', 1800, 45),
('Phone Holder', 500, 80);
