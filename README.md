# rbac
这是一个基于rbac的权限管理包，包含了数据库设计和初始数据创建

目的是为了快速创建数据库和定义初始数据

第一步下载包
composer require randy-tang/rbac 1.0（版本标签号）

第二步发布包,发布包后会在migrations里面复制数据库文件，在seeds里面也会复制初始数据包
php artisan vendor:publish  Randy\Rbac\RbacServiceProvider

第三步运行php artisan migrate 创建数据库

第四步运行
php artisan make:seeder perSeeder
完成数据填充
