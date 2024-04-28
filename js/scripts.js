const settings = document.getElementById("settings");
const clickBox = document.querySelector(".click_box");
const tooltip_span = document.querySelector(".settings span");

settings.addEventListener("click", function() {
    clickBox.style.display = clickBox.style.display === 'none' ? '' : 'none';
    tooltip_span.style.display = tooltip_span.style.display === 'none' ? '' : 'none';
    //console.log(clickBox);
});