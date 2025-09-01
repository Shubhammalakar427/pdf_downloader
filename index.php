<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF Downloader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">📚 PDF Downloader</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#uploadSection">Upload</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#listSection">PDF List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#footer">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ✅ Hero Section -->
<section class="bg-primary text-white text-center py-5">
    <div class="container">
        <h1 class="display-5 fw-bold">Welcome to the PDF Downloader System</h1>
        <p class="lead">Upload, manage, and download PDFs securely.</p>
    </div>
</section>

<!-- ✅ Upload Section -->
<section id="uploadSection" class="container py-5">
    <h2 class="mb-4 text-center">📤 Upload a New PDF</h2>

    <form action="upload.php" method="post" enctype="multipart/form-data" class="mb-4">
        <div class="input-group">
            <input type="file" name="pdf" class="form-control" required>
            <button type="submit" name="upload" class="btn btn-primary">Upload PDF</button>
        </div>
    </form>
</section>

<!-- ✅ List Section -->
<section id="listSection" class="container pb-5">
    <h2 class="mb-4 text-center">📄 Available PDFs</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>File Name</th>
                    <th>Uploaded At</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM pdf_files ORDER BY uploaded_at DESC");
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$i}</td>
                            <td>{$row['file_name']}</td>
                            <td>{$row['uploaded_at']}</td>
                            <td>
                                <a href='{$row['file_path']}' class='btn btn-success btn-sm' download>Download</a>
                            </td>
                        </tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No PDFs uploaded yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<!-- ✅ Footer -->
<footer id="footer" class="bg-dark text-white py-4 mt-auto">
    <div class="container text-center">
        <p class="mb-1">&copy; <?= date("Y") ?> PDF Downloader System</p>
        <p class="mb-0">
            Made with ❤️ using PHP, Bootstrap 5, and MySQL.
        </p>
    </div>
</footer>

<!-- Bootstrap 5 JS (for navbar toggle) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
