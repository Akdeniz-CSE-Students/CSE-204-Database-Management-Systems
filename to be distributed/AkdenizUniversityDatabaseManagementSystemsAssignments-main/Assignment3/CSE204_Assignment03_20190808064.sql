-- 1 ->

CREATE DOMAIN GuestNo AS VARCHAR(10);
CREATE DOMAIN GuestName AS VARCHAR(50);
CREATE DOMAIN GuestAddress AS VARCHAR(250);

CREATE TABLE Guest (
guestNo GuestNo PRIMARY KEY,
guestName GuestName  NOT NULL,
guestAddress GuestAddress  NOT NULL
);


-- 2 ->


CREATE DOMAIN HotelNo AS VARCHAR(10);
CREATE DOMAIN HotelName AS VARCHAR(250);
CREATE DOMAIN City AS VARCHAR(50);

CREATE TABLE Hotel (
hotelNo HotelNo PRIMARY KEY ,
hotelName HotelName  NOT NULL ,
city City NOT NULL
) ;




CREATE DOMAIN RoomNo AS INT CHECK(VALUE BETWEEN 1 AND 100);
CREATE DOMAIN Type AS VARCHAR(50) CHECK (VALUE IN ('Single','Double','Family'));
CREATE DOMAIN Price AS INT CHECK(VALUE BETWEEN 1000 AND 10000);


CREATE TABLE Room (
roomNo RoomNo ,
hotelNo HotelNo ,
type Type NOT NULL ,
price Price NOT NULL ,
FOREIGN KEY (hotelNo) REFERENCES Hotel(hotelNo),
PRIMARY KEY (roomNo,hotelNo)
) ;




CREATE DOMAIN DateFrom AS DATE CHECK(VALUE > CURRENT_DATE);
CREATE DOMAIN DateTo AS DATE CHECK(VALUE > CURRENT_DATE);

CREATE TABLE Booking (
hotelNo HotelNo ,
guestNo GuestNo , 
dateFrom DateFrom , 
dateTo DateTo NOT NULL ,
roomNo RoomNo NOT NULL,
FOREIGN KEY (hotelNo) REFERENCES Hotel(hotelNo),
FOREIGN KEY (guestNo) REFERENCES Guest(guestNo),
FOREIGN KEY (roomNo) REFERENCES Room(roomNo),
PRIMARY KEY (hotelNo, guestNo, dateFrom) 
CONSTRAINT DoubleRoomBookedCheck  (NOT EXISTS (SELECT * FROM Booking b WHERE b.dateTo > Booking.dateFrom AND b.dateFrom < Booking.dateTo AND b.roomNo = Booking.roomNo AND b.hotelNo = Booking.hotelNo)),
CONSTRAINT DoubleGuestBookedCheck (NOT EXISTS (SELECT * FROM Booking b WHERE b.dateTo > Booking.dateFrom AND b.dateFrom < Booking.dateTo AND b.guestNo = Booking.guestNo))
) ; 

-- 3 ->

CREATE TABLE BookingArchive (
hotelNo int ,
guestNo int , 
dateFrom date  , 
dateTo date NOT NULL,
roomNo int NOT NULL,
FOREIGN KEY (hotelNo) REFERENCES Hotel(hotelNo),
FOREIGN KEY (guestNo) REFERENCES Guest(guestNo),
FOREIGN KEY (roomNo) REFERENCES Room(roomNo),
PRIMARY KEY (hotelNo, guestNo, dateFrom)
) ;

INSERT INTO BookingArchieve (
SELECT * FROM Booking WHERE dateTo < '2018/03/22'
) ;

DELETE FROM Booking WHERE dateTo < '2018/03/22' ;


-- 4 ->


CREATE VIEW CheapHotels AS SELECT h.hotelNo,h.hotelName,h.city 
FROM Hotel h, Room r 
WHERE h.hotelNo = r.hotelNo 
GROUP BY h.hotelNo,r.price 
ORDER BY AVG(r.price);



-- 5 ->


CREATE VIEW GuestsBrics AS SELECT *
FROM Guest
WHERE guestAddress LIKE  ('%Brasil%') OR guestAddress LIKE ('%Russia%') OR  guestAddress LIKE ('%India%') OR guestAddress LIKE ('%China%') OR guestAddress LIKE ('%SouthAfrica%');


-- 6 ->

GRANT ALL PRIVILEGES ON CheapHotels TO Manager, Director WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON GuestsBrics TO Manager, Director WITH GRANT OPTION;


-- 7 ->


GRANT SELECT,UPDATE,INSERT 
ON CheapHotels , GuestsBrics 
WITH GRANT OPTION ;


GRANT ALL PRIVILEGES 
ON CheapHotels,GuestsBrics 
TO UserAccounts WITH GRANT OPTION;

REVOKE DELETE,REFERENCES,USAGE
ON CheapHotels,GuestsBrics
FROM UserAccounts;



-- 8 ->


	-- a ->
		
	SELECT h.hotelNo, COUNT(*) 
	FROM Hotel h, Room r, Booking b 
	WHERE h.hotelNo = r.hotelNo AND r.roomNo b.roomNo 
	GROUP BY h.hotelNo ;

	-- b ->
		
	-- May be Invalid because hotelNo is not given in quotes even though it is varchar

	SELECT h.hotelNo FROM Hotel h, Room r, Booking b WHERE (h.hotelNo = r.hotelNo) AND (r.roomNo b.roomNo) AND ( h.hotelNo = 'H001') GROUP BY h.hotelNo ;

	-- c ->

	-- It is invalid because bookingCount cannot be used within any other aggregate function 	   

	-- d ->

	-- It is invalid because bookingCount cannot be used within any other aggregate function

	-- e ->

	-- It is invalid because bookingCount cannot be used in the WHERE clause

	-- f ->

	SELECT h.hotelNo, COUNT(*) AS bookingCount 
	FROM Hotel h, Room r, Booking b 
	WHERE h.hotelNo = r.hotelNo AND r.roomNo b.roomNo 
	GROUP BY h.hotelNo
	ORDER BY bookingCount;
		





 


