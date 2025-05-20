<!-- filepath: e:\OSPanel\domains\NotesApp\src\views\notes.php -->
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
            background-color: #111111;
            color: #ffffff;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        .blur-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            z-index: 0;
            backdrop-filter: blur(8px) brightness(0.7);
            -webkit-backdrop-filter: blur(8px) brightness(0.7);
            pointer-events: none;
        }
        /* Удалено: background: url('/images/figure.png') ... и все эффекты blur/bg */
        /* Удалите или закомментируйте все box-shadow и background: linear-gradient ... #FFD924 ... если хотите убрать желтое свечение с карточек и кнопок */
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
        .nav-links { display: none; }
        .cta-buttons {
            display: flex;
            gap: 1rem;
        }
        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            font-weight: 500;
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
            color: #111111;
            position: relative;
            z-index: 1;
        }
        .btn-primary:hover {
            background: linear-gradient(to right, #925200, #FFCF00);
        }

        .main-content {
            max-width: 1300px;
            margin-left: 0;
            margin-right: auto;
            padding: 6.5rem 1.5rem 2rem 1.5rem;
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
            width: 100%;
        }
        .search-input {
            flex: 1 1 300px;
            min-width: 180px;
            max-width: 100%;
            padding: 0.7rem 1.2rem;
            border-radius: 18px;
            border: none;
            font-size: 1.1rem;
            background: rgba(255,255,255,0.13);
            color: #fff;
            outline: none;
            transition: box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(255,217,36,0.07);
        }
        .search-input:focus {
            box-shadow: 0 2px 16px rgba(255,217,36,0.18);
        }
        .category-select {
            flex: 0 0 220px;
            min-width: 140px;
            padding: 0.7rem 1.2rem;
            border-radius: 18px;
            border: none;
            font-size: 1.1rem;
            background: rgba(255,255,255,0.13);
            color: #FFD924;
            outline: none;
            font-weight: 500;
        }
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
            transition: background 0.2s, letter-spacing 0.2s;
            letter-spacing: 1px;
            box-shadow: none;
        }
        .add-note-btn:hover {
            background: linear-gradient(to right, #925200, #FFCF00);
            letter-spacing: 2px;
        }
        .notes-list {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem 1.5rem;
            width: 100%;
            justify-content: flex-start;
            margin-top: 0.5rem;
            align-items: flex-start;
        }
        .note-card {
            background: rgba(24,24,24,0.82);
            /* border-radius: 22px; */
            /* Удалить box-shadow: 0 12px 36px rgba(255,217,36,0.16), 0 4px 16px rgba(0,0,0,0.22); */
            padding: 2.1rem 2.1rem 1.7rem 2.1rem;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.22s, transform 0.22s;
            position: relative;
            border: 2px solid rgba(255,217,36,0.13);
            overflow: hidden;
            min-width: 0;
            /* Фіксована ширина та висота для однакових квадратних карток */
            width: 360px;
            height: 360px;
            /* Без заокруглень */
            border-radius: 0;
            margin-left: 0;
        }
        .note-card:hover {
            /* Без підсвітки */
            box-shadow: none;
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
            margin-right: 0.3em;
            vertical-align: middle;
        }
        .note-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #FFD924;
            word-break: break-word;
            flex: 1;
            letter-spacing: 0.5px;
        }
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
            margin-right: 0.1em;
            opacity: 0.95;
            letter-spacing: 0.7px;
            box-shadow: 0 2px 8px rgba(255,217,36,0.13);
        }
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
            margin-bottom: 0.2rem;
            font-weight: 500;
        }
        .note-actions {
            display: flex;
            gap: 1.1rem;
        }
        .note-action-btn {
            background: none;
            border: none;
            color: #FFD924;
            font-size: 1.25rem;
            cursor: pointer;
            transition: color 0.2s, transform 0.15s;
            padding: 0.28em 0.5em;
            border-radius: 50%;
        }
        .note-action-btn:hover {
            color: #AD6000;
            background: rgba(255,217,36,0.10);
            transform: scale(1.17);
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
        @media (max-width: 1300px) {
            .main-content {
                max-width: 98vw;
            }
            .notes-list {
                gap: 1.5rem 1.2rem;
            }
            .note-card {
                max-width: 24vw;
                flex-basis: 24vw;
            }
        }
        @media (max-width: 1100px) {
            .note-card {
                max-width: 32vw;
                flex-basis: 32vw;
            }
        }
        @media (max-width: 900px) {
            .main-content {
                padding: 6.5rem 0.5rem 1rem 0.5rem;
                max-width: 99vw;
            }
            .notes-list {
                gap: 1.2rem;
            }
            .note-card {
                max-width: 45vw;
                flex-basis: 45vw;
                padding: 1.2rem 1rem 1rem 1rem;
            }
        }
        @media (max-width: 600px) {
            .navbar {
                flex-direction: column;
                padding: 1rem 0.5rem;
            }
            .main-content {
                padding: 5.5rem 0.2rem 0.5rem 0.2rem;
            }
            .top-filters-row {
                flex-direction: column;
                gap: 0.7rem;
            }
            .notes-list {
                flex-direction: column;
                gap: 1rem;
            }
            .note-card {
                min-width: unset;
                max-width: 100%;
                flex-basis: 100%;
                padding: 1rem 0.7rem 0.7rem 0.7rem;
            }
        }
        .note-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
            transition: filter 0.15s;
        }
        .note-card-link:hover .note-card {
            filter: none;
        }
        .note-card .note-actions button {
            pointer-events: auto;
        }
        .note-card-link .note-actions button {
            pointer-events: auto;
        }
    </style>
</head>
<body>
    <div class="blur-bg"></div>
    <nav class="navbar">
        <a href="index.php" class="logo"><span class="logo-notes">Notes</span><span class="logo-app">App</span></a>
        <div class="cta-buttons">
            <a href="/public/user.php" class="profile-svg-link" title="Профіль">
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
            </a>
        </div>
    </nav>
    <div class="main-content">
        <div class="top-filters-row">
            <input type="text" class="search-input" placeholder="Пошук нотатки...">
            <select class="category-select" onchange="if(this.value) window.location.href='/public/category.php?id='+this.value;">
                <option value="">Всі категорії</option>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id']; ?>">
                            <?= htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <button class="add-note-btn">+ Додати нотатку</button>
        </div>
        <div class="notes-list">
            <?php if (!empty($notes)): ?>
                <?php foreach ($notes as $note): ?>
                    <a href="/public/note.php?id=<?= $note['id']; ?>" class="note-card-link">
                        <div class="note-card">
                            <div class="note-title-row">
                                <!-- Можно добавить иконку категории, если есть -->
                                <span class="note-title"><?= htmlspecialchars($note['title']); ?></span>
                            </div>
                            <div class="note-tags">
                                <?php if (!empty($note['tags'])): ?>
                                    <?php foreach ($note['tags'] as $tag): ?>
                                        <span class="note-tag"><?= htmlspecialchars($tag['name']); ?></span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="note-content"><?= htmlspecialchars(mb_substr($note['content'], 0, 180)); ?><?= mb_strlen($note['content']) > 180 ? '...' : '' ?></div>
                            <div class="note-footer">
                                <div class="note-date"><?= htmlspecialchars($note['created_at']); ?></div>
                                <div class="note-actions">
                                    <button class="note-action-btn" title="Редагувати"><i class="fas fa-edit"></i></button>
                                    <button class="note-action-btn" title="Видалити"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="not-found">У вас ще немає нотаток.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous"></script>
</body>
</html>