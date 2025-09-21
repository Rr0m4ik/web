DROP TABLE IF EXISTS posts;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    about TEXT,
    avatar_src VARCHAR(255),
    avatar_alt VARCHAR(50)
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    image VARCHAR(255),
    like_count INT DEFAULT 0,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);