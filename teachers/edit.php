<?php
include "../config/db.php";



$teacher = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM teachers WHERE id = ?");
    $stmt->execute([$id]);
    $teacher = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$teacher) {
    die("O'qituvchi topilmadi!");
}


$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_teacher'])) {
    $sql = "UPDATE teachers SET first_name=?, last_name=?, subject=?, phone=?, experience=?, address=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $_POST['first_name'], $_POST['last_name'], $_POST['subject'], 
        $_POST['phone'], $_POST['experience'], $_POST['address'], $_POST['id']
    ]);
    $success = true;
    header("refresh:1; url=index.php");
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tahrirlash | <?= htmlspecialchars($teacher['first_name']) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-soft: #eef2ff;
            --bg: #f8fafc;
            --card: #ffffff;
            --text-main: #1e293b;
            --text-sub: #64748b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body { 
            background: var(--bg); 
            background-image: radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%), 
                              radial-gradient(at 100% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .edit-container {
            width: 100%;
            max-width: 550px;
            background: var(--card);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .header { text-align: center; margin-bottom: 35px; }
        .header .icon-box {
            width: 60px;
            height: 60px;
            background: var(--primary-soft);
            color: var(--primary);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 15px;
        }
        .header h2 { font-size: 24px; font-weight: 700; color: var(--text-main); }
        .header p { color: var(--text-sub); font-size: 14px; margin-top: 5px; }

        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 13px; font-weight: 700; color: var(--text-main); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
        
        input, textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #f1f5f9;
            border-radius: 12px;
            font-size: 15px;
            color: var(--text-main);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #f8fafc;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }

        .btn-save {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .btn-save:hover { background: #4f46e5; transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3); }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--text-sub);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
        }
        .btn-back:hover { color: var(--primary); }

        .success-overlay {
            position: fixed; top: 20px; right: 20px;
            background: #10b981; color: white; padding: 15px 25px;
            border-radius: 12px; box-shadow: 0 10px 15px rgba(0,0,0,0.1);
            display: flex; align-items: center; gap: 10px; animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn { from { transform: translateX(100%); } to { transform: translateX(0); } }
    </style>
</head>
<body>

<?php if($success): ?>
    <div class="success-overlay">
        <i class="fa-solid fa-circle-check"></i> Ma'lumotlar yangilandi!
    </div>
<?php endif; ?>

<div class="edit-container">
    <div class="header">
        <div class="icon-box"><i class="fa-solid fa-user-pen"></i></div>
        <h2>Tahrirlash</h2>
        <p>O'qituvchi profilini yangilash</p>
    </div>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $teacher['id'] ?>">

        <div class="row">
            <div class="form-group">
                <label>Ism</label>
                <input type="text" name="first_name" value="<?= htmlspecialchars($teacher['first_name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Familiya</label>
                <input type="text" name="last_name" value="<?= htmlspecialchars($teacher['last_name']) ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label>Mutaxassislik (Fan)</label>
            <input type="text" name="subject" value="<?= htmlspecialchars($teacher['subject']) ?>" required>
        </div>

        <div class="row">
            <div class="form-group">
                <label>Telefon</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($teacher['phone']) ?>" required>
            </div>
            <div class="form-group">
                <label>Tajriba (yil)</label>
                <input type="number" name="experience" value="<?= htmlspecialchars($teacher['experience']) ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label>Yashash manzili</label>
            <textarea name="address" rows="3"><?= htmlspecialchars($teacher['address']) ?></textarea>
        </div>

        <button type="submit" name="update_teacher" class="btn-save">
            <i class="fa-solid fa-cloud-arrow-up"></i> Saqlash va yangilash
        </button>

        <a href="index.php" class="btn-back">Bekor qilish</a>
    </form>
</div>

</body>
</html>