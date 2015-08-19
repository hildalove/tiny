# Tiny PHP Framewokr

目前只支持 tiny.dev/home/index 这种路由格式
### Nginx配置
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

### 框架特点
- 单入口文件
- 采用了单例模式、工厂模式、注册模式
- 基于psr-4 类的自动加载
- PDO 连接读写分离 
- Redis连接




