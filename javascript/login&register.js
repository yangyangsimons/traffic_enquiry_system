function $(selector){
  return document.querySelector(selector);
}
function $$(){
  return document.querySelectorAll(selector);
}

// get username and password from login form;

// use ajax to send a psot request to the login.php server;
var loginForm = $("#login");
loginForm.addEventListener('submit',function(e){
  // prevent default refresh;
  e.preventDefault();
  let username = $("#login input[name=username]").value;
  let password = $("#login input[name=password]").value;
  console.log(username);
  console.log(password);
  // set and send post request;
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST","./server/login.php");
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  console.log("xmlhttp create sucessful");
  xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
      let responseObject = JSON.parse(xmlhttp.responseText);
      if(responseObject.backSuccessful == 1){
        $(".model-login .error-content").innerText = `welcome: ${username}`;
        console.log(window.location.pathname);
        setTimeout(window.location.assign(`./query.php?${username}`),2000);
      }
      if(responseObject.backError == 1){
        $(".model-login .error-content").innerText = `login failed, please use the correct username and password`;
      }
      console.log(responseObject);
    }
  }

  xmlhttp.send(`username=${username}&password=${password}&change=0`);
})
