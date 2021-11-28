# EBD: Database Specification Component

This project aims to build an information system with a web interface for project management that allows teams of users to organize their professional projects. This application’s target audience are companies and teams working on complex projects, offering them a platform to organize every aspect of their workflow.

## A4: Conceptual Data Model

> The Conceptual Data Model contains the identification and description of the entities and relationships that are relevant to the database specification.

> A UML class diagram is used to document the model.

A professional diagram drawing tool that supports UML is recommended.

### 1. Class diagram

> UML class diagram containing the classes, associations, multiplicity and roles.  
> For each class, the attributes, associations and constraints are included in the class diagram.

### 2. Additional Business Rules

> Business rules can be included in the UML diagram as UML notes or in a table in this section.

---

## A5: Relational Schema, validation and schema refinement

> Brief presentation of the artefact goals.

### 1. Relational Schema

| Relation reference | Relation Compact Notation                                                                                                                  |
| ------------------ | ------------------------------------------------------------------------------------------------------------------------------------------ |
| R01                | user(**id**,email UK NN,name NN,password NN, profile_image, profile_description)                                                           |
| R02                | company(**id**,name NN)                                                                                                                    |
| R03                | administrator(**email**,name NN,company_id NN)                                                                                             |
| R04                | work(**user_id**,**company_id**)                                                                                                           |
| R05                | project(**id**, company_id FK,name NN, description, start_date NN, delivery_date NN CK delivery_date>start_date, archived)                 |
| R06                | project_coordinator(**user_id**,**project_id**)                                                                                            |
| R07                | project_member(**user_id**,**company_id**)                                                                                                 |
| R08                | task(**id**, project_id, name NN, description, start_date NN, delivery_date NN CK -> delivery > start, status NN CK status IN Task_Status) |
| R09                | task_assigned(**project_coordinator_id**, **project_member_id**,**task_id**,notified)                                                      |
| R10                | forum_post(**id**,project_id,project_member_id NN, content NN, post_date NN)                                                               |
| R11                | invitation(**project_id** , **user_id**, **coordinator_id**, accepted NN)                                                                  |
| R12                | favorite(**project_id**, **user_id**)                                                                                                      |

###### NOTE:

Primary Keys : <u>Underlined</u> <br>
Unique Keys : UK <br>
Not Null : NN <br>
Check : CK <br>

### 2. Domains

Specification of additional domains:

| Domain Name | Domain Specification                           |
| ----------- | ---------------------------------------------- |
| Task Status | ENUM('Not Started', 'In Progress', 'Complete') |

### 3. Schema validation

To validate the Relational Schema obtained from the Conceptual Data Model, all functional dependencies are identified and the normalization of all relation schemas is accomplished.

| **TABLE R01**                | user                                                             |
| ---------------------------- | ---------------------------------------------------------------- |
| **Keys**                     | { id }, { email }                                                |
| **Functional Dependencies:** |                                                                  |
| FD0101                       | id → {email, name, password, profile_image, profile_description} |
| FD0102                       | email → {id, name, password, profile_image, profile_description} |
| **NORMAL FORM**              | BCNF                                                             |

| **TABLE R02**                | company     |
| ---------------------------- | ----------- |
| **Keys**                     | { id }      |
| **Functional Dependencies:** |             |
| FD0101                       | id → {name} |
| **NORMAL FORM**              | BCNF        |

| **TABLE R03**                | administrator             |
| ---------------------------- | ------------------------- |
| **Keys**                     | { email }                 |
| **Functional Dependencies:** |                           |
| FD0101                       | email → {name,company_id} |
| **NORMAL FORM**              | BCNF                      |

| **TABLE R04**                | work                    |
| ---------------------------- | ----------------------- |
| **Keys**                     | { user_id, company_id } |
| **Functional Dependencies:** |                         |
| FD0101                       | _none_                  |
| **NORMAL FORM**              | BCNF                    |

| **TABLE R05**                | project                                                                   |
| ---------------------------- | ------------------------------------------------------------------------- |
| **Keys**                     | {id }                                                                     |
| **Functional Dependencies:** |                                                                           |
| FD0101                       | id → {company_id, name, description, start_date, delivery_date, archived} |
| **NORMAL FORM**              | BCNF                                                                      |

| **TABLE R06**                | project_coordinator     |
| ---------------------------- | ----------------------- |
| **Keys**                     | { user_id, project_id } |
| **Functional Dependencies:** |                         |
| FD0101                       | _none_                  |
| **NORMAL FORM**              | BCNF                    |

| **TABLE R07**                | project_member          |
| ---------------------------- | ----------------------- |
| **Keys**                     | { user_id, project_id } |
| **Functional Dependencies:** |                         |
| FD0101                       | _none_                  |
| **NORMAL FORM**              | BCNF                    |

| **TABLE R08**                | task                                                                   |
| ---------------------------- | ---------------------------------------------------------------------- |
| **Keys**                     | {id}                                                                   |
| **Functional Dependencies:** |                                                                        |
| FD0101                       | id->{project_id, name, description, start_date, delivery_date, status} |
| **NORMAL FORM**              | BCNF                                                                   |

