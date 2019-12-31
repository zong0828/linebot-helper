# Line bot helper

line bot helper 是一個 line bot server ，其功能是藉由開通一個 line bot api 服務去計算與回覆使用者的問答。

## lumen 啟動方式

```bash=
# -t 指定目錄
php -S 0.0.0.0:80 -t public
```

## 用 ngrok proxy localhost:80

```bash=
ngrok http 80
```
