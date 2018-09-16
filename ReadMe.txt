1) Install docker, docker-compose
2) Setup the network in docker-compose.yml
      2.1) Comment out the external network
      2.2) Enable the new network 

networks:
 app_net:
  driver: bridge
  ipam:
   driver: default
   config:
    - subnet: 10.0.0.0/24
      gateway: 10.0.0.1

3) Add host to /etc/hosts file

     10.0.0.10 dev.ecommerce.com

4) Up (First time) and Start the docker-composer
     
     docker-compose up

5) Migrate Database tables and demo data
 
     php artisan db:migrate
     php artisan db:seed --class=DatabaseSeeder

6) After containers loaded visit the http://dev.ecommerce.com