CREATE DATABASE uth_clubs;
USE uth_clubs;

-- Bảng người dùng
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    student_id VARCHAR(20) UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'admin') DEFAULT 'student',
    email_verified BOOLEAN DEFAULT FALSE,
    verification_token VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Thêm tài khoản mẫu
INSERT INTO users (name, email, password, role) VALUES 
('Quản trị viên', 'admin@ut.edu.vn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Nguyễn Văn Nam', 'nam@ut.edu.vn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student');

-- Bảng câu lạc bộ
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

-- Thêm dữ liệu CLB (toàn tiếng Việt)
INSERT INTO clubs (name, description, category, leader_id, activities, schedule_meeting) VALUES 
('CLB Công Nghệ', 'Khám phá thế giới công nghệ, lập trình và sáng tạo. Tham gia các buổi workshop, hackathon và tọa đàm công nghệ.', 'công nghệ', 2, 'Buổi học lập trình hàng tuần, Cuộc thi Hackathon hàng tháng, Tọa đàm công nghệ, Hỗ trợ khởi nghiệp', 'Thứ Ba hàng tuần, 18:00'),
('CLB Nghệ Thuật', 'Thỏa sức sáng tạo qua nhiều loại hình nghệ thuật: vẽ, nhạc, nhiếp ảnh, và nghệ thuật số.', 'nghệ thuật', 2, 'Sinh hoạt vẽ tranh hàng tuần, Dã ngoại nhiếp ảnh, Triển lãm hàng tháng, Dự án sáng tạo nhóm', 'Thứ Sáu hàng tuần, 16:00'),
('CLB Tranh Biện', 'Rèn luyện kỹ năng hùng biện và tư duy phản biện thông qua các buổi tranh luận và hội thảo.', 'học thuật', 2, 'Tranh biện hàng tuần, Hội thảo nói trước công chúng, Thi đấu liên trường, Phân tích & nghiên cứu', 'Thứ Tư hàng tuần, 19:00'),
('CLB Bóng Đá', 'Tham gia đội bóng của trường với các buổi tập luyện, giao hữu và giải đấu.', 'thể thao', 2, 'Buổi tập luyện, Trận giao hữu giữa khoa, Huấn luyện kỹ năng, Chương trình rèn thể lực', 'Thứ Hai & Thứ Năm, 17:00'),
('CLB Khoa Học', 'Khám phá khoa học, tham gia nghiên cứu và hội thi khoa học trong và ngoài trường.', 'học thuật', 2, 'Thực hành thí nghiệm, Chuẩn bị hội chợ khoa học, Báo cáo nghiên cứu, Tham quan thực tế', 'Thứ Bảy hàng tuần, 14:00'),
('CLB Âm Nhạc', 'Cùng chia sẻ đam mê âm nhạc qua biểu diễn, giao lưu và các buổi workshop.', 'nghệ thuật', 2, 'Buổi jam nhạc, Đêm open mic, Workshop nhạc lý, Biểu diễn hòa nhạc', 'Chủ Nhật hàng tuần, 15:00');

-- Bảng sự kiện
CREATE TABLE events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  club_id INT,
  name VARCHAR(100),
  date DATE,
  location VARCHAR(255),
  max_participants INT,
  description TEXT,
  event_image VARCHAR(255),
  FOREIGN KEY (club_id) REFERENCES clubs(id)
);

-- Thêm sự kiện mẫu
INSERT INTO events (club_id, name, date, location, max_participants, description) VALUES 
(1, 'Cuộc thi Lập trình Hackathon 2024', '2024-02-15', 'Phòng máy tính A', 50, 'Cuộc thi hackathon nhằm phát triển sản phẩm công nghệ trong 24 giờ.'),
(1, 'Hội thảo Trí tuệ Nhân tạo', '2024-02-20', 'Giảng đường 1', 30, 'Buổi hội thảo chia sẻ kiến thức về AI và Machine Learning.'),
(2, 'Triển lãm Nghệ thuật Sinh viên', '2024-02-18', 'Phòng Triển lãm Nghệ thuật', 100, 'Trưng bày các tác phẩm của thành viên CLB Nghệ thuật.'),
(2, 'Cuộc thi Nhiếp ảnh Toàn trường', '2024-02-25', 'Khuôn viên trường', 25, 'Cuộc thi chụp ảnh với chủ đề “Khoảnh khắc sinh viên”.'),
(3, 'Giải Tranh biện Liên Trường', '2024-02-22', 'Hội trường lớn', 200, 'Cuộc thi tranh biện với sự tham gia của nhiều trường đại học.'),
(4, 'Giải Bóng đá Sinh viên UTH', '2024-02-28', 'Sân bóng đá', 22, 'Giải bóng đá giao hữu giữa các khoa.'),
(5, 'Hội chợ Khoa học 2024', '2024-03-05', 'Tòa nhà Khoa học', 80, 'Trưng bày các mô hình nghiên cứu và thí nghiệm khoa học.'),
(6, 'Đêm Nhạc Sinh viên UTH', '2024-03-10', 'Hội trường âm nhạc', 150, 'Chương trình biểu diễn âm nhạc của các thành viên CLB.');

-- Bảng thành viên CLB
CREATE TABLE club_members (
  id INT AUTO_INCREMENT PRIMARY KEY,
  club_id INT,
  user_id INT,
  joined_date DATE DEFAULT (CURRENT_DATE),
  FOREIGN KEY (club_id) REFERENCES clubs(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Bảng đăng ký sự kiện
CREATE TABLE event_registrations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  event_id INT,
  user_id INT,
  status ENUM('registered','attended','cancelled') DEFAULT 'registered',
  FOREIGN KEY (event_id) REFERENCES events(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Thêm thêm sinh viên mẫu
INSERT INTO users (name, email, student_id, password, role) VALUES 
('Nguyễn Văn A', 'nguyenvana@ut.edu.vn', 'SV001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Trần Thị B', 'tranthib@ut.edu.vn', 'SV002', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Lê Văn C', 'levanc@ut.edu.vn', 'SV003', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Phạm Thị D', 'phamthid@ut.edu.vn', 'SV004', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student'),
('Hoàng Văn E', 'hoangvane@ut.edu.vn', 'SV005', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student');

-- Thêm thành viên vào CLB
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

-- Đăng ký sự kiện
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
