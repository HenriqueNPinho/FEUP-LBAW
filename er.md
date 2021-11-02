# ER: Requirements Specification Component

> Project vision.

## A1: Project Management

> Goals, business context and environment.  
> Motivation.  
> Main features.  
> User profiles.

This project aims to build an information system with a web interface for project management that allows teams of users to organize their professional projects. This application’s target audience are companies and teams working on complex projects, offering them a platform to organize every aspect of their work flow.

The motivation behind this project is creating an application that boosts productivity when developing a project. Helps users organize their work by providing them with a simple yet powerful interface for project management.

The application allows for each company’s users to work on multiple projects simultaneously. A project is defined by a list of tasks, the users working on that project and the timeline of completion. The application also includes a forum where users working on the same project can interact with each other.

In order to start using our application a company must first register an account. The company's system administrator can send email invitations to their workers, after which they are prompted to create an account to start using the platform or use an existing account (this accounts for the possibility that a user has used our platform before to work on a different company, but was using the same email address). From that point on, the user needs to use their credentials to access the platform. 

Different user types have different permissions. The existing types are: guests and authenticated users, which includes general, project members and administrators.

Guests are only able to authenticate themselves.

General authenticated users are able to create new and view current projects and are able to manage their projects by accepting/declining new invitations and by marking some as favorites.

Project members within a project are able to view, modify, add, delete, comment and implement tasks and assign them to other collaborators. They are also able to browse and post to the message forum and are able to search for tasks and other collaborators and managers. Whoever posts to the forum may edit and delete the post.

Project managers, besides having every permission a project member has, are able to moderate by adding or removing members from each project and promoting them to managers. They can also edit some project details and archive the project itself.


Every user within a project receives notifications when: a new member joins the project, a user is promoted/demoted, a task is assigned to him and when an assigned task is completed if the user is a project manager or if he’s assigned to that task. 

Administrator may browse for a project and read its details.

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
| US03             | Manage invite          | High                   | As a User, I want to accept/decline invites to a project, so I can decide which projects I want to work on|
| US04             | See home               | High                   | As a User, I want to access the home page, so that I can see a brief presentation of the website                     |
| US05             | See about              | High                   |  As a User, I want to access the about page, so that I can see a complete description of the website and its creators |
| US06             | Consult FAQ            | High                   | As a User, I want to access the FAQ, so that I can get quick answers to common questions                             |

#### 2.3. Authenticated User

| Identifier       | Name                   | Priority               | Description              |
| ---------------- | ---------------------- | ---------------------- |------------------------- |        
| US07             | Create project         |  High                 | As an Authenticated user, I want to create a project, so that I can work on a new project                         |
| US08             | View projects          | High                   | As an Authenticated user, I want to see my projects, so that I can switch between projects                         |
| US09             | Manage profile      |  High      | As an Authenticated user, I want to be able to manage my personal information (Name, Contact Info, Profile Picture,...), so that I can see if there are any errors |
| US10             | Manage project invitations | High              |  As an Authenticated user, I want to be able to accept or decline invitations to participate in new projects               |
| US11             | Mark project as favorite | Medium           |   As an Authenticated user, I want to be able to mark projects as favorites so I can access them faster    
#### 2.4. Project Member

| Identifier       | Name                   | Priority               | Description              |
| ---------------- | ---------------------- | ---------------------- |------------------------- |        
| US12             | Create task            | High                   | As a Project Member, I want to create a task, so that  |
| US13             | Manage tasks           | High          |   As a Project Member, I want to manage tasks, (so that I can assign them to another Project member), choose the priority of each task and its due date |
| US14             | Complete an assigned task |  High     | As a Project Member, I want to be able to mark the tasks I am assigned to as complete |
| US15             | Search tasks           |  High                  | As a Project Member, I want to be able to search for tasks using a search bar |
| US16             | Leave project          |High |As a Project Member, I want to be able to leave the project|
| US17             | Assign Users to Tasks  | High |As a Project Member, I want to be able to assign a task to another project member|
| US18             | Post messages to project forum | Medium | As a Project Member, I want to be able to post new messages to the project forum |
| US19             | View task details      |Medium |As a Project Member, I want to be able to view task details|
| US20             | Comment on task        |Medium |As a Project Member, I want to be able to comment on tasks. |
| US21             | Browse project forum   | Medium  | As a Project Member, I want to access the project forum, so that I can read mine and other users’ messages |
| US22             | View the project’s team|Low(?)|As a Project Member, I want to be able to view the project’s team|
| US23             | View Team members profile|low (?)|As a Project Member, I want to be able to view the profile of project members|

