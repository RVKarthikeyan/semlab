CREATE TABLE food_waste (
    id INT AUTO_INCREMENT PRIMARY KEY,
    food_item VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    location VARCHAR(255),
    donation_status ENUM('pending', 'donated') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    food_item VARCHAR(100) NOT NULL,
    donor_name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    donation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
