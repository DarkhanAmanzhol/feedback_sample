#!/bin/bash

echo -e "\nSTOPING DOCKER\n"
docker compose down

echo -e "\nREMOVING DOCKER IMAGE\n"
docker image rm feedback-project-php

echo -e "\nREMOVING VOLUME\n"
docker volume rm feedback-project_mysql_data
