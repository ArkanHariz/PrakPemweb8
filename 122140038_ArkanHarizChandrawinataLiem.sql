CREATE TABLE peserta_lomba (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    alamat TEXT NOT NULL
);

INSERT INTO peserta_lomba (nama, alamat) 
VALUES 
('Jovan Gunawan', 'Jl. Cilaki No 73 Bandung'),
('Andi Saputra', 'Jl. Merdeka No 5 Jakarta'),
('Budi Santoso', 'Jl. Raya No 10 Surabaya'),
('Rina Pratama', 'Jl. Kesehatan No 15 Yogyakarta'),
('Dwi Hartanto', 'Jl. Sudirman No 21 Medan'),
('Siti Nurhaliza', 'Jl. Semangka No 8 Bali'),
('Agus Setiawan', 'Jl. Pahlawan No 33 Makassar'),
('Lia Susanti', 'Jl. Cempaka No 10 Bandung'),
('Tono Prasetyo', 'Jl. Pelita No 5 Jakarta'),
('Rika Amalia', 'Jl. Mawar No 17 Malang'),
('Bram Nugroho', 'Jl. Melati No 25 Surabaya'),
('Maya Amalia', 'Jl. Raya No 30 Solo'),
('Farhan Yusuf', 'Jl. Putra No 40 Palembang');
