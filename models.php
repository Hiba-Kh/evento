<?php
class Anything {
    var $id;       
    var $session_id;    
    var $event_id;
    var $desc;
    var $date_agenda;
    var $name;
    var $start;
    var $end;
    var $location;
    var $speakers;
    var $description;

}
class UserData {
    var $id;
    var $firstname;
    var $lastname;
    var $gender;
    var $address;
    var $email;
    var $job;
    var $type;
    var $events;
    var $attendedEvents;
    var $intrestedEvents;
    
    
}

class eventData
{
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
    var $start_date;
    var $end_end;
    var $no_speaker;
    var $no_tickets;
    var $description;
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

class userEvent {
    var $event_id;
    var $event_name;
    var $start_date;
    var $end_date;
    var $location_id;
    var $description;
    var $NoOfAttendee;
    var $NoOfInterested;
    var $agendas;
}    

class eventAgenda {
    var $agenda_id;
    var $agenda_date;
    var $start_time;
    var $end_time;
    var $sessions;
}


class agendaSessions {
    var $session_id;
    var $session_title;
    var $start_time;
    var $end_time;
    var $speakers;
}




?>