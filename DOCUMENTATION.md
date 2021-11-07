# Synext framework documentation

## Insatallation !

The Synext Web component has some requirements who should be satisfied before make the installation . You will need to make sure that your server meets the following requirements

### Requirements


- **Php >= 7.4.5** 
- **Pdo Php Extension**
- **Json Php Extension**
- **Composer**

### Synext Installation

Synext use the dependency manager called **[composer](https://getcomposer.org/)** to manage required packages, so before continue make sure you already installed it

#### Via composer create projet

``` bash
$ composer create-project informatutos/synext blog 
```

#### Via GitHub
``` bash
$ git clone https://github.com/Informatutos/synext.git
```
or 

``` bash
$ gh repo clone Informatutos/synext
```

### Local Dev Serve

To run the local server you need to run the following command in the root path of your project

``` bash
$ php -S localhost:8000 -t public -d error_reporting=E_ALL
```
### Configuration 

After the installation finish check if in, 
- **the root path you have the `.env` file otherwise copy the `.env.example` and rename it to `.env`**
- **the `public` folder located on root directory you have the `.htaccess` file , it used to create a pretty url**

***Here is content of this file***

```RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule . index.php [L]
Options -Indexes
```