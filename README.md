# XXE-POC

This is a simple application that can be used to demo XXE vulnerabilities.

Credentials:
admin - password
hacker  - Ab123456

Setup in ubuntu:
apt-get install php-fdomdocument
sudo apt-get install php7.1-xml
sudo apt-get install php7.0-xml

Note: make sure that "orders" directory is writable

The app simulates a simple order processing system where users upload
XML files which are parsed by the app.
There are 2 example XML order files that can be downloaded.



forked from https://github.com/bojanisc/AcmeXXE and Customized.
