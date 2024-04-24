
// $(document).ready(
//     document.getElementById('edit-profile-button').addEventListener('click',loadText
//         //editform load the data  with the post method and the callback funtion using ajax   load(editprofile.php),{commentnewcount:commentnewcount}//name for the post method
//     );
// );
// function loadText() {
//     // console.log("button clicked");
//     var email = document.getElementById('userEmail').value;
//     findUserByEmail(email);
//     //creaet xhr object
//     var xhr = new XMLHttpRequest();
//     xhr.open('POST', '<?php echo URLROOT ?> /recruiters/editprofile.php', true);
//     xhr.onload = function() {
//                 if (xhr.status === 200) {
//                     // Request was successful
//                     //console.log
//                     var response = JSON.parse(xhr.responseText);
//                     //console.log(response)
//                     if (response.exists) {
//                         alert('User with email ' + email + ' exists');
//                     } else {
//                         alert('User with email ' + email + ' does not exist');
//                     }
//                     document.getElementById('editform')
//                 } else {
//                     // Error handling
//                     alert('Error');
//                 }
//             }
//                 xhr.send();


// }
// // function findUserByEmail(email) {
// //     // Create a new XMLHttpRequest object
// //     var xhr = new XMLHttpRequest();

// //     // Configure it: POST-request for the URL
// //     xhr.open('POST', 'find_user.php', true);
// //     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

// //     // Send the request
// //     xhr.send('email=' + encodeURIComponent(email));

// //     // Callback function
// //     xhr.onload = function() {
// //         if (xhr.status === 200) {
// //             // Request was successful
// //             var response = JSON.parse(xhr.responseText);
// //             if (response.exists) {
// //                 alert('User with email ' + email + ' exists');
// //             } else {
// //                 alert('User with email ' + email + ' does not exist');
// //             }
// //         } else {
// //             // Error handling
// //             alert('Error finding user');
// //         }
// //     };
// // }

// // // // Example usage
// // // var email = 'example@example.com';
// // // findUserByEmail(email);


// function yeh(){
//     document.getElementById("btn").addEventListener('click',function(){
//         ('GET', 'text.txt', true,function(data,status));
//         //insert the data in the para 
//         getElementById("getmethod").html(data)
//         alert(status)

//     });

//     function(woahh)=>{
//         input.keyup(function(
//             name= $("input").val()
//             ('POST','editedprofile.php',)
//             getElementById('inputtest').
//         ))

//         function(){
//             document.getElementById("submit").addEventListener('click',get){
//                 document.getElementById("form").addEventListener.preventdefault;
//                 var name=document.getElementById("mail-name").value()
//                 var email=document.getElementById("mail-name").value()
//                 var username=document.getElementById("username-name").value()
//                 .form-Message.load(editedprofile.php,{
//                     name:name,

//                 })

//             }
//         }
//     }

var xhr = new XMLHttpRequest();
const rsp = document.getElementById('success-message');
xhr.onload = function(){
    if (this.status===200){
        container.innerHTML = xhr.responseText;
    }
    else{
        console.log("error");
    }
};

xhr.open('get',);
xhr.send();