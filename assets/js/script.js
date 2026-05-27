// Language Switcher
function setLanguage(lang) {
    const currentLang = document.getElementById('current-language');

    if (lang === 'vi') {
        currentLang.innerHTML = '🇻🇳 Tiếng Việt';
    } else if (lang === 'en') {
        currentLang.innerHTML = '🇬🇧 English';
    }

    console.log('Đã chuyển sang ngôn ngữ:', lang);

    // TODO: Sau này thêm chức năng chuyển đổi thực tế (cookie, session, reload...)
}

// Khởi tạo khi trang load xong
document.addEventListener('DOMContentLoaded', function() {
    console.log('Language switcher initialized');
});