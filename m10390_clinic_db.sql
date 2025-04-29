CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,               
  username VARCHAR(100) NOT NULL UNIQUE,           
  password VARCHAR(255) NOT NULL,                 
  role VARCHAR(50) NOT NULL,                       
  email VARCHAR(100),                              
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,   
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP );

CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,             -- Unique patient ID
    user_id INT,                                   -- References 'users.id' (optional, no FK constraint)
    name VARCHAR(100),                             -- Patient's full name
    age INT,                                       -- Patient's age
    gender ENUM('Male', 'Female', 'Other'),        -- Gender as ENUM for consistent values
    contact VARCHAR(15)                            -- Contact number (mobile or landline)
   );

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,             -- Unique appointment ID
    patient_id INT,                                -- Refers to 'patients.id'
    doctor_id INT,                                 -- Refers to 'users.id' with role 'doctor'
    appointment_date DATE,                         -- Date of the appointment
    appointment_time TIME,                         -- Time of the appointment
    status ENUM('Scheduled', 'Completed', 'Cancelled') DEFAULT 'Scheduled'   
);

INSERT INTO users (username, password, role, email)
VALUES (
  'admin',
  'admin123', -- admin123
  'admin',
  'admin@example.com'
);

INSERT INTO users (username, password, role, email)
VALUES (
  'patient1',  'patient123', 'patient', 'patient1@example.com'
);
