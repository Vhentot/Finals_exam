<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Applicant') {
    header("Location: login_applicant.php"); 
    exit();
}

require_once 'core/dbConfig.php';

$stmt = $pdo->prepare("SELECT * FROM job_posts");
$stmt->execute();
$job_posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

    body {
        font-family: 'Orbitron', sans-serif;
        margin: 0;
        padding: 0;
        background: url('https://st3.depositphotos.com/1008648/31875/i/450/depositphotos_318753496-stock-photo-abstract-connection-blue-background-network.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #fcfafa; /* Changed font color to white */
    }

    .hero-section {
        background: rgba(0, 0, 0, 0.8);
        padding: 60px 0;
        border: 3px solid #03a9f4;
        box-shadow: 0 0 15px #03a9f4, inset 0 0 15px #03a9f4;
    }

    .hero-section h1 {
        font-size: 2.5rem;
        color: #ffffff; /* Changed font color to white */
        text-shadow: 0 0 10px #03a9f4, 0 0 20px #03a9f4, 0 0 30px #03a9f4;
    }

    .hero-section p {
        font-size: 1.2rem;
        color: #ffffff; /* Changed font color to white */
        text-shadow: 0 0 10px #66d9ef, 0 0 20px #66d9ef, 0 0 30px #66d9ef;
    }

    .category-buttons a {
        font-family: 'Orbitron', sans-serif;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border-radius: 10px;
        box-shadow: 0 0 10px #03a9f4;
        color: #fcfafa; /* Changed font color to white */
    }

    .category-buttons a:hover {
        transform: scale(1.1);
        box-shadow: 0 0 20px #03a9f4;
    }

    .btn-success {
        background-color: #03a9f4;
        border: none;
        color: #ffffff; /* Changed font color to white */
    }

    .btn-success:hover {
        background-color: #0288d1;
    }

    .btn-warning {
        background-color: #66d9ef;
        border: none;
        color: #fcfafa; /* Changed font color to white */
    }

    .btn-warning:hover {
        background-color: #4db6ac;
    }

    footer {
        background: rgba(0, 0, 0, 0.8);
        color: #fcfafa; /* Changed font color to white */
        text-shadow: 0 0 10px #03a9f4, 0 0 20px #03a9f4;
        border-top: 3px solid #03a9f4;
        padding: 20px 0;
        margin-top: 50px;
    }
</style>
</head>
<body>
    <div class="container">

        <div class="d-flex justify-content-between align-items-center my-3">
            <h1>Applicant Dashboard</h1>
            <a href="index.php" class="btn btn-secondary">Home</a>
            <a href="profile.php" class="btn btn-info">Your Profile</a>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Available Job Posts</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Job Description</th>
                            <th>Apply</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($job_posts as $job): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($job['title']); ?></td>
                                <td><?php echo htmlspecialchars($job['description']); ?></td>
                                <td>
                                    <a href="apply_job.php?job_id=<?php echo $job['id']; ?>" class="btn btn-primary">Apply</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
