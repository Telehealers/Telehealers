# Telehealers Source
This repo contains source of telehealers, written primarily in/using PHP, JS.

## Deployment Step
1. [One Time] Install docker
2. Load environment variables(see .env for reference)
2. In base directory do `docker-compose up` (might require sudo access). 
2. [One Time] Load data into db(mysql container). (At localhost:3306)
2. [One Time][On Deployment] Change SSL certificate of apache server.
2. Site will be up at `https://localhost:8443`

## Environment Variable
* DB_USERNAME
* DB_PASSWORD
* DB_NAME
* DB_HOSTNAME
* APACHE_LOG_VOLUME: Folder to log apache error into.
