#BirdBBS

> PHP Simple BBS V2EX(like), based on [YII framework 1.1.14](http://www.yiiframework.com). 

##Requirements
- MySQL 5.5
- PHP 5.3
- YII Framework1.1.14's requirements

##Install
> Beta version no install script, but you can install it manually

1. git clone project to your system

2. config your root (birdbbs/www/) dir in the webserver config file

3. load all *.sql (birdbbs/www/protected/data/) file to mysql server

4. replace your infomation in main.php (birdbbs/www/protected/config/main.php) file 

5. replace your infomation in params.php (birdbbs/www/protected/config/params.php)

```
server {
        set $htdocs /Users/outman/Repositories/birdbbs/www;
        listen 80;
        server_name dev.birdbbs.com;
        location / {
            root $htdocs;
            autoindex on;
            index index.php index.html;
    
           if (!-e $request_filename){
                rewrite (.*) /index.php?r=$1;
           }
       }
       location ~ \.php$ {
           include fastcgi_params;
           fastcgi_index index.php;
           fastcgi_pass  127.0.0.1:9000;
           fastcgi_param SCRIPT_FILENAME $htdocs$fastcgi_script_name;
           fastcgi_param PATH_INFO $fastcgi_script_name;
       }
}
```
##Online demo
> [http://bbs.buxiangshuo.cn](http://bbs.buxiangshuo.cn)

##Contact Us & Commercial Service
>pochonlee@gmail.com

##Github
>[https://github.com/outman/birdbbs](https://github.com/outman/birdbbs)

##GitOschina
>[http://git.oschina.net/outman/birdbbs](http://git.oschina.net/outman/birdbbs)

##Screen Snapshot

![系统截图](doc/images/3.png)
![系统截图](doc/images/7.png)

##License
>MIT
