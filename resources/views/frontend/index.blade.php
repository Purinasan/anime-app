<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Recommendation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* CSS Variables for Theme */
        :root {
            --bg-gradient-start: rgba(26, 26, 46, 0.7);
            --bg-gradient-end: rgba(22, 33, 62, 0.75);
            --text-primary: #ffffff;
            --text-secondary: #f0f0f0;
            --card-bg: rgba(255, 255, 255, 0.15);
            --card-bg-hover: rgba(255, 255, 255, 0.2);
            --card-border: rgba(255, 255, 255, 0.2);
            --input-bg: rgba(255, 255, 255, 0.15);
            --shadow-color: rgba(0, 0, 0, 0.3);
            --primary-color: #ff6b81;
            --secondary-color: #1afac0;
        }
        /* Light Mode Variables */
        body.light-mode {
            --bg-gradient-start: rgba(255, 255, 255, 0.9);
            --bg-gradient-end: rgba(245, 247, 250, 0.9);
            --text-primary: #2c3e50;
            --text-secondary: #34495e;
            --card-bg: rgba(255, 255, 255, 0.95);
            --card-bg-hover: rgba(255, 255, 255, 1);
            --card-border: rgba(52, 152, 219, 0.3);
            --input-bg: rgba(255, 255, 255, 0.9);
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            background: 
                linear-gradient(var(--bg-gradient-start), var(--bg-gradient-end)),
                url('https://images.unsplash.com/photo-1578632767115-351597cf2477?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            color: var(--text-primary);
            min-height: 100vh;
            padding: 20px;
            transition: all 0.5s ease;
        }
        body.light-mode {
        background: 
            linear-gradient(var(--bg-gradient-start), var(--bg-gradient-end)),
            url('https://images.unsplash.com/photo-1511296265581-c494a5851fc3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: var(--card-bg);
            border-radius: 15px;
            backdrop-filter: blur(15px);
            border: 1px solid var(--card-border);
            box-shadow: 0 8px 32px var(--shadow-color);
            position: relative;
            transition: all 0.3s ease;
        }

        /* Theme Toggle Button */
        .theme-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--card-bg);
            border: 2px solid var(--primary-color);
            border-radius: 50px;
            padding: 10px 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .theme-toggle:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(255, 107, 129, 0.4);
        }

        .theme-toggle i {
            font-size: 1.2rem;
            color: var(--primary-color);
            transition: transform 0.3s ease;
        }

        .theme-toggle:hover i {
            transform: rotate(20deg);
        }

        .theme-toggle span {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.9rem;
        }

        h1 {
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(255, 107, 129, 0.4);
            transition: color 0.3s ease;
        }

        .author {
            color: var(--secondary-color);
            font-size: 1.1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            justify-content: center;
        }

        .search-bar input {
            flex: 1;
            max-width: 400px;
            padding: 12px 20px;
            border: 2px solid var(--primary-color);
            border-radius: 25px;
            background: var(--input-bg);
            color: var(--text-primary);
            font-size: 1rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        body.light-mode .search-bar input {
            border-color: #3498db;
        }

        .search-bar input::placeholder {
            color: var(--text-secondary);
            opacity: 0.7;
        }

        .search-bar button {
            padding: 12px 25px;
            background: rgba(255, 107, 129, 0.95);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        body.light-mode .search-bar button {
            background: #3498db;
        }

        .search-bar button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 129, 0.5);
        }

        body.light-mode .search-bar button:hover {
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.5);
        }

        .anime-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .anime-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 25px;
            backdrop-filter: blur(15px);
            border: 1px solid var(--card-border);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px var(--shadow-color);
        }

        .anime-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px var(--shadow-color);
            border-color: var(--primary-color);
            background: var(--card-bg-hover);
        }

        body.light-mode .anime-card:hover {
            border-color: #3498db;
        }

        .anime-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        body.light-mode .anime-card::before {
            background: linear-gradient(90deg, #3498db, #2ecc71);
        }

        .anime-media-container {
            position: relative;
            width: 100%;
            margin-bottom: 15px;
        }

        .anime-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
            border-radius: 10px;
            position: relative;
            border: 2px solid rgba(255, 123, 148, 0.5);
        }

        body.light-mode .anime-image {
            border-color: rgba(52, 152, 219, 0.5);
        }

        .anime-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .anime-card:hover .anime-image img {
            transform: scale(1.05);
        }

        .anime-image.no-image {
            background: var(--input-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed rgba(255, 123, 148, 0.5);
        }

        .no-image-placeholder {
            color: var(--text-secondary);
            font-size: 1rem;
            font-weight: 600;
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
            opacity: 0;
            z-index: 2;
            border-radius: 10px;
        }

        .video-buttons {
            display: flex;
            gap: 15px;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0 20px;
        }

        .video-btn {
            background: rgba(0, 0, 0, 0.6);
            border: 2px solid #ff6b81;
            border-radius: 10px;
            padding: 15px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 130px;
            flex: 1;
            max-width: 150px;
        }

        .video-btn:hover {
            background: rgba(255, 107, 129, 0.9);
            transform: translateY(-3px);
            border-color: #ff8fa3;
            box-shadow: 0 5px 20px rgba(255, 107, 129, 0.5);
        }

        .video-btn .play-icon {
            font-size: 2.5rem;
            margin-bottom: 8px;
            color: #ff6b81;
            text-shadow: 0 0 15px rgba(255, 107, 129, 0.7);
            transition: all 0.3s ease;
        }

        .video-btn:hover .play-icon {
            color: white;
            transform: scale(1.1);
        }

        .video-btn p {
            margin: 0;
            font-size: 0.85rem;
            font-weight: 600;
            text-align: center;
        }

        .video-btn.opening-btn {
            border-color: #1afac0;
        }

        .video-btn.opening-btn .play-icon {
            color: #1afac0;
            text-shadow: 0 0 15px rgba(26, 250, 192, 0.7);
        }

        .video-btn.opening-btn:hover {
            background: rgba(26, 250, 192, 0.9);
            border-color: #15d4a8;
        }

        .video-btn.opening-btn:hover .play-icon {
            color: white;
        }

        .video-embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 3;
            background: #000;
        }

        .video-embed iframe {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            border: none;
        }

        .anime-title {
            color: var(--primary-color);
            font-size: 1.4rem;
            margin-bottom: 15px;
            font-weight: 700;
            transition: color 0.3s ease;
        }

        body.light-mode .anime-title {
            color: #2c3e50;
        }

        .anime-genre {
            color: var(--secondary-color);
            margin-bottom: 10px;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        body.light-mode .anime-genre {
            color: #27ae60;
        }

        .anime-description {
            color: var(--text-secondary);
            margin-bottom: 15px;
            line-height: 1.5;
            position: relative;
            overflow: hidden;
            transition: color 0.3s ease;
        }

        .anime-description.truncated {
            max-height: 72px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .read-more-btn {
            background: rgba(255, 107, 129, 0.9);
            color: white;
            border: none;
            padding: 6px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 10px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            display: inline-block;
        }

        body.light-mode .read-more-btn {
            background: #3498db;
        }

        .read-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 129, 0.4);
        }

        .anime-card.expanded .anime-description {
            max-height: none;
            display: block;
            -webkit-line-clamp: unset;
        }

        .anime-rating {
            color: #ffeb3b;
            font-weight: 600;
            font-size: 1.1rem;
            text-shadow: 0 0 10px rgba(255, 235, 59, 0.3);
        }

        body.light-mode .anime-rating {
            color: #f39c12;
        }

        .no-anime {
            text-align: center;
            color: var(--text-secondary);
            font-size: 1.2rem;
            grid-column: 1 / -1;
            padding: 40px;
            background: var(--card-bg);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .anime-grid {
                grid-template-columns: 1fr;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            body {
                background-attachment: scroll;
            }

            .theme-toggle {
                position: static;
                margin: 10px auto 0;
                width: fit-content;
            }

            .video-buttons {
                flex-direction: column;
                gap: 10px;
            }

            .video-btn {
                max-width: 100%;
                width: 80%;
            }
        }
                    /* Watch Episode Button */
            .watch-episode-btn {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 25px;
                cursor: pointer;
                font-size: 0.9rem;
                font-weight: 600;
                margin-top: 10px;
                transition: all 0.3s ease;
                backdrop-filter: blur(10px);
                display: inline-flex;
                align-items: center;
                gap: 8px;
                width: 100%;
                justify-content: center;
            }

            .watch-episode-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
            }

            .watch-episode-btn:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            /* Video Player Modal */
            .video-modal {
                display: none;
                position: fixed;
                z-index: 9999;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.95);
                overflow: auto;
            }

            .video-modal-content {
                position: relative;
                margin: 2% auto;
                width: 90%;
                max-width: 1200px;
                background: #1a1a1a;
                border-radius: 15px;
                padding: 20px;
            }

            .modal-close {
                position: absolute;
                top: 10px;
                right: 20px;
                color: #fff;
                font-size: 35px;
                font-weight: bold;
                cursor: pointer;
                z-index: 10000;
            }

            .modal-close:hover {
                color: #ff6b81;
            }

            .video-player-container {
                position: relative;
                background: #000;
                border-radius: 10px;
                overflow: hidden;
            }

            .custom-video-player {
                width: 100%;
                max-height: 70vh;
                display: block;
            }

            .video-controls {
                display: flex;
                align-items: center;
                gap: 15px;
                padding: 15px;
                background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                transition: opacity 0.3s;
            }

            .video-player-container:hover .video-controls {
                opacity: 1;
            }

            .control-btn {
                background: rgba(255,255,255,0.2);
                border: none;
                color: white;
                padding: 10px 15px;
                border-radius: 5px;
                cursor: pointer;
                transition: all 0.3s;
            }

            .control-btn:hover {
                background: rgba(255,255,255,0.4);
            }

            .progress-bar {
                flex: 1;
                height: 8px;
                background: rgba(255,255,255,0.3);
                border-radius: 4px;
                cursor: pointer;
                position: relative;
            }

            .progress-filled {
                height: 100%;
                background: #ff6b81;
                border-radius: 4px;
                transition: width 0.1s;
            }

            .resolution-selector {
                position: relative;
            }

            .resolution-btn {
                background: rgba(255,255,255,0.2);
                color: white;
                border: none;
                padding: 8px 15px;
                border-radius: 5px;
                cursor: pointer;
                font-weight: bold;
            }

            .resolution-menu {
                display: none;
                position: absolute;
                bottom: 100%;
                right: 0;
                background: #2a2a2a;
                border-radius: 8px;
                margin-bottom: 10px;
                box-shadow: 0 5px 20px rgba(0,0,0,0.5);
            }

            .resolution-menu.active {
                display: block;
            }

            .resolution-option {
                padding: 12px 20px;
                cursor: pointer;
                color: white;
                transition: all 0.2s;
                border-radius: 8px;
            }

            .resolution-option:hover {
                background: rgba(255,107,129,0.3);
            }

            .resolution-option.active {
                background: rgba(255,107,129,0.5);
                font-weight: bold;
            }

            .episode-info {
                padding: 15px 0;
                color: white;
            }

            .episode-info h3 {
                color: #ff6b81;
                margin-bottom: 10px;
            }

            .no-episodes {
                text-align: center;
                padding: 20px;
                color: #888;
            }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <button class="theme-toggle" onclick="toggleTheme()" id="themeToggle">
                <i class="fas fa-moon" id="themeIcon"></i>
                <span id="themeText">Dark Mode</span>
            </button>
            <h1>LIST ANIME RECOMMENDED</h1>
            <p class="author">BY RIZKY PRIMA JULIANTO</p>
        </header>

        <main>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Cari anime...">
                <button id="searchBtn">Cari</button>
            </div>
            <div id="animeContainer" class="anime-grid">
                <!-- Anime will be loaded here -->
            </div>
        </main>
    </div>

    <script>
        const API_BASE = '{{ url("/") }}/api';
        const STORAGE_URL = '{{ url("/storage") }}';
        let isLoading = false;

        // Theme Toggle Function
        function toggleTheme() {
            const body = document.body;
            const themeIcon = document.getElementById('themeIcon');
            const themeText = document.getElementById('themeText');
            
            body.classList.toggle('light-mode');
            
            if (body.classList.contains('light-mode')) {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
                themeText.textContent = 'Light Mode';
                localStorage.setItem('theme', 'light');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
                themeText.textContent = 'Dark Mode';
                localStorage.setItem('theme', 'dark');
            }
        }

        // Load saved theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            const themeIcon = document.getElementById('themeIcon');
            const themeText = document.getElementById('themeText');
            
            if (savedTheme === 'light') {
                document.body.classList.add('light-mode');
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
                themeText.textContent = 'Light Mode';
            }
            
            loadAnime();
            setupSearch();
        });

        function setupSearch() {
            const searchBtn = document.getElementById('searchBtn');
            const searchInput = document.getElementById('searchInput');

            searchBtn.addEventListener('click', handleSearch);
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    handleSearch();
                }
            });
        }

        async function loadAnime() {
            if (isLoading) return;
            
            try {
                isLoading = true;
                showLoading();
                
                const response = await fetch(`${API_BASE}/anime`);
                const result = await response.json();
                
                if (result.success) {
                    displayAnime(result.data);
                } else {
                    showError('Error memuat data anime');
                }
            } catch (error) {
                console.error('Error:', error);
                showError('Terjadi kesalahan saat memuat data');
            } finally {
                isLoading = false;
            }
        }

        async function handleSearch() {
            const searchTerm = document.getElementById('searchInput').value.trim();
            
            if (!searchTerm) {
                loadAnime();
                return;
            }

            try {
                showLoading();
                const response = await fetch(`${API_BASE}/anime-search`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ searchTerm: searchTerm })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    displayAnime(result.data);
                } else {
                    showError('Error saat mencari anime');
                }
            } catch (error) {
                console.error('Error:', error);
                showError('Terjadi kesalahan saat mencari');
            }
        }

        function displayAnime(animeList) {
            const container = document.getElementById('animeContainer');
            
            if (!animeList || animeList.length === 0) {
                container.innerHTML = '<div class="no-anime">Tidak ada anime yang ditemukan</div>';
                return;
            }

            container.innerHTML = animeList.map(anime => `
                <div class="anime-card" data-id="${anime.id}">
                    <div class="anime-media-container">
                        ${anime.image ? `
                            <div class="anime-image">
                                <img src="${STORAGE_URL}/${anime.image}" alt="${escapeHtml(anime.title)}" onerror="this.parentElement.classList.add('no-image'); this.style.display='none'">
                                ${(anime.video_url || anime.opening_url) ? `
                                    <div class="video-overlay">
                                        <div class="video-buttons">
                                            ${anime.video_url ? `
                                                <button class="video-btn trailer-btn" data-video-url="${anime.video_url}">
                                                    <div class="play-icon">▶</div>
                                                    <p>Putar Trailer</p>
                                                </button>
                                            ` : ''}
                                            ${anime.opening_url ? `
                                                <button class="video-btn opening-btn" data-video-url="${anime.opening_url}">
                                                    <div class="play-icon">▶</div>
                                                    <p>Putar Opening</p>
                                                </button>
                                            ` : ''}
                                        </div>
                                    </div>
                                    <div class="video-embed">
                                        <iframe class="video-iframe" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                ` : ''}
                            </div>
                        ` : `
                            <div class="anime-image no-image">
                                <div class="no-image-placeholder">No Image</div>
                                ${(anime.video_url || anime.opening_url) ? `
                                    <div class="video-overlay">
                                        <div class="video-buttons">
                                            ${anime.video_url ? `
                                                <button class="video-btn trailer-btn" data-video-url="${anime.video_url}">
                                                    <div class="play-icon">▶</div>
                                                    <p>Putar Trailer</p>
                                                </button>
                                            ` : ''}
                                            ${anime.opening_url ? `
                                                <button class="video-btn opening-btn" data-video-url="${anime.opening_url}">
                                                    <div class="play-icon">▶</div>
                                                    <p>Putar Opening</p>
                                                </button>
                                            ` : ''}
                                        </div>
                                    </div>
                                    <div class="video-embed">
                                        <iframe class="video-iframe" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                ` : ''}
                            </div>
                        `}
                    </div>
                    <h3 class="anime-title">${escapeHtml(anime.title)}</h3>
                    <p class="anime-genre">Genre: ${escapeHtml(anime.genre)}</p>
                    <div class="description-container">
                        <p class="anime-description truncated" id="desc-${anime.id}">
                            ${escapeHtml(anime.description)}
                        </p>
                        ${anime.description && anime.description.length > 120 ? `
                            <button class="read-more-btn" onclick="toggleReadMore(${anime.id})" id="read-more-${anime.id}">
                                Read More
                            </button>
                        ` : ''}
                    </div>
                    <p class="anime-rating">⭐ ${escapeHtml(anime.rating)}</p>
                    <button class="watch-episode-btn" onclick="openEpisodePlayer(${anime.id}, '${escapeHtml(anime.title)}')" data-anime-id="${anime.id}">
                        <i class="fas fa-play-circle"></i> Watch Episode
                    </button>
                </div>
            `).join('');

            setupVideoHover();
        }

        function toggleReadMore(animeId) {
            const animeCard = document.querySelector(`.anime-card[data-id="${animeId}"]`);
            const description = document.getElementById(`desc-${animeId}`);
            const readMoreBtn = document.getElementById(`read-more-${animeId}`);
            
            if (description.classList.contains('truncated')) {
                description.classList.remove('truncated');
                animeCard.classList.add('expanded');
                readMoreBtn.textContent = 'Read Less';
            } else {
                description.classList.add('truncated');
                animeCard.classList.remove('expanded');
                readMoreBtn.textContent = 'Read More';
            }
        }

        function extractYouTubeId(url) {
            if (!url) return null;
            
            const cleanUrl = url.split('&')[0];
            const patterns = [
                /(?:youtube\.com\/watch\?v=)([a-zA-Z0-9_-]{11})/,
                /(?:youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/,
                /(?:youtu\.be\/)([a-zA-Z0-9_-]{11})/,
                /(?:youtube\.com\/.*[?&]v=)([a-zA-Z0-9_-]{11})/
            ];
            
            for (let pattern of patterns) {
                const match = cleanUrl.match(pattern);
                if (match && match[1]) {
                    return match[1];
                }
            }
            
            return null;
        }

        function setupVideoHover() {
            const animeCards = document.querySelectorAll('.anime-card');
            
            animeCards.forEach(card => {
                const videoEmbed = card.querySelector('.video-embed');
                const videoOverlay = card.querySelector('.video-overlay');
                const iframe = card.querySelector('.video-iframe');
                const videoButtons = card.querySelectorAll('.video-btn');
                
                if (videoEmbed && videoOverlay && iframe && videoButtons.length > 0) {
                    let hoverTimer;
                    let isVideoPlaying = false;
                    
                    card.addEventListener('mouseenter', function() {
                        if (!isVideoPlaying) {
                            clearTimeout(hoverTimer);
                            hoverTimer = setTimeout(() => {
                                videoOverlay.style.display = 'flex';
                                setTimeout(() => {
                                    videoOverlay.style.opacity = '1';
                                }, 10);
                            }, 200);
                        }
                    });
                    
                    videoButtons.forEach(btn => {
                        btn.addEventListener('click', function(e) {
                            e.stopPropagation();
                            clearTimeout(hoverTimer);
                            
                            const videoUrl = this.dataset.videoUrl;
                            const videoId = extractYouTubeId(videoUrl);
                            
                            if (videoId) {
                                if (window.innerWidth <= 768) {
                                    window.open(videoUrl, '_blank');
                                    return;
                                }
                                
                                isVideoPlaying = true;
                                iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
                                
                                videoOverlay.style.opacity = '0';
                                setTimeout(() => {
                                    videoOverlay.style.display = 'none';
                                    videoEmbed.style.display = 'block';
                                    setTimeout(() => {
                                        videoEmbed.style.opacity = '1';
                                    }, 50);
                                }, 300);
                            }
                        });
                    });
                    
                    card.addEventListener('mouseleave', function() {
                        clearTimeout(hoverTimer);
                        
                        if (isVideoPlaying) {
                            isVideoPlaying = false;
                            videoEmbed.style.opacity = '0';
                            setTimeout(() => {
                                videoEmbed.style.display = 'none';
                                iframe.src = '';
                                videoOverlay.style.display = 'none';
                                videoOverlay.style.opacity = '0';
                            }, 300);
                        } else {
                            videoOverlay.style.opacity = '0';
                            setTimeout(() => {
                                videoOverlay.style.display = 'none';
                            }, 300);
                        }
                    });
                }
            });
        }

        function showLoading() {
            document.getElementById('animeContainer').innerHTML = 
                '<div class="no-anime">Memuat data...</div>';
        }

        function showError(message) {
            document.getElementById('animeContainer').innerHTML = 
                `<div class="no-anime">${message}</div>`;
        }

        function escapeHtml(unsafe) {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
        // === VIDEO PLAYER FUNCTIONS ===
        let currentVideo = null;
        let availableResolutions = {};
        let currentAnimeId = null;
        let currentEpisodeId = null;

        async function openEpisodePlayer(animeId, animeTitle) {
            currentAnimeId = animeId;
            
            try {
                // Fetch episodes for this anime
                const response = await fetch(`${API_BASE}/anime/${animeId}/episodes`);
                const result = await response.json();
                
                if (!result.success || !result.episodes || result.episodes.length === 0) {
                    document.getElementById('noEpisodesMessage').style.display = 'block';
                    document.getElementById('videoPlayerContainer').style.display = 'none';
                    document.getElementById('videoModal').style.display = 'block';
                    document.getElementById('modalAnimeTitle').textContent = animeTitle;
                    document.getElementById('modalEpisodeTitle').textContent = '';
                    return;
                }
                
                // Load first episode
                const firstEpisode = result.episodes[0];
                await loadEpisode(animeId, firstEpisode.id, animeTitle, firstEpisode.title);
                
            } catch (error) {
                console.error('Error loading episodes:', error);
                alert('Failed to load episodes. Please try again.');
            }
        }

        async function loadEpisode(animeId, episodeId, animeTitle, episodeTitle) {
            currentEpisodeId = episodeId;
            
            try {
                // Fetch episode resolutions
                const response = await fetch(`${API_BASE}/anime/${animeId}/episodes/${episodeId}/resolutions`);
                const result = await response.json();
                
                if (!result.success || !result.resolutions || Object.keys(result.resolutions).length === 0) {
                    alert('No video files available for this episode.');
                    return;
                }
                
                availableResolutions = result.resolutions;
                
                // Show modal
                document.getElementById('videoModal').style.display = 'block';
                document.getElementById('noEpisodesMessage').style.display = 'none';
                document.getElementById('videoPlayerContainer').style.display = 'block';
                document.getElementById('modalAnimeTitle').textContent = animeTitle;
                document.getElementById('modalEpisodeTitle').textContent = episodeTitle;
                
                // Build resolution menu
                buildResolutionMenu();
                
                // Load default resolution (prefer 720p, or highest available)
                const defaultRes = availableResolutions['720p'] || 
                                 availableResolutions['1080p'] || 
                                 availableResolutions['360p'] || 
                                 availableResolutions['144p'];
                
                const defaultResName = availableResolutions['720p'] ? '720p' :
                                      availableResolutions['1080p'] ? '1080p' :
                                      availableResolutions['360p'] ? '360p' : '144p';
                
                loadVideoSource(defaultRes, defaultResName);
                
            } catch (error) {
                console.error('Error loading episode:', error);
                alert('Failed to load episode. Please try again.');
            }
        }

        function buildResolutionMenu() {
            const menu = document.getElementById('resolutionMenu');
            menu.innerHTML = '';
            
            const resOrder = ['1080p', '720p', '360p', '144p'];
            
            resOrder.forEach(res => {
                if (availableResolutions[res]) {
                    const option = document.createElement('div');
                    option.className = 'resolution-option';
                    option.textContent = res;
                    option.onclick = () => changeResolution(res);
                    menu.appendChild(option);
                }
            });
        }

        function loadVideoSource(src, resolution) {
            const video = document.getElementById('customVideoPlayer');
            const currentTime = video.currentTime || 0;
            const wasPlaying = !video.paused;
            
            video.src = src;
            video.load();
            
            if (currentTime > 0) {
                video.currentTime = currentTime;
            }
            
            if (wasPlaying) {
                video.play();
            }
            
            document.getElementById('currentResolution').textContent = resolution;
            document.getElementById('resolutionMenu').classList.remove('active');
            
            // Update active state in menu
            document.querySelectorAll('.resolution-option').forEach(opt => {
                opt.classList.remove('active');
                if (opt.textContent === resolution) {
                    opt.classList.add('active');
                }
            });
        }

        function changeResolution(resolution) {
            if (availableResolutions[resolution]) {
                loadVideoSource(availableResolutions[resolution], resolution);
            }
        }

        function toggleResolutionMenu() {
            const menu = document.getElementById('resolutionMenu');
            menu.classList.toggle('active');
        }

        function closeVideoPlayer() {
            const video = document.getElementById('customVideoPlayer');
            video.pause();
            video.src = '';
            document.getElementById('videoModal').style.display = 'none';
            currentAnimeId = null;
            currentEpisodeId = null;
            availableResolutions = {};
        }

        function togglePlay() {
            const video = document.getElementById('customVideoPlayer');
            const icon = document.getElementById('playIcon');
            
            if (video.paused) {
                video.play();
                icon.classList.remove('fa-play');
                icon.classList.add('fa-pause');
            } else {
                video.pause();
                icon.classList.remove('fa-pause');
                icon.classList.add('fa-play');
            }
        }

        function seek(e) {
            const video = document.getElementById('customVideoPlayer');
            const progressBar = e.currentTarget;
            const clickX = e.offsetX;
            const width = progressBar.offsetWidth;
            const duration = video.duration;
            
            video.currentTime = (clickX / width) * duration;
        }

        function toggleFullscreen() {
            const container = document.getElementById('videoPlayerContainer');
            
            if (!document.fullscreenElement) {
                container.requestFullscreen();
            } else {
                document.exitFullscreen();
            }
        }

        // Video progress update
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('customVideoPlayer');
            
            if (video) {
                video.addEventListener('timeupdate', function() {
                    const percent = (video.currentTime / video.duration) * 100;
                    document.getElementById('progressFilled').style.width = percent + '%';
                    
                    const current = formatTime(video.currentTime);
                    const total = formatTime(video.duration);
                    document.getElementById('timeDisplay').textContent = `${current} / ${total}`;
                });
                
                video.addEventListener('play', function() {
                    document.getElementById('playIcon').classList.remove('fa-play');
                    document.getElementById('playIcon').classList.add('fa-pause');
                });
                
                video.addEventListener('pause', function() {
                    document.getElementById('playIcon').classList.remove('fa-pause');
                    document.getElementById('playIcon').classList.add('fa-play');
                });
            }
        });

        function formatTime(seconds) {
            if (isNaN(seconds)) return '0:00';
            
            const mins = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${mins}:${secs.toString().padStart(2, '0')}`;
        }

        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('videoModal');
            if (event.target === modal) {
                closeVideoPlayer();
            }
        }
    </script>
            <!-- Video Player Modal -->
        <div id="videoModal" class="video-modal">
            <div class="video-modal-content">
                <span class="modal-close" onclick="closeVideoPlayer()">&times;</span>
                
                <div class="episode-info">
                    <h3 id="modalAnimeTitle"></h3>
                    <p id="modalEpisodeTitle"></p>
                </div>
                
                <div class="video-player-container" id="videoPlayerContainer">
                    <video id="customVideoPlayer" class="custom-video-player" controls>
                        Your browser does not support the video tag.
                    </video>
                    
                    <div class="video-controls" id="videoControls">
                        <button class="control-btn" onclick="togglePlay()">
                            <i class="fas fa-play" id="playIcon"></i>
                        </button>
                        
                        <div class="progress-bar" onclick="seek(event)">
                            <div class="progress-filled" id="progressFilled"></div>
                        </div>
                        
                        <span style="color: white; font-size: 14px;" id="timeDisplay">0:00 / 0:00</span>
                        
                        <div class="resolution-selector">
                            <button class="resolution-btn" onclick="toggleResolutionMenu()">
                                <span id="currentResolution">720p</span>
                            </button>
                            <div class="resolution-menu" id="resolutionMenu"></div>
                        </div>
                        
                        <button class="control-btn" onclick="toggleFullscreen()">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                
                <div id="noEpisodesMessage" class="no-episodes" style="display: none;">
                    No episodes available for this anime yet.
                </div>
            </div>
        </div>
</body>
</html>