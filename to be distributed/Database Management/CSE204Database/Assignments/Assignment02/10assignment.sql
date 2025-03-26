SELECT g.guestName, h.hotelName
FROM booking b, guest g, hotel h
WHERE g.guestNo = b.guestNo AND h.hotelNo = b.hotelNo