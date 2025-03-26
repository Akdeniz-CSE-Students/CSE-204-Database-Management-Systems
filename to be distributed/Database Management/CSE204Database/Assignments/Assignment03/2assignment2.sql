CREATE TABLE Hotel (
hotelNo INT NOT NULL,
hotelName VARCHAR(45), 
city VARCHAR(45),
PRIMARY KEY(hotelNo)
);

CREATE TABLE Room (
roomNo INT NOT NULL, CHECK(roomNo BETWEEN 1 AND 100),
hotelNo INT NOT NULL,
type VARCHAR(45), CHECK(type IN('Single', 'Double','Family')),
price int, CHECK(price BETWEEN 10 AND 100),
PRIMARY KEY(roomNo, hotelNo)
);

CREATE TABLE Booking (
hotelNo INT NOT NULL,
guestNo INT NOT NULL,
dateFrom DATE NOT NULL, 
dateTo DATE ,
roomNo INT CHECK(roomNo BETWEEN'1' AND '100'),
PRIMARY KEY(hotelNo, guestNo, dateFrom)
);