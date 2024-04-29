<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="styles/dangki_dangnhap.css">
</head>
<body>
    <div class="container">

        <form id="formID" action="" method="post">
            <div class="error" id="error"></div>
            <div class="input_field">
                <label for="username">Email: </label>
                <input type="email" name="email" id="email" autocomplete="off">
            </div>
            <div class="input_field">
                <label for="username">Tên tài khoản: </label>
                <input type="text" name="username" id="username" autocomplete="off">
            </div>
            <div class="input_field">
                <label for="password">Mật khẩu: </label>
                <input type="password" name="password" id="password" autocomplete="off">
            </div>
            <div class="input_field">
                <input type="submit" name="submitBtn" id="submitBtn" value="Đăng kí">
                <button id="clear">Clear</button>
            </div>
        </form>
        <p>Đã có tài khoản? Hãy <a href="index.php">đăng nhập</a> ngay!</p>
    </div>

    <script>
        const submitBtn = document.getElementById("submitBtn");
        const form = document.getElementById("formID");
        const errorText = document.getElementById("error");

        submitBtn.addEventListener("click", function(e) {

            e.preventDefault();

            submitBtn.disabled = true; // disable submit btn so the user can't spam

            const email = document.getElementById("email");
            const username = document.getElementById("username");
            const password = document.getElementById("password");

            // collect data
            const data = {};
            data.email = email.value;
            data.username = username.value;
            data.password = password.value;

            //console.log(JSON.stringify(data));

            send_data(data, 'dangki');
    
        });

        function send_data(data, type) {
            let xml = new XMLHttpRequest();

            xml.addEventListener("load", function() {
                if (xml.readyState == 4 || xml.status == 200) { // everything good
                    
                    let message = xml.responseText;
                    if (message == "yes") {
                        alert("Tạo tài khoản thành công!");
                        // chuyển hướng qua trang khác
                        location.href = "chat.php";
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
            xml.open("POST", "backend/api.php", true);
            xml.send(data_string);
        }

        // clear inputs
        const clearBtn = document.getElementById("clear");

        clearBtn.addEventListener("click", Reset);

        function Reset() {
            form.reset();
        }
    </script>
</body>
</html>