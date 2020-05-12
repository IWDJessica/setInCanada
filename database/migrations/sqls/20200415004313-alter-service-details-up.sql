/* Replace with your SQL commands */
ALTER TABLE `service_details`
MODIFY COLUMN `price` varchar(100);

ALTER TABLE `service_details`
ADD COLUMN `image` blob;