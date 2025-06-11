
CREATE DATABASE IF NOT EXISTS forum_universitario CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE forum_universitario;


CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    birth_date DATE NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    category VARCHAR(100) NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


INSERT INTO users (name, email, password, cpf, birth_date, role) VALUES 
('Administrador', 'admin@forum.edu.br', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '000.000.000-00', '1990-01-01', 'admin');


INSERT INTO posts (title, content, category, user_id) VALUES 
('Bem-vindos ao Fórum!', 'Este é o primeiro post do nosso fórum universitário. Aqui vocês podem discutir sobre diversos assuntos acadêmicos, tirar dúvidas e compartilhar conhecimentos.', 'Geral', 1),
('Dúvidas sobre Cálculo I', 'Alguém pode me ajudar com limites e derivadas? Estou com dificuldades para entender alguns conceitos básicos.', 'Matemática', 1),
('Grupo de Estudos - Programação', 'Estou organizando um grupo de estudos sobre algoritmos e estruturas de dados. Interessados, comentem aqui!', 'Programação', 1);


INSERT INTO comments (content, post_id, user_id) VALUES 
('Parabéns pela iniciativa! Este fórum será muito útil para todos nós.', 1, 1),
('Posso ajudar com cálculo! Mando material por aqui.', 2, 1),
('Tenho interesse no grupo de programação! Como faço para participar?', 3, 1);

CREATE INDEX IF NOT EXISTS idx_posts_user_id ON posts(user_id);
CREATE INDEX IF NOT EXISTS idx_posts_category ON posts(category);
CREATE INDEX IF NOT EXISTS idx_posts_created_at ON posts(created_at);
CREATE INDEX IF NOT EXISTS idx_comments_post_id ON comments(post_id);
CREATE INDEX IF NOT EXISTS idx_comments_user_id ON comments(user_id);
CREATE INDEX IF NOT EXISTS idx_users_email ON users(email);