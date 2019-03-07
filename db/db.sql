
CREATE DATABASE `bot`;

CREATE TABLE `symptoms`(
    `text` VARCHAR(50) NOT NULL,
    `value` INT(11) NOT NULL
) ENGINE =InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `symptoms`
    ADD PRIMARY KEY(`value`);
    
ALTER TABLE `symptoms`
    MODIFY `value` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

CREATE TABLE `infkey`(
    `value` INT(11) NOT NULL,
    `inf` VARCHAR(50) NOT NULL,
    `type` VARCHAR(50) NOT NULL,
    `text` VARCHAR(500) NOT NULL,
    `cause` VARCHAR(500) NOT NULL
) ENGINE =InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `pres`(
    `id` INT(11) NOT NULL,
    `drug` VARCHAR(50) NOT NULL,
    `amount` VARCHAR(50) NOT NULL,
    `pres` VARCHAR(50) NOT NULL,
    `doc` VARCHAR(50) NOT NULL
) ENGINE =InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `pres-description`(
    `id` INT(11) NOT NULL,
    `des` VARCHAR(500) NOT NULL
) ENGINE =InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `infkey`
    ADD PRIMARY KEY(`value`);
    
ALTER TABLE `infkey`
    MODIFY `value` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

CREATE TABLE `chat`(
    `sender` INT(11) NOT NULL,
    `receiver` INT(11) NOT NULL,
    `msg` VARCHAR(500) NOT NULL
) ENGINE =InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `history`(
    `id` INT(11) NOT NULL,
    `patient` INT(11) NOT NULL
) ENGINE =InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `account`(
    `owner` VARCHAR(10) NOT NULL,
    `id` INT(11) NOT NULL,
    `pass` VARCHAR(50) NOT NULL    
) ENGINE =InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `account`
    ADD PRIMARY KEY(`id`);

CREATE TABLE `profile`(
    `owner` INT(11) NOT NULL,
    `name` VARCHAR(20) NOT NULL,
    `dp` VARCHAR(50) NOT NULL
) ENGINE =InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `online`(
    `id` INT(11) NOT NULL,
    `name` VARCHAR(20) NOT NULL,
    `type` VARCHAR(50) NOT NULL,
    `dt` DATETIME NOT NULL,
    `state` VARCHAR(10) NOT NULL
) ENGINE =InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `online`
    ADD PRIMARY KEY(`id`);

CREATE TABLE `onlineInf`(
    `id` INT(11) NOT NULL,
    `inf` VARCHAR(20) NOT NULL,
    `type` VARCHAR(20) NOT NULL
) ENGINE =InnoDB DEFAULT CHARSET=utf8;