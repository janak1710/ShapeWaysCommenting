
CREATE TABLE `User` (
    `user_id` INT(11) NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(45) DEFAULT NULL,
    `middle_initial` VARCHAR(45) DEFAULT NULL,
    `last_name` VARCHAR(45) DEFAULT NULL,
    `phone_numer` INT(11) DEFAULT NULL,
    `street` VARCHAR(45) DEFAULT NULL,
    `city` VARCHAR(45) DEFAULT NULL,
    `state` VARCHAR(45) DEFAULT NULL,
    `country` VARCHAR(45) DEFAULT NULL,
    `zipcode` INT(11) DEFAULT NULL,
    PRIMARY KEY (`user_id`)
)  ENGINE=INNODB AUTO_INCREMENT=5 DEFAULT CHARSET=LATIN1;


CREATE TABLE `Product` (
    `product_id` INT(11) NOT NULL AUTO_INCREMENT,
    `product_name` VARCHAR(45) DEFAULT NULL,
    `product_price` DECIMAL(2 , 0 ) DEFAULT NULL,
    `product_color` VARCHAR(45) DEFAULT NULL,
    `product_size` VARCHAR(45) DEFAULT NULL,
    `product_description` VARCHAR(45) DEFAULT NULL,
    `owner_user_id` INT(11) DEFAULT NULL,
    PRIMARY KEY (`product_id`),
    KEY `user_id_idx` (`owner_user_id`),
    CONSTRAINT `owner_user_id` FOREIGN KEY (`owner_user_id`)
        REFERENCES `User` (`user_id`)
        ON DELETE NO ACTION ON UPDATE NO ACTION
)  ENGINE=INNODB AUTO_INCREMENT=6 DEFAULT CHARSET=LATIN1;


CREATE TABLE `User_credentials` (
    `user_id` INT(11) DEFAULT NULL,
    `username` VARCHAR(45) NOT NULL,
    `password` VARCHAR(45) DEFAULT NULL,
    `email_id` VARCHAR(45) DEFAULT NULL,
    PRIMARY KEY (`username`),
    KEY `user_id_idx` (`user_id`),
    CONSTRAINT `user_id` FOREIGN KEY (`user_id`)
        REFERENCES `User` (`user_id`)
        ON DELETE NO ACTION ON UPDATE NO ACTION
)  ENGINE=INNODB DEFAULT CHARSET=LATIN1;


CREATE TABLE `Comment` (
    `comment_id` INT(11) NOT NULL AUTO_INCREMENT,
    `body` VARCHAR(45) DEFAULT NULL,
    `create_time` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `author_user_id` INT(11) DEFAULT NULL,
    `product_id` INT(11) DEFAULT NULL,
    `read_comment` TINYINT(1) DEFAULT '0',
    PRIMARY KEY (`comment_id`),
    KEY `product_id_idx` (`product_id`),
    KEY `author_user_id_idx` (`author_user_id`),
    CONSTRAINT `author_user_id` FOREIGN KEY (`author_user_id`)
        REFERENCES `User` (`user_id`)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `product_id` FOREIGN KEY (`product_id`)
        REFERENCES `Product` (`product_id`)
        ON DELETE NO ACTION ON UPDATE NO ACTION
)  ENGINE=INNODB AUTO_INCREMENT=35 DEFAULT CHARSET=LATIN1;
