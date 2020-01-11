INSERT INTO users ( admin,owner, username, email, password, created, modified)
   VALUES 
(true,true,'michael piper','cakephp@example.com', '$2y$10$j/qT4xv7uPvO67AruX5fKugZ5iUA0i9qHG24d/Y8M7JJ/o7It9CwC', NOW(), NOW()); 
-- password is 'secret'  
INSERT INTO categories (title, description, created, modified)
    VALUES
('Book','book more',   now(), now());
INSERT INTO articles (user_id,category_id, title, slug, body, published, created, modified)
    VALUES
(1, 1, 'First Post', 'first-post', 'This is the first post.', 1, now(), now());