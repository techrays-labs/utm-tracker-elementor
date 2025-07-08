(function () {
    const params = new URLSearchParams(window.location.search);
    const expires = new Date();
    expires.setDate(expires.getDate() + 365);

    params.forEach((value, key) => {
        document.cookie = `qp_${key}=${encodeURIComponent(value)}; path=/; expires=${expires.toUTCString()}`;
    });
})();
