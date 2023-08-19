echo "Starting MYSQL..."
sudo systemctl start mysql
echo "Starting API..."
tmux new-session -d -s catraca_api "cd /home/joao/rd-access && php -S localhost:8080"
echo "Done!"