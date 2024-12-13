CREATE TABLE intruder_alerts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alert_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    location VARCHAR(255),
    status VARCHAR(100)
);

CREATE TABLE alarm_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alert_id INT NOT NULL,
    action_taken VARCHAR(255),
    FOREIGN KEY (alert_id) REFERENCES intruder_alerts(id)
);
