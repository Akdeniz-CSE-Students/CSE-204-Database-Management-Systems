SELECT guestName,g.guestAddress,COUNT(b.guestNo) AS totalNumberOfBookings
FROM guest g, booking b
WHERE g.guestNo = b.guestNo
GROUP BY g.guestNo
