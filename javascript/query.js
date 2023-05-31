// create two shortcut function for element selection;
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
          reject(xhr.onerror);
        }
      }
    }
  })
}

// show the username in the welcome page.
let pageHref = window.location.search;
let loginUser = pageHref.split("?")[1];
// login user is a officer or administrator
var createOfficerButton = $("button.createOfficer");
var signupForm = $("form[name=signup]");
if (loginUser == "Daniels") {
  //user is administrator, replace the welcome words
  $("header.clear-float h1.verifiedUser").innerText = `Administrator: ${loginUser}`;
  // show the create officer button
  createOfficerButton.classList.add("active");
  createOfficerButton.classList.remove("hidden");
  //click the create button show the create Officer form;
  createOfficerButton.addEventListener("click", e => {
    if (signupForm.classList.contains("hidden")) {

      signupForm.classList.remove("hidden");
      signupForm.classList.add("active");
    } else if (signupForm.classList.contains("active")) {
      signupForm.classList.add("hidden");
      signupForm.classList.remove("active");
    }
  })
} else {
  createOfficerButton.addEventListener("click", e => {
    $("span.errorTips").innerText = "You are not able to create Officer, only Administrator can";
  })
  $("header.clear-float h1.verifiedUser").innerText = `Officer: ${loginUser}`;
}
// create new Officer
signupForm.addEventListener('submit', function (e) {
  // prevent default refresh;
  e.preventDefault();
  const signupUsername = $("form[name=signup] input[name=username]").value;
  const signupPassword = $("form[name=signup] input[name=password]").value;
  const cnpassword = $("form[name=signup] input[name=cnpassword]").value;
  // console.log(signupUsername);
  // console.log(signupPassword);
  // console.log(cnpassword);
  if (signupPassword == cnpassword) {
    // send request to server and render page;
    const userInfo = `username=${signupUsername}&cnpassword=${cnpassword}`
    ajaxFn("POST", "./server/signup.php", userInfo)
      .then(value => {
        $("span.errorTips").innerText = value;
        setTimeout(() => { window.location.reload() }, 1000);
      }, reason => {
        $("span.errorTips").innerText = reason;
      })
  }
})

// change password click the change password button then the form will display
let changeButton = $("button.changePassword");
let formChangePassword = $("form[name=changePassword]");
changeButton.addEventListener("click", e => {
  if (formChangePassword.classList.contains("hidden")) {

    formChangePassword.classList.remove("hidden");
    formChangePassword.classList.add("active");
  } else if (formChangePassword.classList.contains("active")) {
    formChangePassword.classList.add("hidden");
    formChangePassword.classList.remove("active");
  }

})
// set the username unchangeable
changepasswordUser.value = loginUser;

formChangePassword.addEventListener("submit", e => {
  e.preventDefault();
  let changepassword_User = changepasswordUser.value;
  let changepassword_oldPassword = $("input[name=oldpassword]").value;
  let changepassword_newPassword = $("input[name=newpassword]").value;
  let changepassword_cnnewPassword = $("input[name=confirmnewpassword]").value;
  if (!(changepassword_newPassword == changepassword_cnnewPassword)) {
    $("span.errorTips").innerText = "two new password not same";
  } else {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "./server/login.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        $("span.errorTips").innerText = xmlhttp.responseText;
        setTimeout(() => { window.location.reload() }, 5000);
      }
    }
    xmlhttp.send(`change=1&changeUser=${changepassword_User}&changeOldpassword=${changepassword_oldPassword}&changeNewpassword=${changepassword_cnnewPassword}`);
  }
})


// query the incident and list the incident information;
let divListIncident = $("div.listIncident");
let queryIncidentForm = $("form[name=findIncident]");
queryIncidentForm.addEventListener("submit", e => {
  e.preventDefault();
  let queryIncidentID = $("form[name=findIncident] input[name=incidentID]").value;
  if (queryIncidentID) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "./server/incident.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        divListIncident.innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.send(`createIncident=0&incidentID=${queryIncidentID}`);
  }
})
// create new incident
// get the information from database;
let divIncident = $("div.incident");
divIncident.addEventListener("mouseenter", e => {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "./server/incident.php");
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      // show all the people ID in the select box;
      let peopleID = $("select[name=incidentPeopleID]");
      let peopleArray = JSON.parse(xmlhttp.responseText).people_ID;
      let peopleContent = "";
      for (let index = 0; index < peopleArray.length; index++) {
        peopleContent = peopleArray[index] + peopleContent;
      }
      peopleID.innerHTML = peopleContent;

      // show all the vehicle ID in the select box;
      let vehicleID = $("select[name=incidentVehicleID]");
      let vehicleArray = JSON.parse(xmlhttp.responseText).vehicle_ID;
      let vehicleContent = "";
      for (let index = 0; index < vehicleArray.length; index++) {
        vehicleContent = vehicleArray[index] + vehicleContent;
      }
      vehicleID.innerHTML = vehicleContent;

      // show all the vehicle ID in the select box;
      let offenceID = $("select[name=incidentOffenceID]");
      let offenceArray = JSON.parse(xmlhttp.responseText).offence_ID;
      let offenceContent = "";
      for (let index = 0; index < offenceArray.length; index++) {
        offenceContent = offenceArray[index] + offenceContent;
      }
      offenceID.innerHTML = offenceContent;
    }
  }
  xmlhttp.send();
})

