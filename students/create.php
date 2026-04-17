<!DOCTYPE html>
<html lang="uz">
<head>
<meta charset="UTF-8">
<title>Student Form</title>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', sans-serif;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #cfd1d8, #cac5d0);
    }

    .form-box {
        background: #fff;
        padding: 30px;
        border-radius: 15px;
        width: 380px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .input-group {
        position: relative;
        margin-bottom: 18px;
    }

    .input-group input,
    .input-group textarea {
        width: 100%;
        padding: 12px 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
        font-size: 14px;
        transition: 0.3s;
    }

    .input-group label {
        position: absolute;
        top: 50%;
        left: 10px;
        color: #888;
        font-size: 14px;
        transform: translateY(-50%);
        pointer-events: none;
        transition: 0.3s;
        background: #fff;
        padding: 0 5px;
    }

    .input-group input:focus,
    .input-group textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 5px rgba(102,126,234,0.4);
    }

    .input-group input:focus + label,
    .input-group input:valid + label,
    .input-group textarea:focus + label,
    .input-group textarea:valid + label {
        top: -8px;
        font-size: 12px;
        color: #667eea;
    }

    textarea {
        resize: none;
        height: 70px;
    }

    button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
</style>
</head>

<body>

<div class="form-box">
    <h2>Student qo‘shish</h2>

    <form action="store.php" method="POST">

        <div class="input-group">
            <input type="text" name="first_name" required>
            <label>First Name</label>
        </div>

        <div class="input-group">
            <input type="text" name="last_name" required>
            <label>Last Name</label>
        </div>

        <div class="input-group">
            <input type="number" name="age" required>
            <label>Age</label>
        </div>

        <div class="input-group">
            <input type="text" name="class_name" required>
            <label>Class Name</label>
        </div>

        <div class="input-group">
            <input type="text" name="phone" required>
            <label>Phone</label>
        </div>

        <div class="input-group">
            <textarea name="address" required></textarea>
            <label>Address</label>
        </div>

        <button type="submit">Saqlash</button>

    </form>
</div>

</body>
</html>

</body>
</html>