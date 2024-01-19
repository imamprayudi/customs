
const $ = require("jquery");
const axios = require("axios");
// const cors = require("cors");

let domain = "http://svr1.jkei.jvckenwood.com";
const path = "/custom_backend";
let host = $(location).attr("origin");

if (host.indexOf("localhost")) {
  domain = "http://136.198.117.118";
}
var url = domain + path;
// function toggleLoadingLogin() {
//     $('div.loading').toggleClass('d-none');
// }

function renderMessage(obj = { html: null, classes: "", icons: null }) {
  let htmo =
    '<div class="alert ' +
    obj.classes +
    ' alert-dismissible fade show" role="alert">' +
    '<i class="' +
    obj.icons +
    '"></i> ' +
    obj.html +
    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
    "</div>";

  $("div.message").html(htmo);
  console.log("Message Rendering", obj.html);
  return;
}

$(function () {
    console.log("session start", sessionStorage);
    // var corsAttr = new EnableCorsAttribute("*","*","*");
    // config.Enable

    // cors({
    //   origin: "*",
    //   credentials: true
    // });

    $("div.message").html(null);
    if ($("div.loading").hasClass("d-none") == false)
        $("div.loading").addClass("d-none");
    $("#btn_login").attr("disabled", false);
    $("#userid").focus();

  // warning ==> <i class="fa-solid fa-triangle-exclamation"></i>
  // danger ==> <i class="fa-solid fa-ban"></i>
  // success ==> <i class="fa-solid fa-check"></i>

  // login verification
  $("form[name=loginForm]").submit((e) => {
    e.preventDefault();
    $("#btn_login").attr("disabled", true);
    $("div.loading").toggleClass("d-none");
    $("div.message").html(null);
    // toggleLoadingLogin();

    axios
      .post(url + "/response/cek_login.php", {
            userid: $("[name=userid]").val(),
            password: $("[name=password]").val()
        }
        ,{
            headers:{
                'Content-Type':'multipart/form-data'
            }
        }
    )
      .then((res) => {
        console.log("response",res);
        console.log("session", sessionStorage);
      })
      .then((res) => {
        console.log("info", res);
        // toggleLoadingLogin()
        if (res.success == false) {
          renderMessage({
            html: res.message,
            classes: "alert-warning",
            icons: "fa-solid fa-triangle-exclamation"
          });
          return;
        }
        if (res.success == true) {
          const hostname = window.location.hostname;
          // console.log("hostname", window.location.hostname)
          // console.log("path", window.location.pathname)
          window.location.href = "../contents_v2/";
        }
      })
      .catch((error) => {
        console.log({ error });
        let res = error.response;
        let data = res.data;
        let msg = data.message;

        msg = msg || "Something went wrong";

        renderMessage({
          html: msg,
          classes: "alert-danger",
          icons: "fa-solid fa-ban"
        });

        // $('#password').val('');
        // $('#userid').val('');
        $("#userid").focus();
        $("div.loading").addClass("d-none");
        $("#btn_login").attr("disabled", false);
        // toggleLoadingLogin();
      })
      .finally(() => {
        // hide loading
        $("div.loading").addClass("d-none");
        // activate button
        $("#btn_login").attr("disabled", false);

        // toggleLoadingLogin()
      });

    return;
    $.post(
      "jvalidasi.php",
      {
        userid: $("[name=userid]").val(),
        password: $("[name=password]").val()
      },
      function (data) {
        if (data.success) {
          $("#error").html(data.message).fadeIn(1000);
          //document.getElementById("cek").innerHTML = "Login oke";
          window.location.href = "jmenu.php";
        } else {
          $("#error").html(data.message).fadeIn(1000);
          // alert("access denied");
        }
      },
      "json"
    );
    return false;
  });
});

// $("#btn_login").click(function(){
//     var parameters;
//     $("form#login_form :input").each(function(){
//         this.parameters = $(this);
//     })

//     console.log("form input", parameters)
// });