| **TABLE R09**                | task_assigned                                                    |
| ---------------------------- | ---------------------------------------------------------------- |
| **Keys**                     | {project_coordinator_id, project_member_id, task_id}             |
| **Functional Dependencies:** |                                                                  |
| FD0101                       | {project_coordinator_id, project_member_id, task_id}->{notified} |
| **NORMAL FORM**              | BCNF                                                             |

| **TABLE R10**                | forum_post                                              |
| ---------------------------- | ------------------------------------------------------- |
| **Keys**                     | {id}                                                    |
| **Functional Dependencies:** |                                                         |
| FD0101                       | id->{project_id, project_member_id, content, post_date} |
| **NORMAL FORM**              | BCNF                                                    |

| **TABLE R11**                | invitation                                         |
| ---------------------------- | -------------------------------------------------- |
| **Keys**                     | {project_id, user_id, coordinator_id}              |
| **Functional Dependencies:** |                                                    |
| FD0101                       | {project_id, user_id, coordinator_id} ->{accepted} |
| **NORMAL FORM**              | BCNF                                               |

| **TABLE R12**                | favorite             |
| ---------------------------- | -------------------- |
| **Keys**                     | {user_id,project_id} |
| **Functional Dependencies:** |                      |
| FD0101                       | _none_               |
| **NORMAL FORM**              | BCNF                 |

Because all relations are in the Boyce–Codd Normal Form (BCNF), the relational schema is also in the BCNF and, therefore, the schema does not need to be further normalized.

---

## A6: Indexes, triggers, transactions and database population

> Brief presentation of the artefact goals.

### 1. Database Workload

> A study of the predicted system load (database load).
> Estimate of tuples at each relation.

| **Relation reference** | **Relation Name** | **Order of magnitude** | **Estimated growth** |
| ---------------------- | ----------------- | ---------------------- | -------------------- | -------- | --- | ---------------- |
| R01                    | Table1            | units                  | dozens               | hundreds | etc | order per time   |
| R02                    | Table2            | units                  | dozens               | hundreds | etc | dozens per month |
| R03                    | Table3            | units                  | dozens               | hundreds | etc | hundreds per day |
| R04                    | Table4            | units                  | dozens               | hundreds | etc | no growth        |

### 2. Proposed Indices

#### 2.1. Performance Indices

> Indices proposed to improve performance of the identified queries.

| **Index**         | IDX01                                  |
| ----------------- | -------------------------------------- |
| **Relation**      | Relation where the index is applied    |
| **Attribute**     | Attribute where the index is applied   |
| **Type**          | B-tree, Hash, GiST or GIN              |
| **Cardinality**   | Attribute cardinality: low/medium/high |
| **Clustering**    | Clustering of the index                |
| **Justification** | Justification for the proposed index   |
| `SQL code`        |                                        |

#### 2.2. Full-text Search Indices

> The system being developed must provide full-text search features supported by PostgreSQL. Thus, it is necessary to specify the fields where full-text search will be available and the associated setup, namely all necessary configurations, indexes definitions and other relevant details.

| **Index**         | IDX01                                |
| ----------------- | ------------------------------------ |
| **Relation**      | Relation where the index is applied  |
| **Attribute**     | Attribute where the index is applied |
| **Type**          | B-tree, Hash, GiST or GIN            |
| **Clustering**    | Clustering of the index              |
| **Justification** | Justification for the proposed index |
| `SQL code`        |                                      |

### 3. Triggers

> User-defined functions and trigger procedures that add control structures to the SQL language or perform complex computations, are identified and described to be trusted by the database server. Every kind of function (SQL functions, Stored procedures, Trigger procedures) can take base types, composite types, or combinations of these as arguments (parameters). In addition, every kind of function can return a base type or a composite type. Functions can also be defined to return sets of base or composite values.

| **Trigger**     | TRIGGER01                                                               |
| --------------- | ----------------------------------------------------------------------- |
| **Description** | Trigger description, including reference to the business rules involved |
| `SQL code`      |                                                                         |

### 4. Transactions

> Transactions needed to assure the integrity of the data.

| SQL Reference       | Transaction Name                    |
| ------------------- | ----------------------------------- |
| Justification       | Justification for the transaction.  |
| Isolation level     | Isolation level of the transaction. |
| `Complete SQL Code` |                                     |

## Annex A. SQL Code

> The database scripts are included in this annex to the EBD component.
>
> The database creation script and the population script should be presented as separate elements.
> The creation script includes the code necessary to build (and rebuild) the database.
> The population script includes an amount of tuples suitable for testing and with plausible values for the fields of the database.
>
> This code should also be included in the group's git repository and links added here.

### A.1. Database schema

### A.2. Database population

---

## Revision history

Changes made to the first submission:

1. Item 1
1. ..

---

GROUP2151, 08/11/2021

| Name           | Number    | E-Mail            |
| -------------- | --------- | ----------------- |
| Sofia Germer   | 201907461 | up201907461@up.pt |
| Miguel Lopes   | 201704590 | up201704590@up.pt |
| Edgar Torre    | 201906573 | up201906573@up.pt |
| Henrique Pinho | 201805000 | up201805000@up.pt |
