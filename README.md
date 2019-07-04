# project-ETA for ITT
Examination tasks Administration for IT trainees.

## Installation

- install xampp
	- only choose: apache, mysql, php, phpmyadmin

- start the xampp control panel
	- open httpd.conf 
		- change document root to '\project-ETA_for_ITT\public'

- start apache

- start mysql
	- start phpmyadmin (by clicking the admin button of mysql)
		- create new database 'eta_for_itt'
		- import dump
		- create user = 'php_user'; pw = 'pu' 

- test connection 
    - type localhost in your browser and go
        - if it doesnt work start from the beginning
