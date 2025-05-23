<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotesApp – Мої нотатки</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Ubuntu', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
  background: url('/images/figure.png') no-repeat center center fixed;
  background-size: cover;
  background-color: #111;
  color: #fff;
  min-height: 100vh;
  overflow-x: hidden;
  position: relative;
}

.blur-bg {
  position: fixed;
  inset: 0;
  z-index: 0;
  backdrop-filter: blur(8px) brightness(0.7);
  -webkit-backdrop-filter: blur(8px) brightness(0.7);
  pointer-events: none;
}

/* === НАВИГАЦИЯ === */
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 10;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 3rem;
  background: rgba(24, 24, 24, 0.55);
  backdrop-filter: blur(10px) saturate(1.2);
  -webkit-backdrop-filter: blur(10px) saturate(1.2);
  border-bottom: 1.5px solid rgba(255, 217, 36, 0.07);
}

.logo {
  display: flex;
  align-items: center;
  gap: 0.2em;
  font-size: 2.1rem;
  font-weight: bold;
  text-decoration: none;
}

.logo-notes {
  background: linear-gradient(to right, #AD6000, #FFD924 80%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.logo-app {
  color: #fff;
}

.cta-buttons {
  display: flex;
  gap: 1rem;
}

/* === КНОПКИ === */
.btn {
  padding: 0.6rem 1.5rem;
  border-radius: 50px;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.3s;
}

.btn-outline {
  background-color: transparent;
  border: 2px solid transparent;
  border-image: linear-gradient(to right, #AD6000, #FFD924);
  border-image-slice: 1;
  background: linear-gradient(to right, #AD6000, #FFD924);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.btn-outline:hover {
  background-color: rgba(255, 217, 36, 0.1);
}

.btn-primary {
  background: linear-gradient(to right, #AD6000, #FFD924);
  border: none;
  color: #111;
}

.btn-primary:hover {
  background: linear-gradient(to right, #925200, #FFCF00);
}

/* === ОСНОВНОЙ КОНТЕНТ === */
.main-content {
  max-width: 1600px;
  margin: 0 auto;
  padding: 6.5rem 1.5rem 2rem;
  position: relative;
  z-index: 2;
  min-height: 80vh;
  display: flex;
  flex-direction: column;
}

.top-filters-row {
  display: flex;
  flex-wrap: wrap;
  gap: 1.2rem;
  align-items: center;
  margin-bottom: 1.5rem;
}

/* === ФИЛЬТРЫ И ПОЛЯ === */
.search-input,
.category-select {
  padding: 0.7rem 1.2rem;
  border-radius: 18px;
  border: none;
  font-size: 1.1rem;
  background: rgba(255, 255, 255, 0.13);
  color: #fff;
  outline: none;
}

.search-input {
  flex: 1 1 300px;
  min-width: 180px;
  transition: box-shadow 0.2s;
}

.search-input:focus {
  box-shadow: 0 2px 16px rgba(255, 217, 36, 0.18);
}

.category-select {
  flex: 0 0 220px;
  min-width: 140px;
  font-weight: 500;
  color: #FFD924;
}

/* === ДОБАВИТЬ ЗАМЕТКУ === */
.add-note-btn {
  margin-left: auto;
  background: #222;
  color: #FFD924;
  border: none;
  padding: 13px 36px;
  border-radius: 24px;
  cursor: pointer;
  font-weight: 700;
  font-size: 1.13rem;
  letter-spacing: 1px;
  transition: background 0.2s, letter-spacing 0.2s;
}

.add-note-btn:hover {
  background: linear-gradient(to right, #925200, #FFCF00);
  letter-spacing: 2px;
}

/* === СПИСОК ЗАМЕТОК === */
.notes-list {
  display: flex;
  flex-wrap: wrap;
  gap: 1.2rem;
  justify-content: flex-start;
  margin-top: 0.5rem;
}

/* === КАРТОЧКА ЗАМЕТКИ === */
.note-card {
  background: rgba(24, 24, 24, 0.82);
  padding: 2.1rem;
  display: flex;
  flex-direction: column;
  border: 2px solid rgba(255, 217, 36, 0.13);
  width: 360px;
  height: 360px;
  overflow: hidden;
  transition: transform 0.22s;
}

.note-card:hover {
  transform: translateY(-1px) scale(1.005);
}

.note-title-row {
  display: flex;
  align-items: center;
  gap: 0.7em;
  margin-bottom: 0.7em;
}

.note-category-icon {
  font-size: 1.35rem;
  color: #FFD924;
}

.note-title {
  flex: 1;
  font-size: 1.35rem;
  font-weight: 700;
  color: #FFD924;
  word-break: break-word;
}

/* === ТЕГИ === */
.note-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.6em;
  margin-bottom: 1.1em;
}

.note-tag {
  background: linear-gradient(to right, #FFD924, #AD6000 80%);
  color: #181818;
  font-size: 1.05rem;
  font-weight: 500;
  border-radius: 14px;
  padding: 0.22em 1.1em;
  opacity: 0.95;
  letter-spacing: 0.7px;
}

/* === СОДЕРЖИМОЕ === */
.note-content {
  font-size: 1.18rem;
  color: #fff;
  opacity: 0.97;
  margin-bottom: 1.5rem;
  word-break: break-word;
  line-height: 1.7;
  min-height: 4.5em;
  max-height: 8.5em;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 5;
  -webkit-box-orient: vertical;
}

/* === ФУТЕР КАРТОЧКИ === */
.note-footer {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  margin-top: auto;
}

.note-date {
  font-size: 1.05rem;
  color: #AD6000;
  opacity: 0.85;
  font-weight: 500;
}

.note-actions {
  display: flex;
  gap: 1.1rem;
}

.search-btn {
  width: 44px;
  height: 44px;
  border: none;
  border-radius: 50%;
  background: none;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 12px rgba(255, 217, 36, 0.13), 0 2px 8px rgba(0, 0, 0, 0.10);
  cursor: pointer;
  transition: box-shadow 0.18s, transform 0.18s;
  margin-left: 0;
  padding: 0;
}

.search-btn svg {
  display: block;
  transition: transform 0.18s;
}

.search-btn:hover {
  box-shadow: 0 4px 18px rgba(255, 217, 36, 0.22), 0 4px 16px rgba(0, 0, 0, 0.13);
  transform: scale(1.07);
}

.search-btn:active svg {
  transform: scale(0.95);
}
    </style>
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
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id']; ?>" <?= (isset($_GET['category_id']) && $_GET['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <button class="add-note-btn" type="submit" style="margin-left:0; width:44px; height:44px; padding:0; display:flex; align-items:center; justify-content:center; background:linear-gradient(to right, #AD6000, #FFD924); color:#181818;">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <circle cx="10" cy="10" r="7" stroke="#181818" stroke-width="2" fill="none"/>
                        <line x1="15.2" y1="15.2" x2="20" y2="20" stroke="#181818" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
                <a href="/public/note.php" class="add-note-btn" style="text-align:center; text-decoration:none; background:linear-gradient(to right, #AD6000, #FFD924); color:#181818;">+ Додати нотатку</a>
            </form>
        </div>
        <div class="notes-list">
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $note): ?>
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
                <p class="not-found">Нічого не знайдено.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous"></script>
    <script>
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
</body>
</html>
