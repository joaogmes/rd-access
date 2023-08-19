sudo apt update &&
sudo apt install net-tools -y &&
sudo apt-get install tmux -y &&
sudo apt install php8.0 -y &&
sudo apt install php8.0-mysql -y &&
sudo apt install php8.0-mbstring -y &&
sudo apt install mariadb-server-10.0 -y &&
sudo apt install php8.0-curl #-y &&
#sudo apt install mysql-server -y &&
sudo apt install npm -y &&
sudo apt install composer -y &&
composer require slim/slim &&
composer require slim/psr7
./database.sh
