create table denpyo (
  id int not null auto_increment primary key,
  tanto text,
  yyyymmdd int not null,
  omise_cd int not null,
  sir_cd int not null,
  item_cd varchar(13),
  jtanka int,
  gtanka int,
  stanka int,
  lease tinyint,
  status tinyint
);

create table imtok (
  omise_cd int not null primary key,
  omise_name text
);

create table imsir (
  sir_cd int not null primary key,
  sir_name text
);

create table imsho (
  item_cd varchar(13) not null primary key,
  item_name text
);

insert into imsho (item_cd, item_name) values
('2000014999213', '新装工事'),
('2000014999220', '新装DP工事'),
('2000014999244', '改装前撤去工事'),
('2000014999251', '改装工事'),
('2000014999268', '改装DP工事'),
('2000014999299', '退店工事'),
('2000014999237', '防犯カメラ先行工事');
