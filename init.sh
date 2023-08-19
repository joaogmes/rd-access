#!/bin/bash

# This script runs the specified commands.

# Log the script start
echo "Script started" >> /home/joao/rd-access/init.log

# Change directory to rd-access and run init.php using PHP
cd ~/rd-access/ && php init.php

# Log completion (optional)
echo "Script completed" >> /home/joao/rd-access/init.log
