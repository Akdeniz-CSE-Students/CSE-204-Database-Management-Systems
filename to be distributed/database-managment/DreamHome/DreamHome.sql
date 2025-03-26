DROP TABLE IF EXISTS branch;

CREATE TABLE Branch
(branchNo char(5) PRIMARY KEY,
 street varchar(35),
 city varchar(10),
 postcode varchar(10)
);

INSERT INTO Branch VALUES('B005','22 Deer Rd','London','SW1 4EH');
INSERT INTO Branch VALUES('B007','16 Argyll St', 'Aberdeen','AB2 3SU');
INSERT INTO Branch VALUES('B003','163 Main St', 'Glasgow','G11 9QX');
INSERT INTO Branch VALUES('B004','32 Manse Rd', 'Bristol','BS99 1NZ');
INSERT INTO Branch VALUES('B002','56 Clover Dr', 'London','NW10 6EU');

DROP TABLE if EXISTS Staff;

CREATE TABLE Staff
(staffNo char(5) PRIMARY KEY,
 fName varchar(10),
 lName varchar(10),
 position varchar(10),
 sex char(1),
 DOB date,
 salary int,
 branchNo char(5)
);

INSERT INTO Staff VALUES('SL21','John','White','Manager','M','1965-10-01',30000,'B005');
INSERT INTO Staff VALUES('SG37','Ann','Beech','Assistant','F','1980-11-10',12000,'B003');
INSERT INTO Staff VALUES('SG14','David','Ford','Supervisor','M','1978-03-24',18000,'B003');
INSERT INTO Staff VALUES('SA9','Mary','Howe','Assistant','F','1990-02-19',9000,'B007');
INSERT INTO Staff VALUES('SG5','Susan','Brand','Manager','F','1960-06-03',24000,'B003');
INSERT INTO Staff VALUES('SL41','Julie','Lee','Assistant','F','1985-06-13',9000,'B005');

DROP TABLE IF EXISTS PrivateOwner;
CREATE TABLE PrivateOwner
(ownerNo char(5) PRIMARY KEY,
 fName varchar(10),
 lName varchar(10),
 address varchar(50),
 telNo char(15),
 email varchar(50),
 password varchar(40)
);

INSERT INTO PrivateOwner VALUES('CO46','Joe','Keogh','2 Fergus Dr. Aberdeen AB2 ','01224-861212', 'jkeogh@lhh.com', null);
INSERT INTO PrivateOwner VALUES('CO87','Carol','Farrel','6 Achray St. Glasgow G32 9DX','0141-357-7419', 'cfarrel@gmail.com', null);
INSERT INTO PrivateOwner VALUES('CO40','Tina','Murphy','63 Well St. Glasgow G42','0141-943-1728', 'tinam@hotmail.com', null);
INSERT INTO PrivateOwner VALUES('CO93','Tony','Shaw','12 Park Pl. Glasgow G4 0QR','0141-225-7025', 'tony.shaw@ark.com', null);

DROP TABLE IF EXISTS PropertyForRent;
CREATE TABLE PropertyForRent
(propertyNo char(5) PRIMARY KEY,
 street varchar(35),
 city varchar(10),
 postcode varchar(10),
 type varchar(10),
 rooms smallint,
 rent int,
 ownerNo char(5) not null,
 staffNo char(5),
 branchNo char(5)
);

INSERT INTO PropertyForRent VALUES('PA14','16 Holhead','Aberdeen','AB7 5SU','House',6,650,'CO46','SA9','B007');
INSERT INTO PropertyForRent VALUES('PL94','6 Argyll St','London','NW2','Flat',4,400,'CO87','SL41','B005' );
INSERT INTO PropertyForRent VALUES('PG4','6 Lawrence St','Glasgow','G11 9QX','Flat',3,350,'CO40', NULL, 'B003');
INSERT INTO PropertyForRent VALUES('PG36','2 Manor Rd','Glasgow','G32 4QX','Flat',3,375,'CO93','SG37','B003' );
INSERT INTO PropertyForRent VALUES('PG21','18 Dale Rd','Glasgow','G12','House',5,600,'CO87','SG37','B003');
INSERT INTO PropertyForRent VALUES('PG16','5 Novar Dr','Glasgow','G12 9AX','Flat',4,450,'CO93','SG14','B003' );

DROP TABLE IF EXISTS Client;
CREATE TABLE Client
(clientNo char(5) PRIMARY KEY,
 fName varchar(10),
 lName varchar(10),
 telNo char(15),
 prefType varchar(10),
 maxRent int,
 email varchar(50)
);

INSERT INTO Client VALUES('CR76','John','Kay','0171-774-5632','Flat',425, 'john.kay@gmail.com');
INSERT INTO Client VALUES('CR56','Aline','Steward','0141-848-1825','Flat',350, 'astewart@hotmail.com');
INSERT INTO Client VALUES('CR74','Mike','Ritchie','01475-943-1728','House',750, 'mritchie@yahoo.co.uk');
INSERT INTO Client VALUES('CR62','Mary','Tregear','01224-196720','Flat',600, 'maryt@hotmail.co.uk');

DROP TABLE IF EXISTS Viewing;
CREATE TABLE  Viewing
(clientNo char(5) not null,
 propertyNo char(5) not null,
 ViewDate date,
 comment varchar(15)
);
INSERT INTO Viewing VALUES('CR56','PA14','2015-05-24','too small');
INSERT INTO Viewing VALUES('CR76','PG4','2015-04-20','too remote');
INSERT INTO Viewing VALUES('CR56','PG4','2015-05-26',null);
INSERT INTO Viewing VALUES('CR62','PA14','2015-05-14','no dining room');
INSERT INTO Viewing VALUES('CR56','PG36','2015-04-28',null);

DROP TABLE IF EXISTS Registration;
CREATE TABLE Registration
(clientNo char(5) not null,
 branchNo char(5) not null,
 staffNo char(5) not null,
 dateJoined date
);

INSERT INTO Registration VALUES('CR76','B005','SL41','2015-01-13');
INSERT INTO Registration VALUES('CR56','B003','SG37','2014-04-13');
INSERT INTO Registration VALUES('CR74','B003','SG37','2013-11-16');
INSERT INTO Registration VALUES('CR62','B007','SA9','2014-03-07');
