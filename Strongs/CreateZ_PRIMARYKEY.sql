CREATE TABLE Z_PRIMARYKEY (
  Z_ENT int(11) NOT NULL,
  Z_NAME varchar(32) DEFAULT NULL,
  Z_SUPER int(11) DEFAULT NULL,
  Z_MAX int(11) DEFAULT NULL,
  PRIMARY KEY (Z_ENT)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;