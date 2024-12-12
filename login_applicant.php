<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once 'core/dbConfig.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND role = 'Applicant'");
    $stmt->execute([$username]);
    $user = $stmt->fetch();


    if ($user && password_verify($password, $user['password'])) {
        session_start(); 
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = 'Applicant'; 
        header("Location: applicant_dashboard.php");
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

    body {
        font-family: 'Orbitron', sans-serif;
        margin: 0;
        padding: 0;
        background: url('https://st3.depositphotos.com/1008648/31875/i/450/depositphotos_318753496-stock-photo-abstract-connection-blue-background-network.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #00ffea;
    }

    .hero-section {
        background: rgba(0, 0, 0, 0.8);
        padding: 60px 0;
        border: 3px solid #03a9f4;
        box-shadow: 0 0 15px #03a9f4, inset 0 0 15px #03a9f4;
    }

    .hero-section h1 {
        font-size: 2.5rem;
        color: #03a9f4;
        text-shadow: 0 0 10px #03a9f4, 0 0 20px #03a9f4, 0 0 30px #03a9f4;
    }

    .hero-section p {
        font-size: 1.2rem;
        color: #66d9ef;
        text-shadow: 0 0 10px #66d9ef, 0 0 20px #66d9ef, 0 0 30px #66d9ef;
    }

    .category-buttons a {
        font-family: 'Orbitron', sans-serif;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border-radius: 10px;
        box-shadow: 0 0 10px #03a9f4;
    }

    .category-buttons a:hover {
        transform: scale(1.1);
        box-shadow: 0 0 20px #03a9f4;
    }

    .btn-success {
        background-color: #03a9f4;
        border: none;
    }

    .btn-success:hover {
        background-color: #0288d1;
    }

    .btn-warning {
        background-color: #66d9ef;
        border: none;
    }

    .btn-warning:hover {
        background-color: #4db6ac;
    }

    footer {
        background: rgba(0, 0, 0, 0.8);
        color: #03a9f4;
        text-shadow: 0 0 10px #03a9f4, 0 0 20px #03a9f4;
        border-top: 3px solid #03a9f4;
        padding: 20px 0;
        margin-top: 50px;
    }
</style>
</head>
<body>

    <div class="container">
        <h1 class="my-5 text-center">Applicant Login</h1>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="mt-3 text-center">
            <p>Don't have an account? <a href="register_applicant.php" class="btn btn-secondary btn-lg px-4">Register here</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
