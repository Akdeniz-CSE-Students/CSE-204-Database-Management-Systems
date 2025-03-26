### Outer Join

-   If one row of a joined table doesn't exists, that row will be ommitted.
    -   select rows where the desired data exist on both tables.

```
select p.*, c.*
from
where
```

### Left Join

-   Take all the row of the left, pass null if rigth doesn't exist

### Right Join

-   Take all the row of the right, pass NULL if left doesn't exist

### Full Outer Join

-   Take all the row, put NULL empty places.

## Union, Intersect, and Difference

-   For the set R and S
    -   R && S called _union_
    -   R || S called _intersect_
    -   R - S called _difference_
