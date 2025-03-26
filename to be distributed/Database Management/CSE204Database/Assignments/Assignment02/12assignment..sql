SELECT s2.guestName, s2.guestAddress, s2.hotelName, s2.city
	FROM (SELECT s1.guestName AS GuestName, 
		s1.guestAddress AS GuestAddress,
		s1.hotelName AS hotelName, 
		s1.city AS city, 
    SUM(s1.totalDay*price) AS totalPrice
		FROM (SELECT g.guestName, 
			g.guestAddress, 
			h.hotelName, 
			h.city, 
			datediff(b.dateTo, b.dateFrom) AS totalDay, 
			r.price AS price
				FROM guest g, room r, booking b, hotel h
					WHERE b.guestNo = g.guestNo 
						AND r.roomNo = b.roomNo 
						AND r.hotelNo = b.hotelNo 
						AND h.hotelNo = r.hotelNo
                        AND b.dateFrom LIKE '%2021'
                        AND b.dateTo LIKE '%2021') s1
	GROUP BY guestName) s2
	WHERE s2.totalPrice > 10000