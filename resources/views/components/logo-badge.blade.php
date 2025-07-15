{{-- resources/views/components/logo-badge.blade.php --}}
<svg width="{{ $size ?? '80' }}" height="{{ $size ?? '80' }}" viewBox="0 0 200 200" class="{{ $class ?? '' }}">
    <defs>
        <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#22c55e;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#16a34a;stop-opacity:1" />
        </linearGradient>
        <linearGradient id="redGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#dc2626;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#991b1b;stop-opacity:1" />
        </linearGradient>
    </defs>

    <!-- Badge Background -->
    <path d="M100 20 L140 50 L170 40 L180 80 L170 120 L140 150 L100 180 L60 150 L30 120 L20 80 L30 40 L60 50 Z"
        fill="url(#gradient1)" stroke="#fff" stroke-width="3" />

    <!-- Inner Circle -->
    <circle cx="100" cy="100" r="55" fill="white" opacity="0.95" />

    <!-- Japanese Elements -->
    <circle cx="100" cy="85" r="15" fill="url(#redGradient)" />

    <!-- Mountain (Fuji) -->
    <path d="M70 115 L100 95 L130 115 Z" fill="#16a34a" />
    <path d="M85 115 L100 103 L115 115 Z" fill="#22c55e" />

    <!-- Text -->
    <text x="100" y="135" text-anchor="middle" fill="#16a34a" font-family="Arial, sans-serif" font-size="16"
        font-weight="bold">LPK</text>
    <text x="100" y="150" text-anchor="middle" fill="#16a34a" font-family="Arial, sans-serif"
        font-size="12">JEPANG</text>
</svg>
