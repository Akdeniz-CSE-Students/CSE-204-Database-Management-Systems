DELETE r FROM room r 
JOIN(SELECT* FROM (SELECT b.roomNo, b.hotelNo, max(b.dateTo) AS lastDate
	FROM booking b
	GROUP BY b.roomNo, b.hotelNo) s1 
		WHERE datediff(CURRENT_TIMESTAMP, s1.lastDate)>365*2) s2
WHERE s2.hotelNo = r.hotelNo
	AND s2.roomNo = r.roomNo