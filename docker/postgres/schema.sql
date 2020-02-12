CREATE SEQUENCE test_datetime_id_seq START WITH 2;

CREATE TABLE test_datetime(
    id int PRIMARY KEY NOT NULL DEFAULT nextval('test_datetime_id_seq'),
    row_date timestamp NOT NULL
);

INSERT INTO test_datetime (id, row_date) VALUES (1, '2020-01-20 22:09:12.457896');
