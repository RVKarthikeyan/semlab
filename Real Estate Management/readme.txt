CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    type VARCHAR(100),
    price DECIMAL(10, 2),
    location VARCHAR(255),
    description TEXT,
    status VARCHAR(100)
);
