CREATE DATABASE app_pos;

CREATE TABLE user(
    id_user int not null PRIMARY KEY auto_increment,
    email VARCHAR
(30) not null,
    nama VARCHAR
(30),
    password VARCHAR
(200),
    image text,
    jenis_kelamin VARCHAR
(10),
    alamat VARCHAR
(50),
    no_telp VARCHAR
(15),
    tanggal_lahir date,
    agama VARCHAR
(15),
    level int
(1),
    is_active int
(1),
    token VARCHAR
(200),
    date_created int,
);

CREATE TABLE pelanggan(
    id_pelanggan int not null PRIMARY KEY auto_increment,
    nama_pelanggan VARCHAR
(20),
    no_telp VARCHAR
(15),
is_active tinyint default 1
);

CREATE TABLE jenis_barang(
    id_jenis_barang int not null PRIMARY KEY auto_increment,
    jenis_barang VARCHAR
(20),
is_active tinyint default 1
);

CREATE TABLE satuan(
    id_satuan int not null PRIMARY KEY auto_increment,
    satuan_barang VARCHAR
(20),
is_active tinyint default 1
);

CREATE TABLE supplier(
    id_supplier int not null PRIMARY KEY auto_increment,
    nama_supplier VARCHAR
(20),
    no_telp VARCHAR
(15),
alamat VARCHAR
(30),
keterangan VARCHAR
(30),
is_active tinyint default 1
);

CREATE TABLE barang(
    id_barang int NOT NULL PRIMARY KEY auto_increment,
    nomor_barang int not null,
    barcode VARCHAR
(100),
    nama_barang VARCHAR
(30),
    harga_barang int,
    stock int DEFAULT 0,
    jenis_barang_id int NOT NULL,
    satuan_id int NOT NULL,
    is_active tinyint default 1
    FOREIGN KEY
(jenis_barang_id) REFERENCES jenis_barang
(id_jenis_barang),
    FOREIGN KEY
(satuan_id) REFERENCES satuan
(id_satuan)
);

