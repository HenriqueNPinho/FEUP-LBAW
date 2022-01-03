# EAP: Architecture Specification and Prototype

Delivery Date: 03/01/2022 
Editor: Sofia Germer (up201907461) - up201907461@up.pt

## A7: High-level architecture. Privileges. Web resources specification

The architecture of the web application to develop is documented indicating the catalogue of resources and the properties of each resource, including: references to the graphical interfaces, and the format of JSON responses. This page includes the following operations over data: create, read, update, and delete

### 1. Overview

| Module | Description|
|----|----|
|**M01: Static Pages** | Web resources associated with static content such as the About Us page and the Frequently Asked Questions (FAQ) page|
|**M02 : Authentication**| Web resources associated with user authentication. Includes the following system features: login/logout, registration, password recovery.|
|**M03: Authenticated User Area** | Web resources associated with the user's personal area and its management. This includes editing profile details (name, email, profile picture,...) and deleting the account.|
|**M04 : Project Area** | Web resources associated with the project components. This module offers an overview of the project that includes web resources from other modules, which will be later descibed (such as tasks, project collaborators, forum access and tasks search). In addition to this, it allows to add users to the project, to manage their hierarchy within the project and to create new projects.|
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

```yaml
openapi: 3.0.0

info:
  version: '1.0'
  title: 'LBAW Project Clinic'
  description: 'Web Resources Specification (A7) for Project Clinic'

servers:
- url: http://lbaw2151.lbaw.fe.up.pt
  description: Production server

tags:
  - name: 'M01: Static Pages'
  - name: 'M02: Authentication'
  - name: 'M03: Authenticated User Area'
  - name: 'M04: Project Area'
  - name: 'M05: Forum'
  - name: 'M06: Company Administrator Area'

paths:
#-------------------------------- M01 -----------------------------------------
  /about-us/:
    get:
      operationId: R101
      summary: 'R101: See About Us'
      description: 'Provide description about website and its creators. Access: PUB'
      tags:
      - 'M01: Static Pages'
      responses:
      '200':
        description: 'Ok. Show About Us page' 
 
  /faq/:
    get:
      operationId: R102
      summary: 'R102: See Frequently Asked Questions (FAQ)'
      description: 'Provide frequently asked questions about our app. Access: PUB'
      tags:
      - 'M01: Static Pages'
      responses:
      '200':
        description: 'Ok. Show FAQ page' 

  /:
    get:
      operationID: R103
      summary: 'R103: See the home page'
      description: 'See the home page when you access the app. Access: PUB'
      tags:
      - 'M01: Static Pages'
      responses:
      '200':
        description: 'Ok. Show homepage' 
#-------------------------------- M02 -----------------------------------------
  /login:
    get:
      operationId: R201
      summary: 'R201: Login Form'
      description: 'Provide login form. Access: PUB'
      tags:
        - 'M02: Authentication'
      responses:
        '200':
          description: 'Ok. Show log-in UI'
    post:
      operationId: R202
      summary: 'R202: Login Action'
      description: 'Processes the login form submission. Access: PUB'
      tags:
        - 'M02: Authentication'
 
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:          # <!--- form field name
                  type: string
                password:    # <!--- form field name
                  type: string
              required:
                - email
                - password
 
      responses:
        '302':
          description: 'Redirect after processing the login credentials.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful authentication. Redirect to projects page.'
                  value: '/projects'
                302Error:
                  description: 'Failed authentication. Redirect to login form.'
                  value: '/login'
                  
  /register:
    get:
      operationId: R203
      summary: 'R203: Register Form'
      description: 'Provide new user registration form. Access: PUB'
      tags:
        - 'M02: Authentication'
      responses:
        '200':
          description: 'Ok. Show sign-up UI'

    post:
      operationId: R204
      summary: 'R204: Register Action'
      description: 'Processes the new user registration form submission. Access: PUB'
      tags:
        - 'M02: Authentication'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                email:
                  type: string
              required:
                - name
                - email
                - password

      responses:
        '302':
          description: 'Redirect after processing the new user information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful authentication. Redirect to the projects page.'
                  value: '/projects'
                302Failure:
                  description: 'Failed authentication. Redirect to login form.'
                  value: '/login'
 
  /password/recovery:
    get:
      operationId: R205
      summary: 'R205: Password Recovery Form'
      description: 'Provide password recovery form. Access: PUB'
      tags:
        - 'M02: Authentication'
      responses:
        '200':  
          description: 'Ok. Show password recovery form'
    post:
      operationId: R206
      summary: 'R206: Recover Password Action'
      description: "Recover a user's password"
      tags:
        - 'M02: Authentication'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                inputEmail:
                  type: string
              required:
                - inputEmail

      responses:
        '303':
          description: 'Redirect after processing password recovery request'
          headers:
            Location:
              schema:
                type: string
              examples:
                303Success:
                  description: 'Ok. Redirect to login.'
                  value: '/login/'
                303Error:
                  description: 'Failed password recovery. Redirect to password recovery.'
                  value: '/login/'

 # ---------------------------- M03 -----------------------------------------------
  
  /logout:

    post:
      operationId: R301
      summary: 'R301: Logout Action'
      description: 'Logout the current authenticated used. Access: USR, ADM'
      tags:
        - 'M03: Authenticated User Area'
      responses:
        '302':
          description: 'Redirect after processing logout.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful logout. Redirect to login form.'
                  value: '/login'
  

  /userpage:
    get:
      operationId: R302
      summary: 'R302: View user profile'
      description: 'Show the individual user profile. Access: OWN'
      tags:
        - 'M03: Authenticated User Area'

      responses:
        '200':
          description: 'Ok. Show view profile UI'
          content:
            schema:
              type: object
              properties:
                name:
                  type: string
                email:
                  type: string
                description:
                  type: string
  
  /edituserpage:
    get:
      operationId: R303
      summary: 'R303: Edit user profile form'
      description: 'Show the individual user profile edit form. Access: OWN'
      tags:
        - 'M03: Authenticated User Area'

      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: 'Ok. Show edit profile UI'
          content:
            schema:
              type: object
              properties:
                name:
                  type: string
                email:
                  type: string
                description:
                  type: string
    post:
      operationID: R304
      summary: 'R304: Edit user profile action'
      description: 'Edit user profile. Access: OWN'
      tags:
        - 'M03: Authenticated User Area'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                inputName:
                  type: string
                inputEmail:
                  type: string
                inputDescription:
                  type: string
                inputProfilePicture:
                  type: file

      responses:
        '302':
          description: 'Redirect after processing the new user information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Information successfully processed. Redirect to user profile.'
                  value: '/userpage'
                302Failure:
                  description: 'Failed to process information. Redirect to edit user information form.'
                  value: '/edituserpage'
  /deleteuser:
    get:
      operationId: 305
      summary: "R305: Delete User"
      description: 'Delete User account. Access: OWN'
      tags:
        - 'M03: Authenticated User Area'

      responses:
        '200':
          description: 'Ok. Account Deleted'

  /changePassword:
    get:
      operationId: R306
      summary: "R306: Change user's password form"
      description: 'Show the password change form. Access: OWN'
      tags:
        - 'M03: Authenticated User Area'

      responses:
        '200':
          description: 'Ok. Show edit profile UI'
    post:
      operationID: R307
      summary: "R307: Change user's password"
      description: "Change user's password"
      tags:
        - 'M03: Authenticated User Area'
      requestBody:
        required: true

      responses:
        '302':
          description: 'Redirect after processing the new user information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Information successfully processed. Redirect to user profile.'
                  value: '/userpage'
                302Failure:
                  description: 'Failed to process information. Redirect to edit user information form.'
                  value: '/edituserpage'
                  
  
 #------------------------------- M04 -----------------------------------------------------------------

  /create-project:
    get:
      operationId: R401
      summary: 'R401: Create New Project Form'
      description: 'Create New Project. Access: USR'
      tags:
        - 'MO4: Project Area'
      responses:
      '200':
        description: 'Ok. Show edit profile UI'
        content:
          schema:
            type: array
            items:
              type: object
              properties:
                company:
                  type: string

  /api/project/create:
    post:
      operationId: R402
      summary: 'R402: Create New Project Action'
      description: 'Create New Project. Access: USR'
      tags:
        - 'M04: Project Area'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                inputName:
                  type: string
                inputCompanyID:
                  type: integer
                inputDescription:
                  type: string
                inputAssignedMembers:
                  type: string
      responses:
        '302':
            description: 'Redirect after processing the project information.'
            headers:
              Location:
                schema:
                  type: string
                examples:
                  302Success:
                    description: 'Success. Redirect to project area.'
                    value: '/project/{id}'
                  302Error:
                    description: 'Failed. Redirect to project creation form.'
                    value: '/create-project/'
          
  project/{id}:
    get:
        operationID: R403
        summary: "R403: See project page"
        description: "See the project page and all its information. Access: PM"
        tags:
          - 'M04: Project Area'
        parameters:
          - in: path
            name: id
            schema:
              type: integer
            required: true

        responses:
          '200':
            description: 'Ok. Show project page UI'
            content:
              schema:
                type: array
                items:
                  type: object
                  properties:
                    name:
                      type: string
                    members:
                      type: array
                      items:
                        type: object
                        properties:
                          $ref: '#/components/schemas/User'
                    

  /api/load-users:
    get:
      operationId: R404
      summary: 'R404: Load Users'
      description: 'Load Users. Access: PM'
      tags:
        - 'M04: Project Area'
      responses:
        '200':
          description: "Return users for pagination"
          content: 
            application/json:
              schema:
                type: object
                properties:
                  posts:
                    type: array
                    items:
                      $ref: '#/components/schemas/User'
        '400':
          description: "Error in parameters"
            
  /project/{project_id}/search:
    get:
      operationId: R405
      summary: 'R405: Search Tasks API'
      description: 'Searches for tasks and returns the results as JSON. Access: PM.'

      tags: 
        - 'M04: Project Area'

      parameters:
        - in: query
          name: query
          description: String to use for full-text search
          schema:
            type: string
          required: true

      responses:
        '200':
          description: Success
          content:
            application/json:
              schema:
                type: array
                items: 
                  $ref: '#/components/schemas/Task'
                   
  /api/task/{project_id}:
    put:
      operationId: R406
      summary: "R406: Create new task"
      description: "Create a new task. Access: PM"
      tags:
        - 'M04: Project Area'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                task-name:
                  type: string
                task-description:
                  type: string
                task-members:
                  type: array
                  items:
                    $ref: '#/components/schemas/User'
                due-date:
                  type: string
      responses:
        '201':
          description: 'Task created'

  api/task/{id}:
    get:
      operationID: R407
      summary: "R407: Get task info"
      description: "Get the task's information. Access: PM"
      tags:
        - 'M04: Project Area'
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: 'Ok. Show task page UI'
          content:
            application/json:
              schema:
                type: array
                items: 
                  $ref: '#/components/schemas/Task'
    delete:
      operationID: R408
      summary: "R408: Delete task"
      description: "Delete a task. Access: PM"
      tags:
        - 'M04: Project Area'
      parameters:
        - in: path
          name: id
          schema:
            type: integer
          required: true

      responses:
        '200':
    post:
      operationID: R409
      summary: "R409: Update task info"
      description: "Update the task's information. Access: PM"
      tags:
        - 'M04: Project Area'
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                task-name:
                  type: string
                task-description:
                  type: string
                task-members:
                  type: array
                  items:
                    $ref: '#/components/schemas/User'
                due-date:
                  type: string
      responses:
        '200':
          description: 'Task updated'


  
#------------------------------- M05 -----------------------------------------------------------------

  /project/{project_id}/forum:
    get:
      operationId: R501
      summary: "R501: Browse through forum's posts"
      description: "Browse through the forum's posts. Access: PM."
      parameters: 
        - in: path
          name: id
          schema:
            type: integer
          required: true
      tags: 
        - 'M05: Forum'
      responses:
        '200':
          description: 'Success show forum UI'
                  
    post:
      operationId: R502
      summary: "R502: Create new post"
      description: 'Show the form to create a new task. Access: PM'
      parameters: 
        - in: path
          name: id
          schema:
            type: integer
          required: true
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                project_id:
                  type: integer
                project_member_id:
                  type: integer
                content:
                  type: array
                post_date:
                  type: string
                deleted:
                  type: boolean
                  items:
                    $ref: '#/components/schemas/Forum'
      tags:
        - 'M05: Forum'

      responses:
        '200':
          description: 'Ok. Post created'

    put:
      operationId: R503
      summary: "R503: Edit an existing post"
      description: 'Show the form to create a new task. Access: PA'
      parameters: 
        - in: path
          name: id
          schema:
            type: integer
          required: true
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                project_id:
                  type: integer
                project_member_id:
                  type: integer
                content:
                  type: array
                post_date:
                  type: string
                deleted:
                  type: boolean
                  items:
                    $ref: '#/components/schemas/Forum'
      tags:
        - 'M05: Forum'

      responses:
        '200':
          description: 'Ok. Post edited'

    delete:
      operationId: R504
      summary: "R504: Delete post"
      description: 'Show the form to create a new task. Access: PA'
      tags:
        - 'M05: Forum'
      parameters: 
        - in: path
          name: id
          schema:
            type: integer
          required: true
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                project_id:
                  type: integer
                project_member_id:
                  type: integer
                deleted:
                  type: boolean
                  items:
                    $ref: '#/components/schemas/Forum'
      responses:
        '200':
          description: 'Ok. Post Deleted'

#------------------------------- M06 -----------------------------------------------------------------
  /invite-user-company:
    post:
      operationID: R601
      summary: "R601: Invite a user to the company's workspace"
      description: "Invite a user to the company's workspace. Access: ADM"
      tags:
        - 'M06: Company Administrator Area'

      
# -------------------- Components --------------------
  
components:
  schemas:
    Task:
      type: object
      properties:
        description:
          type: string
        start_date:
          type: string
        delivery_Date:
          type: string
        status:
          type: string
        project_member:
          type: array
        
          items:
            $ref: '#/components/schemas/User'
        photo:
          type: string

    User:
        type: object
        properties:
          name:
            type: string
          email: 
            type: String
          profile_description:
            type: string
          profile_image:
            type: string

   
```


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
| Sofia Germer  (Editor)  | 201907461 | up201907461@up.pt |
| Miguel Lopes            | 201704590 | up201704590@up.pt |
| Edgar Torre             | 201906573 | up201906573@up.pt |
| Henrique Pinho          | 201805000 | up201805000@up.pt |