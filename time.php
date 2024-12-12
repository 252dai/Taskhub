<?php
session_start();
if(!isset($_SESSION['username'])){
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: login.php");
    exit;
}

try{
    $pdo = new PDO('mysql:host=localhost;dbname=project01', "root", "1234");
} catch(PDOException $e){
    echo $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームから送信された日付とイベント内容を取得
    $date = $_POST['date'] ?? '';
    $event = $_POST['event'] ?? '';

    if (!empty($date) && !empty($event)) {
        // データベースにイベントを追加
        $stmt = $pdo->prepare("INSERT INTO events (event_date, event_details) VALUES (:date, :event)");
        $stmt->execute(['date' => $date, 'event' => $event]);// 成功メッセージを表示
    } else {
        // 必須項目が入力されていない場合のエラーメッセージ
    }
}

// データベースから現在の月のイベントを取得
$currentMonth = date('Y-m'); // 現在の年月（YYYY-MM形式）
$stmt = $pdo->prepare("SELECT * FROM events WHERE event_date LIKE :currentMonth ORDER BY event_date");
$stmt->execute(['currentMonth' => "$currentMonth-%"]); // 月のデータを検索
$events = $stmt->fetchAll(PDO::FETCH_ASSOC); // 結果を配列で取得

// カレンダー生成の準備
define('DAYS_IN_WEEK', 7); // 1週間の日数
$daysInMonth = date('t'); // 現在の月の日数
$firstDayOfMonth = date('N', strtotime(date('Y-m-01'))); // 月初日の曜日（1:月曜日, 7:日曜日）
$weeks = ceil(($daysInMonth + $firstDayOfMonth - 1) / DAYS_IN_WEEK); // カレンダーに必要な週数
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="common2.css">
    <link rel="stylesheet" href="time.css">
    <title>Taskhub</title>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="header-right">
                <a href="projectVer1.php">トップ</a>
                <a href="register.php">登録</a>
                <a href="confirm.php">確認</a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <h1>スケジュール表</h1>

    <!-- カレンダー表示部分 -->
    <table>
        <tr>
            <th>Sun</th> <!-- 日曜日 -->
            <th>Mon</th> <!-- 月曜日 -->
            <th>Tue</th> <!-- 火曜日 -->
            <th>Wed</th> <!-- 水曜日 -->
            <th>Thu</th> <!-- 木曜日 -->
            <th>Fri</th> <!-- 金曜日 -->
            <th>Sat</th> <!-- 土曜日 -->
        </tr>
        <?php
        $day = 1 - $firstDayOfMonth + 1; // 最初の日付を計算
        for ($week = 0; $week < $weeks; $week++) {
            echo "<tr>";
            for ($d = 0; $d < DAYS_IN_WEEK; $d++) {
                if ($day > 0 && $day <= $daysInMonth) {
                    $currentDate = date('Y-m') . '-' . str_pad($day, 2, '0', STR_PAD_LEFT); // YYYY-MM-DD形式の日付
                    $hasEvent = false;

                    // イベントがあるか確認
                    foreach ($events as $event) {
                        if ($event['event_date'] === $currentDate) {
                            $hasEvent = true;
                            break;
                        }
                    }

                    // イベントがある場合は特別なスタイルを適用
                    echo $hasEvent ? "<td class='event'>" : "<td>";
                    echo $day; // 日付を表示
                    echo "</td>";
                } else {
                    // 空白のセルを埋める
                    echo "<td></td>";
                }
                $day++; // 日付を進める
            }
            echo "</tr>";
        }
        ?>
    </table>

    <!-- イベント追加フォーム -->
    <form method="POST">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required> <!-- 日付入力 -->
        <label for="event">Event:</label>
        <input type="text" id="event" name="event" required> <!-- イベント内容入力 -->
        <button type="submit">Add Event</button> <!-- 送信ボタン -->
    </form>
</body>
</html>
