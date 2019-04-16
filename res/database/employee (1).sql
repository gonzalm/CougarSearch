-- Sample database from Elmasri and Navathe's
-- Fundamentals of Database Systems

-- uncomment this if you already created the database and you
-- want to start over (it deletes all the tables and data):
-- DROP SCHEMA company;

CREATE SCHEMA company;

USE company;
 
CREATE TABLE employee
(
	fname varchar(20),
	minit varchar(1),
	lname varchar(20),
	ssn varchar(9) NOT NULL,
	bdate varchar(10),
	address varchar(30),
	sex varchar(1),
	salary int,
	superssn varchar(9),
	dno int,
	PRIMARY KEY (ssn)
);

CREATE TABLE department
(
	dname varchar(20),
	dnumber int NOT NULL,
	mgrssn varchar(9),
	mgrstartdate varchar(10),
	PRIMARY KEY (dnumber)
);

CREATE TABLE dept_locations
(
	dnumber int NOT NULL,
	dlocation varchar(20) NOT NULL,
	PRIMARY KEY (dnumber, dlocation)
);

CREATE TABLE projects
(
	pname varchar(20),
	pnumber int NOT NULL,
	plocation varchar(20),
	dnum int,
	PRIMARY KEY (pnumber)
);

CREATE TABLE works_on
(
	essn varchar(9) NOT NULL,
	pno int NOT NULL,
	hours float,
	PRIMARY KEY (essn, pno)
);

CREATE TABLE dependent
(
	essn varchar(9) NOT NULL,
	dependent_name varchar(20) NOT NULL,
	sex varchar(1),
	bdate varchar(10),
	relationship varchar(10),
	PRIMARY KEY (essn, dependent_name)
);

-- ************* load the data *************
INSERT INTO employee
	(fname, minit, lname, ssn, bdate, address, sex, salary, superssn, dno)
VALUES
	('John','B','Smith','123456789','09-JAN-55','731 Fondren, Houston, TX','M',30000,'333445555',5),
	('Franklin','T','Wong','333445555','08-DEC-45','638 Voss, Houston, TX','M',40000,'888665555',5),
	('Alicia','J','Zelaya','999887777','19-JUN-58','3321 Castle, Spring TX','F',25000,'987654321',4),
	('Jennifer','S','Wallace','987654321','20-JUN-31','291 Berry, Bellaire, TX','F',43000,'888665555',4),
	('Ramesh','K','Narayan','666884444','15-SEP-52','975 Fire Oak, Humble, TX','M',38000,'333445555',5),
	('Joyce','A','English','453453453','31-JUL-62','5631 Rice Houston, TX','F',25000,'333445555',5),
	('Ahmad','V','Jabbar','987987987','29-MAR-59','980 Dallas, Houston, TX','M',25000,'987654321',4),
	('James','E','Borg','888665555','10-NOV-27','450 Stone, Houston, TX','M',55000,'null',1);	

INSERT INTO department
	(dname, dnumber, mgrssn, mgrstartdate)
VALUES
	('Research',5,'333445555','22-MAY-78'),
	('Administration',4,'987654321','01-JAN-85'),
	('Headquarters',1,'888665555','19-JUN-71');

INSERT INTO dept_locations
	(dnumber, dlocation)
VALUES
	(1,'Houston'),
	(4,'Stafford'),
	(5,'Bellaire'),
	(5,'Sugarland'),
	(5,'Houston');
	
INSERT INTO projects
	(pname, pnumber, plocation, dnum)
VALUES
	('ProductX',1,'Bellaire',5),
	('ProductY',2,'Sugarland',5),
	('ProductZ',3,'Houston',5),
	('Computerization',10,'Stafford',4),
	('Reorganization',20,'Houston',1),
	('Newbenefits',30,'Stafford',4);
	
INSERT INTO works_on
	(essn, pno, hours)
VALUES
	('123456789',1,32.500000000000000),
	('123456789',2,7.500000000000000),
	('666884444',3,40.000000000000000),
	('453453453',1,20.000000000000000),
	('453453453',2,20.000000000000000),
	('333445555',2,10.000000000000000),
	('333445555',3,10.000000000000000),
	('333445555',10,10.000000000000000),
	('333445555',20,10.000000000000000),
	('999887777',30,30.000000000000000),
	('999887777',10,10.000000000000000),
	('987987987',10,35.000000000000000),
	('987987987',30,5.000000000000000),
	('987654321',30,20.000000000000000),
	('987654321',20,15.000000000000000),
	('888665555',20,0),
	('123456789',3,15.000000000000000);
	
INSERT INTO dependent
	(essn, dependent_name, sex, bdate, relationship)
VALUES
	('333445555','Alice','F','05-APR-76','DAUGHTER'),
	('333445555','Theodore','M','25-OCT-73','SON'),
	('333445555','Joy','F','03-MAY-48','SPOUSE'),
	('987654321','Abner','M','29-FEB-32','SPOUSE'),
	('123456789','Michael','M','01-JAN-78','SON'),
	('123456789','Alice','F','31-DEC-78','DAUGHTER'),
	('123456789','Elizabeth','F','05-MAY-57','SPOUSE');
	
-- ************* foreign key constraints *************
-- I added the foreign keys after loading some initial data because
-- employee references department and department references employee;
-- there is no way to insert into them without some initial data
-- inserted without checking.

ALTER TABLE employee
	ADD FOREIGN KEY (dno) REFERENCES department(dnumber);
-- note: MySQL doesn't support the following self-referential foreign key:
-- ADD FOREIGN KEY (superssn) REFERENCES employee(ssn)

ALTER TABLE department
	ADD FOREIGN KEY (mgrssn) REFERENCES employee(ssn);

ALTER TABLE dept_locations
	ADD FOREIGN KEY (dnumber) REFERENCES department(dnumber);

ALTER TABLE projects
	ADD FOREIGN KEY (dnum) REFERENCES department(dnumber);

ALTER TABLE works_on
	ADD FOREIGN KEY (essn) REFERENCES employee(ssn),
	ADD FOREIGN KEY (pno) REFERENCES projects(pnumber);
	
ALTER TABLE dependent
	ADD FOREIGN KEY (essn) REFERENCES employee(ssn);	
			
	