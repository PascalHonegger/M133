CREATE USER 'paal_admin'
  IDENTIFIED BY 'paal_password';

GRANT ALL PRIVILEGES ON *.* TO 'paal_admin'@'%'
IDENTIFIED BY PASSWORD 'paal_password'
WITH GRANT OPTION;