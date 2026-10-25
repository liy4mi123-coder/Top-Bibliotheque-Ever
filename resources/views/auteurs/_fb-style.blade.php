<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,500&display=swap" rel="stylesheet">

<style>
    *, *::before, *::after { box-sizing: border-box; }
    body { margin: 0; font-family: 'Inter', sans-serif; background: #021f19; }

    .fb-page {
        position: relative; min-height: 100vh;
        display: flex; padding: 24px;
        background:
            radial-gradient(900px 500px at 15% 10%, rgba(52,211,153,.22), transparent 60%),
            radial-gradient(800px 500px at 90% 95%, rgba(16,185,129,.20), transparent 60%),
            linear-gradient(160deg, #021f19 0%, #043d2f 50%, #064e3b 100%);
        background-attachment: fixed;
    }
    .fb-page::before {
        content: ""; position: fixed; inset: 0; pointer-events: none;
        background-image:
            linear-gradient(rgba(110,231,183,.06) 1px, transparent 1px),
            linear-gradient(90deg, rgba(110,231,183,.06) 1px, transparent 1px);
        background-size: 48px 48px;
        -webkit-mask-image: radial-gradient(ellipse at center, #000 30%, transparent 80%);
        mask-image: radial-gradient(ellipse at center, #000 30%, transparent 80%);
    }

    /* ===== CARD ===== */
    .fb-card {
        position: relative; z-index: 1; margin: auto;
        width: 100%; max-width: 640px;
        background: #fff; border-radius: 28px; overflow: hidden;
        box-shadow: 0 40px 90px -20px rgba(0,0,0,.55), 0 0 0 1px rgba(255,255,255,.08);
        animation: fb-rise .7s ease-out both;
    }
    .fb-card.fb-wide { max-width: 1150px; }
    @keyframes fb-rise { from { opacity: 0; transform: translateY(20px) scale(.98); } to { opacity: 1; transform: none; } }
    @keyframes fb-pulse { 0%,100% { opacity: .5; transform: scale(1);} 50% { opacity: .9; transform: scale(1.12);} }

    /* ===== HEADER BAND ===== */
    .fb-head {
        position: relative; overflow: hidden; color: #fff;
        padding: 30px 40px 32px;
        background: linear-gradient(155deg, #064e3b 0%, #047857 60%, #059669 100%);
    }
    .fb-head::before {
        content: ""; position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,.07) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.07) 1px, transparent 1px);
        background-size: 36px 36px;
        -webkit-mask-image: linear-gradient(180deg, #000, transparent 90%);
        mask-image: linear-gradient(180deg, #000, transparent 90%);
    }
    .fb-glow {
        position: absolute; width: 260px; height: 260px; border-radius: 50%;
        right: -80px; top: -110px;
        background: radial-gradient(circle, rgba(167,243,208,.45), transparent 70%);
        animation: fb-pulse 6s ease-in-out infinite;
    }
    .fb-head > * { position: relative; }
    .fb-head .fb-glow { position: absolute; }

    .fb-backlink {
        display: inline-flex; align-items: center; gap: 6px; margin-bottom: 18px;
        font-size: 13px; font-weight: 600; color: #a7f3d0; text-decoration: none;
    }
    .fb-backlink:hover { color: #fff; }

    .fb-head-row { display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
    .fb-head-left { display: flex; align-items: center; gap: 16px; }
    .fb-head-ico {
        flex: none; width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.25);
    }
    .fb-head-ico svg { width: 26px; height: 26px; }
    .fb-badge {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 11px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
        color: #d1fae5; background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.2);
        padding: 5px 11px; border-radius: 999px;
    }
    .fb-badge b { width: 6px; height: 6px; border-radius: 50%; background: #6ee7b7; display: block; }
    .fb-title { margin: 10px 0 0; font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; line-height: 1.15; }
    .fb-title em { font-style: italic; color: #a7f3d0; font-weight: 500; }
    .fb-sub { margin: 8px 0 0; font-size: 14px; line-height: 1.6; color: rgba(236,253,245,.82); }

    /* ===== BODY ===== */
    .fb-body { padding: 34px 40px 36px; }

    .fb-grid2 { display: grid; grid-template-columns: 1fr 1fr; gap: 0 16px; }
    .fb-field { margin-bottom: 18px; }
    .fb-label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #064e3b; }
    .fb-input {
        display: block; width: 100%; padding: 14px 16px;
        font-family: inherit; font-size: 15px; color: #064e3b;
        background: #f6faf8; border: 1.5px solid #e0e9e5; border-radius: 12px;
        transition: all .2s ease;
    }
    .fb-input::placeholder { color: #9bb3a8; }
    .fb-input:focus { outline: none; background: #fff; border-color: #059669; box-shadow: 0 0 0 4px rgba(5,150,105,.15); }
    .fb-error { margin: 6px 0 0; padding: 0; list-style: none; font-size: 12px; color: #dc2626; }

    /* ===== BUTTONS ===== */
    .fb-actions { display: flex; gap: 12px; margin-top: 26px; }
    .fb-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        padding: 15px 22px; border: 0; cursor: pointer; text-decoration: none;
        font-family: inherit; font-size: 15px; font-weight: 600; color: #fff;
        border-radius: 12px;
        background: linear-gradient(135deg, #047857, #059669 55%, #10b981);
        box-shadow: 0 12px 26px -10px rgba(5,150,105,.7);
        transition: transform .2s, box-shadow .2s, filter .2s;
    }
    .fb-btn:hover { transform: translateY(-2px); filter: brightness(1.06); box-shadow: 0 16px 32px -10px rgba(5,150,105,.8); }
    .fb-btn.fb-grow { flex: 1; }
    .fb-btn svg { width: 18px; height: 18px; }
    .fb-btn-ghost {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 15px 22px; text-decoration: none; cursor: pointer;
        font-family: inherit; font-size: 15px; font-weight: 600; color: #047857;
        background: #ecfdf5; border: 1.5px solid #d1fae5; border-radius: 12px;
        transition: background .2s, border-color .2s;
    }
    .fb-btn-ghost:hover { background: #d1fae5; border-color: #a7f3d0; }
    .fb-btn-light {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 18px; text-decoration: none; cursor: pointer;
        font-family: inherit; font-size: 14px; font-weight: 700; color: #064e3b;
        background: #fff; border: 0; border-radius: 12px;
        box-shadow: 0 12px 26px -12px rgba(0,0,0,.5);
        transition: transform .2s, background .2s;
    }
    .fb-btn-light:hover { transform: translateY(-2px); background: #ecfdf5; }

    /* ===== TABLE ===== */
    .fb-tablewrap { padding: 10px 28px 28px; overflow-x: auto; }
    .fb-table { width: 100%; border-collapse: collapse; min-width: 860px; }
    .fb-table th {
        padding: 16px 12px; text-align: left; white-space: nowrap;
        font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        color: #047857; border-bottom: 2px solid #d1fae5;
    }
    .fb-table td { padding: 14px 12px; font-size: 14px; color: #374151; border-bottom: 1px solid #e5efe9; vertical-align: middle; }
    .fb-table tbody tr { transition: background .15s; }
    .fb-table tbody tr:hover { background: #f6faf8; }
    .fb-id { font-weight: 700; color: #9bb3a8; }
    .fb-person { display: flex; align-items: center; gap: 12px; font-weight: 600; color: #022c22; }
    .fb-ava {
        flex: none; width: 36px; height: 36px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 700; color: #064e3b;
        background: linear-gradient(135deg, #a7f3d0, #6ee7b7);
    }
    .fb-pill { display: inline-block; padding: 5px 12px; border-radius: 999px; font-size: 12px; font-weight: 700; }
    .fb-pill-ok { background: #d1fae5; color: #047857; }
    .fb-pill-no { background: #fee2e2; color: #b91c1c; }

    .fb-row-actions { display: flex; align-items: center; gap: 6px; }
    .fb-row-actions form { margin: 0; }
    .fb-mini {
        display: inline-block; padding: 8px 12px; border-radius: 9px; border: 0; cursor: pointer;
        font-family: inherit; font-size: 12.5px; font-weight: 700; text-decoration: none;
        transition: transform .15s, background .15s;
    }
    .fb-mini:hover { transform: translateY(-1px); }
    .fb-mini-view { background: #d1fae5; color: #047857; }
    .fb-mini-view:hover { background: #a7f3d0; }
    .fb-mini-edit { background: #fff; color: #047857; box-shadow: inset 0 0 0 1.5px #a7f3d0; }
    .fb-mini-edit:hover { background: #ecfdf5; }
    .fb-mini-del { background: #fef2f2; color: #b91c1c; }
    .fb-mini-del:hover { background: #fee2e2; }
    .fb-empty { padding: 40px 12px !important; text-align: center; color: #9bb3a8 !important; }

    /* ===== SHOW ===== */
    .fb-hero-ava {
        flex: none; width: 64px; height: 64px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; color: #064e3b;
        background: linear-gradient(135deg, #a7f3d0, #6ee7b7);
        box-shadow: 0 0 0 4px rgba(255,255,255,.18);
    }
    .fb-info { border-top: 1px solid #e5efe9; }
    .fb-info-row { display: flex; justify-content: space-between; gap: 16px; padding: 15px 4px; border-bottom: 1px solid #e5efe9; font-size: 14px; }
    .fb-info-label { font-weight: 600; color: #064e3b; }
    .fb-info-value { color: #4b5563; text-align: right; }
    .fb-h2 { margin: 28px 0 14px; font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #022c22; }
    .fb-books { margin: 0; padding: 0; list-style: none; }
    .fb-books li {
        display: flex; align-items: center; gap: 12px; margin-bottom: 8px; padding: 13px 16px;
        font-size: 14px; font-weight: 600; color: #064e3b;
        background: #f6faf8; border: 1.5px solid #e0e9e5; border-left: 4px solid #059669; border-radius: 10px;
    }
    .fb-books li svg { flex: none; width: 18px; height: 18px; color: #059669; }
    .fb-nobooks { padding: 8px 0; font-size: 14px; font-style: italic; color: #9ca3af; }

    /* ===== MOBILE ===== */
    @media (max-width: 700px) {
        .fb-page { padding: 14px; }
        .fb-head { padding: 24px 24px 26px; }
        .fb-body { padding: 26px 24px 28px; }
        .fb-grid2 { grid-template-columns: 1fr; }
        .fb-actions { flex-direction: column-reverse; }
        .fb-title { font-size: 26px; }
        .fb-tablewrap { padding: 6px 12px 20px; }
        .fb-info-row { flex-direction: column; gap: 4px; }
        .fb-info-value { text-align: left; }
    }
</style>