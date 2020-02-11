CREATE TABLE test_datetime(
    id SERIAL PRIMARY KEY NOT NULL,
    row_date timestamp NOT NULL
);

INSERT INTO test_datetime (id, row_date) VALUES (1, '2020-01-20 22:09:12.457896');
ALTER SEQUENCE test_datetime_id_seq START WITH 2;
