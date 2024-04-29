<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hồ sơ của tôi</h1>
    <div id="user_content">
        
    </div>
    <a href="edit_user_profile.php"><button>Edit</button></a>
    <a href="chat.php"><button>Quay về</button></a>
    <script src="js/get_data.js"></script>
    <script>
        get_data({}, "user_profile");
    </script>
</body>
</html>