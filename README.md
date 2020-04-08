# BikeStore
Project with PHP MVC
## Language and Technology Used
HTML5
CSS3
JQuery
Bootstrap
PHP7
MVC Design Pattern
## Project Description
This is an online Bike and bike parts store that has listings of various bike along with their features.
It also consists of Bike service Registration. This system allows user to buy bike, bike parts and
inventory online. System allow user to check various articles submitted by user and even comment
feature where user can ask admin for bike on rent. The visitor who visits the system must register
himself by filling up personal details. After registration user can login to the system with his
username and password in order to access the system. User can check various bike listing and can
view each bikes feature. User can also check features of the bike as well as inventory parts, and
accessories. User may select the product and can add the product to shopping cart. User can make
payment through credit cards by clicking on credit card payment option. User must register himself
for posting an article. This application is a combination of both sales and inventory management
of the bike and bike parts. User can easily purchase bike or bike parts by using this system user
does not have to come manually to shop to purchase the product. He can view the bike and bike
parts in effective Graphical User Interface. User can view features of each product and can
compare the products in order to purchase a better product.
## Project Features
1. Visitor Registration: - In this module user must register himself by filling some personal
details.
1. Visitor Login: - After registration user will get user ID and password through which user
can login to access the system.
1. Bike Listing and Features: - User can view list of cars and specification of the car.
1. Bike Parts listing and Features: - User can view list of bike parts and specification of the
bike parts.
1. Shopping Cart: - User can select the product and add to the shopping cart which he wants
to purchase.
1. Rent Bike: - Visitor must register himself for renting bike, he will be charged according to
rent per day basic.
1. Bike Blog Section: - Bikers can post article and registered user can comment over it.
1. Sell Bike: - User can even sell their bike and get response from other user.
1. Bike Servicing: - User can register for bike service, where admin will get to know about
date and time user wants to come for service.
1. Forget Password: - If user forgets his password he can just click forget password, and he
From which he can login into the system.
## MySQL Database Code
* CREATE TABLE `bike`.`users` ( `username` VARCHAR(255) NOT NULL , `firstName` VARCHAR(255) NOT NULL , `lastName` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `gender` TINYINT NOT NULL , `telephone` VARCHAR(11) NOT NULL , `avatarName` VARCHAR(255) NOT NULL , `adminStatus` TINYINT NOT NULL , PRIMARY KEY (`username`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;
* CREATE TABLE `bike`.`posts` ( `postId` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `postContent` TEXT NOT NULL , `photoName` VARCHAR(255) NOT NULL , `postDate` DATETIME NOT NULL , PRIMARY KEY (`postId`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;
* ALTER TABLE `posts` ADD FOREIGN KEY (`username`) REFERENCES `users`(`username`) ON DELETE CASCADE ON UPDATE CASCADE;
* CREATE TABLE `bike`.`comments` ( `commentId` INT NOT NULL AUTO_INCREMENT , `postId` INT NOT NULL , `username` VARCHAR(255) NOT NULL , `commentContent` TEXT NOT NULL , `commentDate` DATETIME NOT NULL , PRIMARY KEY (`commentId`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;
* ALTER TABLE `comments` ADD FOREIGN KEY (`postId`) REFERENCES `posts`(`postId`) ON DELETE CASCADE ON UPDATE CASCADE;
* ALTER TABLE `comments` ADD FOREIGN KEY (`username`) REFERENCES `users`(`username`) ON DELETE CASCADE ON UPDATE CASCADE;
* CREATE TABLE `bike`.`payment` ( `username` VARCHAR(255) NOT NULL , `visaNumber` VARCHAR(16) NOT NULL , `pin` INT NOT NULL , `money` INT NOT NULL ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;
* ALTER TABLE `payment` ADD FOREIGN KEY (`username`) REFERENCES `users`(`username`) ON DELETE CASCADE ON UPDATE CASCADE;
* CREATE TABLE `bike`.`bikeservicing` ( `serviceId` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `serviceDate` DATETIME NOT NULL , PRIMARY KEY (`serviceId`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;
* ALTER TABLE `bikeservicing` ADD FOREIGN KEY (`username`) REFERENCES `users`(`username`) ON DELETE CASCADE ON UPDATE CASCADE;
* CREATE TABLE `bike`.`products` ( `productId` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `name` VARCHAR(255) NOT NULL , `photoName` VARCHAR(255) NOT NULL , `features` TEXT NOT NULL , `quantity` INT NOT NULL , `rentStatus` TINYINT NOT NULL , `isBike` TINYINT NOT NULL , `isNew` TINYINT NOT NULL , PRIMARY KEY (`productId`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;
* ALTER TABLE `products` ADD FOREIGN KEY (`username`) REFERENCES `users`(`username`) ON DELETE CASCADE ON UPDATE CASCADE;
* CREATE TABLE `bike`.`shoppingcart` ( `username` VARCHAR(255) NOT NULL , `productId` INT NOT NULL ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;
* ALTER TABLE `shoppingcart` ADD FOREIGN KEY (`username`) REFERENCES `users`(`username`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `shoppingcart` ADD FOREIGN KEY (`productId`) REFERENCES `products`(`productId`) ON DELETE CASCADE ON UPDATE CASCADE;
* CREATE TABLE `bike`.`rentbike` ( `username` VARCHAR(255) NOT NULL , `productId` INT NOT NULL , `rentDate` DATE NOT NULL ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;
* ALTER TABLE `rentbike` ADD FOREIGN KEY (`username`) REFERENCES `users`(`username`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `rentbike` ADD FOREIGN KEY (`productId`) REFERENCES `products`(`productId`) ON DELETE CASCADE ON UPDATE CASCADE;
* CREATE TABLE `bike`.`orders` ( `orderId` INT NOT NULL AUTO_INCREMENT , `productId` INT NOT NULL , `username` VARCHAR(255) NOT NULL , `orderQuantity` INT NOT NULL , `orderDate` DATETIME NOT NULL , PRIMARY KEY (`orderId`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;
* ALTER TABLE `orders` ADD FOREIGN KEY (`productId`) REFERENCES `products`(`productId`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `orders` ADD FOREIGN KEY (`username`) REFERENCES `users`(`username`) ON DELETE CASCADE ON UPDATE CASCADE;
* ALTER TABLE `users` CHANGE `adminStatus` `adminStatus` TINYINT(4) NOT NULL DEFAULT '0';
* ALTER TABLE `bikeservicing` ADD UNIQUE(`serviceDate`)
