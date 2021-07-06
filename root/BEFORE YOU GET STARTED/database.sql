CREATE TABLE users (
  usersId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  usersName varchar(128) NOT NULL,
  usersEmail varchar(128) NOT NULL,
  usersUid varchar(128) NOT NULL,
  usersPwd varchar(128) NOT NULL,
  usersUniTags varchar(128) NOT NULL,
  usersDepTags varchar(128) NOT NULL
);
