<!DOCTYPE html>
<html>
  <head>
    <meta charset = "utf-8">
    <title>traffic information</title>
    <link rel="stylesheet" href="./css/query.css">
  </head>
  <body>
    <header class = "clear-float">
      <h2>Welcome to the Police Traffic System </h2>
      <h1 class="verifiedUser"></h1>
      <button class="changePassword">Change Password</button>
      <label><span class="errorTips"></span></label>
      <form name="changePassword" class="hidden">
        <!-- <label><span class="errorTips"></span></label> -->
        <label><span>User Name</span><input type="text" id="changepasswordUser" readonly></label>
        <label><span>old password:</span><input type="password" name="oldpassword"></label>
        <label><span>new password:</span><input type="password" name="newpassword"></label>
        <label><span>new password again:</span><input type="password" name="confirmnewpassword"></label>
        <input type="submit" value="change password">
      </form>
      <button class="createOfficer hidden">Create Officer</button>
      <form name='signup' class="hidden">·
        <label>
          <span>Officer Name: </span><input type="text" name="username" placeholder = "User Name">
        </label>
        <label>
          <span>Password: </span><input type="password" name="password" placeholder = "Password">
        </label>
        <label>
          <span>Password Again</span><input type="password" name="cnpassword" placeholder = "Password Again">
        </label>
        <input type="submit" name="submit" value = "Create Officer">
      </form>
    </header>
    <main>
      <div class="incident">
        <h2>Incident Part
          <span>Incident information is list here</span>
        </h2>
        <div class="findIncident">
          <form name="findIncident">
            <label>
              <span>Incident ID: </span><input type="text" name="incidentID"> input example: 2
            </label>
            <input type="submit" value="Find Incident">
          </form>
        </div>
        <div class="listIncident">
          
          </div>
        <div class="createIncident">
          <h2>Create Incident
            <span id="incidentCreateFeedback">create feedback</span>
          </h2>
          <form name="createIncident">
            <label>
              <span>Incident Date: </span><input type="date" name="incidentDate" min="2000-01-01">
            </label>
            <label>
              <span>Incident Statement: </span><input type="text" name="incidentReport">
            </label>
            <label>
              <span>Vehicle ID: </span><select name="incidentVehicleID">
                <option>Vehicle ID</option>
              </select> ID automatically update, you can create a new one in Vehicle part if not exist.
            </label>
            <label>
              <span>People ID: </span><select name="incidentPeopleID" >
                <option>People ID</option>
              </select> ID automatically update, you can create a new one in People part if not exist.
            </label>
            <label>
              <span>Offence ID</span><select name="incidentOffenceID">
                <option>Offence ID</option>
              </select>
            </label>
            <input type="submit" value="create incident">
          </form>
        </div>

      </div>
<!-- below html is for find and create people part -->
      <div class="queryContent">
        <h2>People Part
          <span>Driver's information is list here</span>
        </h2>
        <form name="findPeople">
          <label >
            <span>Driver Name: </span><input type="text" name="name" placeholder="Name"> input example: Smith
          </label>
          <label >
            <span>Licence Number: </span><input type="text" name="licenseNumber" placeholder="License Number">
          </label>
          <input type="submit" value="Find People">
        </form>
        <div class="queryInfContainer">
          
        </div>
        
        <div class="createPeopleContainer">
          <h2>Create People
          </h2>
          <form action="" name="createPeople" class="hideCreatePeople">
            <p class="warmTips">create feedback:<p>
            <label for="">
              <span>People's Name</span><input type="text" name="createName" placeholder="Name">
            </label>
            <label for="">
              <span>People's Birthday</span><input type="Date" name="createDOB">
            </label>
            <label for="">
              <span>People's Address</span><input type="text" name="createAddress" placeholder="Address">
            </label>
            <label for="">
              <span>People's Licence</span><input type="text" name="createLicence" placeholder="Licence Number">
            </label>
            <input type="submit" value="Create People">
          </form>
        </div>
      </div>
<!-- below html is for Vehicle part include query and create vehicles in database -->
    <div class="vehiclePart">
      <h2>Vehicle Part
        <span>Vehicle's information is list here</span>
      </h2>
      <div class="queryVehicles">
        <form name="findVehicles">
          <label for="">
            <span>Vehicle ID: </span><input type="text" name="vehicelID" placeholder="vehicleID">
          </label>
          <input type="submit" value="Find Vehicles">
        </form>
      </div>
      <div class="createCarContainer">
        <p class="warmTips">create feedback:<p>
        <form action="" name="createCar" class="hideCreateCar">
          <label for="">
            <span>Vehicle Brand: </span><input type="text" name="createMake" placeholder="Make of car">
          </label>
          <label for="">
            <span>Vehicle Model: </span><input type="text" name="createModel" placeholder="Model of car">
          </label>
         <label for="">
          <span>Vehicle Colour: </span><input type="text" name="createColour" placeholder="Colour of car">
         </label>
          <label for="">
            <span>Vehicle Licence</span><input type="text" name="createLicence" placeholder="Licence Number">
          </label>
          <label for="">
            <span>Owner's ID</span><select class="ownerInfo">
              <option>select owner</option>
            </select>ID automatically update, you can create a new one in People part if not exist.
            </label>
          </label>
          <!-- <label for="createOwner">select or create owner</label> -->
          <input type="submit" value="Create">
        </form>
      </div>
    </div>
    </main>
    <footer>
    </footer>
    <script src="./javascript/query.js" ></script>
  </body>
</html>