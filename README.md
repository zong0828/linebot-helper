# Line bot helper

[TOC]

## Introduction

line bot helper 是一個 line bot server ，其功能是藉由開通一個 line bot api 服務去計算與回覆使用者的問答。

### Design

> TODO List

1. 調整 RouteX -> ControllerX -> ServiceX -> Repository -> Model 架構
2. 調整 api request 與 exception log

Rules :
| 功能 | 格式 | 介紹 |
| -------- | -------- | -------- |
| 記帳 | #pay,from,to,$,notes | 記帳功能 |
| 取得群組名單 | #group | 取得群組名單 |
| 取得個人帳戶紀錄 | #me | 取得別人需給自己多少歷程、取得自己需給別人多少歷程、取得正負金額 |

Example :
使用  #pay,Zong,Lin,1000,水費 => zong要給lin 1000 元 水費

## Build

### mysql

用 docker 啟動 mysql，因為使用最新版本的 mysql 使用一些 sqlpro 等等 sql client 工具會因為密碼的加密方式改變(mysql_native_password -> caching_sha2_password) 因此需要把它改回來。

```bash=

# 啟動 mysql 容器
docker run --name mysql -p 3306:3306 -e MYSQL_ROOT_PASSWORD=root -d mysql

# 進入容器
docker exec -ti mysql bash

mysql -u root -p

ALTER USER 'root'@'%' IDENTIFIED BY 'root' PASSWORD EXPIRE NEVER;

ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';

FLUSH PRIVILEGES;
```

### lumen 啟動方式

```bash=
# -t 指定目錄
```

### 用 ngrok proxy localhost:80

```bash=
ngrok http 80
```
