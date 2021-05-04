<?php

require_once 'config.php';


class Zoom_Api
{


    protected function sendRequest($data)
    {
        $request_url = "https://api.zoom.us/v2/users//meetings";




        $postFields =  '{
        "topic": "New Meeting",
        "type": 2,
        "start_time": "2020-08-09T12:00:00Z",
        "duration": 45,
        "timezone": "America/Anchorage",
        "password": "1234",
        "agenda": "Zoom WordPress",
        "tracking_fields": [
          {
            "field": "string",
            "value": "string"
          }
        ],
        "settings": {
          "host_video": true,
          "participant_video": true,
          "cn_meeting": false,
          "in_meeting": false,
          "join_before_host": false,
          "mute_upon_entry": true,
          "watermark": false,
          "use_pmi": false,
          "approval_type": 0,
          "registration_type": 1,
          "audio":"voip", 
          "enforce_login": false,
          "enforce_login_domains": "",
          "alternative_hosts": "",
          "registrants_email_notification": false
        }
      }';



        $ch = curl_init();





        curl_setopt_array($ch, array(
            CURLOPT_URL => $request_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer",
                "content-type: application/json",
                "Accept: application/json",
            ),
        ));


        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if (!$response) {
            return $err;
        }
        return json_decode($response);
    }

    public function createAMeeting($data = array())
    {
        $post_time  = $data['start_date'];
        $start_time = gmdate("Y-m-d\TH:i:s", strtotime($post_time));
        $createAMeetingArray = array();
        if (!empty($data['alternative_host_ids'])) {
            if (count($data['alternative_host_ids']) > 1) {
                $alternative_host_ids = implode(",", $data['alternative_host_ids']);
            } else {
                $alternative_host_ids = $data['alternative_host_ids'][0];
            }
        }
        $createAMeetingArray['topic']      = $data['topic'];
        $createAMeetingArray['agenda']     = !empty($data['agenda']) ? $data['agenda'] : "";
        $createAMeetingArray['type']       = !empty($data['type']) ? $data['type'] : 2; //Scheduled
        $createAMeetingArray['start_time'] = $start_time;
        $createAMeetingArray['timezone']   = 'PST';
        $createAMeetingArray['password']   = !empty($data['password']) ? $data['password'] : "";
        $createAMeetingArray['duration']   = !empty($data['duration']) ? $data['duration'] : 60;
        $createAMeetingArray['settings']   = array(
            'join_before_host'  => !empty($data['join_before_host']) ? true : false,
            'host_video'        => !empty($data['option_host_video']) ? true : false,
            'participant_video' => !empty($data['option_participants_video']) ? true : false,
            'mute_upon_entry'   => !empty($data['option_mute_participants']) ? true : false,
            'enforce_login'     => !empty($data['option_enforce_login']) ? true : false,
            'auto_recording'    => !empty($data['option_auto_recording']) ? $data['option_auto_recording'] : "none",
            'alternative_hosts' => isset($alternative_host_ids) ? $alternative_host_ids : ""
        );
        return $this->sendRequest($createAMeetingArray);
    }
}


$zoom_meeting = new Zoom_Api();
try {

    $z = $zoom_meeting->createAMeeting(
        array(
            'start_date' => date("Y-m-d h:i:s", strtotime('tomorrow')),
            'topic' => 'Example Test Meeting'
        )
    );
    echo json_encode($z);
} catch (Exception $ex) {
    echo $ex;
}