<?php

require "conn.php";

function GetUser($user_id, $conn) {

    $user = new UserData();
    
    $mysql_user_qry="SELECT * FROM users WHERE user_id='$user_id'";
    $result=mysqli_query($conn, $mysql_user_qry);
    
    if(!$result) 
    {
        die(mysqli_error($conn));
    }
    else 
    {
        if (mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_assoc($result);
            $user->firstname=$row["first_name"];
            $user->lastname=$row["last_name"];
            $user->email=$row["email"];
            $user->token=$row["token"];
            $user->id=$user_id;
             
            $mysql_meta_qry="SELECT * FROM meta_data WHERE user_id='$user->id'";
            $meta_result=mysqli_query($conn, $mysql_meta_qry);
            
            if(!$meta_result) 
            {
                die(mysqli_error($conn));
            }
            
            if (mysqli_num_rows($meta_result) == 1)
            {
                while($row2 = mysqli_fetch_assoc($meta_result)) 
                {
                    $user->gender=$row2["gender"];
                    $user->address=$row2["address"];
                    $user->job=$row2["job"];
                }
            }
        } 

        $user->myEvents = array();
        $user->attendedEvents = array();
        $user->intrestedEvents = array();
        $user ->upcomingEvents = array();
        
        return $user;
    }
}


function GetEvent($event_id, $conn) {

    $adminEvent = new userEvent();
    $mysql_qry3="SELECT * FROM my_event  WHERE event_id = ' $event_id' ";
    $adminEvent->event_id = $event_id;    
    $result3=mysqli_query($conn, $mysql_qry3);
    $row_event = mysqli_fetch_assoc($result3);
    $adminEvent->event_name = $row_event['event_name'];    
    $adminEvent->start_date = $row_event['start_date'];
    $adminEvent->end_date = $row_event['start_date'];
    $adminEvent->location_id = $row_event['location_id'];
    $adminEvent->isFree = $row_event['isFree'];
    
    $adminEvent->description = $row_event['description'];
    $adminEvent->NoOfAttendee = $row_event['NoOfAttendee'];
    $adminEvent->NoOfInterested = $row_event['NoOfInterested'];
    $adminEvent->agendas = array();
    $mysql_qry4="SELECT * FROM agenda  WHERE event_id = '$adminEvent->event_id'";
    $result4=mysqli_query($conn, $mysql_qry4);

    while ($row4 = mysqli_fetch_assoc($result4)) 
    {
        $eventAgenda = new eventAgenda();
        $eventAgenda->agenda_id = $row4['agenda_id'];
        $eventAgenda->agenda_date = $row4['agenda_date'];
        $eventAgenda->start_time = $row4['start_time'];
        $eventAgenda->end_time = $row4['agenda_date'];
        $eventAgenda->sessions = array();

        $mysql_qry5="SELECT * FROM sessions WHERE sessions.agenda_id = '$eventAgenda->agenda_id' ";
        $result5=mysqli_query($conn,$mysql_qry5);

        while ($row5= mysqli_fetch_assoc($result5)) 
        {
            $sessionsData = new agendaSessions();
            $sessionsData->event_id=$adminEvent->event_id;
            $sessionsData->session_id =$row5['session_id'];
            $sessionsData->session_title = $row5['title'];
            $sessionsData->start_time = $row5['start_time'];
            $sessionsData->end_time = $row5['end_time'];
            $sessionsData->speakers = array();

            $mysql_qry6="SELECT * FROM session_speaker WHERE session_id = $sessionsData->session_id ";
            $result6=mysqli_query($conn,$mysql_qry6);
            
            while ($row6= mysqli_fetch_assoc($result6)) 
            {
                $speaker_id=$row6['speaker_id'];
                $mysql_qry7="SELECT * FROM speaker WHERE speaker_id = $speaker_id";
                $result7=mysqli_query($conn,$mysql_qry7);
                $row7= mysqli_fetch_assoc($result7);
                $speaker = GetUser($row7['user_id'], $conn);
                array_push($sessionsData->speakers,$speaker);
            }
            array_push($eventAgenda->sessions,$sessionsData);
        }
        array_push($adminEvent->agendas,$eventAgenda);
    }

    return $adminEvent;
}




function GetInterestedEvent($user_id, $conn) {
    
        $interestedEvent = new userEvent();
        $mysql_qry10="SELECT * FROM interested WHERE user_id = '$user_id' ";
        $result10=mysqli_query($conn, $mysql_qry10);
        $row10 = mysqli_fetch_assoc($result10);
        $interested_id=$row10["interested_id"];
        $mysql_qry11="SELECT * FROM event_interested  WHERE interested_id = '$interested_id' ";
        $result11=mysqli_query($conn, $mysql_qry11);
        $row11 = mysqli_fetch_assoc($result11);
        $interestedEvent = GetEvent($row11['event_id'], $conn);
        return $interestedEvent;
        
    }
    

?>