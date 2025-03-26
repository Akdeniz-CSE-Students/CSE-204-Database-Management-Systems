### Relational Model Terminology 
- Relation is a table with columns and rows
- Attribute(property) is a column or field
- Tuple is row or record
- Domain is set of allowed value
- Cardinality #row

#### Quote of the day
- Data is not information 
- Information is not knowledge 
- Knowledge is not understanding
- Understanding is not wisdom   ~*Clifford Stoll*

#### DB Relations
- Relation names must be distinct
- Each cell conatin one value
- Inside each column data type must be same, like java array.
- Order of attibutes doesn't matter

#### Relational Keys
- Super Key: set of columns uniquely identifies row
- Candidate Key: min(len(superkey)) 
- Primary Key: Candidate key select to distinct row.
    * Numbers are good primary key 
- Alternate Key: Not selected candidate
- Foreign Key: Primary key that refers to the primary key of another table.

### Intgerity Constraints 
- **Note:** Check the null values with 'IS NULL' and 'IS NOT NULL'
