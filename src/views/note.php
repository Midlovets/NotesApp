<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Перегляд нотатки – NotesApp</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background: url('/images/figure.png') no-repeat center center fixed;
            background-size: cover;
            background-color: #111111;
            color: #fff;
            min-height: 100vh;
            font-family: 'Ubuntu', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        .blur-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            z-index: 0;
            backdrop-filter: blur(8px) brightness(0.7);
            -webkit-backdrop-filter: blur(8px) brightness(0.7);
            pointer-events: none;
        }
        .navbar {
            position: fixed;
            top: 0; left: 0; width: 100vw;
            z-index: 10;
            background: rgba(24,24,24,0.55);
            backdrop-filter: blur(10px) saturate(1.2);
            -webkit-backdrop-filter: blur(10px) saturate(1.2);
            box-shadow: 0 2px 18px 0 rgba(0,0,0,0.10);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 3rem;
            border-bottom: 1.5px solid rgba(255,217,36,0.07);
        }
        .logo {
            font-size: 2.1rem;
            font-weight: bold;
            text-decoration: none;
            letter-spacing: 1.5px;
            display: flex;
            align-items: center;
            gap: 0.2em;
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
        .profile-svg-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: none;
            transition: box-shadow 0.2s, background 0.2s;
            margin-left: 0.5rem;
        }
        .profile-svg-link:hover {
            background: rgba(255,217,36,0.11);
            box-shadow: 0 2px 10px rgba(255,217,36,0.15);
        }
        .profile-svg-icon {
            display: block;
            width: 38px;
            height: 38px;
        }
        .details-full-bg {
            display: none; /* скрываем лишний фон */
        }
        .details-main {
            max-width: 950px;
            min-height: 80vh;
            margin: 7.5rem auto 2.5rem auto;
            background: rgba(24,24,24,0.78); /* как в notes.php */
            border-radius: 0; /* убираем скругление */
            box-shadow: 0 8px 32px 0 rgba(0,0,0,0.18), 0 2px 8px rgba(255,217,36,0.13);
            border: 1.5px solid rgba(255,217,36,0.10); /* как в notes.php */
            padding: 3.5rem 3vw 2.5rem 3vw;
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            overflow: hidden;
            box-sizing: border-box;
        }
        .details-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        .note-category-icon {
            font-size: 2.5rem;
            color: #FFD924;
            filter: drop-shadow(0 2px 8px #FFD92433);
        }
        .details-title-input {
            font-size: 2.7rem;
            font-weight: 700;
            background: none;
            border: none;
            color: #FFD924;
            width: 100%;
            outline: none;
            margin-bottom: 0.2em;
            letter-spacing: 1.5px;
            line-height: 1.1;
        }
        .details-meta {
            display: flex;
            gap: 2.5rem;
            font-size: 1.18rem;
            color: #AD6000;
            opacity: 0.85;
            margin-bottom: 2.2rem;
            flex-wrap: wrap;
        }
        .note-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.7em;
            margin-bottom: 1.7em;
            align-items: center;
        }
        .add-tag-btn {
            background: linear-gradient(to right, #FFD924, #AD6000 80%);
            color: #181818;
            border: none;
            border-radius: 16px;
            font-size: 1.13rem;
            font-weight: 600;
            padding: 0.22em 1.2em;
            cursor: pointer;
            transition: background 0.2s;
            margin-left: 0.7em;
            height: 2.2em;
            display: flex;
            align-items: center;
        }
        .add-tag-btn:hover {
            background: linear-gradient(to right, #AD6000, #FFD924 80%);
        }
        .add-tag-form {
            display: flex;
            align-items: center;
            gap: 0.5em;
            margin-left: 0.7em;
        }
        .add-tag-form.hidden {
            display: none;
        }
        .add-tag-input {
            background: rgba(255,217,36,0.13);
            color: #FFD924;
            min-width: 80px;
            font-size: 1.13rem;
            font-weight: 500;
            border-radius: 16px;
            padding: 0.22em 1.2em;
            border: 1.5px solid #FFD92444;
            outline: none;
            margin-right: 0.1em;
        }
        .details-content-area {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            min-height: 340px;
            font-size: 1.45rem;
            color: #fff;
            background: rgba(255,255,255,0.10);
            border: none;
            border-radius: 0; /* убираем скругление */
            padding: 2.2em 1.7em;
            margin-bottom: 2.7em;
            resize: vertical;
            outline: none;
            font-family: inherit;
            box-shadow: none; /* убираем подсветку */
            line-height: 1.8;
            transition: background 0.2s;
            box-sizing: border-box;
            overflow-wrap: break-word;
        }
        .details-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1.7rem;
            margin-top: 1.5rem;
        }
        .btn {
            padding: 1.1rem 2.7rem;
            border-radius: 28px;
            font-size: 1.18rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            font-weight: 600;
            border: none;
        }
        .btn-back {
            background: none;
            color: #FFD924;
            border: 1.5px solid #FFD924;
        }
        .btn-back:hover {
            background: rgba(255,217,36,0.08);
        }
        .btn-save {
            background: linear-gradient(to right, #AD6000, #FFD924);
            color: #181818;
        }
        .btn-save:hover {
            background: linear-gradient(to right, #925200, #FFCF00);
        }
        .btn-delete {
            background: none;
            color: #fff;
            border: 1.5px solid #AD6000;
        }
        .btn-delete:hover {
            background: rgba(173,96,0,0.13);
            color: #FFD924;
        }
        .note-tag {
            background: linear-gradient(to right, #FFD924, #AD6000 80%);
            color: #181818;
            font-size: 1.13rem;
            font-weight: 500;
            border-radius: 16px;
            padding: 0.22em 1.2em;
            margin-right: 0.1em;
            opacity: 0.93;
            letter-spacing: 0.7px;
            box-shadow: 0 1px 6px rgba(255,217,36,0.13), 0 1px 4px rgba(0,0,0,0.10);
            border: none;
            outline: none;
            display: flex;
            align-items: center;
            gap: 0.5em;
            transition: box-shadow 0.18s, filter 0.18s, background 0.18s;
            cursor: default;
        }
        .note-tag:hover {
            box-shadow: 0 2px 12px rgba(255,217,36,0.22), 0 2px 8px rgba(0,0,0,0.13);
            filter: brightness(1.08);
        }
        .note-tag .remove-tag {
            background: none;
            border: none;
            color: #AD6000;
            font-size: 1.1em;
            margin-left: 0.3em;
            cursor: pointer;
            padding: 0;
            transition: color 0.2s;
            border-radius: 50%;
            width: 1.5em;
            height: 1.5em;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .note-tag .remove-tag:hover {
            color: #d32f2f;
            background: rgba(255,217,36,0.13);
        }
        @media (max-width: 1100px) {
            .details-main {
                max-width: 99vw;
                padding: 2.2rem 1.2rem 1.2rem 1.2rem;
            }
        }
        @media (max-width: 700px) {
            .details-main {
                padding: 1.2rem 0.5rem 1rem 0.5rem;
                border-radius: 18px;
            }
            .details-title-input {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="blur-bg"></div>
    <div class="details-full-bg"></div>
    <nav class="navbar">
        <a href="notes.php" class="logo"><span class="logo-notes">Notes</span><span class="logo-app">App</span></a>
        <div class="cta-buttons" style="position: relative;">
            <button type="button" class="profile-svg-link" id="profileMenuBtn" title="Профіль" style="border:none; background:none; padding:0;">
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
            </button>
            <div id="profileDropdown" style="display:none; position:absolute; top:48px; right:0; background:rgba(24,24,24,0.97); border:1.5px solid #FFD92444; border-radius:12px; min-width:160px; box-shadow:0 4px 16px rgba(0,0,0,0.18); z-index:100;">
                <a href="/public/user.php" style="display:block; padding:12px 18px; color:#FFD924; text-decoration:none; font-weight:500;">Профіль</a>
                <a href="/public/logout.php" style="display:block; padding:12px 18px; color:#fff; text-decoration:none; font-weight:500;">Вийти</a>
            </div>
        </div>
    </nav>
    <form class="details-main" method="post" action="note.php?id=<?= (int)$note['id'] ?>" id="noteForm" autocomplete="off">
        <div class="details-header">
            <span class="note-category-icon"><i class="fas fa-lightbulb"></i></span>
            <input type="text" class="details-title-input" name="title" value="<?= htmlspecialchars($note['title']); ?>" required>
        </div>
        <div class="details-meta">
            <span><?= htmlspecialchars($note['created_at']); ?></span>
            <span>Категорія:
                <select name="category_id" style="background: none; color: #FFD924; border: none; font-weight: 500;">
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= (isset($selectedCategoryId) && $selectedCategoryId == $cat['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </span>
        </div>
        <div class="note-tags" id="tags-list">
            <?php if (!empty($tags)): ?>
                <?php foreach ($tags as $tag): ?>
                    <span class="note-tag"><?= htmlspecialchars($tag['name']); ?> <button type="button" class="remove-tag" title="Видалити тег">&times;</button></span>
                <?php endforeach; ?>
            <?php endif; ?>
            <button type="button" class="add-tag-btn" id="showAddTagBtn">Додати тег</button>
            <span class="add-tag-form hidden" id="addTagForm">
                <input type="text" class="add-tag-input" id="addTagInput" placeholder="Новий тег...">
                <button type="button" class="add-tag-btn" id="addTagBtn">OK</button>
            </span>
        </div>
        <input type="hidden" name="tags" id="tagsInput" value="<?= htmlspecialchars(implode(',', array_column($tags ?? [], 'name'))); ?>">
        <textarea class="details-content-area" name="content" required><?= htmlspecialchars($note['content']); ?></textarea>
        <div class="details-actions">
            <a href="notes.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Назад</a>
            <button type="submit" name="save" class="btn btn-save"><i class="fas fa-save"></i> Зберегти</button>
            <button type="submit" name="delete" class="btn btn-delete" onclick="return confirm('Видалити нотатку?');"><i class="fas fa-trash"></i> Видалити</button>
        </div>
    </form>
    <script>
        // Теги: добавление и удаление
        const tagsList = document.getElementById('tags-list');
        const addTagInput = document.getElementById('addTagInput');
        const addTagBtn = document.getElementById('addTagBtn');
        const tagsInput = document.getElementById('tagsInput');
        const showAddTagBtn = document.getElementById('showAddTagBtn');
        const addTagForm = document.getElementById('addTagForm');

        function getTags() {
            return Array.from(tagsList.querySelectorAll('.note-tag')).map(tag => tag.childNodes[0].textContent.trim());
        }
        function updateTagsInput() {
            tagsInput.value = getTags().join(',');
        }
        function removeTagHandler(e) {
            e.target.closest('.note-tag').remove();
            updateTagsInput();
        }
        tagsList.querySelectorAll('.remove-tag').forEach(btn => {
            btn.onclick = removeTagHandler;
        });

        showAddTagBtn.onclick = function() {
            showAddTagBtn.style.display = 'none';
            addTagForm.classList.remove('hidden');
            addTagInput.focus();
        };

        addTagBtn.onclick = function() {
            const val = addTagInput.value.trim();
            if (val && !getTags().includes(val)) {
                const span = document.createElement('span');
                span.className = 'note-tag';
                span.innerHTML = `${val} <button type="button" class="remove-tag" title="Видалити тег">&times;</button>`;
                span.querySelector('.remove-tag').onclick = removeTagHandler;
                tagsList.insertBefore(span, showAddTagBtn);
                addTagInput.value = '';
                updateTagsInput();
            }
            addTagForm.classList.add('hidden');
            showAddTagBtn.style.display = '';
        };

        addTagInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addTagBtn.click();
            } else if (e.key === 'Escape') {
                addTagForm.classList.add('hidden');
                showAddTagBtn.style.display = '';
            }
        });

        addTagInput.addEventListener('blur', function(e) {
            setTimeout(() => {
                if (!document.activeElement.classList.contains('add-tag-btn')) {
                    addTagForm.classList.add('hidden');
                    showAddTagBtn.style.display = '';
                }
            }, 100);
        });

        // Скрывать форму при потере фокуса (если не клик по кнопке)
        addTagInput.addEventListener('blur', function(e) {
            setTimeout(() => {
                if (!document.activeElement.classList.contains('add-tag-btn')) {
                    addTagForm.classList.add('hidden');
                    showAddTagBtn.style.display = '';
                }
            }, 100);
        });

        // Показать/скрыть выпадающее меню профиля
        const profileMenuBtn = document.getElementById('profileMenuBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        document.addEventListener('click', function(e) {
            if (profileMenuBtn.contains(e.target)) {
                profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
            } else if (!profileDropdown.contains(e.target)) {
                profileDropdown.style.display = 'none';
            }
        });
    </script>
    <!-- Дополнительная иконка профиля с меню (вверху страницы, справа) -->
    <div style="position: fixed; top: 24px; right: 24px; z-index: 100;">
        <button type="button" class="profile-svg-link" id="profileMenuBtn2" title="Профіль" style="border:none; background:none; padding:0;">
            <svg class="profile-svg-icon" width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="19" cy="19" r="18" fill="url(#profileGradient2)" stroke="#FFD924" stroke-width="1.5"/>
                <ellipse cx="19" cy="15.5" rx="7" ry="7" fill="#181818" stroke="#FFD924" stroke-width="1.2"/>
                <ellipse cx="19" cy="27.5" rx="11" ry="6" fill="#181818" stroke="#FFD924" stroke-width="1.2"/>
                <defs>
                    <linearGradient id="profileGradient2" x1="0" y1="0" x2="38" y2="38" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FFD924"/>
                        <stop offset="1" stop-color="#AD6000"/>
                    </linearGradient>
                </defs>
            </svg>
        </button>
        <div id="profileDropdown2" style="display:none; position:absolute; top:48px; right:0; background:rgba(24,24,24,0.97); border:1.5px solid #FFD92444; border-radius:12px; min-width:160px; box-shadow:0 4px 16px rgba(0,0,0,0.18); z-index:100;">
            <a href="/public/user.php" style="display:block; padding:12px 18px; color:#FFD924; text-decoration:none; font-weight:500;">Профіль</a>
            <a href="/public/logout.php" style="display:block; padding:12px 18px; color:#fff; text-decoration:none; font-weight:500;">Вийти</a>
        </div>
    </div>
    <script>
        const profileMenuBtn2 = document.getElementById('profileMenuBtn2');
        const profileDropdown2 = document.getElementById('profileDropdown2');
        document.addEventListener('click', function(e) {
            if (profileMenuBtn2 && profileMenuBtn2.contains(e.target)) {
                profileDropdown2.style.display = profileDropdown2.style.display === 'block' ? 'none' : 'block';
            } else if (profileDropdown2 && !profileDropdown2.contains(e.target)) {
                profileDropdown2.style.display = 'none';
            }
        });
    </script>
</body>
</html>
