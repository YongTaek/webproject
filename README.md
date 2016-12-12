# webproject

##Mysql Setting

```
[client]
default-character-set = utf8

[mysqld]
character-set-client-handshake=FALSE
init_connect="SET collation_connection = utf8_general_ci"
init_connect="SET NAMES utf8"
character-set-server = utf8
collation-server = utf8_general_ci

[mysqldump]
default-character-set = utf8

[mysql]
default-character-set = utf8

[apache server]
<Directory /var/www/html>
  Options -Indexes
</Directory>
<Directory /var/www/html/answer>
  Options -Indexes
</Directory>
<Directory /var/www/html/api>
  Options -Indexes
</Directory>
<Directory /var/www/html/api/board>
  Options -Indexes
</Directory>
<Directory /var/www/html/api/lecture>
  Options -Indexes
</Directory>
<Directory /var/www/html/api/user>
  Options -Indexes
</Directory>
<Directory /var/www/html/board>
  Options -Indexes
</Directory>
<Directory /var/www/html/board/answer>
  Options -Indexes
</Directory>
<Directory /var/www/html/board/free>
  Options -Indexes
</Directory>
<Directory /var/www/html/board/notice>
  Options -Indexes
</Directory>
<Directory /var/www/html/board/question>
  Options -Indexes
</Directory>
<Directory /var/www/html/comment>
  Options -Indexes
</Directory>
<Directory /var/www/html/common>
  Options -Indexes
</Directory>
<Directory /var/www/html/free>
  Options -Indexes
</Directory>
<Directory /var/www/html/icon>
  Options -Indexes
</Directory>
<Directory /var/www/html/lecture>
  Options -Indexes
</Directory>
<Directory /var/www/html/library>
  Options -Indexes
</Directory>
<Directory /var/www/html/notice>
  Options -Indexes
</Directory>
<Directory /var/www/html/public>
  Options -Indexes
</Directory>
<Directory /var/www/html/public/css>
  Options -Indexes
</Directory>
<Directory /var/www/html/question>
  Options -Indexes
</Directory>
<Directory /var/www/html/user>
  Options -Indexes
</Directory>
<Files init.php>
  Order allow,deny
  Deny from all
</Files>
```
