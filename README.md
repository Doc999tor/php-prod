# php-prod

Nice and clean Apache+PHP installation kit for Windows 64bit  
A basis for Nginx frontend and Apache backend server, PHP as a backend language and MS SQL Server database

## What it includes:
1. php-prod folder you drop on C drive
2. Apache 2.4.29
    1. Minimum modules: core, mime_module, rewrite_module, security2_module, php7_module, logio_module, log_rotate_module
    2. Commented `proxy` settings
    3. High `ThreadsPerChild` directive (for powerful servers)
    4. Logging: logs InOut bytes and timing for every request
    5. Slighly configured mod_security rules - blocks well-known user-agents like: Mozilla/5.0 Jorgee,w00tw00t,ZmEu


## How to install
1. `git clone https://github.com/Doc999tor/php-prod.git` in C drive
2. Open cmd as administrator and type:
3. `bin\httpd.exe -k install` - will install Apache as Windows service
4. `bin\httpd.exe -k start`
5. Open `localhost` in your browser and you will see a simple html page
    1. You can uncomment [line 5](https://github.com/Doc999tor/php-prod/blob/2455c6bb419cde5ba6479f36248f8fbf25d7c1fa/Apache24/htdocs/index.php#L5) and to print `phpinfo`

## How to use:
* Drop in `Apache24\htdocs` any static and php files
* If you want to add .htaccess file with Apache settings (`.htaccess` disabled due to performance reasons - `AllowOverride None`)
    * use Virtual host file (will be added later)
    * or create a `conf\my-custom-settings.conf` file with `.htaccess` content and `Include` this file into the main `conf\httpd.conf`
    
### Todo
1. Add Virtual hosts support
2. Add Nginx as frontend
    * Move mod_security to nginx
    * Add caching and gzipping settings
    * Added DoS mitigating settings
    * SSL + HTTP2
    * XSS, Clickjacking and HSTS headers
