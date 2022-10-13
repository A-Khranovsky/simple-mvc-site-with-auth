### Web-application 

#### Vocation

#### Description

#### How to run

* Clone the repository (use branch: router_sets_route)
* ```angular2html docker-compose up -d```
* ```angular2html docker exec -it 58_mysql_1 /bin/sh```
* ```angular2html mysql -u root -p ``` password is: secret
* ```angular2html use mysql;```
* Run SQL queries:
```sql
create table types (
id int not null auto_increment,
name varchar(255) not null,
PRIMARY KEY (id)
)default character set utf8;

insert into types (name) values ('Особисті');
insert into types (name) values ('Робочі');

create table tasks(
id int not null auto_increment,
description text not null,
file varchar(255) not null,
finish_date date not null,
urgently bool default false,
type_id int,
PRIMARY KEY(id),
FOREIGN KEY (type_id) references types(id)
ON DELETE SET NULL

) default character set utf8;

insert into tasks ( description, file, finish_date, urgently, type_id)
values (
'Намалювати інтерфейс цієї программи',
'4.png',
'2022-10-03',
true,
1
);
```