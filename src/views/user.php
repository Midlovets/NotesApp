<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotesApp – Профіль</title>
    <link rel="stylesheet" href="/public/css/user.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <?php if (!empty($message)): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <nav class="navbar">
        <a href="notes.php" class="logo"><span class="logo-notes">Notes</span><span class="logo-app">App</span></a>
        <div class="cta-buttons" style="position: relative;">
            <button type="button" class="profile-svg-link" id="profileMenuBtn" title="Профіль" style="border:none; background:none; padding:0;">
                <?php if (!empty($profilePhotoUrl) && $profilePhotoUrl !== '/NotesApp/public/images/default-avatar.png'): ?>
                    <img src="<?= htmlspecialchars($profilePhotoUrl) ?>" alt="Фото профілю" style="width:38px; height:38px; border-radius:50%; object-fit:cover;">
                <?php else: ?>
                    <!-- SVG-иконка профиля -->
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
                <?php endif; ?>
            </button>
            <div id="profileDropdown" style="display:none; position:absolute; top:48px; right:0; background:rgba(24,24,24,0.97); border:1.5px solid #FFD92444; border-radius:12px; min-width:160px; box-shadow:0 4px 16px rgba(0,0,0,0.18); z-index:100;">
                <a href="user.php" style="display:block; padding:12px 18px; color:#FFD924; text-decoration:none; font-weight:500;">Мій профіль</a>
                <a href="/public/logout.php" style="display:block; padding:12px 18px; color:#fff; text-decoration:none; font-weight:500;">Вийти</a>
            </div>
        </div>
    </nav>

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
                    <form action="/public/user.php" method="POST" enctype="multipart/form-data">
                        <div class="form-section profile-photo-section">
                            <h2>Фото профілю</h2>
                            <div class="photo-container" id="profile-photo-container" style="width:120px; height:120px;">
                                <?php if (!empty($profilePhotoUrl) && $profilePhotoUrl !== '/NotesApp/public/images/default-avatar.png'): ?>
                                    <img class="profile-photo" src="<?= htmlspecialchars($profilePhotoUrl) ?>" alt="Фото профілю" style="width:120px; height:120px; border-radius:50%; object-fit:cover;">
                                <?php else: ?>
                                    <!-- SVG-иконка профиля (большая) -->
                                    <svg class="profile-photo" width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="60" cy="60" r="58" fill="url(#profileGradientBig)" stroke="#FFD924" stroke-width="3"/>
                                        <ellipse cx="60" cy="48" rx="23" ry="23" fill="#181818" stroke="#FFD924" stroke-width="2.5"/>
                                        <ellipse cx="60" cy="90" rx="36" ry="20" fill="#181818" stroke="#FFD924" stroke-width="2.5"/>
                                        <defs>
                                            <linearGradient id="profileGradientBig" x1="0" y1="0" x2="120" y2="120" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#FFD924"/>
                                                <stop offset="1" stop-color="#AD6000"/>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                <?php endif; ?>
                                <div class="camera-icon">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </div>
                            <input type="file" id="profile-photo-upload" name="profile_photo" accept="image/*" style="display: none;">
                        </div>

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
                    <form action="/NotesApp/public/user.php" method="POST">
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
        // Фото профілю
        document.querySelector('.camera-icon').addEventListener('click', function () {
            document.querySelector('#profile-photo-upload').click();
        });
        document.querySelector('#profile-photo-upload').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const container = document.getElementById('profile-photo-container');
                    // Заменяем содержимое контейнера на <img>
                    container.querySelector('.profile-photo')?.remove();
                    const img = document.createElement('img');
                    img.className = 'profile-photo';
                    img.src = e.target.result;
                    img.alt = 'Фото профілю';
                    img.style.width = '120px';
                    img.style.height = '120px';
                    img.style.borderRadius = '50%';
                    img.style.objectFit = 'cover';
                    container.insertBefore(img, container.querySelector('.camera-icon'));
                };
                reader.readAsDataURL(file);
            }
        });

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

        // Сховання повідомлення
        document.addEventListener('DOMContentLoaded', () => {
            const flashMessage = document.querySelector('.message');
            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.classList.add('hide');
                    setTimeout(() => flashMessage.remove(), 500);
                }, 2000);
            }
        });

        // SVG-меню профиля (аналогично notes.php)
        const profileMenuBtn = document.getElementById('profileMenuBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        document.addEventListener('click', function(e) {
            if (profileMenuBtn && profileMenuBtn.contains(e.target)) {
                profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
            } else if (profileDropdown && !profileDropdown.contains(e.target)) {
                profileDropdown.style.display = 'none';
            }
        });
    </script>
</body>
</html>