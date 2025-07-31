export default function initWordPressConsentBridge() {
    if (typeof window.wp_set_consent !== 'function') return;

    const defineConsentTypeOnce = (() => {
        let done = false;
        return () => {
            if (done) return;
            done = true;
            window.wp_set_consent_type?.('optin');
        };
    })();

    const map = {
        analytics: 'statistics',
        advertisement: 'marketing',
        functional: 'preferences',
    };

    const pushConsentToWP = (event) => {
        if (!event?.detail) return;
        defineConsentTypeOnce();

        const categories = {
            ...Object.fromEntries(event.detail.accepted.map((c) => [c, true])),
            ...Object.fromEntries(event.detail.rejected.map((c) => [c, false])),
        };

        Object.entries(categories).forEach(([cookiepalCat, allowed]) => {
            const apiCat = map[cookiepalCat];
            if (apiCat) {
                window.wp_set_consent(apiCat, allowed ? 'allow' : 'deny');
            }
        });
    };

    const syncExistingConsent = () => {
        if (typeof window.getCookiepalConsent !== 'function') return;

        const { categories = {} } = window.getCookiepalConsent();
        const accepted = [];
        const rejected = [];

        Object.entries(categories).forEach(([cat, allowed]) =>
            (allowed ? accepted : rejected).push(cat)
        );

        pushConsentToWP({ detail: { accepted, rejected } });
    };

    document.addEventListener('cookiepal_consent_update', pushConsentToWP);

    document.addEventListener(
        'cookiepal_banner_load',
        () => {
            syncExistingConsent();
        },
        { once: true }
    );

    if (
        typeof window.getCookiepalConsent === 'function' &&
        Object.values(window.getCookiepalConsent()?.categories || {}).some(Boolean)
    ) {
        syncExistingConsent();
    }
}

if (document.readyState === 'complete') {
    initWordPressConsentBridge();
} else {
    window.addEventListener('load', initWordPressConsentBridge);
}
