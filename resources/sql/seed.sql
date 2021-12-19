create schema if not exists lbaw21;



DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS cards CASCADE;
DROP TABLE IF EXISTS items CASCADE;
DROP TABLE IF EXISTS company CASCADE;
DROP TABLE IF EXISTS administrator CASCADE;
DROP TABLE IF EXISTS work CASCADE;
DROP TABLE IF EXISTS projects CASCADE;
DROP TABLE IF EXISTS project_coordinator CASCADE;
DROP TABLE IF EXISTS project_member CASCADE;
DROP TABLE IF EXISTS task CASCADE;
DROP TABLE IF EXISTS task_assigned CASCADE;
DROP TABLE IF EXISTS forum_post CASCADE;
DROP TABLE IF EXISTS invitation CASCADE;
DROP TABLE IF EXISTS favorite CASCADE;
DROP TABLE IF EXISTS post_edition CASCADE;

DROP TYPE IF EXISTS task_status CASCADE;

DROP FUNCTION IF EXISTS add_favorite CASCADE;
DROP FUNCTION IF EXISTS remove_favorites CASCADE;
DROP FUNCTION IF EXISTS add_edit CASCADE;
DROP FUNCTION IF EXISTS task_search_update CASCADE;

CREATE TYPE task_status AS ENUM('Not Started','In Progress', 'Complete');


CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    remember_token VARCHAR,
    profile_image TEXT,
    profile_description TEXT
);


CREATE TABLE cards (
  id SERIAL PRIMARY KEY,
  name VARCHAR NOT NULL,
  user_id INTEGER REFERENCES users NOT NULL
);

CREATE TABLE items (
  id SERIAL PRIMARY KEY,
  card_id INTEGER NOT NULL REFERENCES cards ON DELETE CASCADE,
  description VARCHAR NOT NULL,
  done BOOLEAN NOT NULL DEFAULT FALSE
);


CREATE TABLE company(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL
);

CREATE TABLE administrator(
    id SERIAL PRIMARY KEY,
    email TEXT NOT NULL,
    name TEXT NOT NULL,
    company_id INTEGER NOT NULL REFERENCES company(id)
);

CREATE TABLE work(
    users_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    company_id INTEGER NOT NULL REFERENCES company(id) ON DELETE CASCADE,
    PRIMARY KEY(users_id,company_id)
);

CREATE TABLE projects (
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
    project_id INTEGER NOT NULL REFERENCES projects(id) ON DELETE CASCADE,
    PRIMARY KEY(users_id,project_id)
);



CREATE TABLE project_member(
    users_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    project_id INTEGER NOT NULL REFERENCES projects(id) ON DELETE CASCADE,
    seenNewForumPost BOOLEAN DEFAULT TRUE NOT NULL,
    PRIMARY KEY(users_id,project_id)
);

CREATE TABLE task (
    id SERIAL PRIMARY KEY,
    project_id INTEGER NOT NULL REFERENCES projects(id) ON DELETE CASCADE,
    name TEXT NOT NULL,
    description TEXT,
    start_date TIMESTAMP WITH TIME ZONE,
    delivery_date TIMESTAMP WITH TIME ZONE,
    status task_status DEFAULT 'Not Started',
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
    project_id INTEGER NOT NULL REFERENCES projects(id),
    project_member_id INTEGER NOT NULL REFERENCES users(id),
    content TEXT,
    post_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    deleted BOOLEAN DEFAULT FALSE NOT NULL
);

CREATE TABLE invitation(
    project_id INTEGER NOT NULL REFERENCES projects(id),
    users_id INTEGER NOT NULL REFERENCES users(id),
    coordinator_id INTEGER NOT NULL REFERENCES users(id),
    accepted BOOLEAN,
    PRIMARY KEY(project_id,users_id,coordinator_id)
);

CREATE TABLE favorite(
    project_id INTEGER NOT NULL REFERENCES projects(id),
    users_id INTEGER NOT NULL REFERENCES users(id),
    PRIMARY KEY(project_id,users_id)
);

CREATE TABLE post_edition(
    id SERIAL PRIMARY KEY,
    post_id INTEGER NOT NULL REFERENCES forum_post(id),
    edit_date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    content TEXT
);

-- INDEX 1

CREATE INDEX project_member_user_index  ON project_member USING btree (users_id); CLUSTER project_member USING project_member_user_index;

-- INDEX 2

CREATE INDEX project_member_project_index  ON project_member  USING hash(project_id);

-- INDEX 3

CREATE INDEX task_assigned_member_index  ON task_assigned USING btree  (project_member_id);

-- INDEX 4

ALTER TABLE task
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION task_search_update() RETURNS TRIGGER AS $$
BEGIN
 IF TG_OP = 'INSERT' THEN
        NEW.tsvectors = (
         setweight(to_tsvector('english', NEW.name), 'A') ||
         setweight(to_tsvector('english', NEW.description), 'B')
        );
 END IF;
 IF TG_OP = 'UPDATE' THEN
         IF (NEW.name <> OLD.name OR NEW.description <> OLD.description) THEN
           NEW.tsvectors = (
             setweight(to_tsvector('english', NEW.name), 'A') ||
             setweight(to_tsvector('english', NEW.description), 'B')
           );
         END IF;
 END IF;
 RETURN NEW;
END $$
LANGUAGE plpgsql;

CREATE TRIGGER task_search_update
BEFORE INSERT OR UPDATE ON task
FOR EACH ROW
EXECUTE PROCEDURE task_search_update();

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



INSERT INTO users VALUES (
  DEFAULT,
  'John Doe',
  'admin@example.com',
  '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W'
); -- Password is 1234. Generated using Hash::make('1234')


INSERT INTO company VALUES(DEFAULT,'FEUP');
INSERT INTO projects VALUES(DEFAULT,1,'LBAW','Um trabalho que me faz querer cortar os pulsos','2021-08-24 14:00:00 +02:00', '2022-08-24 14:00:00 +02:00', DEFAULT);
INSERT INTO project_member VALUES(1,1);

-- INSERT INTO cards VALUES (DEFAULT, 'Things to do', 1);
-- INSERT INTO items VALUES (DEFAULT, 1, 'Buy milk');
-- INSERT INTO items VALUES (DEFAULT, 1, 'Walk the dog', true);

-- INSERT INTO cards VALUES (DEFAULT, 'Things not to do', 1);
-- INSERT INTO items VALUES (DEFAULT, 2, 'Break a leg');
-- INSERT INTO items VALUES (DEFAULT, 2, 'Crash the car');