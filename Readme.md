CREATE TABLE employees (
    id integer NOT NULL DEFAULT nextval('employees_id_seq'),
	company_id int,
	name varchar(100) not null,
	surname varchar(100),
	telephone varchar(20),
	salary decimal
);
 
ALTER SEQUENCE employees_id_seq
OWNED BY employees.id;

===================

CREATE TABLE companies (
    id integer NOT NULL DEFAULT nextval('companies_id_seq'),
	name varchar(100) not null,
	address varchar(100),
	license_no varchar(14) not null
);
 
ALTER SEQUENCE companies_id_seq
OWNED BY companies.id;