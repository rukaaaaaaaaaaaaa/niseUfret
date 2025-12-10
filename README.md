# niseUfret

docker compose exec php bin/cake server -H 0.0.0.0 -p 8765

環境構築完了まとめ
以下の環境が整いました：
1. バックエンド（CakePHP 5.2.0 + PHP 8.1）
URL: http://localhost:8765
ディレクトリ: ./backend
起動コマンド:
docker compose exec php bin/cake server -H 0.0.0.0 -p 8765
2. フロントエンド（React + TypeScript + Vite）
URL: http://localhost:3000
ディレクトリ: ./frontend
起動中（ホットリロード対応）
3. データベース（MySQL 8.0）
ポート: 3306
データベース: app_db
ユーザー: app / パスワード: app_pass
ルート: root / パスワード: root
コンテナ管理コマンド
# すべてのサービスを起動
docker compose up -d

# すべてのサービスを停止
docker compose down

# ログを確認
docker compose logs -f

# 特定のコンテナに入る
docker compose exec php bash
docker compose exec frontend sh
s