CREATE TABLE tweets (
    Id int NOT NULL AUTO_INCREMENT,
    CategoryId int NOT NULL,
    FOREIGN KEY (CategoryId) REFERENCES categories(Id) ON DELETE RESTRICT
);