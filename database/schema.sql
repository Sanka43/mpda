-- MPDA Database Schema
-- Run: mysql -u root < database/schema.sql

CREATE DATABASE IF NOT EXISTS mpda_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mpda_db;

CREATE TABLE IF NOT EXISTS branches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    day_of_week VARCHAR(20) NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    venue VARCHAR(255) NOT NULL,
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(150) NOT NULL,
    parent_name VARCHAR(150) NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    age INT NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    school VARCHAR(150) DEFAULT NULL,
    student_dob DATE DEFAULT NULL,
    mother_dob DATE DEFAULT NULL,
    guardian_nic VARCHAR(20) DEFAULT NULL,
    guardian_job VARCHAR(150) DEFAULT NULL,
    emergency_phone VARCHAR(20) NOT NULL,
    preferred_branch_id INT DEFAULT NULL,
    status ENUM('pending', 'reviewed', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (preferred_branch_id) REFERENCES branches(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title_en VARCHAR(255) NOT NULL,
    title_si VARCHAR(255) NOT NULL,
    description_en TEXT,
    description_si TEXT,
    event_date DATE DEFAULT NULL,
    venue VARCHAR(255) DEFAULT NULL,
    image_url VARCHAR(500) DEFAULT NULL,
    is_featured TINYINT(1) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title_en VARCHAR(255) NOT NULL,
    title_si VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt_en TEXT,
    excerpt_si TEXT,
    content_en TEXT,
    content_si TEXT,
    image_url VARCHAR(500) DEFAULT NULL,
    is_published TINYINT(1) DEFAULT 0,
    published_at DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_name VARCHAR(150) NOT NULL,
    student_name VARCHAR(150) DEFAULT NULL,
    content_en TEXT NOT NULL,
    content_si TEXT NOT NULL,
    rating TINYINT DEFAULT 5,
    is_approved TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS site_settings (
    setting_key VARCHAR(100) PRIMARY KEY,
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    subject VARCHAR(255) DEFAULT NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Seed branches from CSV
INSERT INTO branches (name, day_of_week, start_time, end_time, venue, sort_order) VALUES
('Rathmalana', 'Wednesday', '15:00:00', '17:30:00', 'Kamkaru Sewana', 1),
('Panadura', 'Thursday', '15:00:00', '17:30:00', 'Town Hall', 2),
('Kohuwala', 'Friday', '15:00:00', '17:30:00', 'HNB Building', 3),
('Piliyandala', 'Saturday', '08:30:00', '11:30:00', 'Fab Building', 4),
('Gampaha', 'Saturday', '12:30:00', '15:00:00', 'Macro Building', 5),
('Negombo', 'Saturday', '16:00:00', '18:00:00', 'Minal Digital Studio (Upper Floor)', 6),
('Kandy', 'Sunday', '16:00:00', '18:00:00', 'Green Angels Int. School', 7),
('Kurunegala', 'Sunday', '12:30:00', '15:00:00', 'Samudra Supermarket Building', 8),
('Anuradhapura', 'Sunday', '08:00:00', '10:30:00', 'Rex Building', 9),
('Kiribathgoda', 'Monday', '15:00:00', '18:00:00', 'Kandy Building', 10);

-- Seed featured event
INSERT INTO events (title_en, title_si, description_en, description_si, event_date, venue, is_featured, is_active) VALUES
('Mihikatha Annual Concert', 'මිහිකතා වාර්ෂික සංගීත නිර්මාණ ශිළ්පී', 'Our grand annual concert at Sugathadasa Stadium, showcasing the talent and dedication of our students.', 'සුගතධාස ක්‍රීඩාංගනයේදී පැවැත්වෙන අපගේ විශaal ව annual concert. අපගේ ශිෂ්‍යයින්ගේ talent සහ dedication ප්‍රදර්ශනය කරයි.', '2026-10-01', 'Sugathadasa Stadium', 1, 1);

-- Seed site settings
INSERT INTO site_settings (setting_key, setting_value) VALUES
('slogan_en', 'Where Tradition Meets Excellence'),
('slogan_si', 'සම්ප්‍රදාය හා ශ්‍රේෂ්ඨත්වය හමුවන තැන'),
('vision_en', 'To be Sri Lanka''s most respected traditional dance academy, nurturing confident performers who honor heritage while embracing innovation.'),
('vision_si', 'ශ්‍රී ලංකාවේ වඩාත් ගෞරවනීය සම්ප්‍රදායik නර්තන අකademy, උරුමය ගරු කරමින් නවෝත්පාදනය අනුග්‍රහ කරන self-confident performers nurture කරමින්.'),
('mission_en', 'To preserve Sri Lankan cultural dance traditions while providing professional training that builds discipline, confidence, and artistic excellence in every student.'),
('mission_si', 'ශ්‍රී ලංකා සංස්කෘතික නර්තන සම්ප්‍රදායන් සංරක්ෂණය කරමින්, සෑම ශිෂ්‍යයෙකුටම අනුශාසනය, විශ්වාසය සහ කලාත්මක ශ්‍රේෂ්ඨත්වය ගොඩනගන ව professioonal training ලබා දීම.');

-- Default admin (password: mpda2026)
INSERT INTO admin_users (username, password_hash) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Sample testimonials
INSERT INTO testimonials (parent_name, student_name, content_en, content_si, rating, is_approved) VALUES
('Mrs. Perera', 'Dilani', 'MPDA has transformed my daughter''s confidence. The teachers are caring and professional.', 'MPDA මගින් මගේ දියණියගේ self-confidence වෙනස් වී ඇත. ගුරුවරුන් caring සහ professional.', 5, 1),
('Mr. Fernando', 'Kavindu', 'Excellent traditional dance training with a warm, family-like atmosphere.', 'වarm, family-like atmosphere එකක් සමඟ excellent traditional dance training.', 5, 1);
