# EAP: Architecture Specification and Prototype

> Project vision.

## A7: High-level architecture. Privileges. Web resources specification

The architecture of the web application to develop is documented indicating the catalogue of resources and the properties of each resource, including: references to the graphical interfaces, and the format of JSON responses. This page includes the following operations over data: create, read, update, and delete

### 1. Overview

| Module | Description|
|----|----|
|**M01: Static Pages** | Web resources associated with static content such as the About Us page and the Frequently Asked Questions (FAQ) page|
|**M02 : Authentication**| Web resources associated with user authentication. Includes the following system features: login/logout, registration, password recovery.|
|**M03: Authenticated User Area** | Web resources associated with the user's personal area and its management. This includes editing profile details (name, email, profile picture,...) and deleting the account.|
|**M04 : Project Area** | Web resources associated with the project components. This module offers an overview of the project that includes web resources from other modules, which will be later descibed (such as tasks, project collaborators, forum access and tasks search). In addition to this, it allows to add users to the project, to manage their hierarchy within the project and to create new projecs.|
|**M05 : Forum** | Web resources associated with the project's forum. This module includes viewing and posting and editing messages|
|**M06: Company Administrator Area**| Web resources associated with the company's administrator features. This includes user management within the company (inviting and removing users from the company's workspace) and browsing through the company's projects.|

### 2. Permissions

| Identifier | Name                | Descripton              |
| ---------- | ------------------- | ------------------------|
| **PUB**    | Public              | Users without privileges|
| **OWN**    | Owner               | The owner of the content|
| **USR**    | User                | Authenticated users     |
| **PM**     | Project Member      | Member of a project     |
| **PC**     | Project Coordinator | Coordinator of a project|
| **ADM**    | Administrator       | System administrators   |

### 3. OpenAPI Specification

[Link to .yaml file](a7_openapi.yaml)

Link to the Swagger generated documentation (e.g. `https://app.swaggerhub.com/apis-docs/...`).

```yaml
openapi: 3.0.0

...
```

---


## A8: Vertical prototype

### 1. Implemented Features

#### 1.1. Implemented User Stories

| Identifier | Name        | Priority | Description                                                                                                             |
| ---------- | ----------- | -------- | ----------------------------------------------------------------------------------------------------------------------- |
| US101      | Login       | High     | As a Visitor, I want to authenticate myself into the system, so that I can access privileged information                |
| US102      | Sign-up     | High     | As a Visitor, I want to register myself into the system, so that I can authenticate myself into the system              |
| US103      | See home    | High     | As a Visitor, I want to access the home page, so that I can see a brief presentation of the website                     |
| US201      | Create project             | High     | As an Authenticated user, I want to create a project, so that I can work on a new project                                                                      |
| US202      | View projects              | High     | As an Authenticated user, I want to see my projects, so that I can switch between projects                                                                     |
| US203      | Manage profile             | High     | As an Authenticated user, I want to be able to manage my personal information (Name, Contact Info, Profile Picture,...), so that I can update them at any time |
| US204      | Manage project invitations | High     | As an Authenticated user, I want to be able to accept or decline invitations, so that I can participate in new projects                                        |
| US205      | Logout                     | High     | As an Authenticated user, I want to be able to logout of my account                                                                                            |
| US207      | Delete account             | Medium   | As an Authenticated user, I want to be able to delete my account, so that I can erase my personal information from the system                                  |
| US301      | Create task                    | High     | As a Project Member, I want to create a task                                                                                                  |
| US302      | Manage tasks                   | High     | As a Project Member, I want to manage tasks (assign them to another Project member, choose the priority of each task and its due date)        |
| US303      | Complete an assigned task      | High     | As a Project Member, I want to be able to mark the tasks I am assigned to as complete                                                         |
| US304      | Search tasks                   | High     | As a Project Member, I want to be able to search for tasks using a search bar, so that I can access them faster                               |
| US306      | Assign Users to Tasks          | High     | As a Project Member, I want to be able to assign a task to another project member, so that every collaborator knows what they need to work on |
| US308      | View task details              | Medium   | As a Project Member, I want to be able to view task details                                                                                   |
| US312      | View the project’s team        | Low      | As a Project Member, I want to be able to view the project’s team, so that I know every collaborator within the project                       |

#### 1.2. Implemented Web Resources



Module M01: Static Pages  

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R101: Get Homepage | GET / |

Module M02: Authentication  

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R201: Login Form | GET /login   |
| R202: Login Action  | POST /login |
| R203: Logout Action | GET /logout  |
| R204: Register Form  | GET /register  |
| R205: Register Action | POST /register  |

Module M03: Authenticated User Area

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

| Email | Password | Position |
|-------|----------|----------|
|joao@lbaw.com|123456|Project Coordinator|
|maria@example.com|123456|Project Member|



## Revision history

No changes have yet been made to this document.

***
GROUP2151, 03/01/2022

| Name                    | Number    | E-Mail            |
| ----------------------- | --------- | ----------------- |
| Sofia Germer            | 201907461 | up201907461@up.pt |
| Miguel Lopes            | 201704590 | up201704590@up.pt |
| Edgar Torre             | 201906573 | up201906573@up.pt |
| Henrique Pinho (Editor) | 201805000 | up201805000@up.pt |