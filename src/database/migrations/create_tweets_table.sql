CREATE TABLE tveets (
    Id int NOT NULL AUTO_INCREMENT,
    Content text NOT NULL,
    CategoryId int NOT NULL,
    Username varchar(255) NOT NULL,
    CreatedAt int(12) NULL,
    PRIMARY KEY (Id)
);


