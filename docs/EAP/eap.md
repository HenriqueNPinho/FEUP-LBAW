# EAP: Architecture Specification and Prototype

> Project vision.

## A7: High-level architecture. Privileges. Web resources specification

> Brief presentation of the artefact's goals.

### 1. Overview

> An overview of the web application to implement is presented in this section, where the modules are identified and briefly described. The web resources associated with each module are detailed in the individual documentation of each module inside the OpenAPI specification.  

| Module | Description|
|----|----|
|**M01: Static Pages** | Web resources associated with static content such as the About Us page and the Frequently Asked Questions (FAQ) page|
|**M02 : Authentication**| Web resources associated with user authentication. Includes the following system features: login/logout, registration, password recovery.|
|**M03: Authenticated User Area** | Web resources associated with the user's personal area and its management. This includes editing profile details (name, email, profile picture,...) and deleting the account.|
|**M04 : Project Area** | Web resources associated with the project components. This module offers an overview of the project that includes web resources from other modules, which will be later descibed (such as tasks, project collaborators, forum access and tasks search). In addition to this, it allows to add users to the project, to manage their hierarchy within the project and to create new projecs.|
|**M05 : Forum** | Web resources associated with the project's forum. This module includes viewing and posting and editing messages|
|**M06: Company Administrator Area**| Web resources associated with the company's administrator features. This includes user management within the company (inviting and removing users from the company's workspace) and browsing through the company's projects.|

### 2. Permissions

This section defines the permissions used in the modules to establish the conditions of access to resources.

| Identifier | Name                | Descripton              |
| ---------- | ------------------- | ------------------------|
| **PUB**    | Public              | Users without privileges|
| **OWN**    | Owner               | The owner of the content|
| **USR**    | User                | Authenticated users     |
| **PM**     | Project Member      | Member of a project     |
| **PC**     | Project Coordinator | Coordinator of a project|
| **ADM**    | Administrator       | System administrators   |

### 3. OpenAPI Specification

> This section includes the complete API specification in OpenAPI (YAML).

> Additionally there is a link to the OpenAPI YAML file in the group's repository. The filename should include ‘openapi’ to activate GitLab’s OpenAPI viewer.
OpenAPI specification in YAML format to describe the web application's web resources.

Link to the `.yaml` file in the group's repository.

Link to the Swagger generated documentation (e.g. `https://app.swaggerhub.com/apis-docs/...`).

```yaml
openapi: 3.0.0
tags:
 - name: 'M01: Authentication'
 - name: 'M02: Authenticated User Area'
 - name: 'M03: Tasks'
 - name: 'M04: Forum'
 - name: 'M05: Static Pages'
 - name: 'M06: Project Area'
 - name: 'M07: Company Administrator Area'
...
```

---


## A8: Vertical prototype

> Brief presentation of the artefact goals.

### 1. Implemented Features

#### 1.1. Implemented User Stories

> Identify the user stories that were implemented in the prototype.  

| User Story reference | Name                   | Priority                   | Description                   |
| -------------------- | ---------------------- | -------------------------- | ----------------------------- |
| US101      | Login       | High     | As a Visitor, I want to authenticate myself into the system, so that I can access privileged information                |
| US102      | Sign-up     | High     | As a Visitor, I want to register myself into the system, so that I can authenticate myself into the system              |
| US103      | See home    | High     | As a Visitor, I want to access the home page, so that I can see a brief presentation of the website                     |
| US104      | See about   | High     | As a Visitor, I want to access the about page, so that I can see a complete description of the website and its creators |
| US105      | Consult FAQ | High     | As a Visitor, I want to access the FAQ, so that I can get quick answers to common questions                             |

...

#### 1.2. Implemented Web Resources

> Identify the web resources that were implemented in the prototype.  

> Module M01: Module Name  

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R301: Access User Profile | GET /userpage   |
| R302: Edit User Profile Form  | GET /edituserpage |
| R303: Edit User Profile Action | POST /userpage  |
| R304: Delete User's Profile Photo  | GET /deleteuser  |
| R305: Delete Account | GET /api/user/deleteUserPhoto  |
| R306: Accept/Decline Project Invitation | POST /api/user/projectInvite  |

Module M04: Project Area  

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R401: Create Project Form | GET /create-project   |
| R402: Create Project Action  | PUT /api/project/create |
| R403: Create New Task  | PUT /api/task/{task_id}    |
| R404: Get Task Info  | GET /api/task/{task_id}  |
| R405: Edit Task | POST /api/task/{task_id}    |
| R406: Delete Task | DELETE /api/task/{task_id}   |
| R407: Update Task's Status  | POST /api/task/updateStatus/{id}  |
| R408: Search Tasks | GET /project/{project_id}/search/  |
| R409: Get Project Info  | GET /project/{id}  |
| R410: List All User's Projects | GET /projects  |


### 2. Prototype

[Link to the website](http://lbaw2151.lbaw.fe.up.pt/)

#### 2.1. Credentials


---


## Revision history

Changes made to the first submission:
1. Item 1
1. ..

***
GROUP2151, 03/01/2022

| Name                    | Number    | E-Mail            |
| ----------------------- | --------- | ----------------- |
| Sofia Germer            | 201907461 | up201907461@up.pt |
| Miguel Lopes            | 201704590 | up201704590@up.pt |
| Edgar Torre             | 201906573 | up201906573@up.pt |
| Henrique Pinho (Editor) | 201805000 | up201805000@up.pt |