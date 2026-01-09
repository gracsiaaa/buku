<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter The Library</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS KHUSUS LANDING PAGE */
        .gate-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh; /* Agar pas di tengah layar */
            gap: 50px;
            padding: 20px;
            flex-wrap: wrap;
        }

        .portal-card {
            width: 300px;
            height: 400px;
            background: #050505;
            border: 12px ridge var(--frame-dark);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            cursor: pointer;
            transition: 0.5s;
            position: relative;
            text-decoration: none;
            box-shadow: 0 20px 50px -10px black;
        }

        .portal-card:hover {
            transform: translateY(-20px);
            border-color: var(--gold-dust);
            box-shadow: 0 0 30px var(--gold-dust);
        }

        .portal-icon {
            font-size: 5rem;
            color: var(--maroon);
            margin-bottom: 20px;
            text-shadow: 0 5px 10px black;
            transition: 0.3s;
        }

        .portal-card:hover .portal-icon {
            color: var(--silver);
            transform: scale(1.1);
        }

        .portal-title {
            font-family: 'Cinzel Decorative', serif;
            font-size: 2rem;
            color: var(--silver);
            margin-bottom: 10px;
        }

        .portal-desc {
            font-family: 'EB Garamond', serif;
            color: var(--gold-dust);
            font-style: italic;
            font-size: 1.1rem;
            padding: 0 20px;
        }

        /* Garis vertikal pemisah */
        .divider-vertical {
            width: 2px;
            height: 300px;
            background: linear-gradient(to bottom, transparent, var(--frame-light), transparent);
        }

        @media (max-width: 768px) {
            .divider-vertical { display: none; }
        }
    </style>
</head>
<body>

    <div class="dust-container"><div class="dust d1"></div><div class="dust d2"></div></div>

    <header style="margin-bottom: 0; padding-bottom: 40px;">
        <div class="header-ornament">⚜</div>
        <div class="brand">The Great Library</div>
        <br>
        <span class="subtitle">Select Your Destiny</span>
    </header>

    <div class="container">
        <div class="gate-container">
            
            <a href="katalog.php" class="portal-card">
                <div class="portal-icon">📖</div>
                <div class="portal-title">The Gallery</div>
                <div class="portal-desc">For guests and wanderers seeking ancient tales.</div>
            </a>

            <div class="divider-vertical"></div>

            <a href="admin/index.php" class="portal-card">
                <div class="portal-icon">🗝️</div>
                <div class="portal-title">The Archive</div>
                <div class="portal-desc">Restricted access for the keepers of the books.</div>
            </a>

        </div>
    </div>

</body>
</html>