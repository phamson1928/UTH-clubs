CREATE DATABASE uth_clubs;
USE uth_clubs;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    student_id VARCHAR(20) UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'admin') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password, role) VALUES 
('Admin User', 'admin@ut.edu.vn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('John Doe', 'john@ut.edu.vn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student');

CREATE TABLE clubs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  category VARCHAR(50),
  leader_id INT,
  activities TEXT,         
  schedule_meeting VARCHAR(255),
  club_image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (leader_id) REFERENCES users(id)
);

INSERT INTO clubs (name, description, category, leader_id, activities, schedule_meeting) VALUES 
('Tech Club', 'Explore the world of technology, programming, and innovation. Join us for workshops, hackathons, and tech talks.', 'technology', 2, 'Weekly Coding Sessions, Monthly Hackathons, Tech Talks, Startup Incubator', 'Every Tuesday, 6:00 PM'),
('Art Club', 'Express your creativity through various art forms. From painting to digital art, we welcome all artists.', 'arts', 2, 'Weekly Art Sessions, Photography Walks, Monthly Exhibitions, Collaborative Projects', 'Every Friday, 4:00 PM'),
('Debate Society', 'Sharpen your public speaking and critical thinking skills through engaging debates and discussions.', 'academic', 2, 'Weekly Debates, Public Speaking Workshops, Inter-University Competitions, Research & Analysis', 'Every Wednesday, 7:00 PM'),
('Soccer Club', 'Join our soccer team for regular practice sessions, friendly matches, and tournaments.', 'sports', 2, 'Training Sessions, Inter-Department Matches, Skills Workshops, Fitness Programs', 'Every Monday & Thursday, 5:00 PM'),
('Science Society', 'Explore scientific discoveries, conduct experiments, and participate in science fairs and competitions.', 'academic', 2, 'Laboratory Sessions, Science Fair Preparation, Research Presentations, Field Trips', 'Every Saturday, 2:00 PM'),
('Music Club', 'Share your love for music through performances, jam sessions, and music appreciation events.', 'arts', 2, 'Jam Sessions, Open Mic Nights, Music Theory Workshops, Concert Performances', 'Every Sunday, 3:00 PM');

CREATE TABLE events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  club_id INT,
  name VARCHAR(100),
  date DATE,
  location VARCHAR(255),
  max_participants INT,
  event_image VARCHAR(255),
  FOREIGN KEY (club_id) REFERENCES clubs(id)
);

CREATE TABLE event_registrations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  event_id INT,
  user_id INT,
  status ENUM('registered','attended','cancelled') DEFAULT 'registered',
  FOREIGN KEY (event_id) REFERENCES events(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE club_members (
  id INT AUTO_INCREMENT PRIMARY KEY,
  club_id INT,
  user_id INT,
  joined_date DATE DEFAULT (CURRENT_DATE),
  FOREIGN KEY (club_id) REFERENCES clubs(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO events (club_id, name, date, location, max_participants) VALUES 
(1, 'Hackathon 2024', '2024-02-15', 'Computer Lab A', 50),
(1, 'AI Workshop', '2024-02-20', 'Lecture Hall 1', 30),
(2, 'Art Exhibition', '2024-02-18', 'Gallery Hall', 100),
(2, 'Photography Contest', '2024-02-25', 'Campus Garden', 25),
(3, 'Inter-University Debate', '2024-02-22', 'Main Auditorium', 200),
(4, 'Soccer Tournament', '2024-02-28', 'Sports Field', 22),
(5, 'Science Fair', '2024-03-05', 'Science Building', 80),
(6, 'Music Concert', '2024-03-10', 'Music Hall', 150);

INSERT INTO users (name, email, student_id, password, role) VALUES 
('Nguyen Van A', 'nguyenvana@ut.edu.vn', 'SV001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Tran Thi B', 'tranthib@ut.edu.vn', 'SV002', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Le Van C', 'levanc@ut.edu.vn', 'SV003', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Pham Thi D', 'phamthid@ut.edu.vn', 'SV004', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Hoang Van E', 'hoangvane@ut.edu.vn', 'SV005', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student');

INSERT INTO club_members (club_id, user_id, joined_date) VALUES 
(1, 2, '2024-01-15'),
(1, 3, '2024-01-20'),
(2, 4, '2024-01-18'),
(2, 5, '2024-01-22'),
(3, 6, '2024-01-25'),
(4, 7, '2024-01-28'),
(4, 2, '2024-01-30'),
(5, 3, '2024-02-01'),
(6, 4, '2024-02-03');

INSERT INTO event_registrations (event_id, user_id, status) VALUES 
(1, 2, 'registered'),
(1, 3, 'registered'),
(2, 2, 'attended'),
(3, 4, 'registered'),
(4, 4, 'registered'),
(5, 6, 'registered'),
(6, 7, 'registered'),
(7, 3, 'registered'),
(8, 4, 'registered');
