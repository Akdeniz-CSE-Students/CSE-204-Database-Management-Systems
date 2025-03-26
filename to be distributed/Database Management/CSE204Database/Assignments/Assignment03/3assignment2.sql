CREATE TABLE archiveRecords(
hotelNo INT NOT NULL,
guestNo INT NOT NULL,
dateFrom DATE NOT NULL,
dateTo DATE,
roomNo INT,
PRIMARY KEY(hotelNo, guestNo, dateFrom)
);

INSERT INTO archiveRecords
SELECT * FROM Booking b
WHERE (b.dateTo < '2018-03-22');

DELETE FROM Booking b
WHERE (b.dateTo < '2018-03-22');