CREATE TABLE `Admin` (
	`UserN` BINARY NOT NULL,
	`password` varchar(30) NOT NULL
);

CREATE TABLE `User` (
	`userName` varchar(60) NOT NULL UNIQUE,
	`Password` varchar(20) NOT NULL,
	`email` varchar(60) NOT NULL UNIQUE,
	`phoneNum` varchar(50) NOT NULL UNIQUE,
	`numListing` INT NOT NULL DEFAULT '0',
	`listingID` INT NOT NULL DEFAULT '0'
);

CREATE TABLE `Moderator` (
	`ModeratorID` varchar(20) NOT NULL UNIQUE,
	`password` varchar(60) NOT NULL
);

CREATE TABLE `DogProfile` (
	`ListingID` INT NOT NULL AUTO_INCREMENT,
	`Name` varchar(20) NOT NULL,
	`Description` varchar(120) NOT NULL,
	`Breed` varchar(20) NOT NULL,
	`Age` varchar(20) NOT NULL,
	`Photo` varchar(20) NOT NULL,
	`DatePosted` DATETIME(50) NOT NULL,
	PRIMARY KEY (`ListingID`)
);

ALTER TABLE `DogProfile` ADD CONSTRAINT `DogProfile_fk0` FOREIGN KEY (`ListingID`) REFERENCES `User`(`listingID`);

