## 项目基于[Laravel](https://github.com/laravel/laravel)5.6版本构建

### 项目安装  
1. 拉取项目到本地  
    ```
    git clone https://github.com/ihavenodream/laravel.git
    ```
2. 安装依赖  
    ```
    npm install  
    composer install
    ```
3. 创建环境配置文件  
    ```
    cp .env.example .env
    ```
4. 生成加密密钥  
    ```
    php artisan key:generate
    ```
5. 修改.env配置文件为自己的配置  
    ```
    APP_URL=  

    DB_CONNECTION=mysql  
    DB_HOST=127.0.0.1  
    DB_PORT=3306  
    DB_DATABASE=one  
    DB_USERNAME=root  
    DB_PASSWORD=  
    ```
6. 执行数据库表迁移  
    ```
    php artisan migrate
    ```  
7. admin数据写入  
    ```
    php artisan admin:install
    php artisan db:seed
    ```
8. 邮件发送服务使用的是[SendCloud](https://sendcloud.sohu.com/)提供的服务，注册后填写`.env`如下两项  
    ```
    SEND_CLOUD_USER=  
    SEND_CLOUD_KEY=  
    ```  
9. 如无意外就可以正常使用了  
***
## 说明
1. 后台模块  
    后台登陆地址为domain.com/admin  
    初始登陆账号/密码为:admin/admin  
2.   
***
