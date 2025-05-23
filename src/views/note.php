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

.btn {
  padding: 0.6rem 1.5rem;
  border-radius: 50px;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.3s;
  background: #181818;
  color: #FFD924;
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
  background: linear-gradient(to right, #7a4a00, #bfa800);
  border: none;
  color: #111;
}

.btn-primary:hover {
  background: linear-gradient(to right, #5c3900, #FFD924);
}

.add-note-btn {
  margin-left: auto;
  background: #181818;
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
  background: linear-gradient(to right, #7a4a00, #bfa800);
  letter-spacing: 2px;
}

.notes-list {
  display: flex;
  flex-wrap: wrap;
  gap: 1.2rem;
  justify-content: flex-start;
  margin-top: 0.5rem;
}

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
  font-weight: 500;
}

.note-actions {
  display: flex;
  gap: 1.1rem;
}
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
            border-bottom: 1.3px solid #FFD924; /* тоньше линия */
            box-shadow: none;
            transition: border-color 0.2s;
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
            background: #181818;
            color: #FFD924;
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
            background: linear-gradient(to right, #7a4a00, #bfa800);
            color: #181818;
        }
        .btn-save:hover {
            background: linear-gradient(to right, #5c3900, #FFD924);
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
        .category-select,
        select[name="category_id"] {
            background: rgba(24,24,24,0.97);
            color: #FFD924;
            border: 1.5px solid #FFD92444;
            font-weight: 500;
            border-radius: 10px;
            padding: 0.5em 2.2em 0.5em 1em;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.13);
            transition: background 0.2s, color 0.2s;
            position: relative;
        }
        /* Убираем встроенную стрелку */
        select[name="category_id"] {
            background-image: none !important;
        }
        .category-select-wrap {
            display: inline-flex;
            align-items: center;
            position: relative;
        }
        .category-arrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1em;
            height: 1em;
            margin-left: -1.7em; /* чуть левее */
            margin-right: 0.15em;
            cursor: pointer;
            z-index: 2;
            position: relative;
            color: #FFD924;
            font-size: 0.95em;
            transition: color 0.18s;
            user-select: none;
            padding: 0;
        }
        .category-arrow svg {
            display: block;
            width: 1em;
            height: 1em;
        }
        .category-arrow:hover {
            color: #fff;
        }
        select[name="category_id"] option {
            background: #181818 !important;
            color: #FFD924;
        }
        /* Панель форматирования */
        .formatting-toolbar {
            display: flex;
            gap: 0.5em;
            margin-bottom: 1em;
            align-items: center;
        }
        .format-btn {
            background: linear-gradient(to right, #bfa800 90%, #FFD924 100%);
            color: #181818;
            border: none;
            border-radius: 14px;
            font-size: 1.13rem;
            font-weight: 700;
            padding: 0.22em 1.1em;
            cursor: pointer;
            transition: background 0.18s, color 0.18s, box-shadow 0.18s;
            box-shadow: 0 1px 4px rgba(255,217,36,0.13), 0 1px 2px rgba(0,0,0,0.07);
            outline: none;
            display: flex;
            align-items: center;
            gap: 0.2em;
        }
        .formatting-toolbar .format-btn:hover, .formatting-toolbar .format-btn:focus {
            background: linear-gradient(90deg, #FFD924 90%, #bfa800 100%);
            color: #181818;
            box-shadow: 0 2px 8px rgba(255,217,36,0.18), 0 1px 4px rgba(0,0,0,0.09);
        }
        .formatting-toolbar .format-separator {
            background: rgba(255,217,36,0.13);
        }
        /* Отступы и цвет маркеров для всех списков одинаковые */
        #noteContent ul,
        #noteContent ol,
        #noteContent .dash-list {
            margin-left: 2.2em;
            margin-bottom: 1em;
            color: #FFD924;
        }
        #noteContent ul {
            list-style-type: disc;
        }
        #noteContent ol {
            list-style-type: decimal;
        }
        #noteContent .dash-list {
            list-style-type: none;
            padding-left: 0;
        }
        #noteContent .dash-list li::before {
            content: "";
            display: inline-block;
            width: 1.2em;
            height: 2px;
            background: #fff;
            margin-right: 0.7em;
            vertical-align: middle;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <div class="blur-bg"></div>
    <div class="details-full-bg"></div>
   <nav class="navbar">
        <a href="index.php" class="logo"><span class="logo-notes">Notes</span><span class="logo-app">App</span></a>
        <div class="cta-buttons" style="position: relative;">
            <a href="/public/user.php" class="profile-svg-link" id="profileMenuBtn" title="Профіль" style="position: relative;">
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
            <div id="profileDropdown" style="display:none; position:absolute; top:48px; right:0; background:rgba(24,24,24,0.97); border:1.5px solid #FFD92444; border-radius:12px; min-width:160px; box-shadow:0 4px 16px rgba(0,0,0,0.18); z-index:100;">
                <a href="/public/user.php" style="display:block; padding:12px 18px; color:#FFD924; text-decoration:none; font-weight:500;">Профіль</a>
                <a href="/public/logout.php" style="display:block; padding:12px 18px; color:#fff; text-decoration:none; font-weight:500;">Вийти</a>
            </div>
        </div>
    </nav>
    <form class="details-main" method="post" action="note.php<?= isset($note['id']) ? '?id=' . (int)$note['id'] : '' ?>" id="noteForm" autocomplete="off">
        <div class="details-header">
            <!-- <span class="note-category-icon"><i class="fas fa-lightbulb"></i></span> -->
            <input type="text" class="details-title-input" name="title" value="<?= isset($note['title']) ? htmlspecialchars($note['title']) : '' ?>" required>
        </div>
        <div class="details-meta">
            <span>
                <?= isset($note['created_at']) ? htmlspecialchars($note['created_at']) : date('Y-m-d H:i') ?>
                <?php if (isset($note['updated_at']) && $note['updated_at'] !== $note['created_at']): ?>
                    <br>
                    <span style="color:#FFD924; font-size:0.97em;">
                        (оновлено: <?= htmlspecialchars($note['updated_at']); ?>)
                    </span>
                <?php endif; ?>
            </span>
            <span>Категорія:
                <span class="category-select-wrap">
                    <select name="category_id" style="background: none; color: #FFD924; border: none; font-weight: 500;">
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= (isset($selectedCategoryId) && $selectedCategoryId == $cat['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="category-arrow" id="categoryArrow">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path d="M6.5 8l3.5 3.5L13.5 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        </svg>
                    </span>
                </span>
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
        <input type="hidden" name="tags" id="tagsInput" value="<?= htmlspecialchars(isset($tags) ? implode(',', array_column($tags, 'name')) : ''); ?>">
        <!-- Панель форматирования -->
        <div class="formatting-toolbar" style="display:flex; gap:0.5em; margin-bottom:1em; align-items:center;">
            <button type="button" class="format-btn" data-format="bold" title="Жирний текст (Ctrl+B)">
                <i class="fas fa-bold"></i>
            </button>
            <button type="button" class="format-btn" data-format="italic" title="Курсив (Ctrl+I)">
                <i class="fas fa-italic"></i>
            </button>
            <button type="button" class="format-btn" data-format="underline" title="Підкреслений (Ctrl+U)">
                <i class="fas fa-underline"></i>
            </button>
            <div class="format-separator" style="width:1px; height:1.8em; background:rgba(255,217,36,0.25); margin:0 0.5em;"></div>
            <button type="button" class="format-btn" data-format="h1" title="Заголовок 1">
                H1
            </button>
            <button type="button" class="format-btn" data-format="h2" title="Заголовок 2">
                H2
            </button>
            <button type="button" class="format-btn" data-format="h3" title="Заголовок 3">
                H3
            </button>
            <div class="format-separator" style="width:1px; height:1.8em; background:rgba(255,217,36,0.25); margin:0 0.5em;"></div>
            <!-- Списки -->
            <button type="button" class="format-btn" data-format="ul" title="Маркірований список">
                <i class="fas fa-list-ul"></i>
            </button>
            <button type="button" class="format-btn" data-format="ol" title="Нумерований список">
                <i class="fas fa-list-ol"></i>
            </button>
            <button type="button" class="format-btn" data-format="dash" title="Список з лініями">
                <svg width="18" height="18" style="vertical-align:middle" viewBox="0 0 18 18"><rect x="3" y="5" width="2" height="2" rx="1" fill="#7a5a13"/><rect x="3" y="11" width="2" height="2" rx="1" fill="#7a5a13"/><rect x="7" y="6" width="8" height="1.2" rx="0.6" fill="#7a5a13"/><rect x="7" y="12" width="8" height="1.2" rx="0.6" fill="#7a5a13"/></svg>
            </button>
            <div class="format-separator" style="width:1px; height:1.8em; background:rgba(255,217,36,0.25); margin:0 0.5em;"></div>
            <button type="button" class="format-btn" data-format="clear" title="Очистити форматування">
                <i class="fas fa-eraser"></i>
            </button>
        </div>
        <style>
            .formatting-toolbar .format-btn {
                background: linear-gradient(90deg, #bfa800 90%, #FFD924 100%);
                color: #181818;
                border: none;
                border-radius: 14px;
                font-size: 1.13rem;
                font-weight: 700;
                padding: 0.22em 1.1em;
                cursor: pointer;
                transition: background 0.18s, color 0.18s, box-shadow 0.18s;
                box-shadow: 0 1px 4px rgba(255,217,36,0.13), 0 1px 2px rgba(0,0,0,0.07);
                outline: none;
                display: flex;
                align-items: center;
                gap: 0.2em;
            }
            .formatting-toolbar .format-btn:hover, .formatting-toolbar .format-btn:focus {
                background: linear-gradient(90deg, #FFD924 90%, #bfa800 100%);
                color: #181818;
                box-shadow: 0 2px 8px rgba(255,217,36,0.18), 0 1px 4px rgba(0,0,0,0.09);
            }
            .formatting-toolbar .format-separator {
                background: rgba(255,217,36,0.13);
            }
            /* Отступы и цвет маркеров для всех списков одинаковые */
            #noteContent ul,
            #noteContent ol,
            #noteContent .dash-list {
                margin-left: 2.2em;
                margin-bottom: 1em;
                color: #FFD924;
            }
            #noteContent ul {
                list-style-type: disc;
            }
            #noteContent ol {
                list-style-type: decimal;
            }
            #noteContent .dash-list {
                list-style-type: none;
                padding-left: 0;
            }
            #noteContent .dash-list li::before {
                content: "";
                display: inline-block;
                width: 1.2em;
                height: 2px;
                background: #fff;
                margin-right: 0.7em;
                vertical-align: middle;
                border-radius: 2px;
            }
        </style>
        <div id="noteContent"
            class="details-content-area"
            contenteditable="true"
            name="content"
            style="min-height:340px;"
            required
        ><?= isset($note['content']) ? $note['content'] : '' ?></div>
        <input type="hidden" name="content" id="hiddenContent">
        <div class="details-actions">
            <a href="notes.php" class="btn btn-back"><i class="fas fa-arrow-left"></i> Назад</a>
            <button type="submit" name="save" class="btn btn-save"><i class="fas fa-save"></i> <?= isset($note['id']) ? 'Зберегти' : 'Створити' ?></button>
            <?php if (isset($note['id'])): ?>
                <button type="submit" name="delete" class="btn btn-delete" onclick="return confirm('Видалити нотатку?');"><i class="fas fa-trash"></i> Видалити</button>
            <?php endif; ?>
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

        // Клик по стрелке открывает select
        const categoryArrow = document.getElementById('categoryArrow');
        const categorySelect = document.querySelector('select[name="category_id"]');
        if (categoryArrow && categorySelect) {
            categoryArrow.addEventListener('mousedown', function(e) {
                e.preventDefault();
                categorySelect.focus();
                // Для некоторых браузеров (Chrome) открытие выпадающего списка:
                if (typeof categorySelect.showDropdown === 'function') {
                    categorySelect.showDropdown();
                } else {
                    // Симулируем нажатие клавиши Alt+Down
                    const event = new KeyboardEvent('keydown', {key: 'ArrowDown', altKey: true, bubbles: true});
                    categorySelect.dispatchEvent(event);
                }
            });
        }

        // Панель форматирования (contenteditable)
        const formattingToolbar = document.querySelector('.formatting-toolbar');
        const noteContent = document.getElementById('noteContent');
        const hiddenContent = document.getElementById('hiddenContent');

        // --- Функции для преобразования dash-list и форматирования в текст и обратно ---
        function htmlToTextWithFormatting(html) {
            // Используем временный div для парсинга
            const div = document.createElement('div');
            div.innerHTML = html;

            // Списки с линиями
            div.querySelectorAll('ul.dash-list').forEach(ul => {
                let lines = [];
                ul.querySelectorAll('li').forEach(li => {
                    lines.push('- ' + htmlToTextWithFormatting(li.innerHTML));
                });
                ul.replaceWith(document.createTextNode(lines.join('\n')));
            });

            // Обычные маркированные списки
            div.querySelectorAll('ul:not(.dash-list)').forEach(ul => {
                let lines = [];
                ul.querySelectorAll('li').forEach(li => {
                    lines.push('* ' + htmlToTextWithFormatting(li.innerHTML));
                });
                ul.replaceWith(document.createTextNode(lines.join('\n')));
            });

            // Нумерованные списки
            div.querySelectorAll('ol').forEach(ol => {
                let lines = [];
                let idx = 1;
                ol.querySelectorAll('li').forEach(li => {
                    lines.push(idx + '. ' + htmlToTextWithFormatting(li.innerHTML));
                    idx++;
                });
                ol.replaceWith(document.createTextNode(lines.join('\n')));
            });

            // Заголовки
            div.querySelectorAll('h1,h2,h3').forEach(h => {
                let prefix = '';
                if (h.tagName === 'H1') prefix = '# ';
                if (h.tagName === 'H2') prefix = '## ';
                if (h.tagName === 'H3') prefix = '### ';
                h.replaceWith(document.createTextNode(prefix + htmlToTextWithFormatting(h.innerHTML)));
            });

            // Жирный
            div.querySelectorAll('b,strong').forEach(b => {
                b.replaceWith('**' + htmlToTextWithFormatting(b.innerHTML) + '**');
            });

            // Курсив
            div.querySelectorAll('i,em').forEach(i => {
                i.replaceWith('_' + htmlToTextWithFormatting(i.innerHTML) + '_');
            });

            // Подчеркивание
            div.querySelectorAll('u').forEach(u => {
                u.replaceWith('__' + htmlToTextWithFormatting(u.innerHTML) + '__');
            });

            // Ссылки
            div.querySelectorAll('a').forEach(a => {
                a.replaceWith('[' + a.textContent + '](' + a.getAttribute('href') + ')');
            });

            // br -> \n
            div.querySelectorAll('br').forEach(br => {
                br.replaceWith('\n');
            });

            // div/p -> \n
            div.querySelectorAll('div,p').forEach(el => {
                el.replaceWith(htmlToTextWithFormatting(el.innerHTML) + '\n');
            });

            return div.textContent;
        }

        function textWithFormattingToHtml(text) {
            // Преобразуем markdown-подобный текст в html
            let html = text;

            // Экранируем html
            html = html.replace(/</g, "&lt;").replace(/>/g, "&gt;");

            // Списки с линиями
            html = html.replace(/(^|\n)- (.*?)(?=\n[^-]|$)/gs, function(_, p1, items) {
                let lis = items.split('\n').map(line => {
                    if (line.startsWith('- ')) return '<li>' + textWithFormattingToHtml(line.slice(2)) + '</li>';
                    return '';
                }).join('');
                return p1 + '<ul class="dash-list">' + lis + '</ul>';
            });

            // Обычные маркированные списки
            html = html.replace(/(^|\n)\* (.*?)(?=\n[^\*]|$)/gs, function(_, p1, items) {
                let lis = items.split('\n').map(line => {
                    if (line.startsWith('* ')) return '<li>' + textWithFormattingToHtml(line.slice(2)) + '</li>';
                    return '';
                }).join('');
                return p1 + '<ul>' + lis + '</ul>';
            });

            // Нумерованные списки
            html = html.replace(/(^|\n)(\d+)\. (.*?)(?=\n[^\d]|$)/gs, function(_, p1, num, items) {
                let lis = items.split('\n').map(line => {
                    let m = line.match(/^(\d+)\. (.*)$/);
                    if (m) return '<li>' + textWithFormattingToHtml(m[2]) + '</li>';
                    return '';
                }).join('');
                return p1 + '<ol>' + lis + '</ol>';
            });

            // Заголовки
            html = html.replace(/^### (.*)$/gm, '<h3>$1</h3>');
            html = html.replace(/^## (.*)$/gm, '<h2>$1</h2>');
            html = html.replace(/^# (.*)$/gm, '<h1>$1</h1>');

            // Жирный
            html = html.replace(/\*\*(.+?)\*\*/g, '<b>$1</b>');
            // Курсив
            html = html.replace(/_(.+?)_/g, '<i>$1</i>');
            // Подчеркивание
            html = html.replace(/__(.+?)__/g, '<u>$1</u>');

            // Ссылки [text](url)
            html = html.replace(/\[([^\]]+)\]\(([^\)]+)\)/g, '<a href="$2" target="_blank" rel="noopener noreferrer">$1</a>');

            // Переводы строк
            html = html.replace(/\n/g, '<br>');

            return html;
        }

        // Відновлення форматування після завантаження сторінки
        document.addEventListener('DOMContentLoaded', function() {
            if (hiddenContent.value && noteContent.innerHTML !== hiddenContent.value) {
                // Преобразуем текст с форматированием в html
                noteContent.innerHTML = textWithFormattingToHtml(hiddenContent.value);
            }
            // Для ссылок: добавить атрибуты и стили
            Array.from(noteContent.querySelectorAll('a')).forEach(a => {
                a.setAttribute('target', '_blank');
                a.setAttribute('rel', 'noopener noreferrer');
                a.style.color = '#FFD924';
                a.style.textDecoration = 'underline';
            });
        });

        function wrapSelection(tag) {
            const sel = window.getSelection();
            if (!sel.rangeCount) return;
            const range = sel.getRangeAt(0);
            if (!range || !noteContent.contains(range.commonAncestorContainer)) return;
            // Если уже есть такой тег, не вкладывать еще раз
            let parent = range.commonAncestorContainer;
            while (parent && parent !== noteContent) {
                if (parent.nodeType === 1 && parent.nodeName.toLowerCase() === tag) return;
                parent = parent.parentNode;
            }
            // Создаем новый элемент
            const el = document.createElement(tag);
            el.appendChild(range.extractContents());
            range.insertNode(el);
            // Переместить курсор после вставленного элемента
            sel.removeAllRanges();
            const newRange = document.createRange();
            newRange.selectNodeContents(el);
            newRange.collapse(false);
            sel.addRange(newRange);
        }

        if (formattingToolbar && noteContent) {
            formattingToolbar.addEventListener('click', function(e) {
                const btn = e.target.closest('.format-btn');
                if (!btn) return;
                noteContent.focus();
                let cmd = '', value = null;
                switch (btn.dataset.format) {
                    case 'bold':
                        cmd = 'bold'; break;
                    case 'italic':
                        cmd = 'italic'; break;
                    case 'underline':
                        cmd = 'underline'; break;
                    case 'h1':
                        cmd = 'formatBlock'; value = 'H1'; break;
                    case 'h2':
                        cmd = 'formatBlock'; value = 'H2'; break;
                    case 'h3':
                        cmd = 'formatBlock'; value = 'H3'; break;
                    case 'ul':
                        cmd = 'insertUnorderedList'; break;
                    case 'ol':
                        cmd = 'insertOrderedList'; break;
                    case 'dash':
                        // Вставляем строку "- " если выделена строка, иначе обычный ul с dash-list
                        document.execCommand('insertUnorderedList');
                        setTimeout(() => {
                            const sel = window.getSelection();
                            if (sel.rangeCount > 0) {
                                let node = sel.anchorNode;
                                while (node && node !== noteContent && node.nodeName !== 'UL') node = node.parentNode;
                                if (node && node.nodeName === 'UL') {
                                    node.classList.add('dash-list');
                                }
                            }
                        }, 0);
                        break;
                    case 'clear':
                        // Очищаем только форматирование (оставляем текст)
                        document.execCommand('removeFormat', false, null);
                        document.execCommand('unlink', false, null);
                        break;
                }
                if (cmd) {
                    document.execCommand(cmd, false, value);
                }
                saveContentToHidden();
            });
            noteContent.addEventListener('input', saveContentToHidden);
            noteContent.addEventListener('blur', saveContentToHidden);

            // Клик по ссылке в редакторе — переход по ссылке
            noteContent.addEventListener('click', function(e) {
                let a = e.target.closest('a');
                if (a && noteContent.contains(a)) {
                    window.open(a.href, '_blank', 'noopener');
                    e.preventDefault();
                }
            });
        }
        function saveContentToHidden() {
            // Сохраняем именно HTML, чтобы отображалось с форматированием
            hiddenContent.value = noteContent.innerHTML;
        }

        document.getElementById('noteForm').addEventListener('submit', function() {
            saveContentToHidden();
        });

        // При загрузке страницы, если есть сохранённый HTML, вставляем его в редактор
        document.addEventListener('DOMContentLoaded', function() {
            if (hiddenContent.value) {
                noteContent.innerHTML = hiddenContent.value;
            } else {
                saveContentToHidden();
            }
        });
    </script>
</body>
</html>
