<?php
    class Smsgateway
    {
        /** Functions to send sms */
        public function sms_appointment_confirmation($phone_no, $meeting_url, $booked_time) {
            $sms_message = $this->msg_appointment_booked_rightnow(
                $meeting_url, 
                $booked_time);
            return $this->send_sms($phone_no, $sms_message, "TLHLRS");
        }

        public function sms_otp($phone_no, $otp) {
            return $this->send_sms($phone_no, $this->msg_otp($otp), "LOADIT");
        }

        public function sms_successful_registration_to_patient($phone_no) {
            return $this->send_sms($phone_no, $this->msg_patient_registration_successful(), "TLHLRS");
        }
        
        public function sms_prescription_alert($phone_no) {
            return $this->smsgateway->send_sms($phone_no, 
               $this->msg_prescription_alert(), "TLHLRS");
        }

        /** A function to alert doctor that patient had shard his documents */
        public function sms_alert_doctor_about_patient_documents($doctor_phone, $patient_id) {
            $this->send_sms($doctor_phone,
					$this->msg_patient_shared_document($patient_id), "TLHLRS");
        }

        public function sms_successful_registration_to_doctor($phone_no) {
			return $this->send_sms($phone_no, $this->smsgateway->msg_doctor_registration_successful(), "TLHLRS");
        }
        /** A function to send sms to phone_no using curl 
         * return : if fails return true else return true
         * Use sms template function (msg*) to create sms_text.
         * send_param belongs to {TLHLRS, LOADIT}
        */
        private function send_sms($phone_no, $sms_text, $send_param) {
            $api_url = "http://japi.instaalerts.zone/httpapi/QueryStringReceiver?ver=1.0&key=pjjXNjf8In8sb8BdmFYVgw==&encrypt=0&dest=".
                $phone_no."&send=".$send_param."&text=".$sms_text;
            $curl_session = curl_init();
            curl_setopt($curl_session, CURLOPT_URL, $api_url);
            curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl_session, CURLOPT_HEADER, true);
            $sms_api_response = curl_exec($curl_session);
            if (!$sms_api_response) {
                log_message("error", "OTP failed phone:".$phone_no.", message:".$sms_text);
                return false;
            }
            curl_close($curl_session);
            return true;
        }
        /** Message for doctors that patient has shared documents */
        private function msg_patient_shared_document($patient_id) {
            return 'Patient+'.$patient_id.'+shared+reports.+Check+them+on+your+dashboard.';
        }
        /** Message for patient that prescription has been made */
        private function msg_prescription_alert() {
            return 'Prescription+sent+to+email.+Click+https://$_SERVER[HTTPS_HOST]'; 
        }
        /** Successful doctor registration msg */
        private function msg_doctor_registration_successful() {
            return 'Successfully+registered+on+telehealers+with+this+number.+Use+discord+or+known+member+for+queries.+-+Telehealers';
        }
        /** Successful patient registeration msg */
        private function msg_patient_registration_successful() {
            return 'Successfully+registered+on+telehealers+with+this+number.+Helpline+9071123400+call+whatsapp.';
        }
        /** Function to create appointment string msg */
        private function msg_appointment_booked_rightnow($meeting_url, $booked_time) {
            return 'Appointment+scheduled+right+now+link:+'.$meeting_url.'+'.$booked_time.'+Telehealers.' ;
        }

        /** Function for otp messages */
        private function msg_otp($otp) {
            return "OTP%20IS%20-%20".$otp ;
        }
        private function _do_api_call($url)
        {
            $result = file($url);      
            return $result;
        }
        #---------------------------------------



        private $operator = array('11','12','13','14','15','16','17','18','19'); 

        public function validMobile($mobile = null)
        {    
           $mobile = trim($mobile); 
            if ($this->checkValidMobileOperator($mobile) != false) { 
                $countryCode = substr($mobile, 0, 2);
                if (in_array($countryCode, $this->operator)) {
                    $newMobileNo = substr_replace($mobile,"880",0,0);
                } elseif ($countryCode == "01") {
                    $newMobileNo = substr_replace($mobile,"88",0,0);
                } elseif ($countryCode == "80") {
                    $newMobileNo = substr_replace($mobile,"8",0,0);
                } elseif ($countryCode == "+8") {
                    $newMobileNo = substr_replace($mobile,"",0,1);
                } else {
                    $newMobileNo = $mobile;
                } 
                return $newMobileNo; 
            }
        }


        protected function checkValidMobileOperator($mobile = null)
        {
            if(10 <= strlen($mobile) && strlen($mobile) <= 15){

                if(strlen($mobile) == 10){ /*for 10 digits*/
                    return in_array(substr($mobile,0,2), $this->operator);
                } elseif (strlen($mobile) == 11) { /*for 11 digits*/
                    return in_array(substr($mobile,1,2), $this->operator);
                } elseif (strlen($mobile) == 12) { /*for 12 digits*/ 
                    return in_array(substr($mobile,2,2), $this->operator);
                } elseif(strlen($mobile) == 13){ /*for 13 digits*/  
                    return in_array(substr($mobile,3,2), $this->operator);
                } elseif(strlen($mobile) == 14){ /*for 14 digits*/ 
                    return in_array(substr($mobile,4,2), $this->operator);
                } elseif(strlen($mobile) == 15){ /*for 15 digits*/
                    return in_array(substr($mobile,5,2), $this->operator);
                }

            } else {
                return false;
            }
        } 


        public function template($config = null)
        {
            $newStr = $config['message'];
            foreach ($config as $key => $value) {
                $newStr = str_replace("%$key%", $value, $newStr);
            } 
            return $newStr; 
        }

    } 
