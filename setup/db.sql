DROP TABLE IF EXISTS posts;
CREATE TABLE  `posts` (       
  `id` CHAR(36) PRIMARY KEY,
  `title` VARCHAR(100),
  `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `author_id` CHAR(36),
  `slug` VARCHAR(100),
  `content` TEXT
) ENGINE=InnoDB, COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS comments;
CREATE TABLE  `comments` (       
  `id` CHAR(36) PRIMARY KEY,
  `author_id` CHAR(36),
  `post_id` CHAR(36),
  `body` TEXT
) ENGINE=InnoDB, COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS authors;
CREATE TABLE  `authors` (       
  `id` CHAR(36) PRIMARY KEY,
  `first_name` VARCHAR(100),
  `last_name` VARCHAR(100),
  `email` VARCHAR(100),
  `website` VARCHAR(100),
  `number_of_posts` INT,
  `role` VARCHAR(100)
) ENGINE=InnoDB, COLLATE=utf8_general_ci;

/* Sample Data */
INSERT INTO authors (id, first_name, last_name, email, website, number_of_posts, role)
VALUES
('8f010c4c-4b75-11e1-9c18-14dae9cb5ac0', 'Jordan',  'Schatz', 'jordan@noionlabs.com', 'noionlabs.com', 2, 'contributor'),
('aa7e5a9c-4b75-11e1-8d53-14dae9cb5ac0', 'David', 'Sargeant', 'david@dsargeant.com',  'dsargeant.com', 0, 'owner'),
('d238b82a-4b75-11e1-87a3-14dae9cb5ac0', 'Bryan',  'Van Noy', 'bryan@sbwell.com',     'sbwell.com', 0, 'commenter');

INSERT INTO posts (id, title, author_id, slug, content) 
VALUES
('a762dbb6-4b76-11e1-b84a-14dae9cb5ac0', 'The first post',  '8f010c4c-4b75-11e1-9c18-14dae9cb5ac0', 'the-first-post',  'lorem ipsum dolar set amet, non lambda'),
('aca1916c-4b76-11e1-b830-14dae9cb5ac0', 'Post the second', '8f010c4c-4b75-11e1-9c18-14dae9cb5ac0', 'post-the-second', 'A more interesting post, but only slightly so');

INSERT INTO comments (id, author_id, post_id, body) 
VALUES
(uuid(), 'd238b82a-4b75-11e1-87a3-14dae9cb5ac0', 'a762dbb6-4b76-11e1-b84a-14dae9cb5ac0', 'That is a really nice first post!'),
(uuid(), 'aa7e5a9c-4b75-11e1-8d53-14dae9cb5ac0', 'a762dbb6-4b76-11e1-b84a-14dae9cb5ac0', 'Humm.... it could be longer thou'),
(uuid(), 'd238b82a-4b75-11e1-87a3-14dae9cb5ac0', 'aca1916c-4b76-11e1-b830-14dae9cb5ac0', 'This one definetly more then 3 words');
