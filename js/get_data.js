// function to get content based on its type
// it also redirect user to login page if user have not logged in
function get_data(find_object, type) {
            
    let data = {};
    let xml = new XMLHttpRequest();

    xml.addEventListener("load", function() {
        if (xml.readyState == 4 || xml.status == 200) { // everything good
            if (testJSON(xml.responseText)) {
                let obj = JSON.parse(xml.responseText);
                if (typeof(obj.isLoggedIn) != "undefined" && !obj.isLoggedIn) { // chat.php see the info from the api {user has NOT logged in}
                    location.href = "index.php"; // go to login page
                } else {
                    switch(obj.type_of_data) { // handle event based on different types
                        case "user_info":
                            let username = document.getElementById("username");
                            if (obj.display_name == null) {
                                username.innerHTML = 'user#' + obj.uniqueID;
                            } else {
                                username.innerHTML = obj.display_name;
                            }
                            break;

                        case "contacts":
                            let list_of_users = document.getElementById("list_of_users");
                            list_of_users.innerHTML = obj.data;
                            break;

                        case "preview_messages":
                            let preview_messages = document.getElementById("preview_messages");
                            preview_messages.innerHTML = obj.data;
                            break;
                        
                        case "edit_user_profile":
                            let content = document.getElementById("content");
                            content.innerHTML = obj.data;
                            break;

                        case "user_profile":
                            let user_content = document.getElementById("user_content");
                            user_content.innerHTML = obj.data;
                            break;
                        
                    }
                }
            } else {
                document.write(xml.responseText);  // return error message or smt
            }
        }
    });

    
    data.object_info = find_object; // is an obj in an obj
    data.type_of_data = type;
    // get data
    
    let data_string = JSON.stringify(data); // turns to string
    xml.open("POST", "api.php", true);
    xml.send(data_string);
}

function testJSON(text) {
    if (typeof text !== "string") {
        return false;
    }
    try {
        JSON.parse(text);
        return true;
    } catch (error) {
        return false;
    }
}