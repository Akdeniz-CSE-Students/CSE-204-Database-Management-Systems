SELECT r.hotelNo, r.roomNo, r.type, r.price
FROM room r, hotel h
WHERE r.type = "Family Room" AND h.city LIKE 'A%' AND r.hotelNo = h.hotelNo