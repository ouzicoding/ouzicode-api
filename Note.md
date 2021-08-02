# 路由
注册路由模块：app/Providers/RouteServiceProvider.php

# 数据库
### 迁移
##### 生成迁移  
    php artisan make:migration create_users_table
    php artisan make:migration create_users_table --create=users
        --create指定使用Schema的create方法创建表，指定表名users（并不是把users表导出为迁移类）；
    php artisan make:migration alter_users_table --table=users
        --table指定使用Schema的table方法修改表，指定表名users;
##### 执行迁移
    php artisan migrate
##### 转出为sql
    php artisan schema:dump
        以数据库为源，而不是迁移类；存储目录为：database/schema；
