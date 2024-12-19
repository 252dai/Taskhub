<?php
session_start(); //セッション開始
if(!isset($_SESSION['username'])){
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: login.php");
    exit;
}

try{   // データベース接続
    $pdo = new PDO('mysql:host=localhost;dbname=project01', "root", "1234");
} catch(PDOException $e){
    echo $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // フォームからのPOSTリクエストを処理
    $date = $_POST['date'] ?? '';            // フォームの'date'データを取得
    $event = $_POST['event'] ?? '';          // フォームの'event'データを取得

    if (!empty($date) && !empty($event)) { // データが空でない場合、データベースに挿入
        $stmt = $pdo->prepare("INSERT INTO events (event_date, event_details) VALUES (:date, :event)");
        $stmt->execute(['date' => $date, 'event' => $event]);
    }
}

$currentMonth = date('Y-m'); // 現在の月を取得

 // 現在の月のイベントを取得
$stmt = $pdo->prepare("SELECT * FROM events WHERE event_date LIKE :currentMonth ORDER BY event_date");
$stmt->execute(['currentMonth' => "$currentMonth-%"]);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

 // カレンダーの計算用定数と値路を設定
define('DAYS_IN_WEEK', 7); // 1週間の日数
$daysInMonth = date('t'); // 現在の月の日数
$firstDayOfMonth = date('N', strtotime(date('Y-m-01'))); // 現在の月の最初の日の曜日を
$weeks = ceil(($daysInMonth + $firstDayOfMonth - 1) / DAYS_IN_WEEK); // カレンダーに必要な週数を計算
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

    <table>
        <tr>
            <th>Sun</th>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
        </tr>
        <?php // カレンダーの日付を計算して描画
        $day = 1 - $firstDayOfMonth + 1; // カレンダーの最初の日を計算
        for ($week = 0; $week < $weeks; $week++) { // 各週を処理
            echo "<tr>";
            for ($d = 0; $d < DAYS_IN_WEEK; $d++) { // 各曜日を処理
                if ($day > 0 && $day <= $daysInMonth) { // 月内の日付である場合
                    $currentDate = date('Y-m') . '-' . str_pad($day, 2, '0', STR_PAD_LEFT); // 現在の日付を作成
                    $hasEvent = false; // イベントの有無を初期化
                    $eventDetails = ''; // イベントの詳細を初期化

                    foreach ($events as $event) {
                        if ($event['event_date'] === $currentDate) { // 日付が一致するイベントがある場合
                            $hasEvent = true;
                            // 確実に文字列を取得
                            $eventDetails = isset($event['event_details']) ? htmlspecialchars($event['event_details']) : ''; // HTMLエスケープしたイベントの詳細
                            break;
                        }
                    }

                    echo $hasEvent ? "<td class='event'>" : "<td>"; // 日付セルを描画
                    echo $day;  // 日付を表示
                    if ($hasEvent) {
                        echo "<div class='event-content'>{$eventDetails}</div>"; // イベント内容を表示
                    }
                    echo "</td>";
                } else { // 月外の日付けセルの場合
                    echo "<td></td>";
                }
                $day++; // 次の日へ
            }
            echo "</tr>";
        }
        ?>
    </table>

    <form method="POST">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <label for="event">Event:</label>
        <input type="text" id="event" name="event" required>
        <button type="submit">Add Event</button>
    </form>
</body>
</html>
