show variables like 'sql_mode' ;
SET sql_mode = '';

/* Types of phone, house,office,mobile */
CREATE TABLE types
(
    type_id integer not null primary  key auto_increment,
    description varchar(200)
);

/* Types User Provider or Client */
CREATE TABLE type_user_data
(
    type_user_data_id integer not null primary key  auto_increment,
    description varchar(200)
);

CREATE TABLE user_data
(
    user_data_id integer not null primary key auto_increment,
    nit varchar(200),
    first_name varchar(200),
    last_name varchar(200),
    company_name varchar(200),
    address varchar(200),
    credit_days integer null,
    credit_limit integer(200) null,
    type_user integer not null,
    created_at timestamp,
    updated_at timestamp,
    contact_name varchar(200),
    status integer,
    foreign key (type_user) references type_user_data(type_user_data_id)
);

CREATE TABLE phone_data
(
    phone_id integer not null primary key auto_increment,
    user_data_id integer not null,
    type_id integer not null,
    number varchar(200),
    FOREIGN KEY (user_data_id) references user_data(user_data_id),
    foreign KEY (type_id) references types(type_id)
);

CREATE TABLE category
(
    category_id integer not null primary key auto_increment,
    code integer,
    description varchar(200),
    created_at timestamp,
    updated_at timestamp
);

CREATE TABLE sub_category
(
    SCategory_id integer not null primary key auto_increment,
    code integer,
    category_id integer not null,
    description varchar(200),
    created_at timestamp,
    updated_at timestamp,
    FOREIGN KEY(category_id) references category(category_id)
);


/* Insert Data */
select * from types;
insert into types(description) values('casa'),('oficina'),('celular');

select * from type_user_data;
insert into type_user_data(description) values('proveedor'),('cliente');

select * from user_data;
update user_data set type_user = 2 where user_data_id > 3

update user_data set status = 1 where user_data_id = 2;

select * from phone_data;

SELECT
       provider.user_data_id,
       provider.nit,
       provider.address,
       provider.credit_days,
       provider.credit_limit,
       UPPER(provider.company_name) AS company_name,
       UPPER(provider.contact_name) AS contact_name,
       max(case when phones.type_id = '1' then number end) as principal,
       max(case when phones.type_id = '2' then number end) as secundario,
       max(case when phones.type_id = '3' then number end) as contacto
FROM user_data provider
         LEFT JOIN phone_data phones ON phones.user_data_id = provider.user_data_id
WHERE provider.status = 1
group by provider.company_name,1,2,3
order by provider.company_name
