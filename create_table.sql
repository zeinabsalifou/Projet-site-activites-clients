-- Création de la table `activities` pour stocker les informations des activités sportives
CREATE TABLE `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `season` enum('summer','fall','winter','spring') NOT NULL,
  PRIMARY KEY (`id`)
);

-- Création de la table `clients` pour stocker les informations des clients
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
);

-- Création de la table `subscriptions` pour lier les clients aux activités auxquelles ils sont inscrits
CREATE TABLE `subscriptions` (
  `client_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `date` date NOT NULL,
  KEY `client_id` (`client_id`),
  KEY `activity_id` (`activity_id`),
  CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`)
);