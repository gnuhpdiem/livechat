const dangxuatBtn = document.getElementById("dangxuatBtn");
dangxuatBtn.addEventListener("click", function() {
    // make a alert asking if the user is sure
    let answer = confirm("Bạn có chắc chắn bạn muốn đăng xuất không?");
    if (answer) {
        get_data({}, "dangxuat");
    }
});