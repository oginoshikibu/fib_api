## このリポジトリについて

[Fibonacci数](https://ja.wikipedia.org/wiki/%E3%83%95%E3%82%A3%E3%83%9C%E3%83%8A%E3%83%83%E3%83%81%E6%95%B0)を返すAPI。

## 構成概要

- ルーター: /routes/api.php
- コントローラー: /app/Http/Controllers/API/FibController.php
- モデル: /app/Models/NumSeq.php
- FeatureTest: /tests/Feature/FibApiTest.php
- UnitTest: /tests/Unit/FibTest.php

## ローカル実行環境

sailにより初期プロジェクトのインストールを実行した。
```bash
$ curl -s https://laravel.build/fib_api | bash
```

- Ubuntu (WSL2) 22.04 LTS
- Docker desktop 24.0
- PHP 8.2
- Composer 2.6

## API仕様

API URI: http://{IP Address}/fib

GETメソッドでクエリパラメータ`n`に正整数を渡すと、値が**文字列**（オーバーフロー対策）で返ってくる。
```shell
$ curl --location 'http://localhost/fib?n=99'

>   {
        "result": "218922995834555169026"
    }
```

リクエスト毎にO(N)の計算を行っているため、入力する整数が大きいと1 minのtimeoutに引っかかる。

