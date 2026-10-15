CREATE DATABASE sahara_school;

USE sahara_school;

CREATE TABLE admissions (

    id INT AUTO_INCREMENT PRIMARY KEY,

    student_name VARCHAR(150) NOT NULL,

    dob DATE NOT NULL,

    gender VARCHAR(20) NOT NULL,

    class VARCHAR(50) NOT NULL,

    father_name VARCHAR(150) NOT NULL,

    mother_name VARCHAR(150) NOT NULL,

    mobile VARCHAR(10) NOT NULL,

    email VARCHAR(150),

    address TEXT NOT NULL,

    village VARCHAR(100),

    district VARCHAR(100),

    state VARCHAR(100),

    pin VARCHAR(6),

    previous_school VARCHAR(200),

    previous_class VARCHAR(50),

    message TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);