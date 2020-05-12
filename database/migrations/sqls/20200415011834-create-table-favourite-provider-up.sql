/* Replace with your SQL commands */
CREATE TABLE `favourite_service_provider` (
    `service_provider_id` int(6) NOT NULL,
    `user_id` int(6) NOT NULL,
    `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted` int(1) DEFAULT 0, /*soft delete operation 0 - not deleted, 1 - deleted */

    PRIMARY KEY (`service_provider_id`, `user_id`),
    FOREIGN KEY (`service_provider_id`) REFERENCES `service_provider` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);