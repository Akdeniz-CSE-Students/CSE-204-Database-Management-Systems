SELECT g.guestNo, g.guestName, g.guestAddress
FROM guest g, booking b, hotel h
WHERE g.guestNo = b.guestNo AND b.hotelNo = h.hotelNo AND h.hotelName = "Akdeniz Hotel"