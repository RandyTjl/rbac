# rbac
#这是一个基于rbac的权限管理包，包含了数据库设计和初始数据创建

#目的是为了快速创建数据库和定义初始数据

#第一步下载包
composer require randy-tang/rbac 1.0（版本标签号）

#第二步发布包,发布包后会在migrations里面复制数据库文件，在seeds里面也会复制初始数据包
php artisan vendor:publish --provider="Randy\Rbac\RbacServiceProvider"

#第三步
运行php artisan migrate 创建数据库

#第四步运行
php artisan make:seeder perSeeder
完成数据填充

#包发现
laravel5.5 一下的需要到config/app.php里面去添加服务提供者和门面
服务提供者 Randy\Rbac\RbacServiceProvider::class
门面  'Rbac' => Randy\Rbac\Facades\Rbac::class,

laravel5.5 以上已经添加了包自动发现不需要在手动添加


#安装后方法路径
vendor\randy-tang\rbac\src\Http\Rbac.php


