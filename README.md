# Laravel Core for Training

## Requirements
- VirtualBox: Windows 10 use version 5.1.38, MacOS Catalina use version 5.2.38
- Vagrant 2.1.2

## Install Laravel Homestead
Skip this step if Homestead was installed before

### Download Homestead
Download [Laravel Homestead](https://drive.google.com/file/d/1zGZuWjPhhjqoKHF3DkRkIG-jxazlpPlB/view) and unzip **laravel-homestead.zip**
```
    --laravel-homestead
        |--.ssh
            |--id_rsa_member_board
            |--id_rsa_member_board.pub
        |--.vagrant.d
            |--boxes
                |--laravel-VAGRANTSLASH-homestead
        |--homestead
            |--...
            |--Homestead.yaml
            |--...
```

### Prepare vagrant box:
Copy folder 
```bash
    laravel-homestead\.vagrant.d\boxes\laravel-VAGRANTSLASH-homestead
```

to folder
```bash
    C:\Users\{username}\.vagrant.d\boxes
```

### Prepare ssh key:
Copy file
```
    laravel-homestead\.ssh\id_rsa_member_board
    laravel-homestead\.ssh\id_rsa_member_board.pub
```

to folder
```bash
    C:\Users\{username}\.ssh
```

## Connect source code laravel_core to Homestead

### Clone source code
Ex: <path/to/projectroot> = D:\Source\laravel_code
```bash
    $ cd D:\Source
    $ git clone git@github.com:bisync/laravel_core.git -b dev
```

### Connect
Edit file config **laravel-homestead\homestead\Homestead.yaml**:
```yaml
    # Configure ip, memory and cpus
    ip: "192.168.19.19"
    memory: 4048
    cpus: 2

    # Configure path to source files:
    folders:
    - map: <path/to/projectroot>
      to: /home/vagrant/laravel_code/
    sites:
    - map: local-laravel-core.betech.com
      to: /home/vagrant/laravel_code/web/public
    databases:
        - laravel_core
```

## Redirect
Open hosts file and add below line

``` bash
    192.168.19.19   local-laravel-core.betech.com
```


## Run

### Start Virtual machine
```bash
    $ cd {path/to/homestead}
    $ vagrant up
```

### Close Virtual machine
```bash
    $ cd {path/to/homestead}
    $ vagrant halt
```

### Reflect Virtual machine
```bash
    $ cd {path/to/homestead}
    $ vagrant up --provision
```

### Update web dependency
```bash
    $ vagrant ssh
    [vagrant@localhost ~]$ cd laravel_core/web
    [vagrant@localhost ~/laravel_core/web$]$ composer self-update --2
    [vagrant@localhost ~/laravel_core/web$]$ composer install
    [vagrant@localhost ~/laravel_core/web$]$ composer dump-autoload
```

### Create database and data:
``` bash
    $ php artisan db:seed
```

### Access
```bash
    http://local-laravel-core.betech.com/
```

### Admin users:
  - Superadmin: superadmin@betech-vn.com
  - Admin: admin@betech-vn.com
  - Default password: betech1111


- Create new module (https://nwidart.com/laravel-modules/v6/advanced-tools/artisan-commands):
``` bash
    $ php artisan module:make Api
```

- Create new migration inside module:
``` bash
    $ php artisan module:make-migration create_api_request_logs_table Api
```

- Run migration inside module:
``` bash
    $ php artisan module:migrate Api
```

# Cheat sheets

## Form
``` php
    {{ Form::open(['url' => 'foo/bar', 'method' => 'put']) }}
    // Point to url
    {{ Form::close() }}

    {{ Form::open(['route' => ['route.name', $user->id]]) }}
    // Point to named routes
    {{ Form::close() }}

    {{ Form::open(['action' => ['Controller@method', $user->id]]) }}
    // Point to action
    {{ Form::close() }}

    {{ Form::open(['url' => 'foo/bar', 'files' => true]) }}
    // Accept file uploads
    {{ Form::close() }}
```

## If statement
``` php
    @if (condition)
    @else
    @endif
```

## For statement
```php
    @foreach($arrModules as $module)
    @endforeach
```