<style>
    /* select au même style que les inputs */
    select.fb-input {
        appearance: none; -webkit-appearance: none; cursor: pointer; padding-right: 46px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='none' viewBox='0 0 24 24' stroke='%23059669' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 16px center;
    }

    /* statistiques */
    .fb-stats { display: grid; grid-template-columns: repeat(5, 1fr); gap: 14px; padding: 26px 28px 0; }
    .fb-stat {
        padding: 18px; border-radius: 16px;
        background: #f6faf8; border: 1.5px solid #e0e9e5; border-left: 4px solid #059669;
        transition: transform .2s, box-shadow .2s;
    }
    .fb-stat:hover { transform: translateY(-3px); box-shadow: 0 14px 28px -16px rgba(5,150,105,.5); }
    .fb-stat-lbl { font-size: 12px; font-weight: 600; color: #6b7280; }
    .fb-stat-num { margin-top: 8px; font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; line-height: 1; color: #022c22; }
    .fb-stat-num small { font-family: 'Inter', sans-serif; font-size: 12px; font-weight: 600; color: #047857; margin-left: 4px; }

    .fb-price { font-weight: 700; color: #047857; white-space: nowrap; }
    .fb-title-cell { font-weight: 600; color: #022c22; }

    @media (max-width: 1000px) { .fb-stats { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 700px)  { .fb-stats { padding: 20px 12px 0; } }
</style>