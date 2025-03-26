# ER Modeling

## Entity Type

    - Group of objects with same properties

## Relationship Types

    - Set of meaningful associations among entity types.

## Attributes

    - Property of an entity or a relationsip type.

## Keys

    - Candidate Key: uniquely identifies each occurrence of an entity type.
    - Primary Key: candidate key selected uniquely identifies each occurrence of an entity type
    - Composite Key: candidate key that consist of two or more attributes.

```
- |Newspaper| ----- Adverties> ----- |PropertyForRent|
   _________                          _______________
  |Name     |            |           |propertyNo     |
                         |
                         |
                         |
                   | dateAdvert |
                    ____________
                   | cost       |
```

### Structural Constrains

    - *Multiplicity*: number(or range) of possible occurrence of an entity type.
    - Binary relationships:
        + one-to-one(1:1)
        + one-to-many(1:*)
        + many-to-many(*:*)

**Example:**

```
  | Staff | ----- Manages> ----- | Branch |
   _______  1..1            0..1  ________
  |staffNo|                      |BranchNo|

```

-   A member of staff can be manage by zero or one branch.
-   Each Branch managed by only one Staff.

**Cardinality:** Max. number of possible relationship occurrences for an entity participating in a given relationship type.(second side)

**Participation:** Wheter all or only some entity occurrences participate in a relationship.(first side)

### Problems with ER Models

#### Fan Trap

Pathway between certain entity occurrences is ambiguous.

#### Chasm Trap

Pathway between certain enetity doesn't exists.
