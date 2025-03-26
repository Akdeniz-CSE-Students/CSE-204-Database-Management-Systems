SELECT s1.guestName, SUM(s1.totalDay*price) AS totalPrice
FROM (SELECT g.guestName, datediff(dateTo, b.dateFrom) AS totalDay, r.price AS price
FROM guest g, room r, booking b
WHERE b.guestNo = g.guestNo AND r.roomNo = b.roomNo AND r.hotelNo = b.hotelNo) s1
GROUP BY guestName

