<?php
require 'admin/db_connection.php';

// Preluăm articolele pentru dashboard
$stmt = $pdo->query("SELECT a.id, a.title, a.category_id, c.name AS category_name, a.image FROM articles a JOIN categories c ON a.category_id = c.id ORDER BY a.id DESC");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Preluăm categoriile pentru formular
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ro">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel — Portfolio</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="dashboard-container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="#" class="active" data-tab="dashboard"><i class="fas fa-th-large"></i> Dashboard</a></li>
            <li><a href="#" data-tab="add-article"><i class="fas fa-plus-circle"></i> Add Article</a></li>
        </ul>
    </aside>

    <!-- Main content -->
    <main class="main-content">

        <!-- Dashboard Tab -->
        <div class="tab-content" id="dashboard-tab">
            <h1>Articles</h1>
            <div class="articles-grid">
                <?php if(empty($articles)) echo "<p>No articles yet.</p>"; ?>
                <?php foreach($articles as $art): ?>
                    <div class="article-card">
                        <img src="admin/uploads/<?= $art['image'] ?>" alt="<?= htmlspecialchars($art['title']) ?>">
                        <h3><?= htmlspecialchars($art['title']) ?></h3>
                        <p class="category"><?= htmlspecialchars($art['category_name']) ?></p>
                        <div class="actions">
                            <a href="admin/edit_article.php?id=<?= $art['id'] ?>" class="edit-btn"><i class="fas fa-edit"></i> Edit</a>
                            <a href="admin/delete_article.php?id=<?= $art['id'] ?>" class="delete-btn"><i class="fas fa-trash-alt"></i> Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Add Article Tab -->
        <div class="tab-content" id="add-article-tab" style="display:none;">
            <h1>Add New Article</h1>
            <form action="save_article.php" method="POST" enctype="multipart/form-data" class="article-form">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>

                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <?php foreach($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="image">Image</label>
                <input type="file" name="image" id="image" accept="image/*" required>

                <button type="submit">Add Article</button>
            </form>
        </div>

    </main>
</div>

<script>
    // Tab switch
    const tabs = document.querySelectorAll('.sidebar ul li a');
    const contents = {
        'dashboard': document.getElementById('dashboard-tab'),
        'add-article': document.getElementById('add-article-tab')
    };

    tabs.forEach(tab => {
        tab.addEventListener('click', e => {
            e.preventDefault();
            // active link
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            // show/hide content
            for (let key in contents) {
                contents[key].style.display = (tab.dataset.tab === key) ? 'block' : 'none';
            }
        });
    });
</script>
</body>
</html>
