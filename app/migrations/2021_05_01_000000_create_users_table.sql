CREATE TABLE IF NOT EXISTS users
(
	`user_id`    int      NOT NULL AUTO_INCREMENT,
	`login`      text,
	`password`   text,
	`token`      text,
	`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`update_at`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`user_id`)
);