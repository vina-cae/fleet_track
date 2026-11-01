-- Create Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'admin'
);

-- Create Parcels Table
CREATE TABLE parcels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tracking_code VARCHAR(20) NOT NULL,
    sender VARCHAR(100) NOT NULL,
    receiver VARCHAR(100) NOT NULL,
    origin VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    weight DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert a dummy admin account
INSERT INTO users (username, password, role) VALUES ('admin', 'admin123', 'admin');

-- Insert dummy parcels for the dashboard
INSERT INTO parcels (tracking_code, sender, receiver, origin, destination, weight, status) VALUES 
('TRK-380285', 'vanessa', 'vina', 'Manila', 'Cebu', 2.5, 'Delivered'),
('TRK-512811', 'she', 'cae', 'Baguio', 'Davao', 1.2, 'Pending');