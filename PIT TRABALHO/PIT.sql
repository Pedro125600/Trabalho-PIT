create database PIT;
use PIT;

create table conta
(
Id int auto_increment primary key ,
Nome varchar(80),
Sobrenome varchar(80),
Senha Varchar(80),
Email varchar (80),
Informacao varchar (100),
tel varchar(14),
cpf varchar(14)
);



select sobrenome from conta;

Select * from conta