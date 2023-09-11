
select * from conta ;
select * from ideia ;

use pit ;
create database pit ;
 CREATE TABLE  conta (
    id int not null primary key auto_increment ,
    Nome VARCHAR(50),
    Sobrenome VARCHAR(50),
    Senha VARCHAR(50),
    Email VARCHAR(50),
    Informacao VARCHAR(50),
    tel VARCHAR(50),
    cpf VARCHAR(50),
    tipo varchar(50)
);

create table ideia (
id int not null primary key auto_increment ,
nome_ideia varchar(100),
descricao varchar(200),
Valor_nin varchar(100),
foto longblob,
tipo_apoiador varchar(50), 
Tag varchar(50),
tipo_ideia varchar(50),
Email VARCHAR(50)
)

