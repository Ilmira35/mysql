<?php
include "../config/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM classes WHERE id = ?";
    $data = $conn->prepare($sql);
    $data->execute([$id]);
    $class = $data->fetch();

    if (!$class) {
        header("Location: index.php");
        exit();
    }
}

$teacher_query = "SELECT id, first_name, last_name FROM teachers";
$teacher_data = $conn->prepare($teacher_query);
$teacher_data->execute();
$teachers = $teacher_data->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_name = $_POST['class_name'];
    $teachers_id = $_POST['teachers_id'];
    $id = $_POST['id'];

    if (!empty($class_name) && !empty($teachers_id)) {
        $update_sql = "UPDATE classes SET class_name = ?, teachers_id = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        if ($stmt->execute([$class_name, $teachers_id, $id])) {
            header("Location: index.php?status=updated");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinfni tahrirlash</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #4f46e5; --bg: #f8fafc; --white: #ffffff; --text: #1e293b; --border: #e2e8f0; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .form-card { background: var(--white); width: 100%; max-width: 450px; padding: 40px; border-radius: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid var(--border); }
        .form-card h2 { font-size: 24px; font-weight: 700; margin-bottom: 30px; text-align: center; color: var(--text); }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #64748b; }
        input, select { width: 100%; padding: 12px; border: 1.5px solid var(--border); border-radius: 12px; font-size: 15px; outline: none; background: #f8fafc; transition: 0.3s; }
        input:focus, select:focus { border-color: var(--primary); background: #fff; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
        .btn-update { width: 100%; padding: 14px; background: var(--primary); color: white; border: none; border-radius: 12px; font-size: 16px; font-weight: 700; cursor: pointer; transition: 0.3s; }
        .btn-update:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3); }
        .back-link { display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #64748b; font-size: 14px; }
    </style>
</head>
<body>

    <div class="form-card">
        <h2><i class="fa-solid fa-pen-to-square"></i> Tahrirlash</h2>

        <form method="POST">
            <input type="hidden" name="id" value="<?= $class['id'] ?>">

            <div class="form-group">
                <label>Sinf Nomi</label>
                <input type="text" name="class_name" value="<?= htmlspecialchars($class['class_name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Mas'ul O'qituvchi</label>
                <select name="teachers_id" required>
                    <?php foreach($teachers as $teacher): ?>
                        <option value="<?= $teacher['id'] ?>" <?= ($teacher['id'] == $class['teachers_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($teacher['first_name'] . " " . $teacher['last_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn-update">O'zgarishlarni saqlash</button>
        </form>

        <a href="index.php" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Bekor qilish
        </a>
    </div>

</body>
</html>