SELECT  h.hotelNo, h.hotelName, h.city, r.roomNo
FROM guest g, hotel h, booking b, room r
WHERE "2022-03-01" NOT BETWEEN b.dateFrom AND b.dateTo 
AND g.guestNo= b.guestNo 
AND b.hotelNo = h.hotelNo 
AND b.hotelNo=r.hotelNo 
AND r.roomNo = b.roomNo