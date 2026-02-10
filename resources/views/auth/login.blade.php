<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --background-color: #f3edc8;
      --default-color: #444444;
      --heading-color: #7d0a0a;
      --accent-color: #bf3131;
      --surface-color: #ead196;
      --contrast-color: #f8f9fa;
    }

    body {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Poppins", sans-serif;
      color: var(--default-color);
      background: linear-gradient(135deg, var(--background-color), var(--surface-color), var(--contrast-color));
      background-size: 200% 200%;
      animation: gradientShift 10s ease infinite;
      overflow: hidden;
      position: relative;
      padding: 20px;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* 🌟 Pola titik */
    .dot-pattern {
      position: absolute;
      width: 200px;
      height: 200px;
      background-image: radial-gradient(var(--heading-color) 1.5px, transparent 1.5px);
      background-size: 10px 10px;
      opacity: 1;
      z-index: 0;
    }

    .dot-top-left {
      top: 10%;
      left: calc(50% - 280px);
    }

    .dot-bottom-right {
      bottom: 10%;
      right: calc(50% - 280px);
      transform: rotate(180deg);
    }

    /* 💳 Card */
    .login-card {
      position: relative;
      background-color: var(--contrast-color);
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
      width: 100%;
      max-width: 420px;
      padding: 40px;
      border-top: 5px solid var(--accent-color);
      animation: fadeIn 1s ease forwards;
      z-index: 1;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .login-card h3 {
      text-align: center;
      margin-bottom: 25px;
      color: var(--heading-color);
      font-weight: 700;
    }

    .form-control {
      border-radius: 10px;
      border: 1.5px solid #ccc;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 0 0.2rem rgba(191, 49, 49, 0.25);
    }

    .btn-login {
      background-color: var(--accent-color);
      color: var(--contrast-color);
      border: none;
      border-radius: 50px;
      width: 100%;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    .btn-login:hover {
      background-color: var(--heading-color);
    }

    a {
      color: var(--accent-color);
      text-decoration: none;
      font-weight: 500;
    }

    a:hover {
      color: var(--heading-color);
      text-decoration: underline;
    }

    .footer-text {
      text-align: center;
      margin-top: 15px;
      font-size: 0.9rem;
      color: #666;
    }

    /* 📱 RESPONSIVE */
    /* Tablet landscape & Desktop kecil */
    @media (max-width: 992px) {
      .dot-top-left {
        top: 22%;
        left: calc(46% - 220px);
      }
      .dot-bottom-right {
        bottom: 22%;
        right: calc(46% - 220px);
      }
      .login-card {
        max-width: 380px;
        padding: 35px;
      }
    }

    /* Tablet potrait */
    @media (max-width: 768px) {
      .dot-pattern {
        width: 150px;
        height: 150px;
        background-size: 8px 8px;
      }
      .dot-top-left {
        top: 25%;
        left: calc(45% - 180px);
      }
      .dot-bottom-right {
        bottom: 25%;
        right: calc(45% - 180px);
      }
      .login-card {
        max-width: 340px;
        padding: 30px;
      }
    }

    /* Mobile */
    @media (max-width: 576px) {
      .dot-pattern {
        width: 120px;
        height: 120px;
        background-size: 7px 7px;
      }
      .dot-top-left {
        top: 25%;
        left: calc(50% - 150px);
      }
      .dot-bottom-right {
        bottom: 25%;
        right: calc(50% - 150px);
      }
      .login-card {
        width: 100%;
        max-width: 90%;
        padding: 25px 20px;
        margin: auto;
      }
    }
  </style>
</head>
<body>

  <!-- 🔵 Pola titik -->
  <div class="dot-pattern dot-top-left"></div>
  <div class="dot-pattern dot-bottom-right"></div>

  <!-- 💳 Card Login -->
  <div class="login-card">
    <h3>Login Akun</h3>
    <form action="/login" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="remember">
          <label class="form-check-label" for="remember">Ingat saya</label>
        </div>
        <a href="#">Lupa sandi?</a>
      </div>
      <a href="#" class="btn btn-login">Masuk</a>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
