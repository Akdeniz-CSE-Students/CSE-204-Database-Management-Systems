SELECT COUNT(numberOfEachType) 
FROM(SELECT COUNT(type) AS numberOfEachType
FROM room
GROUP BY type) sub
WHERE sub.numberOfEachType = 1