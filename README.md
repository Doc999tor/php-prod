# php-prod

Nice and clean Nginx+Apache+PHP installation kit for Windows 64bit
A basis for Nginx frontend and Apache backend server, PHP as a backend language and MS SQL Server database
This branch uses PHP Slim microframework

## What it includes:
1. php-prod folder you drop on C drive
2. Nginx 1.15.6
	1. Listens to :8080 port
	2. Proxies all types of files to :8081
3. Apache 2.4.29
    1. Listens to :8081 port
    2. Minimum modules: core, mime_module, rewrite_module, security2_module, php7_module, logio_module, log_rotate_module
    3. Virtual hosts
    4. Commented `proxy` settings
    5. High `ThreadsPerChild` directive (for powerful servers)
    6. Logging: logs InOut bytes and timing for every request
    7. Slighly configured mod_security rules - blocks well-known user-agents like: Mozilla/5.0 Jorgee,w00tw00t,ZmEu
4. PHP 7.2.12 with Slim microframework

## How to install
`git clone https://github.com/Doc999tor/php-prod.git` in C drive
Nginx:
1. Open cmd in nginx directory and type:
2. `start nginx`
	1. To check `conf/nginx.conf` syntax: `nginx -t`
	2. To check if nginx runs: `tasklist /fi "imagename eq nginx.exe"`
Apache
1. Open cmd as administrator and type:
2. `bin\httpd.exe -k install` - will install Apache as Windows service
3. `bin\httpd.exe -k start`
Slim
1. Go to `www/example.com` directory
2. Run `composer install`. If you don't have Composer, you have to install it separately
Open `localhost:8080` in your browser and you will see a simple html page
    1. You can uncomment [line 5](https://github.com/Doc999tor/php-prod/blob/2455c6bb419cde5ba6479f36248f8fbf25d7c1fa/Apache24/htdocs/index.php#L5) and to print `phpinfo`

## How to use:
* Change the Nginx port to 80 (443 for https is not supported yet)
* Change the domain name in `\Apache24\conf\vhosts.conf` - `Define DOMAIN your_domain.com`
* Create a `www\your_domain.com` directory
* Drop in `www\your_domain.com` any static and php files
* If you want to add .htaccess file with Apache settings (`.htaccess` disabled due to performance reasons - `AllowOverride None`)
    * use Virtual host file (`\Apache24\conf\vhosts.conf`)
    * or create a `conf\my-custom-settings.conf` file with `.htaccess` content and `Include` this file into the main `conf\httpd.conf`
* `www/example.com/routes.php` - entry point to the application

### Todo
* Move mod_security to nginx
* Add caching settings
* Added DoS mitigating settings
* SSL + HTTP2
* XSS, Clickjacking and HSTS headers
