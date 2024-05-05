<!-- Đây là trang đăng nhập -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="styles/dangki_dangnhap.css">
    <?php include_once __DIR__ . '/styles/styles.php'; ?>
</head>
<body>
    <div class="container">
        <form id="formID" action="" method="post">
            <h1>Đăng nhập</h1>
            <div id="error" class="error"></div>
            <div class="input_field">
                <input type="text" name="username" id="username" autocomplete="off" placeholder="Tên đăng nhập">
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <div class="input_field">
                <input type="password" name="password" id="password" autocomplete="off" placeholder="Mật khẩu">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </div>
            <div class="buttons">
                <input type="submit" name="submitBtn" id="submitBtn" value="Đăng nhập">
                <button id="clear">Clear</button>
            </div>
            <div class="link">
                <p>Chưa có tài khoản? Hãy <a href="dangki.php">đăng kí</a> ngay!</p>
            </div>
        </form>
    </div>
    <script>
        const submitBtn = document.getElementById("submitBtn");
        const form = document.getElementById("formID");
        const errorText = document.getElementById("error");

        submitBtn.addEventListener("click", function(e) {

            e.preventDefault();

            submitBtn.disabled = true; // disable submit btn so the user can't spam

            const username = document.getElementById("username");
            const password = document.getElementById("password");

            // collect data
            const data = {};
            data.username = username.value;
            data.password = password.value;

            //console.log(JSON.stringify(data));

            send_data(data, 'dangnhap');
    
        });

        function send_data(data, type) {
            let xml = new XMLHttpRequest();

            xml.addEventListener("load", function() {
                if (xml.readyState == 4 || xml.status == 200) { // everything good
                    let message = xml.responseText;
                    if (message == "yes") {
                        alert("Đăng nhập thành công!");
                        // chuyển hướng qua trang khác
                        location.href = "chat.php";
                    } else {
                        //alert("not equal");
                        errorText.textContent = message;
                        errorText.style.display = "block";
                    }
                    submitBtn.disabled = false; // after done sending the data, enable the button
                }

            });

            // send data
            data.type_of_data = type;
            let data_string = JSON.stringify(data); // cannot send object so turn the obj to string
            xml.open("POST", "backend/handle_data.php", true);
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