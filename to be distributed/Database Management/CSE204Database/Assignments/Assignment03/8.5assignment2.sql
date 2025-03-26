SELECT sub.hotelNo
FROM(SELECT h.hotelNo AS hotelNo , COUNT(b.hotelNo) AS bookingCount
FROM Hotel h, Booking b, Room r
WHERE h.hotelNo = b.hotelNo AND r.roomNo = b.roomNo AND r.hotelNo = h.hotelNo
GROUP BY b.hotelNo) sub
WHERE sub.bookingCount > 1000