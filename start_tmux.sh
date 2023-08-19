#/bin/bash

# Inicie o tmux e execute o comando dentro dele
echo "teste"
sudo systemctl start mysql
tmux new-session -s php_session "php /home/joao/rd-access/init.php"
nohup php /home/joao/rd-access/init.php
