// function to get content based on its type
// it also redirect user to login page if user have not logged in
function get_data(find_object, type) {
            
    let data = {};
    let xml = new XMLHttpRequest();

    xml.addEventListener("load", function() {
        if (xml.readyState == 4 || xml.status == 200) { // everything good
            if (testJSON(xml.responseText)) {
                let obj = JSON.parse(xml.responseText); // turns the json back to obj
                if (typeof(obj.isLoggedIn) != "undefined" && !obj.isLoggedIn) { // chat.php see the info from the api {user has NOT logged in}
                    location.href = "index.php"; // go to login page
                } else {
                    switch(obj.type_of_data) { // handle event based on different types
                        case "user_info":
                            let username = document.getElementById("username");
                            if (!obj.display_name) {
                                username.innerHTML = 'user#' + obj.userID;
                            } else {
                                username.innerHTML = obj.display_name;
                            }

                            let main_user_profile_img = document.getElementById("main_user_profile_img");
                            if (obj.img != "") {
                                main_user_profile_img.src = 'assets/uploads/' + obj.img;
                            }
                            break;

                        case "contacts":
                            let list_of_users = document.getElementById("list_of_users");
                            list_of_users.innerHTML = obj.data;
                            break;

                        // case "preview_messages":
                        //     let preview_messages = document.getElementById("preview_messages");
                        //     preview_messages.innerHTML = obj.data;
                        //     break;
                        
                        case "edit_user_profile":
                            let content = document.getElementById("content");
                            content.innerHTML = obj.data;
                            //alert(JSON.stringify(obj.data));
                            break;

                        case "user_profile":
                            let user_content = document.getElementById("user_content");
                            user_content.innerHTML = obj.data;
                            break;
                        
                        // case "contacts_chat":
                        //     let chat_preview_messages = document.getElementById("preview_messages");
                        //     chat_preview_messages.innerHTML = obj.data;
                        //     break;
                        
                        case "friend_info":
                            let preview_messages = document.getElementById("preview_messages");
                            preview_messages.innerHTML = obj.info;
                
                            let msg_holder = document.getElementById("msg_holder");
                            msg_holder.innerHTML = obj.messages;

                            let user_box = document.getElementById("user_box");
                            user_box.innerHTML = obj.info;
                            break;

                        case "send_message":
                            let msg_holder1 = document.getElementById("msg_holder");
                            msg_holder1.innerHTML = obj.messages;
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
    xml.open("POST", "backend/handle_data.php", true); // send to api
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