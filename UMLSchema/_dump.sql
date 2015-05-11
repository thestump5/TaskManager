/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     30.04.2015 16:45:29                          */
/*==============================================================*/


alter table Account
   drop primary key;

drop table if exists Account;

alter table Comments
   drop primary key;

drop table if exists Comments;

alter table Project
   drop primary key;

drop table if exists Project;

alter table Rule
   drop primary key;

drop table if exists Rule;

alter table Task
   drop primary key;

drop table if exists Task;

alter table Text
   drop primary key;

drop table if exists Text;

alter table User
   drop primary key;

drop table if exists User;

/*==============================================================*/
/* Table: Account                                               */
/*==============================================================*/
create table Account
(
   account_id           int not null,
   user_id              int,
   pw                   varchar(16),
   IP                   varchar(16),
   etc                  varchar(256)
) engine=InnoDB cherset='utf8';

alter table Account
   add primary key (account_id);

/*==============================================================*/
/* Table: Comments                                              */
/*==============================================================*/
create table Comments
(
   comments_id          int not null,
   task_id              int,
   ansver               smallint
) engine=InnoDB cherset='utf8';

alter table Comments
   add primary key (comments_id);

/*==============================================================*/
/* Table: Project                                               */
/*==============================================================*/
create table Project
(
   project_id           int not null,
   title                varchar(64)
) engine=InnoDB cherset='utf8';

alter table Project
   add primary key (project_id);

/*==============================================================*/
/* Table: Rule                                                  */
/*==============================================================*/
create table Rule
(
   rule_id              int not null,
   account_id           int,
   attribute            varchar(64)
) engine=InnoDB cherset='utf8';

alter table Rule
   add primary key (rule_id);

/*==============================================================*/
/* Table: Task                                                  */
/*==============================================================*/
create table Task
(
   task_id              int not null,
   User                 int,
   Project              int,
   title                varchar(64),
   desctiption          varchar(256),
   user_story           text,
   date                 timestamp,
   status               varchar(8),
   complexity           varchar(8),
   dialog               smallint
) engine=InnoDB cherset='utf8';

alter table Task
   add primary key (task_id);

/*==============================================================*/
/* Table: Text                                                  */
/*==============================================================*/
create table Text
(
   text_id              int not null,
   task_id              int,
   comments_id          int,
   User                 int,
   text                 text,
   date                 timestamp
) engine=InnoDB cherset='utf8';

alter table Text
   add primary key (text_id);

/*==============================================================*/
/* Table: User                                                  */
/*==============================================================*/
create table User
(
   user_id              int not null,
   name                 varchar(64),
   family               varchar(64),
   address              varchar(64),
   pidproject           int
) engine=InnoDB cherset='utf8';

alter table User
   add primary key (user_id);

alter table Account add constraint FK_AccountUser foreign key (user_id)
      references User (user_id) on delete cascade on update cascade;

alter table Comments add constraint FK_DialogComments foreign key (task_id)
      references Task (task_id) on delete cascade on update cascade;

alter table Rule add constraint FK_AcoountRule foreign key (account_id)
      references Account (account_id) MATCH FULL on delete cascade on update cascade;

alter table Task add constraint FK_ProjectTask foreign key (Project)
      references Project (project_id) on delete cascade on update cascade;

alter table Task add constraint FK_TaskUser foreign key (User)
      references User (user_id) on delete restrict on update restrict;

alter table Text add constraint FK_DialogText foreign key (task_id)
      references Task (task_id) on delete restrict on update restrict;

alter table Text add constraint FK_TexUser foreign key (User)
      references User (user_id) on delete cascade on update cascade;

alter table Text add constraint FK_TextComments foreign key (comments_id)
      references Comments (comments_id) on delete cascade on update cascade;

alter table User add constraint FK_ProjectUser foreign key (pidproject)
      references Project (project_id) on delete restrict on update restrict;

