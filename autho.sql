CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ;


CREATE TABLE `annonces` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `image` varchar(1000) NOT NULL,
   `typeDeBien` varchar(100) NOT NULL,
  `details` varchar(10000) NOT NULL

) 