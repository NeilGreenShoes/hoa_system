<div class="hoa-download-page">
    <div class="hoa-container">
        
        <!-- Minimal Top Navigation Header -->
        <header class="hoa-header">
            <div class="hoa-brand">
                <span class="hoa-dot"></span>
                <span class="hoa-system-name">HOA Portal</span>
            </div>
            <a href="/login" class="hoa-back-link">Return to web application</a>
        </header>

        <!-- Main Minimal Download Focus Card -->
        <main class="hoa-card">
            <div class="hoa-card-body">
                <span class="hoa-badge">Official Release</span>
                <h1 class="hoa-heading">Download the Mobile App</h1>
                <p class="hoa-lead">
                    TEMPORARY DECORATION FOR DOWNLOADING APPLICATION
                </p>
                <p class="hoa-lead">
                    Get real-time gate notifications, access your digital subdivision ID, file facility reservations, and settle association dues directly from your smartphone.
                </p>

                <!-- Clean, Uniform Download Actions -->
                <div class="hoa-btn-group">
                    <a href="#" class="hoa-btn hoa-btn-apple" aria-label="Download from the Apple App Store">
                        <i class="fa-brands fa-apple"></i>
                        <span>App Store</span>
                    </a>
                    <a href="#" class="hoa-btn hoa-btn-google" aria-label="Download from the Google Play Store">
                        <i class="fa-brands fa-google-play"></i>
                        <span>Google Play</span>
                    </a>
                </div>

                <!-- Modern Divider -->
                <div class="hoa-divider">
                    <span>Or scan to install</span>
                </div>

                <!-- Centered Clean QR Zone -->
                <div class="hoa-qr-wrapper">
                    <div class="hoa-qr-frame">
                        <!-- Replace icon with dynamic QR code implementation when available -->
                        <i class="fa-solid fa-qrcode"></i>
                    </div>
                    <p class="hoa-qr-caption">Point your phone camera to scan and open directly in your device app store.</p>
                </div>
            </div>

            <!-- Subtle Security/Trust Footer inside the frame -->
            <div class="hoa-card-footer">
                <p><i class="fa-solid fa-shield-halved"></i> Secured official link verified for community homeowners.</p>
            </div>
        </main>

    </div>
</div>

<style>
:root {
    /* Dynamic parameters passed from backend configurations */
    --primary-color: {{ $config->primary_color }};
    --secondary-color: {{ $config->secondary_color }};
    --tertiary-color: {{ $config->tertiary_color }};
    
    /* Clean Minimal Base colors */
    --hoa-bg: #f8fafc;
    --hoa-card-bg: #ffffff;
    --hoa-text-main: #0f172a;
    --hoa-text-sub: #475569;
    --hoa-border-light: #e2e8f0;
}

/* Master Page wrapper */
.hoa-download-page {
    min-height: 100vh;
    background-color: var(--hoa-bg);
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 2rem 1rem;
    box-sizing: border-box;
}

.hoa-container {
    max-width: 520px;
    width: 100%;
    margin: 0 auto;
}

/* Minimal Top Branding bar */
.hoa-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding: 0 0.5rem;
}

.hoa-brand {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.hoa-dot {
    width: 8px;
    height: 8px;
    background-color: var(--primary-color);
    border-radius: 50%;
}

.hoa-system-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--hoa-text-main);
    letter-spacing: -0.01em;
}

.hoa-back-link {
    font-size: 0.85rem;
    color: var(--hoa-text-sub);
    text-decoration: none;
    transition: color 0.15s ease;
}

.hoa-back-link:hover {
    color: var(--primary-color);
}

/* Main Minimal Centered Central Box layout */
.hoa-card {
    background-color: var(--hoa-card-bg);
    border: 1px solid var(--hoa-border-light);
    border-radius: 24px;
    box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.02), 0 10px 15px -3px rgba(15, 23, 42, 0.03);
    overflow: hidden;
}

.hoa-card-body {
    padding: 3rem 2.5rem 2.5rem 2.5rem;
    text-align: center;
}

.hoa-badge {
    display: inline-block;
    background-color: var(--hoa-bg);
    color: var(--secondary-color);
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.35rem 0.85rem;
    border-radius: 100px;
    letter-spacing: 0.03em;
    border: 1px solid var(--hoa-border-light);
}

.hoa-heading {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--hoa-text-main);
    letter-spacing: -0.02em;
    margin: 1.25rem 0 0.75rem 0;
}

.hoa-lead {
    font-size: 0.95rem;
    line-height: 1.55;
    color: var(--hoa-text-sub);
    margin-bottom: 2.25rem;
}

/* Action button configurations mapping to theme variables */
.hoa-btn-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.85rem;
    margin-bottom: 2rem;
}

.hoa-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.6rem;
    background-color: var(--hoa-text-main);
    color: #ffffff;
    padding: 0.9rem 1rem;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 500;
    text-decoration: none;
    transition: background-color 0.15s ease, transform 0.1s ease;
}

.hoa-btn:hover {
    background-color: var(--primary-color);
}

.hoa-btn:active {
    transform: scale(0.98);
}

.hoa-btn i {
    font-size: 1.2rem;
}

/* Structural clean inline dividers */
.hoa-divider {
    display: flex;
    align-items: center;
    text-align: center;
    color: #94a3b8;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin: 2rem 0;
}

.hoa-divider::before,
.hoa-divider::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid var(--hoa-border-light);
}

.hoa-divider:not(:empty)::before {
    margin-right: 1rem;
}

.hoa-divider:not(:empty)::after {
    margin-left: 1rem;
}

/* QR Code Section container layout */
.hoa-qr-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.hoa-qr-frame {
    background-color: #ffffff;
    border: 1px solid var(--hoa-border-light);
    width: 140px;
    height: 140px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 1px 3px rgba(0,0,0,0.02);
}

.hoa-qr-frame i {
    font-size: 6rem;
    color: var(--hoa-text-main);
}

.hoa-qr-caption {
    font-size: 0.8rem;
    color: var(--hoa-text-sub);
    line-height: 1.4;
    max-width: 280px;
    margin: 0;
}

/* Minimal Footer note block */
.hoa-card-footer {
    background-color: var(--hoa-bg);
    border-top: 1px solid var(--hoa-border-light);
    padding: 1rem;
    text-align: center;
}

.hoa-card-footer p {
    margin: 0;
    font-size: 0.75rem;
    color: var(--hoa-text-sub);
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}

.hoa-card-footer i {
    color: #22c55e;
}

/* Responsive breakpoint scaling */
@media (max-width: 480px) {
    .hoa-card-body {
        padding: 2rem 1.5rem 2rem 1.5rem;
    }
    .hoa-btn-group {
        grid-template-columns: 1fr;
    }
}
</style>