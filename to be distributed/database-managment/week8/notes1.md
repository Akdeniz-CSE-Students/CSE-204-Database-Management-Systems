# Fuctional Dependencies

Let _ID_, _Name_ are atribute of a table, we can say that:

-   ID determines Name
-   Name functoinally depends on ID

it is shown as `ID -> Name`

-   _Full functional dependencies_: smallest subset of any dependencies
-   _Transitive dependencies_: If A -> B and B -> C then A -> C

# Normalization

Narmalized data are protected agains to update anamolies.

0. UNF: contains one or more repeating groups
1. 1NF:
    - Each row and column crossection has to be single value.
    - Determine primary key
2. 2NF
    - Based on full functional dependency
    - Identfy primary key
    - Identify functional dependency
3. 3NF
    - Based on transitive dependency.
    - Identify primary key
4. 4NF
5. 5NF
6. Highest normal forms
