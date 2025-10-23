<?php
error_reporting(0);
ini_set('display_errors', 0);

require 'admin/db_connection.php';

// Preluăm toate categoriile
$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

// Categoria selectată (dacă există)
$selected_category = $_GET['category'] ?? null;

// Preluăm articolele filtrate sau toate
if($selected_category){
    $stmt = $pdo->prepare("SELECT articles.*, categories.name AS category_name 
                           FROM articles 
                           JOIN categories ON articles.category_id = categories.id 
                           WHERE category_id = ?");
    $stmt->execute([$selected_category]);
} else {
    $stmt = $pdo->query("SELECT articles.*, categories.name AS category_name 
                         FROM articles 
                         JOIN categories ON articles.category_id = categories.id
                         ORDER BY created_at DESC");
}

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="theme-color" content="#121212"/>
    <title>Ivetta Balan — gallery</title>

    <!-- Stiluri -->
    <link rel="stylesheet" href="styles.css" />

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <nav class="navbar" role="navigation" aria-label="Main navigation">
            <a href="index.php#main" class="logo" aria-label="Ivetta Balan Home">
                <span class="initials">iv.</span>
            </a>

            <ul class="nav-links" id="nav-links" role="menubar" aria-hidden="false">
                <li role="none"><a role="menuitem" href="index.php" class="nav-link">main</a></li>
                <li role="none"><a role="menuitem" href="gallery.php" class="nav-link active">gallery</a></li>
                <li role="none"><a role="menuitem" href="contacts.php" class="nav-link">contacts</a></li>
            </ul>

            <div class="social-links" aria-hidden="false">
                <a href="https://instagram.com/ivetta.balan.md" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://t.me/KidtQurts" target="_blank" rel="noopener" aria-label="Telegram"><i class="fab fa-telegram-plane"></i></a>
                <button id="theme-toggle" class="theme-toggle" aria-label="Schimbă tema">🌙</button>

            </div>

            <button id="menu-toggle" class="menu-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="nav-links">
                <span></span><span></span><span></span>

            </button>
        </nav>
    </header>

    <main style="padding-top:100px;">
        <section class="section gallery-section" aria-labelledby="gallery-title">
            <div class="container">
                <h2 class="section-title" id="gallery-title">gallery</h2>

                <!-- FILTRE CATEGORII -->
                <nav class="portfolio-categories" style="margin-bottom:20px;">
                    <a href="gallery.php" class="<?= $selected_category === null ? 'active' : '' ?>">All</a>
                    <?php foreach($categories as $cat): ?>
                        <a href="gallery.php?category=<?= $cat['id'] ?>" class="<?= $selected_category == $cat['id'] ? 'active' : '' ?>">
                            <?= htmlspecialchars($cat['name']) ?>
                        </a>
                    <?php endforeach; ?>
                </nav>

                <!-- GRID GALERIE -->
                <div class="gallery-grid">
  <?php if(empty($articles)) echo "<p>No articles found.</p>"; ?>
  <?php foreach($articles as $art): ?>
    <div class="gallery-item">
      <img 
        src="admin/uploads/<?= $art['image'] ?>" 
        alt="<?= htmlspecialchars($art['title']) ?>" 
        loading="lazy"
        data-date="<?= htmlspecialchars($art['created_at']) ?>" 
        data-desc="<?= htmlspecialchars($art['content']) ?>">
      <h3><?= htmlspecialchars($art['title']) ?></h3>
      <p class="category-label"><?= htmlspecialchars($art['category_name']) ?></p>
    </div>
  <?php endforeach; ?>    
</div>

<!-- 🔹 Lightbox se pune O SINGURĂ DATĂ, după galerie -->
<div id="lightbox" class="lightbox hidden">
  <div class="lightbox-content">
    <img id="lightbox-img" src="" alt="">
    <div class="lightbox-info">
      <p class="lightbox-date" id="lightbox-date"></p>
      <p class="lightbox-desc" id="lightbox-desc"></p>
    </div>

    <!-- 🔹 Navigare stânga/dreapta -->
    <button class="lightbox-prev" aria-label="Previous">&#10094;</button>
    <button class="lightbox-next" aria-label="Next">&#10095;</button>
  </div>
</div>


            </div>
        </section>
    </main>

    <footer aria-hidden="false" class="site-footer">
        <div class="container">
            <p>© <span id="year"></span> Ivetta Balan — all rights reserved.</p>
        </div>
    </footer>

    <script src="script.js" defer></script>
</body>
</html>
