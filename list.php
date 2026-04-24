<?php
// ===== 1. Database Config =====
$host = "localhost";
$user = "root";
$pass = "";
$db   = "student"; // ตรวจสอบให้แน่ใจว่าใน DBeaver ชื่อ Database คือ student (หรือ st)

// ===== 2. Connect Database =====
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection  failed: " . $conn->connect_error);
}

// ===== 3. Fetch Data =====
// แก้ไขจาก students เป็น student ให้ตรงกับชื่อตารางใน Database
$sql = "SELECT id, name, email, phone FROM student ORDER BY id DESC";
$result = $conn->query($sql);
?>
// This is the student list table
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 40px; background-color: #f9f9f9; }
        table { border-collapse: collapse; width: 100%; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #eee; padding: 12px 15px; text-align: left; }
        th { background-color: #f4f4f4; color: #333; }
        tr:hover { background-color: #f1f1f1; }
        a { text-decoration: none; color: #007bff; font-weight: bold; }
        a:hover { color: #0056b3; }
        .btn { 
            padding: 8px 15px; 
            border: none; 
            background: #28a745; 
            color: white; 
            border-radius: 4px; 
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn:hover { background: #218838; color: white; }
        .action-links a { font-weight: normal; font-size: 14px; }
    </style>
</head>
<body>

<h2>📋 Student List</h2>

<a href="add.php" class="btn">+ Add Student</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th style="width: 120px;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td class="action-links">
                        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | 
                        <a href="delete.php?id=<?= $row['id'] ?>" 
                           style="color: #dc3545;"
                           onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center;">No data found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>

<?php
// ===== 4. Close Connection =====
$conn->close();
?>