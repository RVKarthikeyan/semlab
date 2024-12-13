CREATE TABLE surveys (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    survey_id INT,
    option_text VARCHAR(255),
    FOREIGN KEY (survey_id) REFERENCES surveys(id)
);

CREATE TABLE responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    survey_id INT,
    option_id INT,
    FOREIGN KEY (survey_id) REFERENCES surveys(id),
    FOREIGN KEY (option_id) REFERENCES options(id)
);
