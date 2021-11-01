# ER: Requirements Specification Component

> Project vision.

## A1: Project Management

> Goals, business context and environment.  
> Motivation.  
> Main features.  
> User profiles.


---


## A2: Actors and User stories

![Project Managment Actors](PM_diagram.png)
> Brief presentation of the artefact goals.


### 1. Actors

> Diagram identifying actors and their relationships.  
> Table identifying actors, including a brief description.

| Identifier       | Description            | 
| ---------------- | ---------------------- | 
| Visitor          |  Unauthenticated user that can sign-in in the system or register (sign-up) with email invitation                      | 
| User             |  Generic user that has access to public information| 
| Authenticated User | Generic user that has access to public information, can create projects and accept/decline invites |
| Project Member  | Authenticated user that can manage tasks, post messages on the forum and have access to project information                       | 
| Post Author	  |Authenticated user that can edit/delete their own post |
| Project Coordinator  | Authenticated user that can edit project details and is responsible for the management of users | 
| Administrator    | Authenticated user that can browse and view project details |
| Notifications    | Notifications alert project members about events related to the project  |


### 2. User Stories

> User stories organized by actor.  
> For each actor, a table containing a line for each user story, and for each user story: an identifier, a name, a priority, and a description (following the recommended pattern).

#### 2.1. Visitor

| Identifier       | Name                   | Priority               | Description              |
| ---------------- | ---------------------- | ---------------------- |------------------------- |        
| US01             | Sign-in                |  High                  | As a Visitor, I want to authenticate into the system, so that I can access privileged information                       |
| US02             | Sign-up                |  High                  |  As a Visitor, I want to register myself into the system, so that I can authenticate myself into the system              |

#### 2.2. User

| Identifier       | Name                   | Priority               | Description              |
| ---------------- | ---------------------- | ---------------------- |------------------------- |        
| US03             | Manage invite          | High                   | As a User, I want to accept/decline invites to a project.|
| US04             | See home               | High                   | As a User, I want to access the home page, so that I can see a brief presentation of the website                     |
| US05             | See about              | High                   |  As a User, I want to access the about page, so that I can see a complete description of the website and its creators |
| US06             | Consult FAQ            | High                   | As a User, I want to access the FAQ, so that I can get quick answers to common questions                             |

#### 2.3. Authenticated User

| Identifier       | Name                   | Priority               | Description              |
| ---------------- | ---------------------- | ---------------------- |------------------------- |        
| US07             | Create project         |  Hight                 | As an Authenticated user, I want to create a project, so that I can work on a new project                         |
| US08             | View projects          | High                   | As an Authenticated user, I want to see my projects, so that I can switch between projects                         |
| US09             | Mark project as favorite | Medium           |   As an Authenticated user, I want to be able to mark projects as favorites so I can access them faster                       |
| US10             | Manage project invitations | High              |  As an Authenticated user, I want to be able to accept or decline invitations to participate in new projects               |
| US11             | Manage profile      |  High      |  High
As an Authenticated user, I want to be able to manage my personal information (Name, Contact Info, Profile Picture,...) |

#### 2.4. Project Member

| Identifier       | Name                   | Priority               | Description              |
| ---------------- | ---------------------- | ---------------------- |------------------------- |        
| US12             | Create task            | High                   | As a Project Member, I want to create a task |
| US13             | Manage tasks           | High          |   As a Project Member, I want to manage tasks, (so that I can assign them to another Project member), choose the priority of each task and its due date |
| US14             | Complete an assigned task |  High     | As a Project Member, I want to be able to mark the tasks I am assigned to as complete |
| US15             | Search tasks           |  High                  | As a Project Member, I want to be able to search for tasks using a search bar |
| US16             | Browse project forum   | Medium  | As a Project Member, I want to access the project forum, so that I can read mine and other users’ messages |
| US17             | Post messages to project forum | Medium | As a Project Member, I want to be able to post new messages to the project forum |
| US18             | Assign Users to Tasks  | High |As a Project Member, I want to be able to assign a task to another project member|
| US19             | View task details      |Medium |As a Project Member, I want to be able to view task details|
| US20             | Comment on task        |Medium |As a Project Member, I want to be able to comment on tasks. |
| US21             | Leave project          |High |As a Project Member, I want to be able to leave the project|
| US22             | View the project’s team|Low(?)|As a Project Member, I want to be able to view the project’s team|
| US23             | View Team members profile|low (?)|As a Project Member, I want to be able to view the profile of project members|

#### 2.5. Administrator

| Identifier       | Name                   | Priority               | Description              |
| ---------------- | ---------------------- | ---------------------- |------------------------- |        
| US01             | Invite user to the company's workspace    |                        |                          | 
| US01             |                        |                        |                          |
| US01             |                        |                        |                          |
| US01             |                        |                        |                          |
| US01             |                        |                        |                          |


### 3. Supplementary Requirements

This section contains business rules, technical requirements and other non-functional requirements on the project.

#### 3.1. Business rules

| Identifier       | Name                   | Priority               | 
| ---------------- | ---------------------- | ---------------------- |        
| BR01             | Administrator privileges |  Administrator accounts are independent of the user accounts and cannot create or participate in projects | 
| BR02             | Project delivery date  | A project’s delivery date must always be posterior to its starting date |                          
| BR03             | Forum Post History |A record of all forum posts is kept for posterity (even those deleted by the Post Author)|                          


#### 3.2. Technical requirements

| Identifier       | Name                   | Priority               | 
| ---------------- | ---------------------- | ---------------------- |        
| TR01             |                        |                        | 
| TR01             |                        |                        |                          
| TR01             |                        |                        |                          
| TR01             |                        |                        |                          
| TR01             |                        |                        |

#### 3.3. Restrictions

| Identifier       | Name                   | Priority               | 
| ---------------- | ---------------------- | ---------------------- |        
| C01              |                        |                        | 
| C01              |                        |                        |                          
| C01              |                        |                        |                          
| C01              |                        |                        |                          
| C01              |                        |                        |
---


## A3: Information Architecture

> Brief presentation of the artefact goals.


### 1. Sitemap

> Sitemap presenting the overall structure of the web application.  
> Each page must be identified in the sitemap.  
> Multiple instances of the same page (e.g. student profile in SIGARRA) are presented as page stacks.


### 2. Wireframes

> Wireframes for, at least, two main pages of the web application.
> Do not include trivial use cases.


#### UIxx: Page Name

#### UIxx: Page Name


---


## Revision history

Changes made to the first submission:
1. Item 1
1. ...

***
GROUP2151, 26/10/2021

| Name             | Number    | E-Mail               |
| ---------------- | --------- | -------------------- |
| Sofia Germer     | 201907461 | up201907461@up.pt    |
| Miguel Lopes     | 20170459  | up201704590@up.pt    |
| Edgar Torre      | 201906573 | up201906573@up.pt    |
| Henrique Pinho   | 201805000 | up201805000@up.pt    |
