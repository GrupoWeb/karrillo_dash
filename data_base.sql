CREATE TABLE types
(
    type_id integer not null primary  key auto_increment,
    description varchar(200)
);

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
    credit_limit integer null,
    type_user integer not null,
    created_at timestamp,
    updated_at timestamp,
    contact_name varchar(200),
    status integer,
    foreign key (type_user) references type_user_data(type_user_data_id)

)

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
