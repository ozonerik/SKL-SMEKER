## About SKL
<b>SKL</b>
adalah aplikasi untuk mendownload Surat Keterangan Lulus (SKL) SMK Negeri 1 Krangkeng secara online

## Minimum Server requirements
<ul>
    <li>PHP 8.2</li>
    <li>
        Enable PHP extension: <br>
        <code>curl, fileinfo, gd, intl, mbstring, mysqli, openssl, pdo_mysql, xsl, zip</code><br>
        Cek Your PHP Version<br>
        <code>php -v</code>
    </li>
</ul>

## How Install & Running
<p>
    open Terminal <br>
    <code>git clone https://github.com/ozonerik/SKL-SMEKER.git</code><br>
    <code>cd SKL-SMEKER</code><br>
    <code>composer install</code><br>
    <code>cp .env.example .env</code><br>
    <code>php artisan key:generate</code><br>
</p>
<p>
    open .env file and edit like below<br>
    <code>DB_CONNECTION=mysql</code><br>
    <code>DB_HOST=127.0.0.1</code><br>
    <code>DB_PORT=3306</code><br>
    <code>DB_DATABASE=skl</code><br>
    <code>DB_USERNAME=root</code><br>
    <code>DB_PASSWORD=</code><br>
</p>
<p>
    open Terminal <br>
    <code>php artisan migrate:fresh --seed</code><br>
     <code>php artisan storage:link</code><br>
    <code>php artisan optimize:clear</code><br>
    </code>
</p>

<p>
    NPM Run Build Vite::asset <br>
    <code>npm run build</code>
</p>

<p>
    Running Apps <br>
    <code>php artisan serve</code><br>
    Access <code>http://localhost:8000</code> via Browser
</p>

<p>
    Updated Apps <br>
    <code>git pull origin master</code><br>
    Access <code>http://localhost:8000</code> via Browser
</p>

## Features
<b><i>Features of eSawah v11.1</i></b>
<ul>
    <li>Lararvel 11.14</li>
    <li>Admin Dashboard using adminlte 4</li>
    <li>Bootstrap 5.3</li>
    <li>Livewire 3</li>
    <li>Datatable 2.1</li>
    <li>Spatie Permission 6</li>
    <li>Select2</li>
    <li>php-flasher 2</li>
    <li>Component Form</li>
    <li>image intervention 3</li>
</ul>

## Changelog
<b><i>Changelog of SKL</i></b>
<ul>
    <li>Fixed Profile Pages</li>
    <li>Fixed Component Form</li>
    <li>Fixed Adminlte 4</li>
    <li>Fixed Darkmode</li>
    <li>Fixed Roles User</li>
    <li>Fixed Multi Select Datatables</li>
    <li>Fixed Modal Bootstrap</li>
    <li>Fixed Flash Message</li>
    <li>Fixed Select2</li>
    <li>Fixed Photo Profile</li>
    <li>Fixed Compress Image</li>
</ul>

## Packages

- **[Laravel 11](https://laravel.com/docs/11.x/releases)**
- **[Livewire 3](https://livewire.laravel.com/docs/quickstart)**
- **[Bootstrap 5.3](https://getbootstrap.com/docs/5.3/getting-started/introduction/)**
- **[Bootstrap Icon](https://icons.getbootstrap.com/)**
- **[Spatie Permission 6](https://spatie.be/docs/laravel-permission/v6/introduction)**
- **[Admin LTE 4](https://github.com/ColorlibHQ/AdminLTE)**
- **[select2/select2](https://github.com/select2/select2)**
- **[datatables.net](https://datatables.net/examples/index)**
- **[Intervention/image-laravel](https://github.com/Intervention/image-laravel)**
- **[PHP Flasher](https://php-flasher.io/laravel/)**




## Developer

Aplikasi ini dibuat oleh  [M. Ade Erik](mailto:ozonerik@gmail.com)
