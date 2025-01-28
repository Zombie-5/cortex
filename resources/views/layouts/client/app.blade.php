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

        .navbar-balance {
            color: #000;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .secondary-balance {
            color: var(--primary-green);
            font-size: 0.8rem;
        }

        .video-banner {
            background: #1a1a1a;
            color: white;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
        }

        .watchlist-item {
            border-bottom: 1px solid #eee;
            padding: 12px 0;
        }

        .asset-price {
            font-size: 0.9rem;
            color: #666;
        }

        .price-up {
            color: var(--primary-green);
        }

        .price-down {
            color: #ff4444;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: white;
            border-top: 1px solid #eee;
            padding: 10px 0;
            z-index: 1000;
        }

        .nav-icon {
            font-size: 1.2rem;
        }

        .asset-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
        }

        .btn-add-funds {
            background-color: var(--primary-green);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .support-button-wrapper {
            position: fixed;
            bottom: 80px;
            /* Ajustado para ficar acima da navegação inferior */
            right: 20px;
            z-index: 1050;
        }

        .support-button {
            width: 48px;
            height: 48px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
        }

        .support-button i {
            font-size: 20px;
        }

        .support-tooltip-content {
            position: absolute;
            bottom: 100%;
            right: 0;
            margin-bottom: 10px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
            padding: 8px;
            display: none;
            min-width: 160px;
        }

        .support-options {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .support-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            text-decoration: none;
            color: #333;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .support-option:hover {
            background-color: #f8f9fa;
        }

        .support-option i {
            font-size: 20px;
        }

        .support-option.telegram i {
            color: #0088cc;
        }

        .support-option.whatsapp i {
            color: #25D366;
        }

        .support-option.facebook i {
            color: #1877F2;
        }

        /* Ensure tooltip stays above bottom navigation on mobile */
        @media (max-width: 768px) {
            .support-button-wrapper {
                bottom: 70px;
            }
        }
    </style>
</head>

<body class="pb-5">

    <!-- Navbar -->
    @include('layouts.client.header')

    <!-- Main Content -->
    @yield('content');

    <!-- Floating Support Button -->
    <div class="support-button-wrapper mb-5">
        <button class="btn btn-success rounded-circle support-button" id="supportButton" data-bs-toggle="tooltip"
            data-bs-custom-class="support-tooltip" data-bs-placement="top">
            <i class="bi bi-headset"></i>
        </button>

        <!-- Support Options Tooltip -->
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

    <!-- Bottom Navigation -->
    @include('layouts.client.bottom')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const supportButton = document.getElementById('supportButton');
            const supportTooltip = document.getElementById('supportTooltip');
            let isTooltipVisible = false;

            // Toggle tooltip on button click
            supportButton.addEventListener('click', function(e) {
                e.stopPropagation();
                isTooltipVisible = !isTooltipVisible;
                supportTooltip.style.display = isTooltipVisible ? 'block' : 'none';
            });

            // Close tooltip when clicking outside
            document.addEventListener('click', function(e) {
                if (isTooltipVisible && !supportTooltip.contains(e.target)) {
                    isTooltipVisible = false;
                    supportTooltip.style.display = 'none';
                }
            });

            // Prevent tooltip from closing when clicking inside it
            supportTooltip.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>

    @yield('script')
</body>

</html>
