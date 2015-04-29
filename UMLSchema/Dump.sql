create database if not exists mydb;

use mydb;

drop table if exists `Account`;
create table if not exists Account(
	`id` int(9) not null auto_increment,
	`pw` varchar(16) not null default '1111',
	primary key(`id`)
) engine=InnoDB default charset='utf8';

insert into `Account` (`pw`) 
			   VALUES ('1'),
                      ('2'),
                      ('3');

drop table if exists `User`;
create table if not exists User(
	`id` int(9) not null auto_increment,
	`name` varchar(64) default '',
	`family` varchar(64) default '',
	`address` varchar(128) default '',
	primary key(`id`)
) engine=InnoDB default charset='utf8';

insert into `User` (`name`, `family`, `address`) 
            VALUES ('name1','family1','address1'),
				   ('name2','family2','address2'),
				   ('name3','family3','address3');

select * from `Account`;
select * from `User`;