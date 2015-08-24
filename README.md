# Tiny PHP Framework

目前只支持 tiny.dev/home/index 这种路由格式
### Nginx配置
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

### 框架特点
- 单入口文件
- 采用了单例模式、工厂模式、注册模式
- 基于psr-4的自动加载
- Mysql 读写分离 
- Redis连接

### Example
- Redis存储用户登录信息
- 用Redis实现消息队列



