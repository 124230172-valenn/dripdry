-- ==========================================================
-- DATABASE: dripdry (versi fix untuk sistem Drip & Dry Laundry)
-- ==========================================================

DROP DATABASE IF EXISTS dripdry;
CREATE DATABASE dripdry CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE dripdry;

-- ==========================================================
-- TABLE: user
-- ==========================================================
CREATE TABLE user (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  phone VARCHAR(20) DEFAULT NULL,
  address TEXT DEFAULT NULL,
  role ENUM('admin','pelanggan') DEFAULT 'pelanggan',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY (username),
  UNIQUE KEY (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default users
INSERT INTO user (username, email, password, phone, address, role) VALUES
('admin', 'admin@gmail.com', '123', '081234567890', 'Jl. Administrasi No. 1', 'admin'),
('uci', 'uci@gmail.com', '123', '081234567891', 'Jl. Contoh No. 2', 'pelanggan'),
('valen', 'valen@gmail.com', '123', '081234567892', 'Jl. Pelanggan No. 3', 'pelanggan');

-- ==========================================================
-- TABLE: services
-- ==========================================================
CREATE TABLE services (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description TEXT DEFAULT NULL,
  price DECIMAL(10,2) NOT NULL,
  duration VARCHAR(50) NOT NULL,
  is_active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO services (name, description, price, duration) VALUES
('Cuci Reguler', 'Cuci biasa untuk pakaian sehari-hari', 15000, '1-2 hari'),
('Cuci Express', 'Cuci cepat untuk kebutuhan mendesak', 25000, '6-8 jam'),
('Setrika Saja', 'Hanya setrika tanpa cuci', 10000, '4-6 jam'),
('Cuci + Setrika', 'Paket lengkap cuci dan setrika', 20000, '1-2 hari'),
('Dry Clean', 'Cuci bahan khusus seperti jas dan sutra', 35000, '2-3 hari');

-- ==========================================================
-- TABLE: booking
-- ==========================================================
CREATE TABLE booking (
  booking_id INT(11) NOT NULL AUTO_INCREMENT,
  id_user INT(11) DEFAULT NULL,
  service_id INT(11) DEFAULT NULL,
  date DATE NOT NULL,
  time VARCHAR(20) NOT NULL,
  dropoff TINYINT(1) NOT NULL,
  payment ENUM('cash','qris') NOT NULL,
  weight DECIMAL(5,2) DEFAULT NULL,
  total_price DECIMAL(10,2) DEFAULT NULL,
  status TINYINT(1) DEFAULT 1 COMMENT '1=Pending, 2=Processing, 3=Completed, 4=Cancelled',
  notes TEXT DEFAULT NULL,
  bukti_pembayaran VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (booking_id),
  KEY fk_user_booking (id_user),
  KEY fk_service_booking (service_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO booking (id_user, service_id, date, time, dropoff, payment, weight, total_price, status, notes)
VALUES
(2, 1, '2025-10-26', '09:00-11:00', 1, 'cash', 3.0, 45000, 3, 'Selesai dicuci'),
(3, 4, '2025-10-27', '13:00-15:00', 0, 'qris', 2.5, 50000, 2, 'Sedang dicuci'),
(2, 2, '2025-10-28', '10:00-12:00', 1, 'cash', 1.5, 37500, 1, 'Menunggu pembayaran');

-- ==========================================================
-- TABLE: payments
-- ==========================================================
CREATE TABLE payments (
  id INT(11) NOT NULL AUTO_INCREMENT,
  booking_id INT(11) NOT NULL,
  amount DECIMAL(10,2) NOT NULL,
  payment_method ENUM('cash','qris','transfer') NOT NULL,
  status ENUM('pending','paid','failed') DEFAULT 'pending',
  payment_proof VARCHAR(255) DEFAULT NULL,
  paid_at TIMESTAMP NULL DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY fk_payment_booking (booking_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==========================================================
-- TABLE: notifications
-- ==========================================================
CREATE TABLE notifications (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) DEFAULT NULL,
  title VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  type ENUM('info','success','warning','error') DEFAULT 'info',
  is_read TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY fk_notification_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==========================================================
-- TABLE: settings
-- ==========================================================
CREATE TABLE settings (
  id INT(11) NOT NULL AUTO_INCREMENT,
  setting_key VARCHAR(100) NOT NULL,
  setting_value TEXT NOT NULL,
  description TEXT DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY setting_key (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO settings (setting_key, setting_value, description) VALUES
('company_name', 'Drip & Dry Laundry', 'Nama perusahaan'),
('company_address', 'Jl. Laundry No. 123, Jakarta Selatan', 'Alamat perusahaan'),
('company_phone', '+62 21 1234 5678', 'Nomor telepon perusahaan'),
('company_email', 'info@dripdrylaundry.com', 'Email perusahaan'),
('operational_hours', '08:00-20:00', 'Jam operasional');

-- ==========================================================
-- RELATIONS
-- ==========================================================
ALTER TABLE booking
  ADD CONSTRAINT fk_user_booking FOREIGN KEY (id_user) REFERENCES user (id) ON DELETE SET NULL,
  ADD CONSTRAINT fk_service_booking FOREIGN KEY (service_id) REFERENCES services (id) ON DELETE SET NULL;

ALTER TABLE payments
  ADD CONSTRAINT fk_payment_booking FOREIGN KEY (booking_id) REFERENCES booking (booking_id) ON DELETE CASCADE;

ALTER TABLE notifications
  ADD CONSTRAINT fk_notification_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE;

-- ==========================================================
-- INDEXES
-- ==========================================================
CREATE INDEX idx_booking_status ON booking(status);
CREATE INDEX idx_booking_date ON booking(date);
CREATE INDEX idx_booking_user ON booking(id_user);
CREATE INDEX idx_notifications_user ON notifications(user_id);
CREATE INDEX idx_notifications_read ON notifications(is_read);

COMMIT;
