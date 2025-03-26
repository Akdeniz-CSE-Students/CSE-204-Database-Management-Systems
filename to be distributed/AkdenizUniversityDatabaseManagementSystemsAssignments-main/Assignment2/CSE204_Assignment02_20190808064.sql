-- 1 - 

SELECT * 
FROM hotel ;
	
-- 2  - 

SELECT guestName AS 'Name' 
FROM guest ; 

-- 3 - 

SELECT DISTINCT r.type AS 'Room Type' 
FROM room r 
WHERE r.price >= 300 ; 

-- 4 -   

SELECT roomNo AS 'Room No' , h.hotelName AS 'Hotel Name' , type AS 'Type' , price AS 'Price' 
FROM hotel h,room r 
WHERE h.city LIKE 'A%' AND r.type = 'Family Room' AND h.hotelNo = r.hotelNo ; 

-- 5 -  

SELECT DISTINCT g.guestNo AS 'No' , g.guestName AS 'Name' , g.guestAddress AS 'Address'
FROM guest g, booking b, hotel h 
WHERE h.hotelName = 'Akdeniz Hotel' AND b.hotelNo = h.hotelNo AND g.guestNo = b.guestNo ;

-- 6 - 

SELECT * 
FROM room 
WHERE roomNo NOT IN 
(
SELECT roomNo FROM room r WHERE roomNo IN (SELECT roomNo FROM booking b WHERE TIMESTAMPDIFF(YEAR,b.dateTo,CURDATE()) < 2 )
UNION
SELECT roomNo FROM room WHERE roomNo NOT IN (SELECT r.roomNo FROM room r JOIN booking b ON r.roomNo = b.roomNo AND r.hotelNo = b.hotelNo GROUP BY b.roomNo)
);

-- 7 - 

SELECT g.guestNo AS 'No', g.guestName AS 'Name', g.guestAddress AS 'Address' , count(b.guestNo) AS 'Total Number of Bookings' 
FROM guest g 
JOIN booking b ON g.guestNo = b.guestNo 
GROUP BY b.guestNo;

-- 8 -  

SELECT g.guestName AS 'Name' , sum(r.price * (DATEDIFF(dateTo,dateFrom))) AS 'Total Price' 
FROM booking b 
JOIN room r ON r.roomNo = b.roomNo 
JOIN guest g ON g.guestNo = b.guestNo 
GROUP BY b.guestNo;

-- 9 -

SELECT * 
FROM room r 
WHERE roomNo NOT IN 
(SELECT b.roomNo FROM booking b INNER JOIN room r ON r.hotelNo = b.hotelNo WHERE ('2022-03-01' BETWEEN b.dateFrom AND b.dateTo) ) ;

-- 10 - 

SELECT DISTINCT g.guestName AS 'Name', h.hotelName AS 'Hotel' 
FROM booking b 
JOIN guest g ON g.guestNo = b.guestNo 
JOIN hotel h ON h.hotelNo = b.hotelNo;

-- 11 -

SELECT count(DISTINCT type) AS 'Count of Room Type' 
FROM room ;

-- 12 -

SELECT DISTINCT g.guestName AS 'Name' , g.guestAddress 'Address' , h.hotelName AS 'Hotel Name' , h.city 'City'
FROM booking b 
INNER JOIN room r ON b.roomNo = r.roomNo  
INNER JOIN guest g ON g.guestNo = b.guestNo 
INNER JOIN hotel h ON h.hotelNo = b.hotelNo  
WHERE TIMESTAMPDIFF(YEAR,b.dateTo,CURDATE()) < 1 AND  g.guestNo IN
(
SELECT g.guestNo 
FROM booking b
INNER JOIN room r ON r.roomNo = b.roomNo
INNER JOIN guest g ON g.guestNo = b.guestNo
WHERE TIMESTAMPDIFF(YEAR,b.dateTo,CURDATE()) < 1  
GROUP BY b.guestNo HAVING sum(r.price * (DATEDIFF(dateTo,dateFrom))) > 10000
);

