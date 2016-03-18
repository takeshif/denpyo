create table denpyo (
  id int not null auto_increment primary key,
  yyyymmdd int not null,
  omise_cd int not null,
  sir_cd int not null,
  item_cd varchar(13),
  jtanka int,
  gtanka int,
  stanka int,
  lease tinyint
);

create table imtok (
  item_cd int not null primary key,
  item_name text
);

create table imsir (
  sir_cd int not null primary key,
  sir_name text
);
