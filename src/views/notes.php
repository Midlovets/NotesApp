<!-- filepath: e:\OSPanel\domains\NotesApp\src\views\notes.php -->
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotesApp – Мої нотатки</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/notes.css">
</head>
<body>
    <div class="blur-bg"></div>
    <nav class="navbar">
        <a href="index.php" class="logo"><span class="logo-notes">Notes</span><span class="logo-app">App</span></a>
        <div class="cta-buttons" style="position: relative;">
            <div class="profile-svg-link" id="profileMenuBtn" title="Профіль" tabindex="0" style="position: relative; cursor:pointer;">
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
            <div id="profileDropdown" style="display:none; position:absolute; top:48px; right:0; background:rgba(24,24,24,0.97); border:1.5px solid #FFD92444; border-radius:12px; min-width:160px; box-shadow:0 4px 16px rgba(0,0,0,0.18); z-index:1001;">
                <a href="/public/user.php" style="display:block; padding:12px 18px; color:#FFD924; text-decoration:none; font-weight:500;">Профіль</a>
                <a href="/public/logout.php" style="display:block; padding:12px 18px; color:#fff; text-decoration:none; font-weight:500;">Вийти</a>
            </div>
        </div>
    </nav>
    <div class="main-content">
        <div class="top-filters-row">
            <form method="get" action="search.php" style="display: flex; gap: 1rem; width: 100%;">
                <input type="text" class="search-input" name="q" placeholder="Пошук нотатки..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                <select class="category-select" name="category_id">
                    <option value="">Всі категорії</option>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id']; ?>" <?= (isset($_GET['category_id']) && $_GET['category_id'] == $category['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <button class="add-note-btn" type="submit" style="margin-left:0; width:44px; height:44px; padding:0; display:flex; align-items:center; justify-content:center;">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <circle cx="10" cy="10" r="7" stroke="#181818" stroke-width="2" fill="none"/>
                        <line x1="15.2" y1="15.2" x2="20" y2="20" stroke="#181818" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
                <a href="/public/note.php" class="add-note-btn" style="text-align:center; text-decoration:none;">+ Додати нотатку</a>
            </form>
        </div>
        <div class="notes-list">
            <?php if (!empty($notes)): ?>
                <?php foreach ($notes as $note): ?>
                    <div class="note-card">
                        <div class="note-title-row">
                            <span class="note-title"><?= htmlspecialchars($note['title']); ?></span>
                        </div>
                        <div class="note-tags">
                            <?php if (!empty($note['tags'])): ?>
                                <?php foreach ($note['tags'] as $tag): ?>
                                    <span class="note-tag"><?= htmlspecialchars($tag['name']); ?></span>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="note-content">
                            <?= mb_strlen(strip_tags($note['content'])) > 180
                                ? mb_substr($note['content'], 0, 180) . '...'
                                : $note['content']; ?>
                        </div>
                        <div class="note-footer">
                            <div class="note-date">
                                <?= htmlspecialchars($note['created_at']); ?>
                                <?php if (!empty($note['updated_at']) && $note['updated_at'] !== $note['created_at']): ?>
                                    <br>
                                    <span style="color:#FFD924; font-size:0.97em;">
                                        (оновлено: <?= htmlspecialchars($note['updated_at']); ?>)
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="note-actions" style="display: flex; gap: 0.5rem; align-items: center;">
                                <a href="/public/note.php?id=<?= $note['id']; ?>" class="note-action-btn" title="Редагувати" style="display: flex; align-items: center; justify-content: center; width: 38px; height: 38px;">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                                        <path d="M4 17.5V18.5H5H17H18V17.5V15.5V14.5H17H5H4V15.5V17.5Z" stroke="#FFD924" stroke-width="2"/>
                                        <path d="M16.1213 5.87868C16.5118 5.48816 16.5118 4.85499 16.1213 4.46447L15.5355 3.87868C15.145 3.48816 14.5118 3.48816 14.1213 3.87868L6 12V15H9L16.1213 7.87868Z" stroke="#FFD924" stroke-width="2"/>
                                    </svg>
                                </a>
                                <form method="post" action="/public/note.php?id=<?= $note['id']; ?>" style="display:inline;">
                                    <button type="submit" name="delete" class="note-action-btn" title="Видалити" onclick="return confirm('Видалити нотатку?');" style="background:none; border:none; padding:0; display: flex; align-items: center; justify-content: center; width: 38px; height: 38px;">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                                            <path d="M6 7V17C6 18.1046 6.89543 19 8 19H14C15.1046 19 16 18.1046 16 17V7" stroke="#FFD924" stroke-width="2"/>
                                            <path d="M3 7H19" stroke="#FFD924" stroke-width="2"/>
                                            <path d="M9 10V15" stroke="#FFD924" stroke-width="2"/>
                                            <path d="M13 10V15" stroke="#FFD924" stroke-width="2"/>
                                            <path d="M8 7V5C8 3.89543 8.89543 3 10 3H12C13.1046 3 14 3.89543 14 5V7" stroke="#FFD924" stroke-width="2"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="not-found">У вас ще немає нотаток.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        window.onclick = function(event) {
            var modal = document.getElementById('addNoteModal');
            if (event.target === modal) modal.style.display = "none";
        }

        // Показать/скрыть выпадающее меню профиля (по клику и по наведению)
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
        profileDropdown.addEventListener('mouseenter', function() {
            profileDropdown.style.display = 'block';
        });
        profileDropdown.addEventListener('mouseleave', function() {
            profileDropdown.style.display = 'none';
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous"></script>
</body>
</html>