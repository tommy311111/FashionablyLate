# お問い合わせフォーム
## 環境構築

Dockerビルド
1. git clone git@github.com:tommy311111/FashionablyLate.git
2. docker-compose up -d --build

 Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. .env.exampleファイルから.envを作成し、環境変数を変更
4. php artison key:generate
5. php artisan migrate
6. php artisan db:seed

使用技術
- PHP 7.4.9
- Laravel 8.83.3
- MyCQL 8.0.26

ER図




- 開発環境：http://localhost/
- phpMyAdmin : http://localhost:8080/
