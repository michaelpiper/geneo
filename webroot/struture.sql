
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin BOOLEAN DEFAULT FALSE,
    owner BOOLEAN DEFAULT FALSE,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    display_image VARCHAR(255) DEFAULT NULL,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
    UNIQUE KEY (username),
    UNIQUE KEY (email)
);

CREATE TABLE categories ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) DEFAULT NULL,
    description VARCHAR(255) DEFAULT NULL,
    cover_image VARCHAR(255) DEFAULT NULL,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
    UNIQUE KEY (title)
);
CREATE TABLE tags ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) DEFAULT NULL,
    description VARCHAR(255) DEFAULT NULL,
    cover_image VARCHAR(255) DEFAULT NULL,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
    UNIQUE KEY (title)
);
CREATE TABLE articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL ,
    category_id INT NOT NULL ,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    slug VARCHAR(255) NOT NULL,
    cover_image VARCHAR(255) DEFAULT NULL,
    published BOOLEAN DEFAULT 0,
    viewed BOOLEAN DEFAULT 0,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
    unique(slug),
    UNIQUE KEY (title),
    FOREIGN KEY user_key (user_id) REFERENCES users(id),
    FOREIGN KEY category_key (category_id) REFERENCES categories(id)
) CHARSET=utf8mb4;

CREATE TABLE articles_tags (     
    article_id INT UNSIGNED NOT NULL,     
    tag_id INT NOT NULL,     
    PRIMARY KEY (article_id, tag_id),     
    FOREIGN KEY tag_key(tag_id) REFERENCES tags(id),    
    FOREIGN KEY article_key(article_id) REFERENCES articles(id) 
);
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) DEFAULT NULL,
    email VARCHAR(255) DEFAULT NULL,
    subject VARCHAR(255) DEFAULT NULL,
    message TEXT NOT NULL,
    article_id INT UNSIGNED NOT NULL,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
    FOREIGN KEY article_key(article_id) REFERENCES articles(id)
) CHARSET=utf8mb4;