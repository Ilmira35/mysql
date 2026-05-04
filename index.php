<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modern Light Dashboard</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',sans-serif}

    body{
      /* Orqa fon yumshoq oq rangda */
      background: #f8fafc;
      color:#1e293b;
      min-height:100vh;
    }

    /* NAVBAR */
    .navbar{
      display:flex;
      justify-content:space-between;
      align-items:center;
      padding:15px 40px;
      background:rgba(255,255,255,0.8);
      backdrop-filter: blur(15px);
      border-bottom:1px solid #e2e8f0;
      position:sticky;
      top:0;
      z-index: 100;
    }

    .logo{
      font-size:22px;
      font-weight:bold;
      color:#4f46e5; /* Ko'kroq zamonaviy rang */
    }

    .menu{
      display:flex;
      gap:25px;
      list-style:none;
    }

    .menu a{
      text-decoration:none;
      color:#64748b;
      font-size:15px;
      position:relative;
      padding:5px;
      transition:0.3s;
      font-weight: 500;
    }

    .menu a::after{
      content:"";
      position:absolute;
      left:0;
      bottom:-5px;
      width:0%;
      height:2px;
      background:#4f46e5;
      transition:0.3s;
    }

    .menu a:hover{
      color:#4f46e5;
    }

    .menu a:hover::after{
      width:100%;
    }

    /* MAIN */
    .main{
      padding:40px;
    }

    .header{
      font-size:28px;
      margin-bottom:30px;
      font-weight:700;
      color: #0f172a;
    }

    .cards{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
      gap:25px;
    }

    /* Karta havolasi uchun */
    .card-link {
      text-decoration: none;
      color: inherit;
    }

    .card{
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius:24px;
      padding:30px;
      transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position:relative;
      overflow:hidden;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* Oq dizayndagi neon chizig'i effekti */
    .card::before{
      content:"";
      position:absolute;
      width:150%;
      height:150%;
      background:linear-gradient(120deg,transparent, rgba(79, 70, 229, 0.1), transparent);
      top:-100%;
      left:-100%;
      transition:0.6s;
    }

    .card:hover::before{
      top:0;
      left:0;
    }

    .card:hover{
      transform:translateY(-10px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
      border-color: #4f46e5;
    }

    .card i{
      font-size:35px;
      margin-bottom:20px;
      color:#4f46e5;
      background: #f5f3ff;
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 16px;
    }

    .card h3{
      margin-bottom:10px;
      font-size: 20px;
      color: #1e293b;
    }

    .card p{
      color:#64748b;
      font-size:14px;
      line-height: 1.5;
    }

    /* Kichik chiroyli detal */
    .card .arrow {
        position: absolute;
        bottom: 30px;
        right: 30px;
        opacity: 0;
        transform: translateX(-10px);
        transition: 0.3s;
        color: #4f46e5;
    }

    .card:hover .arrow {
        opacity: 1;
        transform: translateX(0);
    }

  </style>
</head>
<body>

  <div class="navbar">
    <div class="logo">My School</div>
    <ul class="menu">
      <li><a href="students/index.php">Students</a></li>
      <li><a href="teachers/index.php">Teachers</a></li>
      <li><a href="classes/index.php">Classes</a></li>
    </ul>
  </div>

  <div class="main">
    <div class="header">Boshqaruv Paneli</div>

    <div class="cards">
      <a href="students/index.php" class="card-link">
          <div class="card">
            <i class="fa-solid fa-user-graduate"></i>
            <h3>Students</h3>
            <p>Talabalar ro'yxatini ko'rish, yangi talabalar qo'shish va ularni tahrirlash.</p>
            <div class="arrow"><i class="fa-solid fa-arrow-right"></i></div>
          </div>
      </a>

      <a href="teachers/index.php" class="card-link">
          <div class="card">
            <i class="fa-solid fa-chalkboard-user"></i>
            <h3>Teachers</h3>
            <p>O'qituvchilarning shaxsiy ma'lumotlari va faoliyatini boshqarish bo'limi.</p>
            <div class="arrow"><i class="fa-solid fa-arrow-right"></i></div>
          </div>
      </a>

      <a href="classes/index.php" class="card-link">
          <div class="card">
            <i class="fa-solid fa-book"></i>
            <h3>Classes</h3>
            <p>Sinflar tarkibi, dars jadvali va xonalar taqsimotini nazorat qilish.</p>
            <div class="arrow"><i class="fa-solid fa-arrow-right"></i></div>
          </div>
      </a>
    </div>
  </div>

</body>
</html>