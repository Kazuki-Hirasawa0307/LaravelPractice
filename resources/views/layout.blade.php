<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>タスク管理アプリ</title>
    @yield('styles')
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="my-navbar">
            <a class="my-navbar-brand" href="/folders/1/tasks">案件マスタ</a>
            <a class="my-navbar-brand" href="/folders/1/tasks">人員計画表</a>
            <a class="my-navbar-brand" href="/folders/1/tasks">ユーザー追加</a>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    @yield('scripts')
</body>

</html>

{{-- レイアウトとは枠組み、骨組みのような意味合いでしょうか。ページごとに変わらない部分だけを記述します。
ページごとに変化する部分は @yield で穴埋めにしています。いろいろ説明するよりページのテンプレートを見たほうが分かりやすいと思いますので、
まずは先ほど作成したタスク作成ページのテンプレート resources/views/tasks/create.blade.php を以下の通りに編集してください。 --}}
