# Indexing in Databases

Datastructure technique which allows you to quickly retrieve records from a database file.

Index table columns:

```
Search Key | Data Reference(pointer)
```

## Types of Indexing

Based on indexing attributes, 2 types of indexing exists.

### Primary Indexing

Ordered file which is fixed length size with two fields.

#### Desnse Index

Record is created for every key valued in the database.

#### Sparse Index

Record is created for some of the values in the database. It is little bit slower but need less space to store keys.

### Secondary Indexing

This is two-level database indexing technique to reduce the mapping size of the first level.

### Clustering Index in DBMS

Records themselves are stored in the Index and not pointers.

#### Advantages of Indexing

-   It reduces total number of I/O operations needed.
-   Offers faster search and retrieval of data to users.

#### Disadvantages

-   In delete, insert or update each index should be updated in the secondary storage.
