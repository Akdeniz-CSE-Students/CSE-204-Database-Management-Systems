GRANT ALL PRIVILEGES
ON bricscountries 
TO Accounts;
REVOKE DELETE, REFERENCES, USAGE
ON bricscountries 
FROM Accounts;

GRANT ALL PRIVILEGES
ON cheapestHotels 
TO Accounts;
REVOKE DELETE, REFERENCES, USAGE
ON cheapestHotels 
FROM Accounts;


GRANT SELECT, UPDATE, INSERT
ON bricscountries 
TO Accounts;
GRANT SELECT, UPDATE, INSERT
ON cheapestHotels 
TO Accounts;



