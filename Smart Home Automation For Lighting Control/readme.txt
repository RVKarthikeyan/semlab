CREATE TABLE lights (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location VARCHAR(255),
    status VARCHAR(100)
);

CREATE TABLE light_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    light_id INT NOT NULL,
    action VARCHAR(100),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (light_id) REFERENCES lights(id)
);
