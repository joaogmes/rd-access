sudo mysql <<EOF
DROP USER 'rd'@'localhost';
FLUSH PRIVILEGES;
CREATE USER 'rd'@'localhost' IDENTIFIED BY 'access';
GRANT ALL PRIVILEGES ON *.* TO 'rd'@'localhost';
FLUSH PRIVILEGES;
EXIT;
EOF

# MySQL credentials
mysql_user="rd"
mysql_password="access"

# Define the path to the SQL file
creationFile="app/config/defaults/db-creation.sql"
updateFile="app/config/defaults/db-updates.sql"

# Execute the SQL file using MySQL
mysql -u $mysql_user -p$mysql_password <$creationFile
mysql -u $mysql_user -p$mysql_password <$updateFile
