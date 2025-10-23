<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="theme-color" content="#121212"/>
    <title>Ivetta Balan — contacts</title>

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
               <li role="none"><a role="menuitem" href="gallery.php" class="nav-link">gallery</a></li>
                <li role="none"><a role="menuitem" href="contacts.php" class="nav-link active">contacts</a></li>
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
        <section class="section contacts-section" aria-labelledby="contacts-title">
            <div class="container"><?php if(isset($_GET['success'])): ?>
    <p style="color: var(--accent-color); margin-bottom: 20px;">Thank you! Your message has been sent successfully.</p>
<?php endif; ?>

                <h2 class="section-title" id="contacts-title">contacts</h2>

                <div class="contacts-grid">
                    <a class="contact-item" href="https://instagram.com/ivetta.balan.md" target="_blank" rel="noopener" aria-label="Instagram profile">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                        <p>ivetta.balan.md</p>
                    </a>
                    <a class="contact-item" href="https://t.me/KidtQurts" target="_blank" rel="noopener" aria-label="Telegram profile">
                        <i class="fab fa-telegram-plane" aria-hidden="true"></i>
                        <p>KidtQurts</p>
                    </a>
                    <a class="contact-item" href="mailto:ivetta.balan@gmail.com" aria-label="Send email">
                        <i class="fas fa-envelope" aria-hidden="true"></i>
                        <p>ivetta.balan@gmail.com</p>
                    </a>
                    <a class="contact-item" href="tel:+37379934565" aria-label="Call phone">
                        <i class="fas fa-phone-alt" aria-hidden="true"></i>
                        <p>+373 799 345 65</p>
                    </a>
                </div>

                <!-- FORMULAR CONTACT -->
                <form action="send_message.php" method="POST" class="contact-form" style="margin-top:40px;">
                    <div class="form-group" style="margin-bottom:20px;">
                        <input type="text" name="name" placeholder="Your Name" required style="width:100%; padding:12px; border-radius:6px; border:1px solid var(--border); background:var(--bg-dark); color:#fff;">
                    </div>
                    <div class="form-group" style="margin-bottom:20px;">
                        <input type="email" name="email" placeholder="Your Email" required style="width:100%; padding:12px; border-radius:6px; border:1px solid var(--border); background:var(--bg-dark); color:#fff;">
                    </div>
                    <div class="form-group" style="margin-bottom:20px;">
                        <textarea name="message" placeholder="Your Message" rows="6" required style="width:100%; padding:12px; border-radius:6px; border:1px solid var(--border); background:var(--bg-dark); color:#fff;"></textarea>
                    </div>
                    <button type="submit" style="padding:12px 28px; background:var(--accent-color); color:#fff; border:none; border-radius:6px; font-weight:700; cursor:pointer; transition: all .25s;" class="send-btn">Send Message</button>
                </form>
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
