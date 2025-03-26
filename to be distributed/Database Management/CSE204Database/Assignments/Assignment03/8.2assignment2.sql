SELECT h.hotelNo
FROM Hotel h, Room r, Booking b
WHERE h.hotelNo = r.hotelNo AND r.roomNo = b.roomNo AND h.hotelNo = "H001"
GROUP BY h.hotelNo;