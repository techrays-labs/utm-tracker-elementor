(function () {
    const params = new URLSearchParams(window.location.search);
    const expires = new Date();
    expires.setDate(expires.getDate() + 7); // 7-day cookie

    params.forEach((value, key) => {
        document.cookie = `qp_${key}=${encodeURIComponent(value)}; path=/; expires=${expires.toUTCString()}`;
    });
})();
