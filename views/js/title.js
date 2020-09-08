import { Member } from "../js/models/member.js";
$(window).ready(() => {
    $.ajax({
        type: "GET",
        url: "/PID_Assignment/member/getSessionUserName"
    }).then(function (e) {
        $("#userName").html(`<a href="/PID_Assignment/views/pageFront/updateMemberData.html">${e}</a>`);
        if (e) {
            $("#textLogin").text("登出");
            $("#textregistered").html("");
        }

    });
});