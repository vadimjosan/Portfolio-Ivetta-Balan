<?php
require 'admin/db_connection.php';

$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

$selected_category = $_GET['category'] ?? null;
if($selected_category){
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE category_id = ?");
    $stmt->execute([$selected_category]);
} else {
    $stmt = $pdo->query("SELECT * FROM articles");
}

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="theme-color" content="#121212"/>
    <title>Ivetta Balan — digital artist</title>

    <!-- Stiluri -->
    <link rel="stylesheet" href="styles.css" />

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <!-- FontAwesome (iconițe) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <nav class="navbar" role="navigation" aria-label="Main navigation">
            <a href="#main" class="logo" aria-label="Ivetta Balan Home">
                <span class="initials">iv.</span>
            </a>

            <ul class="nav-links" id="nav-links" role="menubar" aria-hidden="false">
                <li role="none"><a role="menuitem" href="index.php" class="nav-link active">main</a></li>
                <li role="none"><a role="menuitem" href="gallery.php" class="nav-link">gallery</a></li>
                <li role="none"><a role="menuitem" href="contacts.php" class="nav-link">contacts</a></li>
            </ul>

            <div class="social-links" aria-hidden="false">
                <a href="https://instagram.com/ivetta.balan.md" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://t.me/Kivitgkarts" target="_blank" rel="noopener" aria-label="Telegram"><i class="fab fa-telegram-plane"></i></a>
                <button id="theme-toggle" class="theme-toggle" aria-label="Schimbă tema">🌙</button>

            </div>

            <!-- Hamburger -->
            <button id="menu-toggle" class="menu-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="nav-links">
                <span></span><span></span><span></span>
            </button>
        </nav>
    </header>

    <main>
        <!-- HERO -->
        <section class="hero-section" id="main" aria-labelledby="hero-heading" tabindex="-1">
            <div class="visual-art" role="img" aria-label="Abstract artwork background"></div>

            <div class="container hero-content">
                <div class="text-content">
                    <div class="artist-name" id="hero-heading">
                        <h1>ivetta</h1>
                        <h1>balan</h1>
                    </div>
                    <p class="role">digital artist</p>
                    <p class="tagline">turning pixels into stories and ideas into visuals</p>
                    <div class="signature">N.Mmmm</div>
                </div>
            </div>
        </section>

        <!-- ABOUT -->
        <section class="section about-her" id="about" aria-labelledby="about-title">
            <div class="container">
                <h2 class="section-title" id="about-title">about her</h2>
                <div class="about-content">
                    <p class="col-left">
                        She is a graphic designer. On this website, you'll find her portfolio along with contact information below. Her work spans concept art for characters and games, designs for bank cards and business cards, as well as illustration for advertising. Her artistic style reflects creativity, attention to detail, and a passion for visual storytelling.
                    </p>
                    <p class="col-right">
                        She's open to new ideas, but she sticks to a single style. She's willing to collaborate and can do anything you ask, but will she actually want to do it?
                        <br><br>
                        Suggest a product, she'll find a way to wrap it in style.
                    </p>
                </div>
            </div>
        </section>

        <?php
require 'db.php';

// Preluăm toate articolele pentru galerie
$stmt = $pdo->query("SELECT articles.*, categories.name AS category_name 
                     FROM articles 
                     JOIN categories ON articles.category_id = categories.id 
                     ORDER BY created_at DESC");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- ... restul header-ului și secțiunilor ... -->

<!-- GALLERY -->
<section class="section gallery-section" aria-labelledby="gallery-title">
    <div class="container">
        <h2 class="section-title" id="gallery-title">gallery</h2>

        <!-- Carousel -->
        <div class="carousel-container">
            <button class="carousel-btn prev-btn" aria-label="Previous">&#10094;</button>
            <div class="gallery-carousel">
                <?php foreach($articles as $art): ?>
                    <div class="gallery-item" style="height: auto;">
                        <img src="admin/uploads/<?= $art['image'] ?>" alt="<?= htmlspecialchars($art['title']) ?>" loading="lazy">
                        <h3><?= htmlspecialchars($art['title']) ?></h3>
                        <p class="category-label"><?= htmlspecialchars($art['category_name']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-btn next-btn" aria-label="Next">&#10095;</button>
        </div>
    </div>
    <div class="center">
        <a class="btn btn-outline-iv" href="gallery.php">view more</a>
    </div>


</section>


        <!-- CONTACTS -->
        <section class="section contacts-section" id="contacts" aria-labelledby="contacts-title">
            <div class="container">
                <h2 class="section-title" id="contacts-title">contacts</h2>

                <address class="contacts-grid">
                    <a class="contact-item" href="https://instagram.com/ivetta.balan.md" target="_blank" rel="noopener" aria-label="Instagram profile">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                        <p>ivetta.balan.md</p>
                    </a>
                    <a class="contact-item" href="https://t.me/Kivitgkarts" target="_blank" rel="noopener" aria-label="Telegram profile">
                        <i class="fab fa-telegram-plane" aria-hidden="true"></i>
                        <p>Kivitgkarts</p>
                    </a>
                    <a class="contact-item" href="mailto:ivetta.balan@gmail.com" aria-label="Send email">
                        <i class="fas fa-envelope" aria-hidden="true"></i>
                        <p>ivetta.balan@gmail.com</p>
                    </a>
                    <a class="contact-item" href="tel:+37379934568" aria-label="Call phone">
                        <i class="fas fa-phone-alt" aria-hidden="true"></i>
                        <p>+373 799 345 68</p>
                    </a>
                </address>
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
