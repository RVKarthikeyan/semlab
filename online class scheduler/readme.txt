CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(100) NOT NULL,
    start_time TIME,
    end_time TIME,
    day_of_week VARCHAR(20)
);

CREATE TABLE schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_id INT NOT NULL,
    teacher_name VARCHAR(100),
    schedule_date DATE,
    FOREIGN KEY (class_id) REFERENCES classes(id)
);
