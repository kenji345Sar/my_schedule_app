## 概要
このプロジェクトは、ユーザーがスケジュールを作成し、スケジュールアイテムを追加できるWebアプリケーションです。ユーザーは自分のプロフィールを編集し、作成したスケジュールを表示、編集、削除することができます。このプロジェクトは、LaravelとVite、Tailwind CSS、Alpine.jsを使用しています。

## インストール

1. プロジェクトをクローンまたはダウンロードします。
2. `composer install` コマンドを実行して、依存関係をインストールします。
3. `npm install` コマンドを実行して、npmパッケージをインストールします。
4. .env ファイルを作成し、データベース接続情報を設定します。
5. `php artisan migrate` コマンドを実行して、データベースマイグレーションを実行します。
6. `php artisan serve` コマンドを実行して、ローカル開発サーバーを起動します。

## 設定

必要な設定は、.env ファイルで行います。データベース接続情報やメール設定など、必要な情報を正確に設定してください。

## 使い方と機能

1. `/register` にアクセスし、新規ユーザーを登録します。
2. `/login` にアクセスし、登録したユーザーでログインします。
3. `/dashboard` または `/schedules` にアクセスし、新しいスケジュールを作成します。
4. スケジュールの詳細ページにアクセスし、スケジュールアイテムを追加します。
5. スケジュールやスケジュールアイテムを編集または削除することができます。
6. `/profile` にアクセスし、ユーザーのプロフィールを編集します。

## 機能追加・変更

- ユーザーとスケジュールを多対多で対応させました。
- ログインユーザーが作成したスケジュールを取得できます。
- ログインユーザーに割り当てられたスケジュールを取得できます。
- 権限管理に `SchedulePolicy.php` を使用しました。
- 以下の制限が適用されています。
  1. 認証済みのすべてのユーザーがスケジュール一覧を表示できます。
  2. スケジュール作成者またはスケジュールに割り当てられたユーザーのみ、スケジュールの詳細を表示できます。
  3. 認証済みのすべてのユーザーがスケジュールを作成できます。
  4. スケジュール作成者のみ、スケジュールを更新・削除できます。

## スタイル適用

このプロジェクトでは、BootstrapとTailwind CSSを同時に使用しています。Laravel Breezeにより、一部のコンポーネントでTailwind CSSが既に適用されています。他の部分ではBootstrapと独自のCSSを適用しています。以下の手順に従って、プロジェクトにスタイルを適用してください。

<div style="padding-left: 20px;">
   <h3>Bootstrapのインポート</h3>
   <ol>
      <li>BootstrapのCSSファイルをプロジェクトにインポートします。</li>
      <li>必要に応じて、BootstrapのJavaScriptファイルもインポートします。</li>
   </ol>

   <h3>スタイルの適用</h3>
   <ol>
      <li>各コンポーネントやページごとに、BootstrapまたはTailwind CSSのどちらのスタイルを使用するかを明確に決定します。これにより、スタイルの競合を回避できます。</li>
      <li>Bootstrapのコンポーネントやスタイルが適用される範囲を限定するために、専用のCSSクラスを使用してください。</li>
   </ol>

   <h3>注意事項</h3>
   <ol>
      <li>全体的なデザインの一貫性やコードの維持性に影響を与える可能性があるため、どちらか一方のフレームワークに統一することを検討してください。</li>
      <li>必要に応じて、独自のCSSを追加して、プロジェクトのスタイルをカスタマイズできます。</li>
   </ol>
</div>


## 開発

1. `npm run dev` コマンドを実行して、開発モードでアプリケーションを実行します。
2. コーディング規約やブランチ戦略、プルリクエストの手順、テストの実行方法に関する情報を記載してください。

## リリースノート
プロジェクトの各バージョンに対する変更点を記録します。

## FAQ
プロジェクトに関する一般的な質問とその回答をリストアップします。

## ライセンス
プロジェクトのライセンスを明記します。