// create incident 
let createIncidentForm = $("form[name=createIncident]");
createIncidentForm.addEventListener("submit", e => {
  e.preventDefault();
  let createIncidentVehicleID = $("select[name=incidentVehicleID]").value;
  let createIncidentPeopleID = $("select[name=incidentPeopleID]").value;
  let createIncidentOffenceID = $("select[name=incidentOffenceID]").value;
  let createIncidentStatement = $("input[name=incidentReport]").value;
  let createIncidentDate = $("input[name=incidentDate]").value;
  if (!(createIncidentPeopleID || createIncidentVehicleID || createIncidentOffenceID || createIncidentStatement || createIncidentDate)) {
    console.log("please fulfill all the table");
  } else {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "./server/incident.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        incidentCreateFeedback.innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.send(`createIncident=1&createIncidentVehicleID=${createIncidentVehicleID}&createIncidentPeopleID=${createIncidentPeopleID}&createIncidentOffenceID=${createIncidentOffenceID}&createIncidentDate=${createIncidentDate}&createIncidentStatement=${createIncidentStatement}`);
  }
})


// show createPeople form
let createPeopleForm = $("form[name=createPeople]");
let queryForm = $("form[name=findPeople]");
queryForm.addEventListener('submit', function (e) {
  // prevent default refresh;
  e.preventDefault();
  let name = $("form[name=findPeople] input[name=name]").value;
  let licenseNumber = $("form[name=findPeople] input[name=licenseNumber]").value;
  console.log(name);
  console.log(licenseNumber);
  // set and send post request;
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "./server/queryPeople.php");
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  console.log("xmlhttp create sucessful");
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      let table = document.createElement("table");
      table.className = "pelpleTable";
      table.innerHTML = xmlhttp.responseText;
      $("div.queryInfContainer").append(table);
    }
  }
  xmlhttp.send(`name=${name}&licenseNumber=${licenseNumber}`);
})

// queryVehicles;
let queryVehicles = $("form[name=findVehicles]");
queryVehicles.addEventListener('submit', function (e) {
  // prevent default refresh;
  e.preventDefault();
  let vehicleID = $("form[name=findVehicles] input[name=vehicelID]").value;
  console.log(vehicleID);
  // set and send post request;
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "./server/queryVehicles.php");
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  console.log("xmlhttp create sucessful");
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      let content = document.createElement("table");
      content.className = "contentTable";
      content.innerHTML = xmlhttp.responseText;
      $(".queryVehicles").append(content);
    }
  }
  xmlhttp.send(`vehicleID=${vehicleID}`);
})

// create people function
let warn = $("form[name=createPeople] .warmTips");
createPeopleForm.addEventListener('submit', function (e) {
  // prevent default refresh;
  e.preventDefault();
  let createName = $("form[name=createPeople] input[name=createName]").value;
  let createDOB = $("form[name=createPeople] input[name=createDOB]").value;
  let createAddress = $("form[name=createPeople] input[name=createAddress]").value;
  let createLicence = $("form[name=createPeople] input[name=createLicence]").value;

  // set and send post request;
  if (createName == null || createLicence == null) {
    warn.innerHTML = "Please fill the name and licence number";
  } else {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "./server/createPeople.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    console.log("xmlhttp create sucessful");
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        warn.innerText = xmlhttp.responseText;
      }
    }
    xmlhttp.send(`createName=${createName}&createDOB=${createDOB}&createAddress=${createAddress}&createLicence=${createLicence}`);
  }
})


// create vehicles
let createCarContainer = $(".createCarContainer");
let createCarForm = $("form[name=createCar]");
let warntips = $(".createCarContainer .warmTips");
console.log(warn);
// when fill the owener's ID it will automatically list the exist owner's;
// let labelOwner = $("label[for=createOwner]");
let ownerInfo = $("select.ownerInfo");
console.log(ownerInfo);
createCarContainer.addEventListener("mouseenter", e => {
  console.log(e);
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "./server/createCar.php");
  console.log("xmlhttp create sucessful");
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      ownerInfo.innerHTML = xmlhttp.responseText;
    }
  }
  xmlhttp.send();
})

createCarForm.addEventListener('submit', function (e) {
  // prevent default refresh;
  e.preventDefault();
  let createMake = $("form[name=createCar] input[name=createMake]").value;
  let createModel = $("form[name=createCar] input[name=createModel]").value;
  let createColour = $("form[name=createCar] input[name=createColour]").value;
  let createLicence = $("form[name=createCar] input[name=createLicence]").value;
  let ownerIndex = ownerInfo.selectedIndex;
  let createOwner = ownerInfo.options[ownerIndex].text;
  console.log(createOwner);
  // set and send post request;
  if (createLicence == null || createOwner == null) {
    warntips.innerHTML = "Please fill the Licence and Owner";
  } else {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "./server/createCar.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    console.log("xmlhttp create sucessful");
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        warntips.innerText = xmlhttp.responseText;
      }
    }
    xmlhttp.send(`createMake=${createMake}&createModel=${createModel}&createColour=${createColour}&createLicence=${createLicence}&createOwner=${createOwner}`);
  }
}) 
