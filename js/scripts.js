const user = document.querySelector(".main_user_profile img");
const clickBox = document.querySelector(".click_box");

user.addEventListener("click", function() {
    clickBox.style.display = clickBox.style.display === 'none' ? '' : 'none';
    //console.log(clickBox);
});