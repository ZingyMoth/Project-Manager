DROP DATABASE IF EXISTS aproject;

CREATE DATABASE aproject;
USE aproject;

CREATE TABLE users (
    uid INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE projects (
    pid INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    short_description VARCHAR(500) NOT NULL,
    phase ENUM('design', 'development', 'testing', 'deployment', 'complete') NOT NULL DEFAULT 'design',
    uid INT NOT NULL,
    FOREIGN KEY (uid) REFERENCES users(uid) ON DELETE CASCADE,
    CHECK (end_date >= start_date)
) ENGINE=InnoDB;

INSERT INTO users (username, password, email) VALUES
('alice', '$2y$12$JCHoPLIJ/IN7ZEM1bvXak.nyFVwxUOnYdWnelaEb/fC2IKGwKuIwO', 'alice@example.com'),
('bob', '$2y$12$m0.HVvvSHHBOf9ntvXCaPu3k2ehAbS3IouuGLufWTvNMJNVF2hHYa', 'bob@example.com');

INSERT INTO projects (title, start_date, end_date, short_description, phase, uid) VALUES
('Customer Portal', '2026-01-12', '2026-06-30', 'Self-service portal for customers to view orders and invoices.', 'development', 1),
('Inventory Tracker', '2026-03-01', '2026-09-15', 'Tracks stock levels across warehouses in real time.', 'design', 1),
('Payroll Upgrade', '2025-09-05', '2026-02-28', 'Migrates payroll to the new HR platform.', 'testing', 2),
('Mobile Booking App', '2026-02-20', NULL, 'Lets clients book appointments from their phones.', 'deployment', 2),
('Intranet Redesign', '2025-05-10', '2025-12-01', 'Refreshed staff intranet with improved search.', 'complete', 1);