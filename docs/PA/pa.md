# PA: Product and Presentation

> Project vision.

## A9: Product

We developed a web application for project management which includes, task management and assignment, easier communication between project members using the project's forum, a notification system, etc. Users can use our app on both an professional environment or a personal one.

### 1. Installation

The final release version can be found [here](http://lbaw2151.lbaw.fe.up.pt).

The full Docker command to start the image available at the group's GitLab Container Registry using the production database:

```
sudo docker run -it -p 8000:80 --name=lbaw2151 -e DB_DATABASE="lbaw2151" -e DB_SCHEMA="lbaw2151" -e DB_USERNAME="lbaw2151" -e DB_PASSWORD="wQTXZRMG" git.fe.up.pt:5050/lbaw/lbaw2122/lbaw2151
```

### 2. Usage

http://lbaw2151.lbaw.fe.up.pt  

#### 2.1. Administration Credentials

To access the admin page just login using this credentials: 

| Username | Password |
| -------- | -------- |
| sofia@example.com    | 1234 |

#### 2.2. User Credentials

| Type          | Username  | Password |
| ------------- | --------- | -------- |
| User/Project Coordinator | admin@example.com   | 1234 |
| User/Project Coordinator   | maria@example.com    | 1234 |

### 3. Application Help

> Describe where help has been implemented, pointing to working examples.  

### 4. Input Validation

> Describe how input data was validated, and provide examples to scenarios using both client-side and server-side validation.  

### 5. Check Accessibility and Usability

Results of accessibility and usability tests using the following checklists:

- Accessibility: [Accessibility Report - SAPO UX](./Checklist%20de%20Acessibilidade%20-%20SAPO%20UX.pdf)
- Usability: [Usability Report - SAPO UX](./Checklist%20de%20Usabilidade%20-%20SAPO%20UX.pdf)

### 6. HTML & CSS Validation

The results of the validation of the HTML and CSS code:

- HTML: https://validator.w3.org/nu/  
- CSS: [W3C CSS Validator Report](./W3C%20CSS%20Validator%20results.pdf)

### 7. Revisions to the Project

No structural changes were made to the project. That being said, some changes were made in the database to accommodate Laravel's functional requirements, such as:

- Creating a table for password resetting using Laravel's built-in functions
- Adding a row to the User's table to allow for email verification
- Adding deleted_at rows to tables where we use Laravel's Soft Delete function
- After discussing with the teacher we decided to remove Administration table from the database. Administrators are now identified by a flag in the Users table 

### 8. Implementation Details

#### 8.1. Libraries Used

The only library we used was FontAwesome, to use icons in our project. Documentation can be found [here](https://fontawesome.com/v5.15/how-to-use/on-the-web/referencing-icons/basic-use).

#### 8.2 User Stories

> This subsection should include all high and medium priority user stories, sorted by order of implementation. Implementation should be sequential according to the order identified below. 
>
> If there are new user stories, also include them in this table. 
> The owner of the user story should have the name in **bold**.
> This table should be updated when a user story is completed and another one started. 

| US Identifier | Name    | Module | Priority                       | Team Members               | State  |
| ------------- | ------- | ------ | ------------------------------ | -------------------------- | ------ |
| US101      | Login      | M01 | High     | Sofia Germer | 100% |
| US102      | Sign-up     | M02 | High     | Sofia Germer | 100% |
| US103      | See home    | M01 | High     | Miguel Lopes | 100% |
| US104      | See about   | M01 | High     | Henrique Pinho, Sofia Germer | 100% |
| US105      | Consult FAQ | M01 | High     | Henrique Pinho | 100% |
| US201      | Create project       | M04   | High     | Henrique Pinho | 100% |
| US202      | View projects             | M04 | High     | Miguel Lopes | 100% |
| US203      | Manage profile          | M03   | High     | Sofia Germer | 100%|
| US204      | Manage project invitations | M03 | High     | Miguel Lopes | 100% |
| US205      | Logout                    | M03 | High     | Sofia Germer | 100% |
| US206      | Mark project as favorite  | M04 | Medium   | Miguel Lopes | 100% |
| US207      | Delete account            | M02 | Medium   | Miguel Lopes | 100% |
| US301      | Create task                | M04    | High     |  Miguel Lopes | 100%|
| US302      | Manage tasks                | M04  | High     |  Miguel Lopes | 100%|
| US303      | Complete an assigned task   | M04   | High     |  Miguel Lopes | 100%|
| US304      | Search tasks               | M04   | High     |  Miguel Lopes | 100%|
| US305      | Leave project               | M04   | High     | Miguel Lopes | 100% |
| US306      | Assign Users to Tasks       | M04  | High     | Miguel Lopes | 100% |
| US307      | Post messages to project forum | M05 | Medium   | Edgar Torres | 100% |
| US308      | View task details            | M04 | Medium   | Miguel Lopes | 100% |
| US309      | Comment on task              | M04  | Medium   | Miguel Lopes | 100% |
| US310      | Browse project forum         | M05 | Medium   | Edgar Torres | 100% |
| US311      | Receive notifications        | M04  | Medium   | Miguel Lopes | 100% |
| US312      | View the project’s team      | M04 | Low      |  Miguel Lopes | 100% |
| US313      | View Team members profile    | M04 | Low      | Sofia Germer | 100% |
| US401      | Edit posts  | M05 | High     | Miguel Lopes | 100% |
| US402      | Delete posts | M05 | High     | Miguel Lopes | 100% |
| US501      | Add user to project      | M04  | High     | Miguel Lopes | 100% |
| US502      | Assign tasks to members  | M04  | High     | Miguel Lopes | 100% |
| US503      | Assign new coordinator   | M04  | High     | Miguel Lopes | 100% |
| US504      | Edit project details      | M04 | Medium     |  | 0% |
| US505      | Invite to Project by email | M04 |Medium   | Miguel Lopes | 100% |
| US506      | Archive project            | M04 | Medium   | Miguel Lopes | 100% |
| US601      | Invite user to the company’s workspace | M06  | High | Sofia Germer, Miguel Lopes | 100% |
| US602      | View a list of company users          | M06 | High     | Sofia Germer, Miguel Lopes | 100% |
| US603      | Remove user from the company’s workplace| M06 | High     | Sofia Germer, Miguel Lopes | 100% |
| US604      | Browse projects                     | M06     | High     | Sofia Germer, Miguel Lopes | 100% | 
---


## A10: Presentation
 
> This artefact corresponds to the presentation of the product.

### 1. Product presentation

Brief presentation of the product and its main features (2 paragraphs max).  

URL to the product: http://lbaw2151.lbaw.fe.up.pt  

Slides used during the presentation should be added, as a PDF file, to the group's repository and linked to here.


### 2. Video presentation

> Screenshot of the video plus the link to the lbaw21gg.mp4 file  

> - Upload the lbaw21gg.mp4 file to the video uploads' [Google folder](https://drive.google.com/drive/folders/1-fPoSR3lXyPI38UgpWf6iQBe2Lk_ckoT?usp=sharing "Videos folder"). You need to use a Google U.Porto account to upload the video.   
> - The video must not exceed 2 minutes.
> - Include a link to the video on the Google Drive folder.


---


## Revision history

***

GROUP2151, 21/01/2022

| Name                  | Number    | E-Mail            |
| --------------------- | --------- | ----------------- |
| Sofia Germer          | 201907461 | up201907461@up.pt |
| Miguel Lopes (Editor) | 201704590 | up201704590@up.pt |
| Edgar Torre           | 201906573 | up201906573@up.pt |
| Henrique Pinho        | 201805000 | up201805000@up.pt |
