# DB Design

Database design has 3 step by step phases namely: conceptual, logical and physical

1. Conceptual: Representaion of database, which includes identificaition of the important entities.

    - Identify entity types
    - Identify relationship types
    - Associate attributes with entity or relationship types.
    - Determine attribute domains
    - Determine candidate, primary and alternate key.
    - Check model for redundancy
    - Validate conceptual data model against user transaction.

2. Locagical: Translation of conceptual representation to logical structure, identifying entities, relationships and attributes.

    - Derive relations for logical data model.
    - Validate relations useing normalization
    - Validate relations against user transactions
    - Check integrity constrains
    - Review logical data model with user
    - Merge logical data model into global model
    - Check future growth

3. Physical: How logical structure is implemented in target DBMS.
    - Translate logical data model for target DBMS
    - Design file organizations and indexing
    - Design user view
    - Design security mechanisms
    - Consider introduction of controlled redundancy
    - Monitor and tune the operational system
