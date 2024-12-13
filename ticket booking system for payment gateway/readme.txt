CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_name VARCHAR(255),
    price DECIMAL(10, 2),
    status VARCHAR(100)
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT,
    customer_name VARCHAR(255),
    customer_email VARCHAR(255),
    booking_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id)
);
