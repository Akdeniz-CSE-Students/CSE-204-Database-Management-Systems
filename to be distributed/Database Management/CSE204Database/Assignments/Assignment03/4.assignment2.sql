SELECT sub3.hotelNo
FROM(SELECT hotelNo, sum(sub2.totalPriceByType)/sum(sub2.count) AS avgPrice
FROM(SELECT sub1.hotelNo, sub1.price * sub1.count AS totalPriceByType, sub1.count AS count
FROM(SELECT hotelNo, price, COUNT(*) AS count
FROM room
GROUP BY type, price) sub1) sub2
GROUP BY hotelNo
ORDER BY avgPrice) sub3
