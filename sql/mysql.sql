#
# Structure table for `amreviews_reviews` (30 fields)
#

CREATE TABLE `amreviews_reviews` (
    `id`           INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `uid`          INT(10) UNSIGNED NOT NULL DEFAULT 0,
    `catid`        INT(10) UNSIGNED NOT NULL DEFAULT 0,
    `weight`       INT(10) UNSIGNED NOT NULL DEFAULT 0,
    `title`        VARCHAR(100)                   NULL,
    `subtitle`     VARCHAR(100)                   NULL,
    `image_file`   VARCHAR(100)                   NULL,
    `image_align`  CHAR(1)          NOT NULL DEFAULT '',
    `our_rating`   VARCHAR(5)                     NOT NULL DEFAULT '0',
    `reviewer_ip`  VARCHAR(45)      NOT NULL DEFAULT '',
    `teaser`       TEXT                           NULL,
    `item_details` TEXT                           NULL,
    `review`       TEXT                           NULL,
    `keywords`     TEXT                           NULL,
    `date`         INT(11) UNSIGNED               NOT NULL DEFAULT 0,
    `date_publish` INT(11) UNSIGNED               NOT NULL DEFAULT 0,
    `date_end`     INT(11) UNSIGNED               NOT NULL DEFAULT 0,
    `views`        INT(10) UNSIGNED              NOT NULL DEFAULT 0,
    `pagetitle`    ENUM ('None','Yes','Yes2')     NOT NULL DEFAULT 'None',
    `metaheaders`  ENUM ('None','Yes','Yes2')     NOT NULL DEFAULT 'None',
    `comments`     ENUM ('0','1')                 NOT NULL DEFAULT '1',
    `notify`       ENUM ('0','1')                 NOT NULL DEFAULT '0',
    `validated`    ENUM ('0','1')                 NOT NULL DEFAULT '0',
    `showme`       ENUM ('0','1')                 NOT NULL DEFAULT '1',
    `highlight`    ENUM ('0','1')                 NOT NULL DEFAULT '0',
    `nohtml`       ENUM ('0','1')                 NOT NULL DEFAULT '1',
    `nosmiley`     ENUM ('0','1')                 NOT NULL DEFAULT '1',
    `noxcode`      ENUM ('0','1')                 NOT NULL DEFAULT '1',
    `noimage`      ENUM ('0','1')                 NOT NULL DEFAULT '1',
    `nobr`         ENUM ('0','1')                 NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`)
)
    ENGINE = MyISAM;
#
# Structure table for `amreviews_cat` (6 fields)
#

CREATE TABLE `amreviews_cat` (
    `id`          INT(5)       NOT NULL AUTO_INCREMENT,
    `pid`         INT(5)       NOT NULL DEFAULT 0,
    `title`       VARCHAR(100) NOT NULL DEFAULT '0',
    `description` TEXT         NOT NULL,
    `weight`      INT(5)       NOT NULL DEFAULT 0,
    `showme`      INT(1)       NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`)
)
    ENGINE = MyISAM;
#
# Structure table for `amreviews_rate` (12 fields)
#

CREATE TABLE `amreviews_rate` (
    `id`           INT(5)           NOT NULL AUTO_INCREMENT,
    `review_id`    INT(5)           NOT NULL DEFAULT 0,
    `rating`       INT(5)           NOT NULL DEFAULT 0,
    `uid`          INT(10)          NOT NULL DEFAULT 0,
    `user_ip`      VARCHAR(45)      NOT NULL DEFAULT '0',
    `user_browser` VARCHAR(50)      NOT NULL DEFAULT '0',
    `title`        VARCHAR(100)     NOT NULL DEFAULT '0',
    `text`         TEXT             NOT NULL,
    `date_created` INT(11) UNSIGNED NOT NULL DEFAULT 0,
    `showme`       TINYINT(1)       NOT NULL DEFAULT 1,
    `validated`    TINYINT(1)       NOT NULL DEFAULT 0,
    `useful`       VARCHAR(20)      NOT NULL DEFAULT '0/0',
    PRIMARY KEY (`id`)
)
    ENGINE = MyISAM;
