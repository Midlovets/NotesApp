<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotesApp – Профіль</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/user.css">
    <style>
        body {
            overflow: hidden;
        }
    </style>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php if (!empty($message)): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- Фикс: иконка профиля всегда поверх и не перекрывается nav-баром -->
    <nav class="navbar">
        <a href="notes.php" class="logo">
            <span class="logo-notes">Notes</span>
            <span class="logo-app">App</span>
        </a>
        <div class="cta-buttons">
            <div class="profile-svg-link" id="profileMenuBtn" title="Профіль" tabindex="0" style="z-index: 2000; position: relative;">
                <svg class="profile-svg-icon" width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="19" cy="19" r="18" fill="url(#profileGradient)" stroke="#FFD924" stroke-width="1.5"/>
                    <ellipse cx="19" cy="15.5" rx="7" ry="7" fill="#181818" stroke="#FFD924" stroke-width="1.2"/>
                    <ellipse cx="19" cy="27.5" rx="11" ry="6" fill="#181818" stroke="#FFD924" stroke-width="1.2"/>
                    <defs>
                        <linearGradient id="profileGradient" x1="0" y1="0" x2="38" y2="38" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FFD924"/>
                            <stop offset="1" stop-color="#AD6000"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <div id="profileDropdown" style="display:none; position:absolute; top:48px; right:0; background:rgba(24,24,24,0.97); border:1.5px solid #FFD92444; border-radius:12px; min-width:160px; box-shadow:0 4px 16px rgba(0,0,0,0.18); z-index:1999;">
                <a href="/public/user.php" style="display:block; padding:12px 18px; color:#FFD924; text-decoration:none; font-weight:500;">Профіль</a>
                <a href="/public/logout.php" style="display:block; padding:12px 18px; color:#fff; text-decoration:none; font-weight:500;">Вийти</a>
            </div>
        </div>
    </nav>
    <div style="height: 80px;"></div>

    <div class="content-wrapper">
        <aside class="sidebar">
            <h2 class="menu-title">Мій профіль</h2>
            <ul class="profile-menu">
                <li class="active" data-tab="edit-profile">Редагувати профіль</li>
                <li data-tab="account-settings">Налаштування акаунту</li>
            </ul>
        </aside>

        <div class="main-content">
            <!-- Редагування профілю -->
            <div id="edit-profile" class="tab-content active">
                <h1 class="page-title">Редагувати профіль</h1>
                <div class="profile-form">
                    <?php if (!empty($_SESSION['profile_updated'])): ?>
                        <div class="message">Нікнейм успішно змінено!</div>
                        <?php unset($_SESSION['profile_updated']); ?>
                    <?php endif; ?>
                    <form action="/public/user.php" method="POST">
                        <div class="form-section">
                            <h2>Основні дані</h2>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="new_username">Нікнейм</label>
                                    <input type="text" id="new_username" name="new_username"
                                        value="<?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?>" placeholder="Введіть новий нікнейм">
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <button type="submit" name="update_profile" class="update-btn">Оновити</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Налаштування акаунту -->
            <div id="account-settings" class="tab-content">
                <h1 class="page-title">Налаштування акаунту</h1>
                <div class="profile-form">
                    <?php if (!empty($_SESSION['password_message'])): ?>
                        <div class="message password-message"><?= htmlspecialchars($_SESSION['password_message']) ?></div>
                        <?php unset($_SESSION['password_message']); ?>
                    <?php endif; ?>
                    <form action="/public/user.php" method="POST">
                        <div class="form-section">
                            <h2>Зміна паролю</h2>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="current_password">Поточний пароль</label>
                                    <input type="password" id="current_password" name="current_password" placeholder="Введіть поточний пароль" required>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Новий пароль</label>
                                    <input type="password" id="new_password" name="new_password" placeholder="Введіть новий пароль" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Підтвердження паролю</label>
                                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Підтвердіть новий пароль" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <button type="submit" name="change_password" class="update-btn">Змінити пароль</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Вкладки
        document.querySelectorAll('.profile-menu li').forEach(item => {
            item.addEventListener('click', function (event) {
                event.preventDefault();
                const tabId = this.getAttribute('data-tab');
                document.querySelectorAll('.profile-menu li').forEach(li => li.classList.remove('active'));
                this.classList.add('active');
                document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Вихід
        document.getElementById('logout-link').addEventListener('click', function (event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        });

        // Перехід на сторінку профілю
        document.getElementById('openUserPage').addEventListener('click', function (event) {
            event.preventDefault();
            window.location.href = 'user.php';
        });

        // Сховання повідомлень
        document.addEventListener('DOMContentLoaded', () => {
            // Скрыть все обычные сообщения через 2 секунды (кроме password-message)
            document.querySelectorAll('.message:not(.password-message)').forEach(msg => {
                setTimeout(() => {
                    msg.style.transition = 'opacity 0.5s';
                    msg.style.opacity = '0';
                    setTimeout(() => msg.remove(), 500);
                }, 2000);
            });
            // Скрыть все сообщения о смене пароля через 3 секунды
            document.querySelectorAll('.password-message').forEach(msg => {
                setTimeout(() => {
                    msg.style.transition = 'opacity 0.5s';
                    msg.style.opacity = '0';
                    setTimeout(() => msg.remove(), 500);
                }, 3000);
            });
        });

        // SVG-меню профиля (аналогично notes.php)
        const profileMenuBtn = document.getElementById('profileMenuBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        // Показать по наведению
        profileMenuBtn.addEventListener('mouseenter', function() {
            profileDropdown.style.display = 'block';
        });
        profileMenuBtn.addEventListener('mouseleave', function() {
            setTimeout(() => {
                if (!profileDropdown.matches(':hover')) {
                    profileDropdown.style.display = 'none';
                }
            }, 120);
        });
        profileDropdown.addEventListener('mouseleave', function() {
            profileDropdown.style.display = 'none';
        });
        profileDropdown.addEventListener('mouseenter', function() {
            profileDropdown.style.display = 'block';
        });

        // Показать/скрыть по клику (для мобильных)
        profileMenuBtn.addEventListener('click', function(e) {
            e.preventDefault();
            profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
        });
        document.addEventListener('click', function(e) {
            if (!profileMenuBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.style.display = 'none';
            }
        });
    </script>
</body>
</html>