-- إنشاء قاعدة البيانات
CREATE DATABASE IF NOT EXISTS realo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE realo;

-- جدول المستخدمين
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'user'
);

-- جدول العقارات
CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    price INT NOT NULL,
    location VARCHAR(150) NOT NULL,
    type VARCHAR(50) NOT NULL,
    description TEXT,
    image VARCHAR(255)
);

-- إضافة مستخدم مسؤول تجريبي (كلمة المرور: admin123)
INSERT INTO users (username, password, role) VALUES ('admin', 'admin123', 'admin');

-- بيانات عقارات تجريبية
INSERT INTO properties (title, price, location, type, description, image) VALUES
('شقة 3 غرف بوسط المدينة', 450000, 'الرياض', 'شقة', 'شقة واسعة في موقع مميز مع إطلالة جميلة ومواقف للسيارات.', 'property1.jpg'),
('فيلا فاخرة بحديقة', 1200000, 'جدة', 'فيلا', 'فيلا مستقلة مع حديقة كبيرة ومسابح، تصميم عصري.', 'property2.jpg'),
('شقة استوديو للإيجار', 2500, 'الدمام', 'شقة', 'شقة صغيرة مناسبة للأفراد، مجهزة بالكامل.', 'property3.jpg'),
('أرض سكنية للبيع', 800000, 'الرياض', 'أرض', 'أرض سكنية في حي هادئ، مناسبة للبناء.', 'property4.jpg'),
('شقة 4 غرف راقية', 650000, 'مكة', 'شقة', 'شقة كبيرة قريبة من الحرم، تشطيب فاخر.', 'property5.jpg'),
('عمارة للإيجار', 35000, 'الرياض', 'عمارة', 'عمارة سكنية كاملة، 6 شقق، موقع ممتاز.', 'property6.jpg');
