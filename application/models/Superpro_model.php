<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Superpro_model extends CI_model {
    #-----------------------------------------------
    #   Superpro API: Create call room.
    #	Returns Video call link.
    #-----------------------------------------------
    function createVideoCallRoom($doctor_name, $doctor_email, $patient_name, $patient_email) {
        $curl_session = curl_init();
        curl_setopt_array($curl_session, array(
            CURLOPT_URL => getenv('SUPERPRO_CREATE_VIDEOCALL_API_ENDPOINT'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "usersAdd":[
                {
                    "name":"'.$doctor_name.'",
                    "email":"'.trim($doctor_email).'",
                    "role":"host"
                },
                {
                    "name":"'.$patient_name.'",
                    "email":"'.trim($patient_email).'",
                    "role":"aud"
                },
                {
                    "name":"assistant",
                    "email":"support@telehealers.in",
                    "role":"cohost"
                }
            ]
        }
        ',
            CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.getenv('SUPERPRO_AUTH_TOKEN'),
            'Content-Type: application/json'
            ),
        ));
        $superpro_response = curl_exec($curl_session);

        if (!$superpro_response) {
            log_message('error',$superpro_response);
            show_404();
        }

        curl_close($curl_session);
        $superpro_data = json_decode($superpro_response);

        if (isset($superpro_data->message)) {
            log_message('error', $superpro_data->message);
            show_404();
        }
        return $superpro_data->videoCallUrl ;
    }
    #-----------------------------------------------
    #   Input: Client & Dr. Details in HTML in <p>...</p> format.
    #	Returns: Email msg for a video-call.
    #-----------------------------------------------
    public function createVideoCallInformationMail($participantInfoHTML) {
        return '<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
            <center style="width: 100%; background-color: #f1f1f1;">
                <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
                    &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                </div>
                <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                    <!-- BEGIN BODY -->
                    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                        <tbody><tr>
                            <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <td class="logo" style="text-align: left;">
                                            <h1>
                                                <a href="http://telehealers.in/">
                                                <img src="http://telehealers.in/assets/uploads/images/telehe2.png">
                                                </a>
                                            </h1>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                        <tr>
                            </tr></tbody></table><table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody><tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                                    <td valign="middle" width="100%" style="text-align:left; padding: 0 2.5em;">
                                        <div class="product-entry">
                                            <div class="text">
                                                '.$participantInfoHTML.'
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody></table>


                    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                        <tbody><tr>
                            <td class="bg_white" style="text-align: center;">
                                <p>Receive these email? You can <a href="#" style="color: rgba(0,0,0,.8);">Unsubscribe here</a></p>
                            </td>
                        </tr>
                    </tbody></table>
                </div>
            </center>
        </body></html>' ;
    }


}    