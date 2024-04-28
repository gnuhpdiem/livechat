function dangxuat() {
    let answer = confirm("Bạn có chắc chắn bạn muốn đăng xuất không?");
    if (answer) {
        get_data({}, "dangxuat");
    }
}