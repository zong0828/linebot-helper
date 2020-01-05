# Line bot helper

[TOC]

## Introduction

line bot helper 是一個 line bot server ，其功能是藉由開通一個 line bot api 服務去計算與回覆使用者的問答。

### Design

> TODO List

1. 調整 RouteX -> ControllerX -> ServiceX -> Repository -> Model 架構
2. 調整 api request 與 exception log
3. 調整 exeption 的方式
4. 包裝 docker image

Rules :
| 功能 | 格式 | 介紹 |
| -------- | -------- | -------- |
| 記帳 | #pay,from,to,$,notes | 記帳功能 |
| 取得群組名單 | #group | 取得群組名單 |
| 取得個人帳戶紀錄 | #me | 取得別人需給自己多少歷程、取得自己需給別人多少歷程、取得正負金額 |

Example :
使用  #pay,Zong,Lin,1000,水費 => zong要給lin 1000 元 水費

## Build

### lumen 啟動方式

```bash=
# -t 指定目錄
php -S 0.0.0.0:80 -t public
```

### 用 ngrok proxy localhost:80

```bash=
ngrok http 80
```

### docker env command
TODO nginx setting

```bash=
docker create network side-project

# mysql
docker run --network side-project --name mysql -p 3306:3306 -e MYSQL_ROOT_PASSWORD=root -d mysql

# 基於 mysql 某版本之後加密方式的改變導致一些 sql client 無法連線
ALTER USER 'root'@'%' IDENTIFIED BY 'root' PASSWORD EXPIRE NEVER;
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';
FLUSH PRIVILEGES;

# nginx
docker pull nginx

docker run --network side-project --name side-project-nginx -p 80:80 -v ${PWD}:/usr/share/nginx/html/linebot-helper -d nginx
```

- 手動改 nginx 設定

```bash=
# 安裝 vim
apt-get update; apt-get install vim;
```
