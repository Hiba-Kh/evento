<?php

class UserData {
    var $id;
    var $firstname;
    var $lastname;
    var $gender;
    var $address;
    var $email;
    var $job;
    var $type;
    
    var $event_id;
    var $location;
    var $name_event;
    var $start;
    var $start_date;   
    var $end_date;
    var $end;
}

class AgendaData {
    var $id;
    var $event_id;
    var $name;
    var $start;
    var $end;
    var $session_location;
    var $speakers;
    var $location_id;
    var $location_name;
    var $location_address;
    var $location_lng;
    var $location_lat;
}

class AnalysisData {
    var $NoOfAttendee;
    var $NoOfInterested;
}



?>