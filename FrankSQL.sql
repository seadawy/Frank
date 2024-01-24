CREATE TABLE `Questions`(
    `user_token` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `options` VARCHAR(255) NOT NULL,
    `answer` VARCHAR(255) NOT NULL
);
CREATE TABLE `Quiz`(
    `user_token` VARCHAR(255) NOT NULL,
    `questionNo` BIGINT NOT NULL
);
ALTER TABLE
    `Quiz` ADD PRIMARY KEY `quiz_user_token_primary`(`user_token`);
CREATE TABLE `History`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `host` VARCHAR(255) NOT NULL,
    `guest` VARCHAR(255) NOT NULL,
    `guest_answers` VARCHAR(255) NOT NULL,
    `score` BIGINT NOT NULL
);
ALTER TABLE
    `History` ADD PRIMARY KEY `history_id_primary`(`id`);
CREATE TABLE `Users`(
    `token` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NULL
);
ALTER TABLE
    `Users` ADD PRIMARY KEY `users_token_primary`(`token`);
ALTER TABLE
    `History` ADD CONSTRAINT `history_guest_foreign` FOREIGN KEY(`guest`) REFERENCES `Users`(`token`);
ALTER TABLE
    `Questions` ADD CONSTRAINT `questions_user_token_foreign` FOREIGN KEY(`user_token`) REFERENCES `Quiz`(`user_token`);
ALTER TABLE
    `History` ADD CONSTRAINT `history_host_foreign` FOREIGN KEY(`host`) REFERENCES `Users`(`token`);
ALTER TABLE
    `Users` ADD CONSTRAINT `users_token_foreign` FOREIGN KEY(`token`) REFERENCES `Quiz`(`user_token`);