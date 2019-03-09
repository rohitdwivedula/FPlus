# Setup & Installation Instructions

This application's root has two major sub-folders: ```private``` and ```public_html```. The ```private``` files can be accessed only on the server while the files inside the ```public_html``` directory can be accessed by anyone. To begin using this app, configure the Apache server to have ```DOCUMENT_ROOT``` as ```/FPlus/public_html```. Once this is done, you will have to setup the databases required and connect to the various APIs that this project uses.

## Database Setup 

This application requires MySQL. Once MySQL has been installed, open the file ```/private/db_setup.sql``` and copy the entire file. Paste and execute the file in the MySQL command prompt. 

## GMail API Setup

1. This application uses the PHP GMail API to send emails to users. You need to activate the API before being able to use this application.
2. Go to the [GMail PHP QuickStart page](https://developers.google.com/gmail/api/quickstart/php). 
3. Turn on the GMail API, and download the client configuration file and save them in the working directory.
4. Install composer using ```sudo apt install composer```.
5. Navigate to ```/private/gmail``` and run the command ```composer require google/apiclient:^2.0``` to gather the required libraries. 
6. Execute ```php gmail_api_setup.php```
7. You will be prompted to authorize email access. Once you've granted permission, the authetication flow is complete and GMail API can be used by FPlus.