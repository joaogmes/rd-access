#!/bin/bash

# This script runs the specified commands.

# Log the script start
# echo "Script started" >> /home/joao/rd-access/init.log
sudo systemctl start mysql
cd ~/rd-access/ && nohup php init.php &
# Change directory to rd-access and run init.php using PHP in the background

# Log completion (optional)
# echo "Script completed" >> /home/joao/rd-access/init.log
