create database qna;

use qna;

create table user (
  id int(10) primary key,
  name varchar(50) not null,
  passwd varchar(128) not null,
  authority enum('student', 'assistant', 'professor') not null
);

create table question (
  id int(10) auto_increment primary key,
  u_id int(10),
  title varchar(128) not null,
  content mediumtext,
  time datetime,
  score int(5) default 0,
  pinned boolean default false,
  foreign key (u_id) references user(id)
);

create table answer (
  id int(10) auto_increment primary key,
  u_id int(10),
  q_id int(10),
  content mediumtext,
  time datetime,
  score int(5) default false,
  foreign key (u_id) references user(id),
  foreign key (q_id) references question(id)
);

create table comment (
  id int(10) auto_increment primary key,
  u_id int(10),
  reference_id int(10),
  content mediumtext,
  time datetime,
  score int(5) default false,
  type enum('question', 'answer', 'board', 'notice', 'lecture'),
  foreign key (u_id) references user(id)
);

create table notice (
  id int(10) auto_increment primary key,
  u_id int(10),
  title varchar(128) not null,
  content mediumtext,
  time datetime,
  url varchar(1000),
  pinned boolean default false,
  foreign key (u_id) references user(id)
);

create table board (
  id int(10) auto_increment primary key,
  u_id int(10),
  title varchar(128) not null,
  content mediumtext,
  time datetime,
  pinned boolean default false,
  foreign key (u_id) references user(id)
);

create table favorite (
  u_id int(10),
  q_id int(10),
  foreign key (u_id) references user(id),
  foreign key (q_id) references question(id)
);

create table lecture (
  id int(10) auto_increment primary key,
  name varchar(100) not null,
  url varchar(1000) not null,
  open boolean default false
);

create table notification (
  u_id int(10),
  message mediumtext,
  url varchar(1000),
  time datetime,
  isread boolean default false,
  foreign key (u_id) references user(id)
);

create table tag(
  id int(10) auto_increment primary key,
  name varchar(50) not null unique
);

create table tag_question (
  t_id int(10),
  q_id int(10),
  foreign key (t_id) references tag(id),
  foreign key (q_id) references question(id)
);

create table user_question (
  u_id int(10),
  r_id int(10),
  type enum('question', 'answer') not null,
  foreign key (u_id) references user(id)
);