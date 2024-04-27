<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cài đặt hồ sơ cá nhân</title>
    <link rel="stylesheet" href="styles/settings.css">
</head>
<body>
    <h1>Tài khoản của tôi</h1>
    <div class="content" id="content" style="display: flex;">

    </div>
    <script src="js/get_data.js"></script>
    <script>
        get_data({}, "settings");
    </script>
</body>
</html>