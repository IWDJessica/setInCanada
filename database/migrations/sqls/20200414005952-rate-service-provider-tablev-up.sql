/* Replace with your SQL commands */
CREATE TABLE `rate_service_provider` (
    `service_provider_id` int(6) NOT NULL,
    `user_id` int(6) NOT NULL,
    `rate` tinyint NOT NULL,

    FOREIGN KEY (`service_provider_id`) REFERENCES `service_provider` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);