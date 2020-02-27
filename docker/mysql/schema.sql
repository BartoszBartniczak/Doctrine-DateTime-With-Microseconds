CREATE TABLE test_datetime(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
        row_date timestamp(6) NOT NULL
) AUTO_INCREMENT=2;

INSERT INTO test_datetime (id, row_date) VALUES (1, '2020-01-20 22:09:12.457896');
