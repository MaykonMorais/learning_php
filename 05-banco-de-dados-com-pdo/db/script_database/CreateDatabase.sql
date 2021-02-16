USE fullstackphp;

CREATE TABLE user(
  id integer not null autoincrement,
  first_name varchar(255),
  last_name varchar(255),
  email varchar(255),
  document varchar(255),
  PRIMARY KEY (id)
);

CREATE TABLE user_adrress(
  id integer not null autoincrement,
  user_id int(11) unsigned DEFAULT NULL,
  street varchar(255),
  number varchar(255),
  complement varchar(255),
  PRIMARY KEY (id),
  KEY  addr_user (user)id,
  CONSTRAINT user_id FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE ON UPDATE NO ACTION
);

set character_set_client = utf8;
set character_set_connection = utf8;
set character_set_results = utf8;
set collation_connection = utf8_general_ci;

