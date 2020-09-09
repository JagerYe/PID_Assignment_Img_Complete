import { Employee } from "../js/models/employee.js";
$(window).ready(() => {
    $.ajax({
        type: "GET",
        url: "/PID_Assignment_Img_Complete/employee/getSessionEmpID"
    }).then(function (e) {
        $("#empID").text(e);
        if (e.length <= 0) {
            window.location.href = "/PID_Assignment_Img_Complete/views/pageBack/login.html";
        } else {
            $("#textLogin").text("登出");
        }
    });
});