#### 2.5. Post Author

| Identifier       | Name                   | Priority               | Description              |
| ---------------- | ---------------------- | ---------------------- |------------------------- |        
| US24             |Edit posts|High|As the Post Author, I want to be able to edit my own posts|
| US25             |Delete posts|High|As the Post Author, I want to be able to delete my own posts|

#### 2.6. Project Coordinator

| Identifier       | Name                   | Priority               | Description              |
| ---------------- | ---------------------- | ---------------------- |------------------------- |        
| US26           |Add user to project|High|As the Project Coordinator, I want to be able to add an user to the project|
| US27           |Assign tasks to members|High|As the Project Coordinator, I want to be able to assign a task to a member|
| US28           |Assign new coordinator|High|As the Project Coordinator, I want to be able to choose another coordinator| 
| US29           |Edit project details|High|As the Project Coordinator, I want to be able to edit project details, so that| 
| US30           |Manage members permissions||| 
| US31           |Invite to Project by email|High|As the Project Coordinator, I want to be able to Invite a new member by email, so that |
| US32           |Archive project|Medium|As the Project Coordinator, I want to be able to archive a project, so that| 


 #### 2.7. Notifications

| Identifier       | Name                   | Priority               | Description              |
| ---------------- | ---------------------- | ---------------------- |------------------------- |        
| US33            | Change in Project Coordinator         | High                   | As a notification, I want to notify every project member that the Project Coordinator has changed, so that |
| US34             | Completed Task        | Medium               | As a notification, I want to notify every project member that a task is completed, so that everyone can start working on a new one|
| US36             | Assigned to Task            | Medium                 |  As a notification, I want to notify a project member that a new task has been assigned to them, so they can start working on it |
| US36             | Accepted Invitation    | Medium                  | As a notification, I want to notify every project member when someone accepts an invitation,so they know that a new member joined the project                             |


#### 2.8. Administrator

| Identifier       | Name                   | Priority               | Description              |
| ---------------- | ---------------------- | ---------------------- |------------------------- |        
|US37             |Invite user to the company’s workspace|High|As the Administrator I want to be able to control who gets to access the company’s |
|US38              |View a list of company users|High|As the Administrator I want to be able to be able to view a list of all users with access to the company’s project management platform|
|US39              |Remove user from the company’s workplace|High|As the Administrator I want to be able to revoke an user’s access to the company’s project management platform|
|US40              |Browse projects|High|As the Administrator I want to be able to browse projects and all its details with view only permissions|


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
| TR01             | Availability|The system must be available 99 percent of the time in each 24-hour period| 
| TR02             | Accessibility|The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the web browser they use|        
| TR03             | Usability|The system should be simple and easy to use. The MediaLibrary system is designed to be used by media consumers from all ages, with or without technical experience, so a very good usability is a critical requirement.|
| TR04             | Performance|The system should have response times shorter than 2 s to ensure the user's attention|
| TR05             | Web application|The system should be implemented as a web application with dynamic pages (HTML5, JavaScript, CSS3 and PHP).It is critical that the MediaLibrary system is easily accessible from anywhere without the need to install specific applications or software, adopting standard web technologies.|
| TR06             | Portability|The server-side system should work across multiple platforms (Linux, Mac OS, etc.).The MediaLibrary system is destined for personal use. To make it easily available to a large user base, it should be platform-independent.|
| TR07             | Database|The PostgreSQL database management system must be used, with a version of 11 or higher.|
| TR08             | Security|The system shall protect information from unauthorised access through the use of an authentication and verification system|
| TR09             | Robustness|The system must be prepared to handle and continue operating when runtime errors occur|
| TR10             | Scalability|The system must be prepared to deal with the growth in the number of users and their actions|
| TR11             | Ethics|The system must respect the ethical principles in software development (for example, personal user details, or usage data, should not be collected nor shared without full acknowledgement and authorization from its owner)|


#### 3.3. Restrictions

| Identifier       | Name                   | Priority               | 
| ---------------- | ---------------------- | ---------------------- |        
| C01              |   Deadline             | The platform must be developed and ready to use by the end of the semester | 

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
