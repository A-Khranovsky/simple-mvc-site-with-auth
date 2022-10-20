### Web-application 
Simple site with MVC, non-framework, non-libraries with authentication, authorization, cookies, session.
#### Vocation
Praction with MVC, PHP8, callback types, authorization & authentication by session & cookies.
#### Description
Project realizes authentication by checking entered login, password in database, outputs greeting with user. Project is 
extendable, can be extended by new controllers, models, routes. If login and password were found  - are created cookies
with expiration time and session, in session array is written user id & login, is executed redirection to home page
(http://localhost/home). Home page is closed for non-authenticated users. If session is ended, but cookies exist 
user are able to open home page, session is extends (if browser were closed cookie will make not to logout for some
time. if you open the browser it will redirect to home page. Browser must not delete cookies). If authenticated 
user opens auth page (http://localhost/auth) he will be redirected to home page. Logout is redirect from home page
to auth page automatically. Project handles exceptions in case: wrong url, wrong login & password, empty fields 
of login & password. Password is stored in hash condition by SHA1.
#### How to run
* Clone the repository 
* Create file (in root dir of project) .env and copy data from .env.example in it
* ```docker-compose up -d```
* ```docker exec -it 59_mysql_1 /bin/sh```
* ```mysql -u root -p ``` password is: secret
* ```use mydb;```
* Run SQL queries:
```sql
create table users(
                      id int not null auto_increment,
                      login varchar(255) not null,
                      password varchar(255) not null,
                      PRIMARY KEY (id)
)default character set utf8;

insert into users (login, password) values ('alex', sha1('password'));
```
* Open in browser http://localhost/auth
* Enter login: alex, password: password
* Close browser
* Open browser, open http://localhost/auth
* Logout by logout link
