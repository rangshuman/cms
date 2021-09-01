-- creating the database
CREATE DATABASE cms COLLATE utf8mb4_general_ci;

-- creating the categories table
CREATE TABLE cms.categroies (
    cat_id INT(10) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    cat_title VARCHAR(300) COLLATE utf8mb4_general_ci
);

-- inserting data into the categories table
INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES (NULL, 'HTML'), (NULL, 'JavaScript')