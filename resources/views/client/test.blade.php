<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trading Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-green: #1dc37a;
            --light-gray: #f8f9fa;
        }
        
        body {
            background-color: #f8f9fa;
        }
        
        .banner-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .feature-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        
        .feature-card:hover {
            transform: translateY(-2px);
        }
        
        .feature-icon {
            font-size: 2rem;
            color: var(--primary-green);
            margin-bottom: 10px;
        }
        
        .news-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 70px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .news-card {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 8px;
            background: var(--light-gray);
            margin-bottom: 10px;
        }
        
        .news-stats {
            display: flex;
            gap: 20px;
            color: #666;
            font-size: 0.9rem;
        }
        
        /* Support Button Styles */
        .support-button-wrapper {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
        }
        
        /* ... (manter os estilos do support button do código anterior) ... */
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- Banner Section -->
        <div class="banner-section">
            <div class="text-center">
                <img src="your-logo.png" alt="Logo" class="img-fluid mb-3" style="max-height: 100px;">
                <div class="banner-indicators">
                    <i class="bi bi-circle-fill mx-1 text-success"></i>
                    <i class="bi bi-circle mx-1"></i>
                    <i class="bi bi-circle mx-1"></i>
                </div>
            </div>
        </div>

        <!-- Feature Grid -->
        <div class="feature-grid">
            <div class="feature-card">
                <i class="bi bi-graph-up feature-icon"></i>
                <h5>Markets</h5>
            </div>
            <div class="feature-card">
                <i class="bi bi-download feature-icon"></i>
                <h5>Download</h5>
            </div>
            <div class="feature-card">
                <i class="bi bi-people feature-icon"></i>
                <h5>Invite</h5>
            </div>
            <div class="feature-card">
                <i class="bi bi-book feature-icon"></i>
                <h5>Guide</h5>
            </div>
        </div>

        <!-- News Section -->
        <div class="news-section">
            <h4 class="mb-4">Latest Updates</h4>
            <div class="news-card">
                <div class="flex-grow-1">
                    <h6 class="mb-2">Market Analysis</h6>
                    <div class="news-stats">
                        <span><i class="bi bi-eye me-1"></i>5117</span>
                        <span><i class="bi bi-clock me-1"></i>8191</span>
                    </div>
                </div>
                <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/WhatsApp%20Image%202025-01-28%20at%2023.03.11-ZHDD0ZaBIP15wUDfgDZGU7uDatsNj8.jpeg" alt="News" class="ms-3 rounded" style="width: 60px; height: 60px; object-fit: cover;">
            </div>
        </div>
    </div>

    <!-- Support Button -->
    <div class="support-button-wrapper">
        <button class="btn btn-success rounded-circle support-button" id="supportButton">
            <i class="bi bi-headset"></i>
        </button>
        
        <div class="support-tooltip-content" id="supportTooltip">
            <div class="support-options">
                <a href="https://t.me/yourhandle" class="support-option telegram">
                    <i class="bi bi-telegram"></i>
                    <span>Telegram</span>
                </a>
                <a href="https://wa.me/yourphone" class="support-option whatsapp">
                    <i class="bi bi-whatsapp"></i>
                    <span>WhatsApp</span>
                </a>
                <a href="https://m.me/yourpage" class="support-option facebook">
                    <i class="bi bi-facebook"></i>
                    <span>Facebook</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Manter o script do support button do código anterior -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Manter o JavaScript do support button do código anterior
    </script>
</body>
</html>