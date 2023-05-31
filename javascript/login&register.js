function $(selector) {
  return document.querySelector(selector);
}
function $$() {
  return document.querySelectorAll(selector);
}


// create an ajaxFn function for send the ajax request it return a Promise object.
// method is the require method;
// url is the require url;
// info is the string using in XMLHttpRequest send() method;
function ajaxFn(method, url, info) {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open(method, url);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(info);
    xhr.onreadystatechange = () => {
      if (xhr.readyState === 4) {
        if (xhr.status >= 200 && xhr.status < 300) {
          resolve(xhr.responseText);
        } else {
          reject(error);
        }
      }
    }
  })
}


// use ajax to send a post request to the login.php server;
const loginForm = $("#login");
loginForm.addEventListener('submit', async function (e) {

  e.preventDefault();

  // get username and password from login form;
  const username = $("#login input[name=username]").value;
  const password = $("#login input[name=password]").value;
  const userInfo = `username=${username}&password=${password}&change=0`

  // send request and get response from server;
  let responseData = await ajaxFn('POST', './server/login.php', userInfo);

  // parse data and render page;
  let responseObject = JSON.parse(responseData);
  if (responseObject.backSuccessful == 1) {
    $(".model-login .error-content").innerText = `welcome: ${username}`;
    console.log(window.location.pathname);
    setTimeout(() => {
      window.location.assign(`./query.php?${username}`);
    }, 1000);
  }
  if (responseObject.backError == 1) {
    $(".model-login .error-content").innerText = `login failed, please use the correct username and password`;
  }
})


//   const userInfo = `username=${username}&password=${password}&change=0`
//   // set and send post request;
//   let responseData = await ajaxFn('POST', './server/login.php', userInfo);

//   let xhr = new XMLHttpRequest();
//   xmlhttp.open("POST", "./server/login.php");
//   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   console.log("xmlhttp create sucessful");
//   xmlhttp.onreadystatechange = function () {
//     if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//       let responseObject = JSON.parse(xmlhttp.responseText);
//       if (responseObject.backSuccessful == 1) {
//         $(".model-login .error-content").innerText = `welcome: ${username}`;
//         console.log(window.location.pathname);
//         setTimeout(window.location.assign(`./query.php?${username}`), 2000);
//       }
//       if (responseObject.backError == 1) {
//         $(".model-login .error-content").innerText = `login failed, please use the correct username and password`;
//       }
//       console.log(responseObject);
//     }
//   }
//   xmlhttp.send(`username=${username}&password=${password}&change=0`);
// })