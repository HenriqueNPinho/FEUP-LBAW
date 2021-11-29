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
DROP TABLE IF EXISTS post_edition CASCADE;

DROP TYPE IF EXISTS task_status;

DROP FUNCTION IF EXISTS add_favorite;
DROP FUNCTION IF EXISTS remove_favorites;
DROP FUNCTION IF EXISTS add_edit;

CREATE TYPE task_status AS ENUM('Not Started','In Progress', 'Complete');

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    email TEXT NOT NULL UNIQUE,
    name TEXT NOT NULL,
    password TEXT NOT NULL,
    profile_image TEXT NOT NULL,
    profile_description TEXT
);

CREATE TABLE company(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL
);

CREATE TABLE administrator(
    email TEXT PRIMARY KEY,
    name TEXT NOT NULL,
    company_id INTEGER NOT NULL REFERENCES company(id)
);

CREATE TABLE work(
    users_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    company_id INTEGER NOT NULL REFERENCES company(id) ON DELETE CASCADE,
    PRIMARY KEY(users_id,company_id)
);

CREATE TABLE project (
    id SERIAL PRIMARY KEY,
    company_id INTEGER NOT NULL REFERENCES company(id) ON DELETE CASCADE,
    name TEXT NOT NULL,
    description TEXT,
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
    id SERIAL PRIMARY KEY,
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
    id SERIAL PRIMARY KEY,
    project_id INTEGER NOT NULL REFERENCES project(id),
    project_member_id INTEGER NOT NULL REFERENCES users(id),
    content TEXT,
    post_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    deleted BOOLEAN DEFAULT FALSE NOT NULL
);

CREATE TABLE invitation(
    project_id INTEGER NOT NULL REFERENCES project(id),
    users_id INTEGER NOT NULL REFERENCES users(id),
    coordinator_id INTEGER NOT NULL REFERENCES users(id),
    accepted BOOLEAN,
    PRIMARY KEY(project_id,users_id,coordinator_id)
);

CREATE TABLE favorite(
    project_id INTEGER NOT NULL REFERENCES project(id),
    users_id INTEGER NOT NULL REFERENCES users(id),
    PRIMARY KEY(project_id,users_id)
);

CREATE TABLE post_edition(
    id SERIAL PRIMARY KEY,
    post_id INTEGER NOT NULL REFERENCES forum_post(id),
    edit_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    content TEXT
);

-- TRIGGER 1

CREATE FUNCTION add_favorite() RETURNS TRIGGER AS
$BODY$
	BEGIN
		IF ((SELECT COUNT(*) FROM favorite WHERE NEW.users_id = users_id)=5) THEN
		RAISE EXCEPTION 'A user cant have more than 5 favorite projects';
		END IF;
		RETURN NEW;
	END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_favorite
BEFORE INSERT OR UPDATE ON favorite
FOR EACH ROW
EXECUTE PROCEDURE add_favorite();

-- TRIGGER 2

CREATE FUNCTION remove_favorites() RETURNS TRIGGER AS
$BODY$
BEGIN
IF (NEW.archived=TRUE) THEN
DELETE FROM favorite WHERE NEW.id = project_id;
END IF;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER remove_favorites
BEFORE UPDATE ON project
FOR EACH ROW
EXECUTE PROCEDURE remove_favorites();

-- TRIGGER 3

CREATE FUNCTION add_edit() RETURNS TRIGGER AS
$BODY$
BEGIN
IF (NEW.content!=OLD.content) THEN
INSERT INTO post_edition VALUES(DEFAULT,OLD.id,DEFAULT,OLD.content);
END IF;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_edit
BEFORE UPDATE ON forum_post
FOR EACH ROW
EXECUTE PROCEDURE add_edit();