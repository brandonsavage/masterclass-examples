# Object Oriented PHP Masterclass Repository

Welcome to the code repository for the Object Oriented PHP Masterclass.

You will use this repository to complete the lessons which you will receive daily over the next few weeks.

Warnings and Disclaimers
------------------------

THIS CODE IS PROVIDED WITH NO WARRANTY. IT HAS NOT BEEN SECURITY REVIEWED AND CONTAINS KNOWN SECURITY VULNERABILITIES. DO NOT RUN THIS CODE IN PRODUCTION ENVIRONMENTS.

Installing This Codebase
------------------------

**NOTE: these instructions are for Mac or Linux. You're unfortunately on your own for Windows.**

1. Fork this repository. You'll see the Fork option and you can fork it to your own GitHub.
2. Clone the repository using ```git clone```.
3. Create a virtual host (see the virtual host data at the bottom of this file). Also add an entry to your /etc/hosts file.
4. Create a database in MySQL.
5. Use the schema.sql file to create a database schema.
6. Copy config.php-init to config.php and fill in the database information.
7. Copy public/htaccess-dist to public/.htaccess.
8. Go to your local site and create a user account.

Virtual Host Configuration
--------------------------

Use the following VirtualHost configuration:

```
<VirtualHost *:80>
    ServerName news.local
    DocumentRoot /path/to/codebase/public

    <Directory /path/to/codebase/publicpublic>
        DirectoryIndex index.php
        AllowOverride all
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```
