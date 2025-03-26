CREATE VIEW bricsCountries
AS SELECT *
FROM Guest
WHERE guestAddress IN ("Brazil","Russia","India","China","South Africa");