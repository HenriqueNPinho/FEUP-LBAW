CREATE TYPE task_status AS ENUM('Not Started','In Progress', 'Complete');

DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS company CASCADE;
DROP TABLE IF EXISTS administrator CASCADE;
DROP TABLE IF EXISTS work CASCADE;
DROP TABLE IF EXISTS project CASCADE;
DROP TABLE IF EXISTS project_coordinator CASCADE;
DROP TABLE IF EXISTS project_member CASCADE;
DROP TABLE IF EXISTS task CASCADE;
DROP TABLE IF EXISTS task_assigned CASCADE;
DROP TABLE IF EXISTS forum_post CASCADE;
DROP TABLE IF EXISTS invitation CASCADE;
DROP TABLE IF EXISTS favorite CASCADE;

CREATE TABLE users (
    id INTEGER PRIMARY KEY,
    email TEXT NOT NULL UNIQUE,
    name TEXT NOT NULL,
    password TEXT NOT NULL,
    profile_image TEXT NOT NULL,
    profile_description TEXT
);

CREATE TABLE company(
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL
);

CREATE TABLE administrator(
    email TEXT PRIMARY KEY,
    name TEXT NOT NULL
);

CREATE TABLE work(
    users_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    company_id INTEGER NOT NULL REFERENCES company(id) ON DELETE CASCADE,
    PRIMARY KEY(users_id,company_id)
);

CREATE TABLE project (
    id INTEGER PRIMARY KEY,
    company_id INTEGER NOT NULL REFERENCES company(id) ON DELETE CASCADE,
    name TEXT NOT NULL,
    decription TEXT,
    start_date TIMESTAMP WITH TIME ZONE,
    delivery_date TIMESTAMP WITH TIME ZONE,
    archived BOOLEAN DEFAULT FALSE NOT NULL,
    CONSTRAINT date_ck CHECK (delivery_date>start_date)
);

CREATE TABLE project_coordinator(
    users_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    project_id INTEGER NOT NULL REFERENCES project(id) ON DELETE CASCADE,
    PRIMARY KEY(users_id,project_id)
);

CREATE TABLE project_member(
    users_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    project_id INTEGER NOT NULL REFERENCES project(id) ON DELETE CASCADE,
    seenNewForumPost BOOLEAN DEFAULT TRUE NOT NULL,
    PRIMARY KEY(users_id,project_id)
);

CREATE TABLE task (
    id INTEGER PRIMARY KEY,
    project_id INTEGER NOT NULL REFERENCES project(id) ON DELETE CASCADE,
    name TEXT NOT NULL,
    decription TEXT,
    start_date TIMESTAMP WITH TIME ZONE,
    delivery_date TIMESTAMP WITH TIME ZONE,
    TYPE task_status DEFAULT 'Not Started',
    CONSTRAINT date_ck CHECK (delivery_date>start_date)
);

CREATE TABLE task_assigned(
    project_coordinator_id INTEGER NOT NULL REFERENCES users(id),
    project_member_id INTEGER NOT NULL REFERENCES users(id),
    task_id INTEGER NOT NULL REFERENCES task(id),
    notified BOOLEAN DEFAULT FALSE NOT NULL,
    PRIMARY KEY(project_coordinator_id,project_member_id,task_id)
);

CREATE TABLE forum_post(
    id INTEGER PRIMARY KEY,
    project_id INTEGER NOT NULL REFERENCES project(id),
    project_member_id INTEGER NOT NULL REFERENCES users(id),
    content TEXT,
    post_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL
);

CREATE TABLE invitation(
    project_id INTEGER NOT NULL REFERENCES project(id),
    users_id INTEGER NOT NULL REFERENCES users(id),
    task_id INTEGER NOT NULL REFERENCES task(id),
    accepted BOOLEAN,
    PRIMARY KEY(project_id,users_id,task_id)
);

CREATE TABLE favorite(
    project_id INTEGER NOT NULL REFERENCES project(id),
    users_id INTEGER NOT NULL REFERENCES users(id),
);