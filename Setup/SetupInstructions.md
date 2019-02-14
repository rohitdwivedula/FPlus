# Setup & Installation Instructions

## Database Setup 

This application requires MySQL. Once MySQL has been installed, open the file ```db_setup.sql``` and copy the entire file. Paste and execute the file in the MySQL command prompt. 

## GMail API Setup

1. This application uses the PHP GMail API to send emails to users. You need to activate the API before being able to use this application.
2. Go to the [GMail PHP QuickStart page](https://developers.google.com/gmail/api/quickstart/php). Turn on the GMail API, and install composer using ```sudo apt install composer```.
3. Navigate to ```fplus/Setup``` and run the command ```composer require google/apiclient:^2.0``` to gather the required libraries. 
4. Execute ```php gmail_api_setup.php```
5. You will be prompted to authorize email access. Once you've granted permission, the authetication flow is complete and GMail API can be used by FPlus. 