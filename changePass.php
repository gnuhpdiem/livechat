<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="formID" action="" method="post">
        <div class="error" id="error"></div>
        <div class="input_field">
            <label for="currentPass">Current password: </label>
            <input type="password" name="currentPass" id="currentPass" autocomplete="off">
        </div>
        <div class="input_field">
            <label for="newPass">New password: </label>
            <input type="password" name="newPass" id="newPass" autocomplete="off">
        </div>
        <div class="input_field">
            <input type="submit" name="submitBtn" id="submitBtn" value="Cập nhật">
        </div>
    </form>
    <a href="edit_user_profile.php"><button>Quay về</button></a>

    <script>
        const submitBtn = document.getElementById("submitBtn");
        const form = document.getElementById("formID");
        const errorText = document.getElementById("error");

        submitBtn.addEventListener("click", function(e) {

            e.preventDefault();

            submitBtn.disabled = true;

            const currentPass = document.getElementById("currentPass");
            const newPass = document.getElementById("newPass");

            // collect data
            const data = {};
            data.currentPass = currentPass.value;
            data.newPass = newPass.value;

            //console.log(JSON.stringify(data));

            send_data(data, "changePass");
    
        });

        function send_data(data, type) {
            let xml = new XMLHttpRequest();

            xml.addEventListener("load", function() {
                if (xml.readyState == 4 || xml.status == 200) { // everything good
                    
                    let message = xml.responseText;
                    if (message == "yes") {
                        alert("Cập nhật thành công!");
                        // chuyển hướng qua trang khác
                        location.href = "edit_user_profile.php";
                    } else {
                        errorText.textContent = message;
                        errorText.style.display = "block";
                    }
                    submitBtn.disabled = false; // after done sending the data, enable the button
                }

            });

            // send data
            data.type_of_data = type;
            let data_string = JSON.stringify(data); // cannot send object so turn the obj to string
            xml.open("POST", "api.php", true);
            xml.send(data_string);
        }

    </script>
</body>
</html>