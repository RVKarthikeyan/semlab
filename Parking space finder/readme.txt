CREATE TABLE parking_spaces (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location VARCHAR(255),
    total_spaces INT,
    available_spaces INT
);

CREATE TABLE parking_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parking_space_id INT NOT NULL,
    start_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    end_time TIMESTAMP NULL,
    FOREIGN KEY (parking_space_id) REFERENCES parking_spaces(id)
);
