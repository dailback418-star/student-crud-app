<?php
// ================================
// ค่าระบบ
// ================================
$currentYear = 2569;

// ================================
// เตรียมตัวแปรเก็บข้อมูลผู้ใช้
// ================================
$users = [];

// ================================
// Function: คำนวณอายุ
// ================================
function calculateAge($birthYear, $currentYear) {
    return $currentYear - $birthYear;
}

// ================================
// Function: ตรวจสอบข้อมูลปีเกิดและอายุworkshop
// ================================
function validateData($birthYear, $currentYear) {

    if ($birthYear > $currentYear) {
        return "ข้อมูลปีเกิดไม่ถูกต้อง";
    }

    $age = calculateAge($birthYear, $currentYear);

    if ($age > 120) {
        return "ข้อมูลปีเกิดไม่ถูกต้อง";
    }

    return true; // ข้อมูลถูกต้อง
}

// ================================
// Function: ตรวจสอบสิทธิ์เข้าใช้งาน
// ================================
function checkAccess($age) {
    if ($age > 15) {
        return "✅ อนุญาตให้เข้าร่วมworkshop Programming";
    } else {
        return "❌ ไม่อนุญาตให้เข้าร่วม";
    }
}
function checkB($age) {
    if ($age > 18) {
        return "✅ อนุญาตให้เข้าร่วมhackathon";
    } else {
        return "❌ ไม่อนุญาตให้เข้าร่วม";
    }
}
function checkc($age) {
    if ($age >= 20) {
        return "✅ อนุญาตให้เข้าร่วมResearch Conference";
    } else {
        return "❌ ไม่อนุญาตให้เข้าร่วม";
    }
}
// ================================
// ประมวลผล Form
// ================================
if (isset($_POST['username']) && isset($_POST['birthYear'])) {

    $username = trim($_POST['username']);
    $birthYear = (int)$_POST['birthYear'];

    if (!empty($username) && $birthYear > 0) {

        $validationResult = validateData($birthYear, $currentYear);

        if ($validationResult === true) {

            $age = calculateAge($birthYear, $currentYear);
            $status = checkAccess($age);
            $status = checkB($age);
            $status = checkc($age);
            $object = calculateAge($birthYear, $currentYear,$age,$status);

            $users[] = [
                "username" => $username,
                "birthYear" => $birthYear,
                "age" => $age,
                "status" => $status,
                "object" => $object,
            ];

        } else {
            echo "<p style='color:red;'>$validationResult</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Age Gate Web App</title>
</head>
<body>

<h2>ระบบตรวจสอบสิทธิ์เข้าร่วมกิจกรรม</h2>

<form method="post">
    ชื่อผู้สมัคร:<br>
    <input type="text" name="username"><br><br>

    ปีเกิด (พ.ศ.):<br>
    <input type="number" name="birthYear"><br><br>
    ประเภทกิจกรรม:<br>
    <input type="select" name="object"><br><br>
    <button type="submit">เพิ่มผู้ใช้</button>
</form>

<hr>

<?php
// ================================
// แสดงผลผู้ใช้ทั้งหมด
// ================================
foreach ($users as $user) {
    echo "ชื่อผู้ใช้: " . htmlspecialchars($user['username']) . "<br>";
    echo "ปีเกิด: " . $user['birthYear'] . "<br>";
    echo "อายุ: " . $user['age'] . " ปี<br>";
    echo "สถานะ: " . $user['status'] . "<br>";
    echo "<hr>";
}
?>

</body>
</html>