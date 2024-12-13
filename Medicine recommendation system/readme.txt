CREATE TABLE medicines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    recommended_for VARCHAR(100),
    side_effects TEXT
);

CREATE TABLE user_symptoms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    symptoms TEXT NOT NULL,
    recommendation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
