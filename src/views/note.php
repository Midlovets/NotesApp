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
    <link rel="stylesheet" href="/public/css/note.css">
</head>
<body>
    <div class="blur-bg"></div>
    <div class="details-full-bg"></div>
   <nav class="navbar">
        <a href="notes.php" class="logo"><span class="logo-notes">Notes</span><span class="logo-app">App</span></a>
        <div class="cta-buttons" style="position: relative;">
            <div class="profile-svg-link" id="profileMenuBtn" title="Профіль" tabindex="0" style="position: relative;">
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
            <div id="profileDropdown" style="display:none; position:absolute; top:48px; right:0; background:rgba(24,24,24,0.97); border:1.5px solid #FFD92444; border-radius:12px; min-width:160px; box-shadow:0 4px 16px rgba(0,0,0,0.18); z-index:100;">
                <a href="notes.php" style="display:block; padding:12px 18px; color:#FFD924; text-decoration:none; font-weight:500;">Мої нотатки</a>
                <a href="/public/user.php" style="display:block; padding:12px 18px; color:#FFD924; text-decoration:none; font-weight:500;">Профіль</a>
                <a href="/public/logout.php" style="display:block; padding:12px 18px; color:#fff; text-decoration:none; font-weight:500;">Вийти</a>
            </div>
        </div>
    </nav>
    
    <form class="details-main" method="post" action="note.php<?= isset($note['id']) ? '?id=' . (int)$note['id'] : '' ?>" id="noteForm" autocomplete="off">
        <div class="details-header">
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

        addTagInput.addEventListener('blur', function(e) {
            setTimeout(() => {
                if (!document.activeElement.classList.contains('add-tag-btn')) {
                    addTagForm.classList.add('hidden');
                    showAddTagBtn.style.display = '';
                }
            }, 100);
        });

        const profileMenuBtn = document.getElementById('profileMenuBtn');
        const profileDropdown = document.getElementById('profileDropdown');

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

        profileMenuBtn.addEventListener('click', function(e) {
            e.preventDefault();
            profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
        });
        document.addEventListener('click', function(e) {
            if (!profileMenuBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.style.display = 'none';
            }
        });

        const categoryArrow = document.getElementById('categoryArrow');
        const categorySelect = document.querySelector('select[name="category_id"]');
        if (categoryArrow && categorySelect) {
            categoryArrow.addEventListener('mousedown', function(e) {
                e.preventDefault();
                categorySelect.focus();

                if (typeof categorySelect.showDropdown === 'function') {
                    categorySelect.showDropdown();
                } else {

                    const event = new KeyboardEvent('keydown', {key: 'ArrowDown', altKey: true, bubbles: true});
                    categorySelect.dispatchEvent(event);
                }
            });
        }

        const formattingToolbar = document.querySelector('.formatting-toolbar');
        const noteContent = document.getElementById('noteContent');
        const hiddenContent = document.getElementById('hiddenContent');


        function htmlToTextWithFormatting(html) {

            const div = document.createElement('div');
            div.innerHTML = html;

            div.querySelectorAll('ul.dash-list').forEach(ul => {
                let lines = [];
                ul.querySelectorAll('li').forEach(li => {
                    lines.push('- ' + htmlToTextWithFormatting(li.innerHTML));
                });
                ul.replaceWith(document.createTextNode(lines.join('\n')));
            });


            div.querySelectorAll('ul:not(.dash-list)').forEach(ul => {
                let lines = [];
                ul.querySelectorAll('li').forEach(li => {
                    lines.push('* ' + htmlToTextWithFormatting(li.innerHTML));
                });
                ul.replaceWith(document.createTextNode(lines.join('\n')));
            });

            div.querySelectorAll('ol').forEach(ol => {
                let lines = [];
                let idx = 1;
                ol.querySelectorAll('li').forEach(li => {
                    lines.push(idx + '. ' + htmlToTextWithFormatting(li.innerHTML));
                    idx++;
                });
                ol.replaceWith(document.createTextNode(lines.join('\n')));
            });
            div.querySelectorAll('h1,h2,h3').forEach(h => {
                let prefix = '';
                if (h.tagName === 'H1') prefix = '# ';
                if (h.tagName === 'H2') prefix = '## ';
                if (h.tagName === 'H3') prefix = '### ';
                h.replaceWith(document.createTextNode(prefix + htmlToTextWithFormatting(h.innerHTML)));
            });

            div.querySelectorAll('b,strong').forEach(b => {
                b.replaceWith('**' + htmlToTextWithFormatting(b.innerHTML) + '**');
            });

            div.querySelectorAll('i,em').forEach(i => {
                i.replaceWith('_' + htmlToTextWithFormatting(i.innerHTML) + '_');
            });

            div.querySelectorAll('u').forEach(u => {
                u.replaceWith('__' + htmlToTextWithFormatting(u.innerHTML) + '__');
            });

            div.querySelectorAll('a').forEach(a => {
                a.replaceWith('[' + a.textContent + '](' + a.getAttribute('href') + ')');
            });

            div.querySelectorAll('br').forEach(br => {
                br.replaceWith('\n');
            });

            div.querySelectorAll('div,p').forEach(el => {
                el.replaceWith(htmlToTextWithFormatting(el.innerHTML) + '\n');
            });

            return div.textContent;
        }

        function textWithFormattingToHtml(text) {
            let html = text;
            html = html.replace(/</g, "&lt;").replace(/>/g, "&gt;");

            html = html.replace(/(^|\n)- (.*?)(?=\n[^-]|$)/gs, function(_, p1, items) {
                let lis = items.split('\n').map(line => {
                    if (line.startsWith('- ')) return '<li>' + textWithFormattingToHtml(line.slice(2)) + '</li>';
                    return '';
                }).join('');
                return p1 + '<ul class="dash-list">' + lis + '</ul>';
            });

            html = html.replace(/(^|\n)\* (.*?)(?=\n[^\*]|$)/gs, function(_, p1, items) {
                let lis = items.split('\n').map(line => {
                    if (line.startsWith('* ')) return '<li>' + textWithFormattingToHtml(line.slice(2)) + '</li>';
                    return '';
                }).join('');
                return p1 + '<ul>' + lis + '</ul>';
            });

            html = html.replace(/(^|\n)(\d+)\. (.*?)(?=\n[^\d]|$)/gs, function(_, p1, num, items) {
                let lis = items.split('\n').map(line => {
                    let m = line.match(/^(\d+)\. (.*)$/);
                    if (m) return '<li>' + textWithFormattingToHtml(m[2]) + '</li>';
                    return '';
                }).join('');
                return p1 + '<ol>' + lis + '</ol>';
            });

            html = html.replace(/^### (.*)$/gm, '<h3>$1</h3>');
            html = html.replace(/^## (.*)$/gm, '<h2>$1</h2>');
            html = html.replace(/^# (.*)$/gm, '<h1>$1</h1>');

            html = html.replace(/\*\*(.+?)\*\*/g, '<b>$1</b>');
            html = html.replace(/_(.+?)_/g, '<i>$1</i>');
            html = html.replace(/__(.+?)__/g, '<u>$1</u>');

            html = html.replace(/\[([^\]]+)\]\(([^\)]+)\)/g, '<a href="$2" target="_blank" rel="noopener noreferrer">$1</a>');

            html = html.replace(/\n/g, '<br>');

            return html;
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (hiddenContent.value && noteContent.innerHTML !== hiddenContent.value) {
                noteContent.innerHTML = textWithFormattingToHtml(hiddenContent.value);
            }
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
            let parent = range.commonAncestorContainer;
            while (parent && parent !== noteContent) {
                if (parent.nodeType === 1 && parent.nodeName.toLowerCase() === tag) return;
                parent = parent.parentNode;
            }
            const el = document.createElement(tag);
            el.appendChild(range.extractContents());
            range.insertNode(el);
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

            noteContent.addEventListener('click', function(e) {
                let a = e.target.closest('a');
                if (a && noteContent.contains(a)) {
                    window.open(a.href, '_blank', 'noopener');
                    e.preventDefault();
                }
            });
        }
        function saveContentToHidden() {
            hiddenContent.value = noteContent.innerHTML;
        }

        document.getElementById('noteForm').addEventListener('submit', function() {
            saveContentToHidden();
        });

        document.addEventListener('DOMContentLoaded', function() {
            if (hiddenContent.value) {
                noteContent.innerHTML = hiddenContent.value;
            } else {
                saveContentToHidden();
            }
        });
