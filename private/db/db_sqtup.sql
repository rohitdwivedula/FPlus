CREATE DATABASE fplus;
USE fplus;

CREATE TABLE users (
	username varchar(25) NOT NULL,
	firstname varchar(255) NOT NULL,
	lastname varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	salt varchar(255) NOT NULL,
	phone varchar(20),
	dob date,
	account_created_on datetime NOT NULL,
	sex char(1),
	PRIMARY KEY (username)
);

CREATE TABLE posts (
	post_id int NOT NULL AUTO_INCREMENT,
	username varchar(25) NOT NULL,
	body TEXT NOT NULL,
	media TEXT,
	visibility int NOT NULL,
	posted_on datetime NOT NULL,
	PRIMARY KEY (post_id),
	FOREIGN KEY (username) REFERENCES users(username)
);

CREATE TABLE comments (
	comment_id int NOT NULL AUTO_INCREMENT,
	post_id int NOT NULL,
	username varchar(25) NOT NULL,
	comment_text TEXT NOT NULL,
	commented_on datetime NOT NULL,
	parent int,
	PRIMARY KEY (comment_id),
	FOREIGN KEY (post_id) REFERENCES posts(post_id),
	FOREIGN KEY (username) REFERENCES users(username),
	FOREIGN KEY (parent) REFERENCES comments(comment_id)
);

CREATE TABLE reactions (
	react_id int NOT NULL AUTO_INCREMENT,
	post_id int NOT NULL,
	username varchar(25) NOT NULL,
	react_type int NOT NULL,
	PRIMARY KEY (react_id),
	FOREIGN KEY (post_id) REFERENCES posts(post_id),
	FOREIGN KEY (username) REFERENCES users(username)
);

CREATE TABLE circles (
	relation_id int NOT NULL AUTO_INCREMENT,
	user1 varchar(25) NOT NULL, 
	user2 varchar(25) NOT NULL,
	relation int NOT NULL,
	PRIMARY KEY (relation_id),
	FOREIGN KEY (user1) REFERENCES users(username),
	FOREIGN KEY (user2) REFERENCES users(username)
);
