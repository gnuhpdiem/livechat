<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="content">

    </div>
    <a href="changePass.php"><button>Đổi mật khẩu</button></a>
    <a href="main_user_profile.php"><button>Quay về</button></a>
    <script src="js/get_data.js"></script>
    <script>
        get_data({}, "edit_user_profile");
    </script>
    <script>
        
        function collect_data(e) {

            const submitBtn = document.getElementById("submitBtn");
            const form = document.getElementById("formID");
            const errorText = document.getElementById("error");

            e.preventDefault();

            submitBtn.disabled = true;

            const display_name = document.getElementById("display_name");
            const username = document.getElementById("username");
            const email = document.getElementById("email");

            // collect data
            const data = {};
            data.display_name = display_name.value;
            data.username = username.value;
            data.email = email.value;

            //console.log(JSON.stringify(data));

            send_data(data, "update_profile");
    
        };

        function send_data(data, type) {
            let xml = new XMLHttpRequest();

            xml.addEventListener("load", function() {
                if (xml.readyState == 4 || xml.status == 200) { // everything good
                    
                    let message = xml.responseText;
                    if (message == "yes") {
                        alert("Cập nhật thành công!");
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

    </script>
</body>
</html>