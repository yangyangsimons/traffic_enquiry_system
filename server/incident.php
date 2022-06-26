<?php
header("Content-Type: application/json; charset=utf8");
$conn = require('connection.php');
if( $_SERVER['REQUEST_METHOD'] === 'GET'){
//    get all people_ID from database;
    $sqlPeople = "SELECT People_ID FROM People;";
    $peopleResult = mysqli_query($conn,$sqlPeople);
    $arrPeople = [];
    while($people = mysqli_fetch_array($peopleResult)){
        array_push($arrPeople,"<option>$people[0]</option>");
    }
    array_push($arrPeople,"<option>People_ID</option>");

//    get all vehicle_ID from database;
    $sqlVehicle = "SELECT Vehicle_ID FROM Vehicle";
    $vehicleResult = mysqli_query($conn,$sqlVehicle);
    $arrVehicle = [];
    while($vehicle = mysqli_fetch_array($vehicleResult)){
        array_push($arrVehicle,"<option>$vehicle[0]</option>");
    }
    array_push($arrVehicle,"<option>Vehicle ID</option>");

//    get all offence_ID from database
    $sqlOffence = "SELECT Offence_ID FROM Offence";
    $offenceResult = mysqli_query($conn,$sqlOffence);
    $arrOffence = [];
    while($offence = mysqli_fetch_array($offenceResult)){
        array_push($arrOffence,"<option>$offence[0]</option>");
    }
    array_push($arrOffence,"<option> Offence ID </option>");
    class Response{
       public $people_ID = "";
       public $vehicle_ID = "";
       public $offence_ID = "";
    }
    $responseContent = new Response();
    $responseContent ->people_ID = $arrPeople;
    $responseContent ->vehicle_ID = $arrVehicle;
    $responseContent ->offence_ID = $arrOffence;
    echo json_encode($responseContent);

}
if($_SERVER['REQUEST_METHOD'] == 'POST' && !$_POST["createIncident"]){
    $queryIncidentID = $_POST["incidentID"];
    $sqlIncident = "SELECT * FROM Incident WHERE Incident_ID = '$queryIncidentID'";
    $incidentResult = mysqli_query($conn,$sqlIncident);
    $incident = mysqli_fetch_array($incidentResult);
    $incidentNum = mysqli_num_rows($incidentResult);
    if($incident){
        echo "<h3> Incident information, Incident Number: $incidentNum </h3>>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Incident_ID</th>><th>Vehicle_ID</th>><th>People_ID</th><th>Incident_Data</th><th>incident_Report</th><th>Offence_ID</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>$incident[0]</td>><td>$incident[1]</td><td>$incident[2]</td><td>$incident[3]</td><td>$incident[4]</td><td>$incident[5]</td>";
        echo "</tr>";
    }else{
        echo "this incident ID not exist in the database" . "<br>" . "Create an Incident in the system" ;
    }
}else if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["createIncident"]){
    $incidentVehicleID = $_POST["createIncidentVehicleID"];
    $incidentPeopleID = $_POST["createIncidentPeopleID"];
    $incidentDate = $_POST["createIncidentDate"];
    $incidentReport = $_POST["createIncidentStatement"];
    $incidentOffenceID = $_POST["createIncidentOffenceID"];
    $sqlCreateIncident = "INSERT INTO Incident(Vehicle_ID,People_ID,Incident_Date,Incident_Report,Offence_ID)VALUES('$incidentVehicleID','$incidentPeopleID','$incidentDate','$incidentReport','$incidentOffenceID')";
    $createIncidentResult = mysqli_query($conn,$sqlCreateIncident);
    $sqlcreateIncidentID = "SELECT Incident_ID FROM Incident WHERE (Incident_Report = '$incidentReport' AND Vehicle_ID = '$incidentVehicleID') AND Offence_ID = $incidentOffenceID";
    $resultCreateIncidentID = mysqli_query($conn,$sqlcreateIncidentID);
    $CreateIncidentIDRow = mysqli_num_rows($resultCreateIncidentID);
    if($CreateIncidentIDRow){
        $NewIncidentIDArray = mysqli_fetch_array($resultCreateIncidentID);
        $NewIncidentID = $NewIncidentIDArray[0];
        echo "create successful, the new Incident ID is ".$NewIncidentID;
    }else{
        echo "Error: " . $sqlCreateIncident . "<br>" . $conn->error;
    }
}

mysqli_close($conn);