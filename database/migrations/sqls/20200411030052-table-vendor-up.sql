/* Replace with your SQL commands */
CREATE TABLE `service_provider` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contactNumber` varchar(50) NOT NULL,
  `businessName` varchar(200) NOT NULL,
  `image` blob NULL,
  `status` int(1) NOT NULL,
  `acceptTerms` int(1) NOT NULL,
  `acceptEmail` int(1),
  `created` DATETIME NOT NULL,

PRIMARY KEY (`id`)
);

CREATE TABLE `service` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL, /* for now service type will be a string, in the future might be a ENUM */
  `service_provider_id` int(6) NOT NULL,

  PRIMARY KEY (`id`),
  FOREIGN KEY (`service_provider_id`) REFERENCES `service_provider`(`id`)
);

CREATE TABLE `service_details` (
  `service_id` int(6) NOT NULL,
  `price` decimal NOT NULL,
  `service_hours` text NOT NULL,/* this is going to store a JSON object like {"sunday": {"from":"HH:MM", "to": "HH:MM"}}*/
  `attributes` text, /* extra additional attributes */

  FOREIGN KEY (`service_id`) REFERENCES `service`(`id`)
);
/* reference for how to use JSON columns https://scotch.io/tutorials/working-with-json-in-mysql*/

CREATE TABLE `service_location` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `service_id` int(6) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,

  PRIMARY KEY (`id`),
  FOREIGN KEY (`service_id`) REFERENCES `service`(`id`)
);

/* reference for db relationship https://vladmihalcea.com/database-table-relationships/ */