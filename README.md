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
```