SET sql_mode='';


CREATE TABLE IF NOT EXISTS `action_serial` (
`id` int(11) unsigned
,`appointment_id` varchar(250)
,`patient_id` varchar(250)
,`schedul_id` int(11)
,`date` date
,`sequence` varchar(100)
,`venue_id` int(11)
,`doctor_id` int(11)
,`problem` varchar(255)
,`get_date_time` datetime
,`get_by` int(11)
,`status` int(11)
,`day` int(11)
,`start_time` time
,`end_time` time
,`per_patient_time` int(11)
,`visibility` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `advice_prescriptiion`
--

CREATE TABLE IF NOT EXISTS `advice_prescriptiion` (
  `advice_prescription_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `advice_id` int(11) DEFAULT NULL,
  `prescription_id` int(11) NOT NULL,
  `appointment_id` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`advice_prescription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advice_prescriptiion`
--

INSERT INTO `advice_prescriptiion` (`advice_prescription_id`, `advice_id`, `prescription_id`, `appointment_id`, `status`) VALUES
(1, 11, 1, 'A20LQX30', 0),
(2, 41, 1, 'A20LQX30', 0),
(3, 10, 2, 'A20IY68', 0),
(4, 10, 3, 'A2087TS', 0),
(7, 10, 6, 'A20CQLL', 0),
(8, 10, 7, 'A207P78N', 0),
(9, 42, 7, 'A207P78N', 0),
(10, 44, 1, 'A20Z9TH', 0),
(11, 10, 1, 'A20Z9TH', 0),
(12, 45, 2, 'A20LG1G', 0),
(13, 10, 3, 'A20UK7Z', 0),
(14, 11, 3, 'A20UK7Z', 0),
(15, 10, 4, 'A20T58Q', 0),
(16, 10, 5, 'A20VRPQ', 0),
(17, 10, 5, 'A20VRPQ', 0),
(18, 47, 6, 'A208SHI', 0);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_tbl`
--

CREATE TABLE IF NOT EXISTS `appointment_tbl` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `appointment_id` varchar(250) NOT NULL,
  `patient_id` varchar(250) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `schedul_id` int(11) NOT NULL,
  `sequence` varchar(100) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `get_date_time` datetime NOT NULL,
  `get_by` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_setting`
--

CREATE TABLE IF NOT EXISTS `app_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_setting`
--

INSERT INTO `app_setting` (`id`, `language`) VALUES
(1, 'english');

-- --------------------------------------------------------

--
-- Table structure for table `blog_tbl`
--

CREATE TABLE IF NOT EXISTS `blog_tbl` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `details` text NOT NULL,
  `picture` varchar(1000) NOT NULL,
  `post_by` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `post_category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_tbl`
--

INSERT INTO `blog_tbl` (`id`, `title`, `details`, `picture`, `post_by`, `post_date`, `post_category`) VALUES
(5, 'Lorem ipsum dolor sit amet', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>', 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/blog/tabout.png', 1, '2016-10-08', 0),
(9, 'Demo bdtask Hospital Limited', '<p xss=removed>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><div><br></div>', 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/blog/blog.png', 1, '2017-05-02', 0),
(10, 'This is demo text Title', '<p xss=removed>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>', 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/blog/blog1.png', 1, '2017-05-02', 0),
(11, 'Letraset sheets containing Lorem Ipsum', '<span xss=removed>Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</span>', 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/blog/blog2.png', 1, '2020-06-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `custom_sms_info`
--

CREATE TABLE IF NOT EXISTS `custom_sms_info` (
  `custom_sms_id` int(11) NOT NULL AUTO_INCREMENT,
  `reciver` varchar(100) NOT NULL,
  `gateway` text NOT NULL,
  `message` text NOT NULL,
  `sms_date_time` datetime NOT NULL,
  PRIMARY KEY (`custom_sms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `custom_sms_info`
--

INSERT INTO `custom_sms_info` (`custom_sms_id`, `reciver`, `gateway`, `message`, `sms_date_time`) VALUES
(1, '01751194212', 'nexmo', '', '2020-06-16 11:55:41'),
(2, '01751194212', 'nexmo', '', '2020-06-16 11:55:52'),
(3, '01751194212', 'nexmo', '', '2020-06-16 11:57:42'),
(4, '01751194212', 'nexmo', '', '2020-06-16 11:59:52'),
(5, '01751194212', 'nexmo', '', '2020-06-16 12:00:04'),
(6, '01751194212', 'nexmo', '', '2020-06-16 12:01:07'),
(7, '01245789', 'nexmo', '[removed]alert&#40;\'aldskfa\'&#41;;[removed]', '2020-06-25 09:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_advice`
--

CREATE TABLE IF NOT EXISTS `doctor_advice` (
  `advice_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `create_by` int(11) NOT NULL,
  `advice_status` int(11) NOT NULL DEFAULT 1,
  `advice` varchar(100) NOT NULL,
  PRIMARY KEY (`advice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor_advice`
--

INSERT INTO `doctor_advice` (`advice_id`, `create_by`, `advice_status`, `advice`) VALUES
(10, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(11, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(12, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(13, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(14, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(15, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(18, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(40, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(41, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(42, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'),
(44, 1, 1, 'Donec venenatis arcu aliquam erat condimentum, ac cursus neque ultricies.'),
(45, 1, 1, 'fasdfasdfasdfsadf'),
(47, 1, 1, '[removed]alert&#40;\'aldskfa\'&#41;;[removed]');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_details`
--

CREATE TABLE IF NOT EXISTS `doctor_details` (
  `doctor_details_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `doctor_short_bio` text DEFAULT NULL,
  `doctor_details_bio` text DEFAULT NULL,
  `academic_info` text DEFAULT NULL,
  `work_experience` text DEFAULT NULL,
  PRIMARY KEY (`doctor_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_tbl`
--

CREATE TABLE IF NOT EXISTS `doctor_tbl` (
  `doctor_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_id` int(11) NOT NULL,
  `doctor_name` varchar(120) NOT NULL,
  `department` varchar(200) DEFAULT NULL,
  `designation` varchar(120) DEFAULT NULL,
  `degrees` text DEFAULT NULL,
  `specialist` varchar(250) DEFAULT NULL,
  `doctor_exp` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `blood_group` varchar(50) DEFAULT NULL,
  `doctor_phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `service_place` text DEFAULT NULL,
  `about_me` text DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `doctor_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE IF NOT EXISTS `email_config` (
  `email_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `at_appointment` int(11) NOT NULL,
  `at_registration` int(11) NOT NULL,
  `reminder` int(11) NOT NULL,
  `protocol` text NOT NULL,
  `mailpath` text NOT NULL,
  `mailtype` text NOT NULL,
  `sender` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`email_config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`email_config_id`, `at_appointment`, `at_registration`, `reminder`, `protocol`, `mailpath`, `mailtype`, `sender`, `status`) VALUES
(1, 1, 1, 1, 'sendmail', '/usr/sbin/sendmail', 'html', 'doctorss@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_delivery`
--

CREATE TABLE IF NOT EXISTS `email_delivery` (
  `email_delivery_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_ss_id` int(11) DEFAULT NULL,
  `reciver_email` varchar(120) NOT NULL,
  `delivery_date_time` datetime NOT NULL,
  `email_info_id` int(11) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  PRIMARY KEY (`email_delivery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_info`
--

CREATE TABLE IF NOT EXISTS `email_info` (
  `email_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(255) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_phone` varchar(111) NOT NULL,
  `patient_email` varchar(111) DEFAULT NULL,
  `appointment_date` datetime NOT NULL,
  `appointment_id` varchar(111) NOT NULL,
  `status` int(11) DEFAULT 0,
  `email_counter` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`email_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_schedule`
--

CREATE TABLE IF NOT EXISTS `email_schedule` (
  `email_ss_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_temp_id` int(11) NOT NULL,
  `email_ss_name` text NOT NULL,
  `email_schedule` varchar(100) NOT NULL,
  `email_ss_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`email_ss_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_schedule`
--

INSERT INTO `email_schedule` (`email_ss_id`, `email_temp_id`, `email_ss_name`, `email_schedule`, `email_ss_status`) VALUES
(2, 7, 'Schedule One', '2:0:0', 1),
(3, 7, 'Schedule Two', '1:2:3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE IF NOT EXISTS `email_template` (
  `email_temp_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_temp_name` text NOT NULL,
  `email_template` longtext NOT NULL,
  `email_temp_status` int(11) DEFAULT 1,
  `default_status` int(11) NOT NULL DEFAULT 0,
  `template_type` int(11) NOT NULL DEFAULT 0,
  `set_default` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`email_temp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`email_temp_id`, `email_temp_name`, `email_template`, `email_temp_status`, `default_status`, `template_type`, `set_default`) VALUES
(2, 'Template One', '                                                                          \r\n  \r\n  \r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\r\n   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Doctoress</title>\r\n\r\n    <style type=\"text/css\">\r\n\r\n\r\n     @media only screen and (max-width: 680px){\r\n        body{width:100% !important; min-width:100% !important;} \r\n        \r\n        table[id=\"emailBody\"],\r\n        table[class=\"flexibleContainer\"],\r\n       td[class=\"flexibleContainerCell\"] {width:100% !important;}\r\n        td[class=\"flexibleContainerBox\"], td[class=\"flexibleContainerBox\"] table {display: block;width: 100%;text-align: left;}\r\n       table[class=\"flexibleContainerBoxNext\"]{padding-top: 10px !important;}\r\n  \r\n      }\r\n   </style>\r\n\r\n\r\n  \r\n\r\n\r\n  \r\n\r\n    <center style=\"background-color:#E1E1E1;\">\r\n      <table id=\"bodyTable\" style=\"table-layout: fixed;max-width:100% !important;width: 100% !important;min-width: 100% !important;\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\" height=\"100%\">\r\n       <tbody><tr>\r\n         <td align=\"center\" valign=\"top\">\r\n\r\n\r\n            <table id=\"emailBody\" bgcolor=\"#FFFFFF\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"700\">\r\n\r\n             <tbody><tr>\r\n               <td align=\"center\" valign=\"top\">\r\n\r\n                  <table style=\"color:#FFFFFF;\" bgcolor=\"#3498db\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\r\n                    <tbody><tr>\r\n                     <td align=\"center\" valign=\"top\">\r\n\r\n                        <table class=\"flexibleContainer\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"700\">\r\n                          <tbody><tr>\r\n                           <td class=\"flexibleContainerCell\" align=\"center\" width=\"700\" valign=\"top\">\r\n\r\n                            \r\n                              <table cellspacing=\"0\" cellpadding=\"30\" border=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                 <td class=\"textContent\" align=\"center\" valign=\"top\">\r\n                                    <h1 style=\"color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;\">\r\n                                   Hi! %patient_name%</h1>\r\n                                   <h2 style=\"text-align:center;font-weight:normal;font-family:Helvetica,Arial,sans-serif;font-size:23px;margin-bottom:10px;color:#205478;line-height:135%;\">\r\n                                    Your Appointment Information</h2>\r\n                                 </td>\r\n                               </tr>\r\n                             </tbody></table>\r\n\r\n                            </td>\r\n                         </tr>\r\n                       </tbody></table>\r\n                        \r\n                      </td>\r\n                   </tr>\r\n                 </tbody></table>\r\n                </td>\r\n             </tr>\r\n\r\n\r\n             <tr>\r\n                <td align=\"center\" valign=\"top\">\r\n\r\n                  <table style=\"color:#FFFFFF;\" bgcolor=\"#3498db\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\r\n                    <tbody><tr>\r\n                     <td align=\"center\" valign=\"top\">\r\n\r\n                        <table class=\"flexibleContainer\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"700\">\r\n                          <tbody><tr>\r\n                           <td class=\"flexibleContainerCell\" align=\"center\" width=\"700\" valign=\"top\">\r\n\r\n                            \r\n                              <table cellspacing=\"0\" cellpadding=\"30\" border=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                 <td class=\"textContent\" align=\"center\" valign=\"top\">\r\n                                    <p style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#000;line-height:135%;\">\r\n                                      Thnks for your appointment request to %doctor_name% .\r\n                                     This is an automatic system generated email as with na\r\n                                      appointment.\r\n                                      Your appointment details as below...\r\n                                    </p>\r\n                                  </td>\r\n                               </tr>\r\n                             </tbody></table>\r\n\r\n                            </td>\r\n                         </tr>\r\n                       </tbody></table>\r\n                        \r\n                      </td>\r\n                   </tr>\r\n                 </tbody></table>\r\n                </td>\r\n             </tr>\r\n         \r\n              <tr>\r\n                <td align=\"center\" valign=\"top\">\r\n                  <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\r\n                   <tbody><tr>\r\n                     <td align=\"center\" valign=\"top\">\r\n                        <table class=\"flexibleContainer\" cellspacing=\"0\" cellpadding=\"30\" border=\"0\" width=\"700\">\r\n                         <tbody><tr>\r\n                           <td class=\"flexibleContainerCell\" width=\"700\" valign=\"top\">\r\n\r\n                             <table align=\"left\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                 <td class=\"flexibleContainerBox\" align=\"left\" valign=\"middle\">\r\n                                    <table class=\"flexibleContainerBoxNext\" style=\"max-width: 100%;\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"700\">\r\n                                      <tbody><tr>\r\n                                       <td style=\"margin-left: 1em;\">\r\n                                          <h3 style=\"color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;\">\r\n                                            Your name : %patient_name%</h3>\r\n                                         <div style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;\">\r\n                                            Your ID : %patient_id%, </div>\r\n                                         <div style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;\">\r\n                                            Appointment ID : %appointment_id%, </div>\r\n                                          <div style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;\">\r\n                                            Serial : %sequence% </div>\r\n                                         <div style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;\">\r\n                                            and Appointment Date : %appointment_date%. \r\n                                          </div>\r\n                                        </td>\r\n                                     </tr>\r\n                                   </tbody></table>\r\n                                  </td>\r\n                               </tr>\r\n                             </tbody></table>\r\n                            </td>\r\n                         </tr>\r\n                       </tbody></table>\r\n                      </td>\r\n                   </tr>\r\n                 </tbody></table>\r\n                </td>\r\n             </tr>\r\n\r\n\r\n             <tr>\r\n                <td align=\"center\" valign=\"top\">\r\n\r\n                  <table style=\"color:#FFFFFF;\" bgcolor=\"#3498db\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\r\n                    <tbody><tr>\r\n                     <td align=\"center\" valign=\"top\">\r\n\r\n                        <table class=\"flexibleContainer\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"700\">\r\n                          <tbody><tr>\r\n                           <td class=\"flexibleContainerCell\" align=\"center\" width=\"700\" valign=\"top\">\r\n\r\n                            \r\n                              <table cellspacing=\"0\" cellpadding=\"30\" border=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                 <td class=\"textContent\" align=\"center\" valign=\"top\">\r\n                                    \r\n                                    <div style=\"text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;\">\r\n                                      Thank you for the Appointment\r\n                                    </div>\r\n                                  </td>\r\n                               </tr>\r\n                             </tbody></table>\r\n\r\n                            </td>\r\n                         </tr>\r\n                       </tbody></table>\r\n                        \r\n                      </td>\r\n                   </tr>\r\n                 </tbody></table>\r\n                </td>\r\n             </tr>\r\n\r\n         \r\n        \r\n      </tbody></table>\r\n    \r\n  \r\n\r\n</td></tr></tbody></table></center>                                                                  ', 1, 0, 0, 0),
(4, 'Default Template', '\n \n  \n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <title>Doctoress</title>\n\n    <style type=\"text/css\">\n\n\n     @media only screen and (max-width: 680px){\n        body{width:100% !important; min-width:100% !important;} \n        \n        table[id=\"emailBody\"],\n        table[class=\"flexibleContainer\"],\n       td[class=\"flexibleContainerCell\"] {width:100% !important;}\n        td[class=\"flexibleContainerBox\"], td[class=\"flexibleContainerBox\"] table {display: block;width: 100%;text-align: left;}\n       table[class=\"flexibleContainerBoxNext\"]{padding-top: 10px !important;}\n  \n      }\n   </style>\n\n\n  \n\n\n  \n\n    <center style=\"background-color:#E1E1E1;\">\n      <table id=\"bodyTable\" style=\"table-layout: fixed;max-width:100% !important;width: 100% !important;min-width: 100% !important;\" width=\"100%\" height=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n       <tbody><tr>\n         <td valign=\"top\" align=\"center\">\n\n\n            <table id=\"emailBody\" width=\"700\" bgcolor=\"#FFFFFF\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n\n             <tbody><tr>\n               <td valign=\"top\" align=\"center\">\n\n                  <table style=\"color:#FFFFFF;\" width=\"100%\" bgcolor=\"#3498db\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                    <tbody><tr>\n                     <td valign=\"top\" align=\"center\">\n\n                        <table class=\"flexibleContainer\" width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                          <tbody><tr>\n                           <td class=\"flexibleContainerCell\" valign=\"top\" width=\"700\" align=\"center\">\n\n                            \n                              <table width=\"100%\" border=\"0\" cellpadding=\"30\" cellspacing=\"0\">\n                                <tbody><tr>\n                                 <td class=\"textContent\" valign=\"top\" align=\"center\">\n                                    <h1 style=\"color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;\">\n                                   Hi! %patient_name%</h1>\n                                   <h2 style=\"text-align:center;font-weight:normal;font-family:Helvetica,Arial,sans-serif;font-size:23px;margin-bottom:10px;color:#205478;line-height:135%;\">\n                                    Your Appointment Information</h2>\n                                 </td>\n                               </tr>\n                             </tbody></table>\n\n                            </td>\n                         </tr>\n                       </tbody></table>\n                        \n                      </td>\n                   </tr>\n                 </tbody></table>\n                </td>\n             </tr>\n\n\n             <tr>\n                <td valign=\"top\" align=\"center\">\n\n                  <table style=\"color:#FFFFFF;\" width=\"100%\" bgcolor=\"#3498db\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                    <tbody><tr>\n                     <td valign=\"top\" align=\"center\">\n\n                        <table class=\"flexibleContainer\" width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                          <tbody><tr>\n                           <td class=\"flexibleContainerCell\" valign=\"top\" width=\"700\" align=\"center\">\n\n                            \n                              <table width=\"100%\" border=\"0\" cellpadding=\"30\" cellspacing=\"0\">\n                                <tbody><tr>\n                                 <td class=\"textContent\" valign=\"top\" align=\"center\">\n                                    <p style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#fff;line-height:135%;\">\n                                      Thnks for your appointment request to %doctor_name% .\n                                     This is an automatic system generated email as with na\n                                      appointment.\n                                      Your appointment details as below...\n                                    </p>\n                                  </td>\n                               </tr>\n                             </tbody></table>\n\n                            </td>\n                         </tr>\n                       </tbody></table>\n                        \n                      </td>\n                   </tr>\n                 </tbody></table>\n                </td>\n             </tr>\n         \n              <tr>\n                <td valign=\"top\" align=\"center\">\n                  <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                   <tbody><tr>\n                     <td valign=\"top\" align=\"center\">\n                        <table class=\"flexibleContainer\" width=\"700\" border=\"0\" cellpadding=\"30\" cellspacing=\"0\">\n                         <tbody><tr>\n                           <td class=\"flexibleContainerCell\" valign=\"top\" width=\"700\">\n\n                             <table width=\"100%\" align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                                <tbody><tr>\n                                 <td class=\"flexibleContainerBox\" valign=\"middle\" align=\"left\">\n                                    <table class=\"flexibleContainerBoxNext\" style=\"max-width: 100%;\" width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                                      <tbody><tr>\n                                       <td style=\"margin-left: 1em;\">\n                                          <h3 style=\"color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;\">\n                                            Your name : %patient_name%</h3>\n                                         <div style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;\">\n                                            Your ID : %patient_id%, </div>\n                                         <div style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;\">\n                                            Appointment ID : %appointment_id%, </div>\n                                          <div style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;\">\n                                            Serial : %sequence% </div>\n                                         <div style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;\">\n                                            and Appointment Date : %appointment_date%. \n                                          </div>\n                                        </td>\n                                     </tr>\n                                   </tbody></table>\n                                  </td>\n                               </tr>\n                             </tbody></table>\n                            </td>\n                         </tr>\n                       </tbody></table>\n                      </td>\n                   </tr>\n                 </tbody></table>\n                </td>\n             </tr>\n\n\n             <tr>\n                <td valign=\"top\" align=\"center\">\n\n                  <table style=\"color:#FFFFFF;\" width=\"100%\" bgcolor=\"#3498db\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                    <tbody><tr>\n                     <td valign=\"top\" align=\"center\">\n\n                        <table class=\"flexibleContainer\" width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n                          <tbody><tr>\n                           <td class=\"flexibleContainerCell\" valign=\"top\" width=\"700\" align=\"center\">\n\n                            \n                              <table width=\"100%\" border=\"0\" cellpadding=\"30\" cellspacing=\"0\">\n                                <tbody><tr>\n                                 <td class=\"textContent\" valign=\"top\" align=\"center\">\n                                    \n                                    <div style=\"text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;\">\n                                      Thank you for the Appointment\n                                    </div>\n                                  </td>\n                               </tr>\n                             </tbody></table>\n\n                            </td>\n                         </tr>\n                       </tbody></table>\n                        \n                      </td>\n                   </tr>\n                 </tbody></table>\n                </td>\n             </tr>\n\n         \n        \n      </tbody></table>\n    \n  \n\n</td></tr></tbody></table></center>', 1, 1, 0, 1),
(5, 'Template One', ' <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\r\n   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Doctoress</title>\r\n\r\n    <style type=\"text/css\">\r\n\r\n\r\n     @media only screen and (max-width: 680px){\r\n        body{width:100% !important; min-width:100% !important;} \r\n        \r\n        table[id=\"emailBody\"],\r\n        table[class=\"flexibleContainer\"],\r\n       td[class=\"flexibleContainerCell\"] {width:100% !important;}\r\n        td[class=\"flexibleContainerBox\"], td[class=\"flexibleContainerBox\"] table {display: block;width: 100%;text-align: left;}\r\n       table[class=\"flexibleContainerBoxNext\"]{padding-top: 10px !important;}\r\n  \r\n      }\r\n   </style>\r\n\r\n\r\n  \r\n\r\n\r\n \r\n\r\n   <center style=\"background-color:#E1E1E1;\">\r\n      <table id=\"bodyTable\" style=\"table-layout: fixed;max-width:100% !important;width: 100% !important;min-width: 100% !important;\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\" height=\"100%\">\r\n       <tbody><tr>\r\n          <td align=\"center\" valign=\"top\">\r\n\r\n\r\n           <table id=\"emailBody\" bgcolor=\"#FFFFFF\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"700\">\r\n\r\n              <tbody><tr>\r\n                <td align=\"center\" valign=\"top\">\r\n\r\n                  <table style=\"color:#FFFFFF;\" bgcolor=\"#3498db\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\r\n                    <tbody><tr>\r\n                      <td align=\"center\" valign=\"top\">\r\n\r\n                        <table class=\"flexibleContainer\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"700\">\r\n                          <tbody><tr>\r\n                            <td class=\"flexibleContainerCell\" align=\"center\" width=\"700\" valign=\"top\">\r\n\r\n                            \r\n                              <table cellspacing=\"0\" cellpadding=\"30\" border=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                  <td class=\"textContent\" align=\"center\" valign=\"top\">\r\n                                    <h1 style=\"color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;\">\r\n                                   Hi! %patient_name%</h1>\r\n                                   <h2 style=\"text-align:center;font-weight:normal;font-family:Helvetica,Arial,sans-serif;font-size:23px;margin-bottom:10px;color:#205478;line-height:135%;\">\r\n                                   Your Registration Information</h2>\r\n                                  </td>\r\n                               </tr>\r\n                             </tbody></table>\r\n\r\n                            </td>\r\n                         </tr>\r\n                       </tbody></table>\r\n                        \r\n                      </td>\r\n                   </tr>\r\n                 </tbody></table>\r\n                </td>\r\n             </tr>\r\n\r\n\r\n             <tr>\r\n                <td align=\"center\" valign=\"top\">\r\n\r\n                  <table style=\"color:#FFFFFF;\" bgcolor=\"#3498db\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\r\n                    <tbody><tr>\r\n                      <td align=\"center\" valign=\"top\">\r\n\r\n                        <table class=\"flexibleContainer\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"700\">\r\n                          <tbody><tr>\r\n                            <td class=\"flexibleContainerCell\" align=\"center\" width=\"700\" valign=\"top\">\r\n\r\n                            \r\n                              <table cellspacing=\"0\" cellpadding=\"30\" border=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                  <td class=\"textContent\" align=\"center\" valign=\"top\">\r\n                                    <p style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#000;line-height:135%;\">\r\n                                      Thnks for your appointment request to Dr. Doctor name .\r\n                                      This is an automatic system generated email as with na\r\n                                      appointment.\r\n                                      Your appointment details as below...\r\n                                    </p>\r\n                                  </td>\r\n                               </tr>\r\n                             </tbody></table>\r\n\r\n                            </td>\r\n                         </tr>\r\n                       </tbody></table>\r\n                        \r\n                      </td>\r\n                   </tr>\r\n                 </tbody></table>\r\n                </td>\r\n             </tr>\r\n         \r\n              <tr>\r\n                <td align=\"center\" valign=\"top\">\r\n                  <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\r\n                   <tbody><tr>\r\n                      <td align=\"center\" valign=\"top\">\r\n                        <table class=\"flexibleContainer\" cellspacing=\"0\" cellpadding=\"30\" border=\"0\" width=\"700\">\r\n                         <tbody><tr>\r\n                            <td class=\"flexibleContainerCell\" width=\"700\" valign=\"top\">\r\n\r\n                             <table align=\"left\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                  <td class=\"flexibleContainerBox\" align=\"left\" valign=\"middle\">\r\n                                    <table class=\"flexibleContainerBoxNext\" style=\"max-width: 100%;\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"700\">\r\n                                      <tbody><tr>\r\n                                        <td style=\"margin-left: 1em;\">\r\n                                          <h3 style=\"color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;\">\r\n                                            Your name : %patient_name%</h3>\r\n                                         <div style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;\">\r\n                                             Your ID : %patient_id%, </div>\r\n                                         <div style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;\">\r\n                                            and Date : %date%. \r\n                                          </div>\r\n                                        </td>\r\n                                     </tr>\r\n                                   </tbody></table>\r\n                                  </td>\r\n                               </tr>\r\n                             </tbody></table>\r\n                            </td>\r\n                         </tr>\r\n                       </tbody></table>\r\n                      </td>\r\n                   </tr>\r\n                 </tbody></table>\r\n                </td>\r\n             </tr>\r\n\r\n\r\n             <tr>\r\n                <td align=\"center\" valign=\"top\">\r\n\r\n                  <table style=\"color:#FFFFFF;\" bgcolor=\"#3498db\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\r\n                    <tbody><tr>\r\n                      <td align=\"center\" valign=\"top\">\r\n\r\n                        <table class=\"flexibleContainer\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"700\">\r\n                          <tbody><tr>\r\n                            <td class=\"flexibleContainerCell\" align=\"center\" width=\"700\" valign=\"top\">\r\n\r\n                            \r\n                              <table cellspacing=\"0\" cellpadding=\"30\" border=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                  <td class=\"textContent\" align=\"center\" valign=\"top\">\r\n                                    \r\n                                    <div style=\"text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;\">\r\n                                      Thank you for the Appointment\r\n                                    </div>\r\n                                  </td>\r\n                               </tr>\r\n                             </tbody></table>\r\n\r\n                            </td>\r\n                         </tr>\r\n                       </tbody></table>\r\n                        \r\n                      </td>\r\n                   </tr>\r\n                 </tbody></table>\r\n                </td>\r\n             </tr>\r\n\r\n         \r\n       \r\n     </tbody></table>\r\n    \r\n \r\n\r\n                                                                  </td></tr></tbody></table></center>                                                                   ', 1, 0, 1, 0),
(6, 'Default Template', '<!DOCTYPE html\">\n <html>\n  <head>\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <title>Doctoress</title>\n\n    <style type=\"text/css\">\n\n\n     @media only screen and (max-width: 680px){\n        body{width:100% !important; min-width:100% !important;} \n        \n        table[id=\"emailBody\"],\n        table[class=\"flexibleContainer\"],\n       td[class=\"flexibleContainerCell\"] {width:100% !important;}\n        td[class=\"flexibleContainerBox\"], td[class=\"flexibleContainerBox\"] table {display: block;width: 100%;text-align: left;}\n       table[class=\"flexibleContainerBoxNext\"]{padding-top: 10px !important;}\n  \n      }\n   </style>\n\n\n  </head>\n\n\n <body bgcolor=\"#E1E1E1\" leftmargin=\"0\" marginwidth=\"0\" topmargin=\"0\" marginheight=\"0\" offset=\"0\">\n\n   <center style=\"background-color:#E1E1E1;\">\n      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\" id=\"bodyTable\" style=\"table-layout: fixed;max-width:100% !important;width: 100% !important;min-width: 100% !important;\">\n       <tr>\n          <td align=\"center\" valign=\"top\" >\n\n\n           <table bgcolor=\"#FFFFFF\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" id=\"emailBody\">\n\n              <tr>\n                <td align=\"center\" valign=\"top\">\n\n                  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"color:#FFFFFF;\" bgcolor=\"#3498db\">\n                    <tr>\n                      <td align=\"center\" valign=\"top\">\n\n                        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"flexibleContainer\">\n                          <tr>\n                            <td align=\"center\" valign=\"top\" width=\"700\" class=\"flexibleContainerCell\">\n\n                            \n                              <table border=\"0\" cellpadding=\"30\" cellspacing=\"0\" width=\"100%\">\n                                <tr>\n                                  <td align=\"center\" valign=\"top\" class=\"textContent\">\n                                    <h1 style=\"color:#FFFFFF;line-height:100%;font-family:Helvetica,Arial,sans-serif;font-size:35px;font-weight:normal;margin-bottom:5px;text-align:center;\">\n                                   Hi! %patient_name%</h1>\n                                   <h2 style=\"text-align:center;font-weight:normal;font-family:Helvetica,Arial,sans-serif;font-size:23px;margin-bottom:10px;color:#205478;line-height:135%;\">\n                                    Your Registration Information</h2>\n                                  </td>\n                               </tr>\n                             </table>\n\n                            </td>\n                         </tr>\n                       </table>\n                        \n                      </td>\n                   </tr>\n                 </table>\n                </td>\n             </tr>\n\n\n             <tr>\n                <td align=\"center\" valign=\"top\">\n\n                  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"color:#FFFFFF;\" bgcolor=\"#3498db\">\n                    <tr>\n                      <td align=\"center\" valign=\"top\">\n\n                        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"flexibleContainer\">\n                          <tr>\n                            <td align=\"center\" valign=\"top\" width=\"700\" class=\"flexibleContainerCell\">\n\n                            \n                              <table border=\"0\" cellpadding=\"30\" cellspacing=\"0\" width=\"100%\">\n                                <tr>\n                                  <td align=\"center\" valign=\"top\" class=\"textContent\">\n                                    <p style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#fff;line-height:135%;\">\n                                      Thnks for your appointment request to Dr. Jhon Dev .\n                                      This is an automatic system generated email as with na\n                                      appointment.\n                                      Your appointment details as below...\n                                    </p>\n                                  </td>\n                               </tr>\n                             </table>\n\n                            </td>\n                         </tr>\n                       </table>\n                        \n                      </td>\n                   </tr>\n                 </table>\n                </td>\n             </tr>\n         \n              <tr>\n                <td align=\"center\" valign=\"top\">\n                  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                   <tr>\n                      <td align=\"center\" valign=\"top\">\n                        <table border=\"0\" cellpadding=\"30\" cellspacing=\"0\" width=\"700\" class=\"flexibleContainer\">\n                         <tr>\n                            <td valign=\"top\" width=\"700\" class=\"flexibleContainerCell\">\n\n                             <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n                                <tr>\n                                  <td align=\"left\" valign=\"middle\" class=\"flexibleContainerBox\">\n                                    <table class=\"flexibleContainerBoxNext\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" style=\"max-width: 100%;\">\n                                      <tr>\n                                        <td style=\"margin-left: 1em;\">\n                                          <h3 style=\"color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;\">\n                                            Your name : %patient_name%</h3>\n                                         <div  style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;\">\n                                             Your ID : %patient_id%, </div>\n                                         <div style=\"text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;\">\n                                            and Date : %date%. \n                                          </div>\n                                        </td>\n                                     </tr>\n                                   </table>\n                                  </td>\n                               </tr>\n                             </table>\n                            </td>\n                         </tr>\n                       </table>\n                      </td>\n                   </tr>\n                 </table>\n                </td>\n             </tr>\n\n\n             <tr>\n                <td align=\"center\" valign=\"top\">\n\n                  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"color:#FFFFFF;\" bgcolor=\"#3498db\">\n                    <tr>\n                      <td align=\"center\" valign=\"top\">\n\n                        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"700\" class=\"flexibleContainer\">\n                          <tr>\n                            <td align=\"center\" valign=\"top\" width=\"700\" class=\"flexibleContainerCell\">\n\n                            \n                              <table border=\"0\" cellpadding=\"30\" cellspacing=\"0\" width=\"100%\">\n                                <tr>\n                                  <td align=\"center\" valign=\"top\" class=\"textContent\">\n                                    \n                                    <div style=\"text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#FFFFFF;line-height:135%;\">\n                                      Thank you for the Appointment\n                                    </div>\n                                  </td>\n                               </tr>\n                             </table>\n\n                            </td>\n                         </tr>\n                       </table>\n                        \n                      </td>\n                   </tr>\n                 </table>\n                </td>\n             </tr>\n\n         </td>\n       </tr>\n     </table>\n    </center>\n </body>\n</html>\n', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emergency_stop_tbl`
--

CREATE TABLE IF NOT EXISTS `emergency_stop_tbl` (
  `stop_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `stop_date` date NOT NULL,
  `schedul_date` date NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`stop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `generic_tbl`
--

CREATE TABLE IF NOT EXISTS `generic_tbl` (
  `generic_id` int(11) NOT NULL AUTO_INCREMENT,
  `prescription_id` int(11) NOT NULL,
  `appointment_id` varchar(120) NOT NULL,
  `group_id` int(11) NOT NULL,
  `mg` varchar(100) NOT NULL,
  `dose` varchar(50) NOT NULL,
  `day` varchar(33) NOT NULL,
  `medicine_type` text NOT NULL,
  `medicine_com` text NOT NULL,
  PRIMARY KEY (`generic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phrase` text NOT NULL,
  `english` text DEFAULT NULL,
  `test` text DEFAULT NULL,
  `spanish` text DEFAULT NULL,
  `removedalert40aldskfa41removed` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=338 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `phrase`, `english`, `test`, `spanish`, `removedalert40aldskfa41removed`) VALUES
(1, 'deashbord', 'Dashboard', NULL, NULL, NULL),
(2, 'prescription', 'Prescription', NULL, NULL, NULL),
(3, 'appointment', 'Appointment', NULL, NULL, NULL),
(4, 'create_trade', 'Create (Trade)', NULL, NULL, NULL),
(5, 'create_generic', 'Create (Generic)', NULL, NULL, NULL),
(6, 'create_appointment', 'Create Appointment', NULL, NULL, NULL),
(7, 'appointment_list', 'Appointment List', NULL, NULL, NULL),
(8, 'patient', 'Patient', NULL, NULL, NULL),
(9, 'add_new_patient', 'Add New Patient', NULL, NULL, NULL),
(10, 'patient_list', 'Patient List', NULL, NULL, NULL),
(11, 'schedule', 'Schedule', NULL, NULL, NULL),
(12, 'add_schedule', 'Add Schedule', NULL, NULL, NULL),
(13, 'schedule_list', 'Schedule List', NULL, NULL, NULL),
(14, 'emergency_stop', 'Emergency Stop', NULL, NULL, NULL),
(15, 'stop', 'Stop', NULL, NULL, NULL),
(16, 'emergency_stop_list', 'Emergency Stop List', NULL, NULL, NULL),
(17, 'venue', 'Venue', NULL, NULL, NULL),
(18, 'create_venue', 'Create Venue', NULL, NULL, NULL),
(19, 'venue_list', 'Venue List', NULL, NULL, NULL),
(20, 'setup_data', 'Setup Data', NULL, NULL, NULL),
(21, 'add_medicine', 'Add New Medicine', NULL, NULL, NULL),
(22, 'medicine_list', 'Medicine List', NULL, NULL, NULL),
(23, 'add_company', 'Add Company', NULL, NULL, NULL),
(24, 'add_group', 'Add Group', NULL, NULL, NULL),
(25, 'add_advice', 'Add Advice', NULL, NULL, NULL),
(26, 'add_test_name', 'Add Test Name', NULL, NULL, NULL),
(27, 'test_list', 'Test List', NULL, NULL, NULL),
(28, 'users', 'Users', NULL, NULL, NULL),
(29, 'web_site', 'Web Site', NULL, NULL, NULL),
(30, 'language_setting', 'Language Setting', NULL, NULL, NULL),
(31, 'web_setting', 'Web Settiing', NULL, NULL, NULL),
(32, 'header_setup', 'Header Setup', NULL, NULL, NULL),
(33, 'profile', 'Profile', NULL, NULL, NULL),
(34, 'slider', 'Slider setup', NULL, NULL, NULL),
(35, 'blog', 'Blog', NULL, NULL, NULL),
(36, 'add_new_post', 'Add New Post', NULL, NULL, NULL),
(37, 'post_list', 'Post List', NULL, NULL, NULL),
(38, 'gateway', 'Gateway Setup', NULL, NULL, NULL),
(39, 'sms_template', 'Template', NULL, NULL, NULL),
(40, 'send_custom_sms', 'Send Custom Sms', NULL, NULL, NULL),
(41, 'sms_setup', 'SMS', NULL, NULL, NULL),
(42, 'sms_schedule', 'Sms Schedule', NULL, NULL, NULL),
(43, 'sms_report', 'Sms Report', NULL, NULL, NULL),
(44, 'custom_sms_report', 'Custom SMS Report', NULL, NULL, NULL),
(45, 'auto_sms_report', 'Auto SMS Report', NULL, NULL, NULL),
(46, 'email_setup', 'Email Setup', NULL, NULL, NULL),
(47, 'email_configaretion', 'Email Configuration', NULL, NULL, NULL),
(48, 'email_template', 'Email Template', NULL, NULL, NULL),
(49, 'email_template_list', 'Email Template List', NULL, NULL, NULL),
(50, 'email_schedule_setup', 'Email Schedule Setup', NULL, NULL, NULL),
(51, 'emergency_stop_setup', 'Emergency Stop Setup', NULL, NULL, NULL),
(52, 'add_new_user', 'Add New User', NULL, NULL, NULL),
(53, 'user_list', 'User List', NULL, NULL, NULL),
(54, 'send_custom_email', 'Send Custom Email', NULL, NULL, NULL),
(55, 'email_list', 'Email List', NULL, NULL, NULL),
(56, 'prescription_list', 'Prescription List', NULL, NULL, NULL),
(57, 'total_patient', 'Total Patient', NULL, NULL, NULL),
(58, 'today_patient', 'Today Patient', NULL, NULL, NULL),
(59, 'today_appointment', 'Today Appointment', NULL, NULL, NULL),
(60, 'new_appointment', 'New Appointment', NULL, NULL, NULL),
(61, 'total_appointment', 'Total Appointment', NULL, NULL, NULL),
(62, 'today_prescription', 'Today Prescription', NULL, NULL, NULL),
(63, 'total_prescription', 'Total Prescription', NULL, NULL, NULL),
(64, 'total_sms', 'Total SMS', NULL, NULL, NULL),
(65, 'today_sms', 'Today SMS', NULL, NULL, NULL),
(66, 'custom_sms', 'Custom SMS', NULL, NULL, NULL),
(67, 'auto_sms', 'Auto SMS', NULL, NULL, NULL),
(68, 'total_send_email', 'Total Send Email', NULL, NULL, NULL),
(69, 'line_chart', 'Line Chart', NULL, NULL, NULL),
(70, 'appointment_chart', 'Appointment Chart', NULL, NULL, NULL),
(71, 'patient_chart', 'Patient Chart', NULL, NULL, NULL),
(72, 'chart_shows_total_report', 'This chart shows total report', NULL, NULL, NULL),
(73, 'appointment_progress', 'This chart shows total appointment progress', NULL, NULL, NULL),
(74, 'patient_progress', 'This chart shows total patient progress', NULL, NULL, NULL),
(75, 'send_total_email', 'Send Total Email', NULL, NULL, NULL),
(76, 'patient_name', 'Patient Name', NULL, NULL, NULL),
(77, 'phone_number', 'Phone Number', NULL, NULL, NULL),
(78, 'birth_date', 'Birth date', NULL, NULL, NULL),
(79, 'age', 'Age', NULL, NULL, NULL),
(80, 'male', 'Male', NULL, NULL, NULL),
(81, 'female', 'Female', NULL, NULL, NULL),
(82, 'others', 'Others', NULL, NULL, NULL),
(83, 'patient_id', 'Patient Id', NULL, NULL, NULL),
(84, 'patient_cc', 'Patient CC', NULL, NULL, NULL),
(85, 'patient_weight', 'Patient Weight', NULL, NULL, NULL),
(86, 'patient_bp', 'Patient BP', NULL, NULL, NULL),
(87, 'oex', 'O/Ex', NULL, NULL, NULL),
(88, 'pd', 'PD', NULL, NULL, NULL),
(89, 'medicine', 'Medicine', NULL, NULL, NULL),
(90, 'type', 'Type', NULL, NULL, NULL),
(91, 'medicine_name', 'Medicine Name', NULL, NULL, NULL),
(92, 'mgml', 'Mg/Ml', NULL, NULL, NULL),
(93, 'dose', 'Dose', NULL, NULL, NULL),
(94, 'day', 'Day', NULL, NULL, NULL),
(95, 'medicine_comment', 'Comments', NULL, NULL, NULL),
(96, 'overal_comment', 'Overall Comment', NULL, NULL, NULL),
(97, 'test', 'Test', NULL, NULL, NULL),
(98, 'add', 'Add', NULL, NULL, NULL),
(99, 'advice', 'Advice', NULL, NULL, NULL),
(100, 'test_name', 'Test Name', NULL, NULL, NULL),
(101, 'submit', 'Submit', NULL, NULL, NULL),
(102, 'reset', 'Reset', NULL, NULL, NULL),
(103, 'description', 'Description', NULL, NULL, NULL),
(104, 'generic_name', 'Generic Name', NULL, NULL, NULL),
(105, 'picture', 'Picture', NULL, NULL, NULL),
(106, 'sex', 'Gender', NULL, NULL, NULL),
(107, 'action', 'Action', NULL, NULL, NULL),
(108, 'appointment_id', 'Appointment Id', NULL, NULL, NULL),
(109, 'date', 'Date', NULL, NULL, NULL),
(110, 'choose_serial', 'Choose Serial', NULL, NULL, NULL),
(111, 'date_placeholder', 'yyyy-mm-dd', NULL, NULL, NULL),
(112, 'sequence', 'Appointment Time', NULL, NULL, NULL),
(113, 'sms', 'Send SMS', NULL, NULL, NULL),
(114, 'sms_gateway', 'SMS Gateway', NULL, NULL, NULL),
(115, 'send', 'Send', NULL, NULL, NULL),
(116, 'sms_message', 'SMS Send Successfully!', NULL, NULL, NULL),
(117, 'name', 'Full Name', NULL, NULL, NULL),
(118, 'email', 'Email Address', NULL, NULL, NULL),
(119, 'blood_group', 'Blood Group', NULL, NULL, NULL),
(120, 'address', 'Address', NULL, NULL, NULL),
(121, 'edit_patient', 'Edit Patient', NULL, NULL, NULL),
(122, 'update', 'Update', NULL, NULL, NULL),
(123, 'visibility', 'Visibility', NULL, NULL, NULL),
(124, 'yes', 'Yes', NULL, NULL, NULL),
(125, 'no', 'No', NULL, NULL, NULL),
(126, 'set_time_msg', 'You can set only minute', NULL, NULL, NULL),
(127, 'set_per_patient_time', 'Per Patient Time', NULL, NULL, NULL),
(128, 'end_time', 'End Time', NULL, NULL, NULL),
(129, 'start_time', 'Start Time', NULL, NULL, NULL),
(130, 'set_time', 'Set Time', NULL, NULL, NULL),
(131, 'saturday', 'Saturday', NULL, NULL, NULL),
(132, 'sunday', 'Sunday', NULL, NULL, NULL),
(133, 'monday', 'Monday', NULL, NULL, NULL),
(134, 'tuesday', 'Tuesday', NULL, NULL, NULL),
(135, 'wednesday', 'Wednesday', NULL, NULL, NULL),
(136, 'thusday', 'Thursday', NULL, NULL, NULL),
(137, 'friday', 'Friday', NULL, NULL, NULL),
(138, 'edit_schedule', 'Edit Schedule', NULL, NULL, NULL),
(139, 'stop_date', 'Stop Date', NULL, NULL, NULL),
(140, 'schedule_date', 'Schedule Date', NULL, NULL, NULL),
(141, 'message', 'Message', NULL, NULL, NULL),
(142, 'specialist', 'Specialist', NULL, NULL, NULL),
(143, 'edit_emergency_stop', 'Edit Emergency Stop', NULL, NULL, NULL),
(144, 'venue_name', 'Venue Name', NULL, NULL, NULL),
(145, 'venue_contact', 'Venue Contact', NULL, NULL, NULL),
(146, 'venue_address', 'Venue Address', NULL, NULL, NULL),
(147, 'venue_map', 'Venue Map', NULL, NULL, NULL),
(148, 'edot_venue', 'Edit Venue', NULL, NULL, NULL),
(149, 'company_name', 'Company Name', NULL, NULL, NULL),
(150, 'group_name', 'Group Name', NULL, NULL, NULL),
(151, 'medicine_description', 'Medicine Description', NULL, NULL, NULL),
(152, 'edit_medicine', 'Edit Medicine', NULL, NULL, NULL),
(153, 'web_site_enable_disable', 'Web site Enable Or Disable', NULL, NULL, NULL),
(154, 'html_code_title', 'Html Code Sample', NULL, NULL, NULL),
(155, 'js_code_title', 'Js Code Sample ', NULL, NULL, NULL),
(156, 'use_thirt_parti_api', 'Use third party Api ', NULL, NULL, NULL),
(157, 'therd_parti_api_preview', 'Third party Api preview', NULL, NULL, NULL),
(158, 'website_enable', 'Website Enable', NULL, NULL, NULL),
(159, 'website_desable', 'Website disable', NULL, NULL, NULL),
(160, 'website_enable_msg', 'If you don\'t want to Show The website, Click the button', NULL, NULL, NULL),
(161, 'website_desable_msg', 'If you want to Show The website, Click the button', NULL, NULL, NULL),
(162, 'html_code_description', 'Html Code Sample Place this code wherever you want the plugin to appear on your page.', NULL, NULL, NULL),
(163, 'js_code_description', 'Place this code wherever you want the plugin to appear on your page.', NULL, NULL, NULL),
(164, 'facebook_link', 'facebook Link', NULL, NULL, NULL),
(165, 'twitter_link', 'twitter Link', NULL, NULL, NULL),
(166, 'youtube_link', 'Youtube Link', NULL, NULL, NULL),
(167, 'linkedin_link', 'Linkedin Link', NULL, NULL, NULL),
(168, 'google_link', 'Google Linlk', NULL, NULL, NULL),
(169, 'working_description', 'Working Description', NULL, NULL, NULL),
(170, 'hotline', 'Hotline', NULL, NULL, NULL),
(171, 'copy_right', 'Copy Right', NULL, NULL, NULL),
(172, 'logo', 'Logo', NULL, NULL, NULL),
(173, 'favicon', 'Favicon', NULL, NULL, NULL),
(174, 'appointment_image', 'Appointment Image', NULL, NULL, NULL),
(175, 'about_image', 'About Image', NULL, NULL, NULL),
(176, 'total_appointment_details', 'Total Appointment details', NULL, NULL, NULL),
(177, 'today_appointment_details', 'Today Appointment Details', NULL, NULL, NULL),
(178, 'total_patient_details', 'Total Patient Details', NULL, NULL, NULL),
(179, 'twitter_post', 'Twitter Post', NULL, NULL, NULL),
(180, 'google_map', 'Google Map', NULL, NULL, NULL),
(181, 'doctor_name', 'Doctor Name', NULL, NULL, NULL),
(182, 'designation', 'Designation', NULL, NULL, NULL),
(183, 'degrees', 'Degrees', NULL, NULL, NULL),
(184, 'department', 'Department', NULL, NULL, NULL),
(185, 'service_place', 'Service Place', NULL, NULL, NULL),
(186, 'about_me', 'About Me', NULL, NULL, NULL),
(187, 'slider_list', 'Slider List', NULL, NULL, NULL),
(188, 'heading', 'Heading', NULL, NULL, NULL),
(189, 'details', 'Details', NULL, NULL, NULL),
(190, 'select_category', 'Select Category', NULL, NULL, NULL),
(191, 'title', 'Title', NULL, NULL, NULL),
(192, 'edit_post', 'Edit Post', NULL, NULL, NULL),
(193, 'edit_slider', 'Edit Slider', NULL, NULL, NULL),
(194, 'category', 'Select Category', NULL, NULL, NULL),
(195, 'category_name', 'Category Name', NULL, NULL, NULL),
(196, 'status', 'Status', NULL, NULL, NULL),
(197, 'provider', 'Provider', NULL, NULL, NULL),
(198, 'user_name', 'User Name', NULL, NULL, NULL),
(199, 'password', 'password', NULL, NULL, NULL),
(200, 'sender', 'Sender', NULL, NULL, NULL),
(201, 'sms_template_list', 'SMS Template List', NULL, NULL, NULL),
(202, 'sms_template_setup', 'SMS Template Setup', NULL, NULL, NULL),
(203, 'template_name', 'Template Name', NULL, NULL, NULL),
(204, 'set_default', 'Set Default', NULL, NULL, NULL),
(205, 'schedule_name', 'Schedule Name', NULL, NULL, NULL),
(206, 'time', 'Time', NULL, NULL, NULL),
(207, 'sms_cronjob_des', 'You can use above link for cron job. Copy and paste at cron job Command box', NULL, NULL, NULL),
(208, 'sms_schedule_list', 'SMS Schedule List', NULL, NULL, NULL),
(209, 'reciver', 'Reciver', NULL, NULL, NULL),
(210, 'from_date', 'From Date', NULL, NULL, NULL),
(211, 'to_date', 'To Date', NULL, NULL, NULL),
(212, 'date_time', 'Date Time', NULL, NULL, NULL),
(213, 'search', 'Search', NULL, NULL, NULL),
(214, 'send_at_appointment', 'Email Send At Appointment Time. ', NULL, NULL, NULL),
(215, 'send_at_registration', 'Email Send At Patient Registration', NULL, NULL, NULL),
(216, 'send_by_reminder', 'Email Send By Reminder.', NULL, NULL, NULL),
(217, 'protocol', 'Protocol', NULL, NULL, NULL),
(218, 'mailepath', 'MailPath', NULL, NULL, NULL),
(219, 'mailtype', 'MailType', NULL, NULL, NULL),
(220, 'sender_email', 'Sender Email', NULL, NULL, NULL),
(221, 'email_template_list_of_app', 'Email Template list For Registration', NULL, NULL, NULL),
(222, 'email_template_list_of_reg', 'Email Template list For Appointment', NULL, NULL, NULL),
(223, 'active', 'Active', NULL, NULL, NULL),
(224, 'reciver_email', 'Reciver Email', NULL, NULL, NULL),
(225, 'subject', 'Subject', NULL, NULL, NULL),
(226, 'edit_email_template', 'Edit Email Template', NULL, NULL, NULL),
(227, 'email_schedule_stup', 'Email Schedule Setup', NULL, NULL, NULL),
(228, 'email_schedule_stup_list', 'Email Schedule Setup List', NULL, NULL, NULL),
(229, 'email_cronjob_msg', 'You can use above link for cron job. Copy and paste at cron job Command box.', NULL, NULL, NULL),
(230, 'appointment_info', 'Appointment Information', NULL, NULL, NULL),
(231, 'appointment_footer_msg', 'Kindly Report to Reception 30 minutes Earlier then your appointment', NULL, NULL, NULL),
(232, 'patient_history', ' History', NULL, NULL, NULL),
(233, 'signature', 'Signature', NULL, NULL, NULL),
(234, 'chamber_time', 'CHAMBER TIME', NULL, NULL, NULL),
(235, 'prescription_empty_msg', 'You have no prescription......................', NULL, NULL, NULL),
(236, 'social_link', 'Social Link', NULL, NULL, NULL),
(237, 'recent_news', 'Recent News', NULL, NULL, NULL),
(238, 'latest_twitter', 'Latest Twitter', NULL, NULL, NULL),
(239, 'register', 'REGISTER', NULL, NULL, NULL),
(240, 'doctor_spciality', 'Doctor Spciality', NULL, NULL, NULL),
(241, 'doctor_degrees', 'Doctor Degrees', NULL, NULL, NULL),
(242, 'doctor_experience', 'Doctor Experience', NULL, NULL, NULL),
(243, 'website_title', 'Website Title', NULL, NULL, NULL),
(244, 'home', 'HOME', NULL, NULL, NULL),
(245, 'working_hour', 'WORKING HOURS', NULL, NULL, NULL),
(246, 'testimonial', 'TESTIMONIAL', NULL, NULL, NULL),
(247, 'contact', 'CONTACT', NULL, NULL, NULL),
(248, 'latest_news', 'Latest News', NULL, NULL, NULL),
(249, 'larnmore', 'Larn More', NULL, NULL, NULL),
(250, 'close', 'Close', NULL, NULL, NULL),
(251, 'login', 'Login', NULL, NULL, NULL),
(252, 'doctor', 'Doctor', NULL, NULL, NULL),
(253, 'assistant', 'Assistant', NULL, NULL, NULL),
(254, 'login_title', 'Please Login', NULL, NULL, NULL),
(255, 'login_msg', 'UserEmail or Password are Invalid.', NULL, NULL, NULL),
(256, 'image_upload_msg', 'Image dosn\'t upload!. Image size to large.', NULL, NULL, NULL),
(257, 'website_setup_msg', 'Setup Successgully.', NULL, NULL, NULL),
(258, 'delete_msg', 'Delete Successfull.', NULL, NULL, NULL),
(259, 'edit_msg', 'Edit Successfully.', NULL, NULL, NULL),
(260, 'slider_ste_msg', 'Slider set Successful..', NULL, NULL, NULL),
(261, 'update_msg', 'Update Successfully.', NULL, NULL, NULL),
(262, 'venue_add_msg', 'Venue Added successfully', NULL, NULL, NULL),
(263, 'exist_error_msg', 'It\'s Allrady Exist', NULL, NULL, NULL),
(264, 'register_msg', 'Registeration Successfully.', NULL, NULL, NULL),
(265, 'post_add_msg', 'Add New Post Successfully..', NULL, NULL, NULL),
(266, 'sms_send_msg', 'SMS Send Successfully!', NULL, NULL, NULL),
(267, 'emal_send_msg', 'Email Send Successfully.', NULL, NULL, NULL),
(268, 'schedule_add_msg', 'Schedule Add Successfully.', NULL, NULL, NULL),
(269, 'template_add_msg', 'Add Template Successfully.', NULL, NULL, NULL),
(270, 'gorup_add_msg', 'Group inserted Successful', NULL, NULL, NULL),
(271, 'medicine_add_msg', 'Mdicine inserted Successful', NULL, NULL, NULL),
(272, 'advice_add_msg', 'Advice inserted Successful', NULL, NULL, NULL),
(273, 'test_add_msg', 'Test inserted Successful', NULL, NULL, NULL),
(274, 'company_add_msg', 'Company inserted Successful', NULL, NULL, NULL),
(275, 'password_change_msg', 'Password Change Successfull', NULL, NULL, NULL),
(276, 'password_change_error_msg', 'Your Old Password Dos Not Mathch', NULL, NULL, NULL),
(277, 'schedule_error_msg', 'Already set up scheduled on this day, please select others one day.', NULL, NULL, NULL),
(278, 'emergency_stop_msg', 'Emergency Stop Successfully.', NULL, NULL, NULL),
(279, 'appointment_error_msg', 'Sorry You already get apointment in this date', NULL, NULL, NULL),
(280, 'get', '', NULL, NULL, NULL),
(281, 'get_appointment_msg', 'You Got this appointment Successful..', NULL, NULL, NULL),
(282, 'patient_id_exist_msg', 'This id Is allredy exist, Please try again', NULL, NULL, NULL),
(283, 'venue_empty_msg', 'Sorry there have no assign venue.', NULL, NULL, NULL),
(284, 'email_setup_msg', 'Email Configaretion Successfully.', NULL, NULL, NULL),
(285, 'email_template_add_msg', 'Email Template Add Successfully.', NULL, NULL, NULL),
(286, 'about_menu', 'ABOUT', NULL, NULL, NULL),
(287, 'font_appointment', 'APPOINTMENT', NULL, NULL, NULL),
(288, 'change_password', 'Change Password', NULL, NULL, NULL),
(289, 'logout', 'Logout', NULL, NULL, NULL),
(290, 'register_information', 'Registration Information.', NULL, NULL, NULL),
(291, 'sl', 'SL', NULL, NULL, NULL),
(292, 'pad_print', 'Pad Print', NULL, NULL, NULL),
(293, 'default_print', 'Default Print', NULL, NULL, NULL),
(294, 'history', 'History', NULL, NULL, NULL),
(295, 'temperature', 'Temperature', NULL, NULL, NULL),
(296, 'print_pattern', 'Print Pattern', NULL, NULL, NULL),
(297, 'setup_pattern', 'Setup Print Pattern', NULL, NULL, NULL),
(298, 'pattern_list', 'Setup Pattern List', NULL, NULL, NULL),
(299, 'header_blank', 'Header Blank', NULL, NULL, NULL),
(300, 'footer_blank', 'Footer Blank', NULL, NULL, NULL),
(301, 'side_content', 'Side Content', NULL, NULL, NULL),
(302, 'content_blank', 'Content Blank', NULL, NULL, NULL),
(303, 'height', 'Height', NULL, NULL, NULL),
(304, 'width', 'Width', NULL, NULL, NULL),
(305, 'edit_print_pattern', 'Edit Print Pattern', NULL, NULL, NULL),
(306, 'footer_logo', 'Footer Logo', NULL, NULL, NULL),
(307, 'payment', 'Payment', NULL, NULL, NULL),
(308, 'setup_payment_method', 'Setup Payment Method', NULL, NULL, NULL),
(309, 'paypal_business_email', 'Paypal Business Email', NULL, NULL, NULL),
(310, 'amount', 'Amount', NULL, NULL, NULL),
(311, 'pyment_list', 'Pyment List', NULL, NULL, NULL),
(312, 'pyment_setup', 'Pyment Setup', NULL, NULL, NULL),
(313, 'payment_setup', 'Payment Setup', NULL, NULL, NULL),
(314, 'payment_list', 'Payment List', NULL, NULL, NULL),
(315, 'notes', 'Notes', NULL, NULL, NULL),
(316, 'doctoress_dashboard', 'Doctoress Dashboard', NULL, NULL, NULL),
(317, 'site_view', 'Site View', NULL, NULL, NULL),
(318, 'edit_prescription', 'Edit Prescription', NULL, NULL, NULL),
(319, 'select_message', 'Please Select time slot for consultation', NULL, NULL, NULL),
(320, 'schedule_msg', 'There have no time schedule setup! Please Try Again.', NULL, NULL, NULL),
(321, 'schedule_date_msg', 'Doctor do not seat In this date!', NULL, NULL, NULL),
(322, 'book_sequence', 'You Selected', NULL, NULL, NULL),
(323, 'patient_id_msg', 'Your id is available', NULL, NULL, NULL),
(324, 'patient_name_load_msg', 'Didn\'t match. Please Enter Your Valid Id.', NULL, NULL, NULL),
(325, 'remember_me', 'Remember me', NULL, NULL, NULL),
(326, 'edit_generic', 'Edit(Generic)', NULL, NULL, NULL),
(327, 'sms_list', 'SMS List', NULL, NULL, NULL),
(328, 'time_zone_setup', 'Time Zone Setup', NULL, NULL, NULL),
(329, 'time_setup', 'Select Time Zone', NULL, NULL, NULL),
(330, 'select_venue', 'Select Venue', NULL, NULL, NULL),
(331, 'change', 'Change', NULL, NULL, NULL),
(332, 'old_passwor', 'Old Password', NULL, NULL, NULL),
(333, 'new_password', 'New Password', NULL, NULL, NULL),
(334, 'confirm_password', 'Confirm Password', NULL, NULL, NULL),
(335, 'full_name', 'Full Name', NULL, NULL, NULL),
(336, 'testimonials', 'Testimonials', NULL, NULL, NULL),
(337, 'old_password', 'Old Password', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_info`
--

CREATE TABLE IF NOT EXISTS `log_info` (
  `log_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` int(11) NOT NULL,
  `active_status` int(11) NOT NULL DEFAULT 1,
  `logout_time` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `medecine_info`
--

CREATE TABLE IF NOT EXISTS `medecine_info` (
  `medicine_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `medicine_name` varchar(100) NOT NULL,
  `med_group_id` int(11) DEFAULT NULL,
  `med_description` text DEFAULT NULL,
  `med_company_id` int(11) NOT NULL,
  `medicine_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`medicine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medecine_info`
--

INSERT INTO `medecine_info` (`medicine_id`, `medicine_name`, `med_group_id`, `med_description`, `med_company_id`, `medicine_status`) VALUES
(1, 'Napa-ex', 0, '<p>adfgsdfgsdfg</p>\r\n', 1, 0),
(20, 'ALOTRIKA', 20, '<p>98 Green Road, Farmgate, ssDhaka</p>\r\n', 10, 0),
(21, 'tess', 7, 'asdfasdf sdfgsdfgsdfg sdfhdfghdfgh', 14, 0),
(22, 'Aromix', 21, 'This is Medical Description', 13, 0),
(23, 'asdf', 23, 'asdfasdf', 14, 0),
(24, 'a', 23, 'as', 1, 0),
(25, '[removed]alert&#40;\'aldskfa\'&#41;;[removed]', 1, 'doctor', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_company_info`
--

CREATE TABLE IF NOT EXISTS `medicine_company_info` (
  `company_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` text NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicine_company_info`
--

INSERT INTO `medicine_company_info` (`company_id`, `company_name`) VALUES
(1, 'Medicines Company1'),
(2, 'Medicines Company12'),
(3, 'Medicines Company13'),
(4, 'Medicines Company14'),
(5, 'Medicines Company2'),
(7, 'Medicines Company4'),
(8, 'ORAKIA'),
(10, 'AMOKLA'),
(13, 'bdtask'),
(14, 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_group_tbl`
--

CREATE TABLE IF NOT EXISTS `medicine_group_tbl` (
  `med_group_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  PRIMARY KEY (`med_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicine_group_tbl`
--

INSERT INTO `medicine_group_tbl` (`med_group_id`, `group_name`) VALUES
(7, 'XTROMA '),
(8, 'ALOMATA'),
(9, 'ORTIXA'),
(10, 'IBNESINA'),
(12, 'ETROMIKA'),
(13, 'DETROLA'),
(14, 'TOAKATA'),
(15, 'GONITA'),
(16, 'ORAKIA'),
(17, 'ASOLAKA'),
(18, 'ATOKILA'),
(20, 'THKILA'),
(21, 'Home Bound'),
(23, 'asdf'),
(24, 'fdfsadfasd');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_prescription`
--

CREATE TABLE IF NOT EXISTS `medicine_prescription` (
  `med_pres_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `appointment_id` varchar(100) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `medicine_type` text DEFAULT NULL,
  `mg` varchar(20) NOT NULL,
  `dose` varchar(100) NOT NULL,
  `day` int(11) NOT NULL,
  `medicine_com` varchar(100) NOT NULL,
  PRIMARY KEY (`med_pres_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `patient_tbl` (
  `patient_id` varchar(250) NOT NULL,
  `patient_name` text NOT NULL,
  `patient_email` varchar(120) DEFAULT NULL,
  `patient_phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `sex` varchar(120) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `blood_group` varchar(250) NOT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_account_setup`
--

CREATE TABLE IF NOT EXISTS `payment_account_setup` (
  `set_up_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `paypal_email` varchar(200) NOT NULL,
  `amount` double NOT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0=demo, 1=active',
  PRIMARY KEY (`set_up_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_account_setup`
--

INSERT INTO `payment_account_setup` (`set_up_id`, `doctor_id`, `paypal_email`, `amount`, `status`) VALUES
(1, 1, 'info@bdtask.com', 200, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_table`
--

CREATE TABLE IF NOT EXISTS `payment_table` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` varchar(200) NOT NULL,
  `patient_id` varchar(200) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `payer_email` varchar(200) NOT NULL,
  `date_time` datetime NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 1,
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `prescription` (
  `prescription_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(200) NOT NULL,
  `appointment_id` varchar(200) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `pres_comments` varchar(255) NOT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `pressure` varchar(20) DEFAULT NULL,
  `problem` varchar(100) NOT NULL,
  `oex` text DEFAULT NULL,
  `pd` text DEFAULT NULL,
  `history` text DEFAULT NULL,
  `temperature` varchar(100) DEFAULT NULL,
  `create_date_time` datetime NOT NULL,
  `prescription_status` int(11) NOT NULL DEFAULT 1,
  `prescription_type` int(11) NOT NULL,
  PRIMARY KEY (`prescription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `print_pattern`
--

CREATE TABLE IF NOT EXISTS `print_pattern` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `pattern_no` text NOT NULL,
  `header_height` int(11) DEFAULT NULL,
  `header_width` int(11) DEFAULT NULL,
  `footer_height` int(11) DEFAULT NULL,
  `footer_width` int(11) DEFAULT NULL,
  `content_height_1` int(11) DEFAULT NULL,
  `content_width_1` int(11) DEFAULT NULL,
  `content_height_2` int(11) DEFAULT NULL,
  `content_width_2` int(11) DEFAULT NULL,
  `pattern_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schedul_setup_tbl`
--

CREATE TABLE IF NOT EXISTS `schedul_setup_tbl` (
  `schedul_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day` int(11) NOT NULL,
  `per_patient_time` int(11) NOT NULL,
  `visibility` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`schedul_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedul_setup_tbl`
--

INSERT INTO `schedul_setup_tbl` (`schedul_id`, `doctor_id`, `venue_id`, `start_time`, `end_time`, `day`, `per_patient_time`, `visibility`, `status`) VALUES
(1, 1, 1, '08:00:00', '17:00:00', 3, 10, 1, 1),
(2, 1, 1, '08:00:00', '17:00:00', 4, 10, 1, 1),
(3, 1, 1, '08:00:00', '17:00:00', 5, 10, 1, 1),
(6, 1, 4, '04:00:00', '13:00:00', 1, 10, 1, 1),
(7, 1, 4, '04:00:00', '13:00:00', 2, 10, 1, 1),
(8, 0, 4, '17:30:00', '21:00:00', 3, 12, 1, 1),
(10, 1, 1, '20:00:00', '23:00:00', 7, 20, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `heading` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `picture` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `heading`, `details`, `sequence`, `picture`, `status`) VALUES
(1, 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 3, 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/images/tslide1.png', 1),
(2, 'WELCOME TO  DOCTORss ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 1, 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/images/tslide3.png', 1),
(3, 'Donec venenatis ante', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', 2, 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/images/tslide.png', 1),
(4, 'Proin suscipit dui ut .', 'Consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum.', 4, 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/images/tslide2.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_delivery`
--

CREATE TABLE IF NOT EXISTS `sms_delivery` (
  `sms_delivery_id` int(11) NOT NULL AUTO_INCREMENT,
  `ss_id` int(11) NOT NULL,
  `delivery_date_time` datetime NOT NULL,
  `sms_info_id` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`sms_delivery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sms_gateway`
--

CREATE TABLE IF NOT EXISTS `sms_gateway` (
  `gateway_id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_name` text NOT NULL,
  `user` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `authentication` text NOT NULL,
  `link` text NOT NULL,
  `default_status` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`gateway_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_gateway`
--

INSERT INTO `sms_gateway` (`gateway_id`, `provider_name`, `user`, `password`, `authentication`, `link`, `default_status`, `status`) VALUES
(1, 'nexmo', 'eadf274012', '6648b2ea3eba913f', 'Doctoress', 'https://www.nexmo.com/', 1, 1),
(2, 'clickatell', 'clickatell', '9d2e2d3aa558ddcb', 'Doctoress', 'https://www.clickatell.com/', 0, 1),
(3, 'default', 'default', '02641f076b0cc3a17', 'Doctoress', 'https://www.default.com/', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_info`
--

CREATE TABLE IF NOT EXISTS `sms_info` (
  `sms_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `phone_no` varchar(250) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `appointment_id` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `sms_counter` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sms_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `sms_schedule`
--

CREATE TABLE IF NOT EXISTS `sms_schedule` (
  `ss_id` int(11) NOT NULL AUTO_INCREMENT,
  `ss_teamplate_id` int(11) NOT NULL,
  `ss_name` text NOT NULL,
  `ss_schedule` varchar(100) NOT NULL,
  `ss_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ss_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_schedule`
--

INSERT INTO `sms_schedule` (`ss_id`, `ss_teamplate_id`, `ss_name`, `ss_schedule`, `ss_status`) VALUES
(3, 2, 'One', '1:1:1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_teamplate`
--

CREATE TABLE IF NOT EXISTS `sms_teamplate` (
  `teamplate_id` int(11) NOT NULL AUTO_INCREMENT,
  `teamplate_name` text DEFAULT NULL,
  `teamplate` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `default_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`teamplate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_teamplate`
--

INSERT INTO `sms_teamplate` (`teamplate_id`, `teamplate_name`, `teamplate`, `status`, `default_status`) VALUES
(2, 'Teamplate One', '%doctor_name%. Hello, %patient_name%. Your ID: %patient_id%, Appointment ID: %appointment_id%, Serial: %sequence% and Appointment Date: %appointment_date%. Thank you for the Appointment.', 1, 0),
(4, 'Teamplate Two', '%doctor_name%. Hello, %patient_name%. Your ID: %patient_id%, Appointment ID: %appointment_id%, Serial: %sequence% and Appointment Date: %appointment_date%. Thank you for the Appointment.', 1, 0),
(5, 'Default Template', '%doctor_name%. Hello, %patient_name%. Your ID: %patient_id%, Appointment ID: %appointment_id%, Serial: %sequence% and Appointment Date: %appointment_date%. Thank you for the Appointment.', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE IF NOT EXISTS `testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `title`, `details`, `create_by`, `post_date`, `picture`) VALUES
(1, 'Letraset sheets containing Lorem Ipsum passagesssss', '<p><span xss=\"removed\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum vulputate diam, aliquam egestas nibh ante vel dui. Sed in tellus interdum eros vulputate placerat sed non enim. Pellentesque eget justo porttitor urna dictum fermentum sit amet sed mauris. Praesent molestie vestibulum erat ac rhoncus. Aenean nunc risus, accumsan nec ipsum et, convallis sollicitudin dui. Proin dictum quam a semper malesuada. Etiam porta sit amet risus quis porta. Nulla facilisi. Cras at interdum ante. Ut gravida pharetra ligula vitae malesuada.</span><br></p>', 1, '2020-06-16', 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/blog/blog3.png'),
(2, 'Letraset sheets containing Lorem Ipsum', '<p><span xss=removed>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum vulputate diam, aliquam egestas nibh ante vel dui. Sed in tellus interdum eros vulputate placerat sed non enim. Pellentesque eget justo porttitor urna dictum fermentum sit amet sed mauris. Praesent molestie vestibulum erat ac rhoncus. Aenean nunc risus, accumsan nec ipsum et, convallis sollicitudin dui. Proin dictum quam a semper malesuada. Etiam porta sit amet risus quis porta. Nulla facilisi. Cras at interdum ante. Ut gravida pharetra ligula vitae malesuada.</span><br></p>', 1, '2020-06-16', 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/blog/blog4.png'),
(4, 'Letraset sheets containing Lorem Ipsum passagesssss', '<p><span xss=\"removed\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum vulputate diam, aliquam egestas nibh ante vel dui. Sed in tellus interdum eros vulputate placerat sed non enim. Pellentesque eget justo porttitor urna dictum fermentum sit amet sed mauris. Praesent molestie vestibulum erat ac rhoncus. Aenean nunc risus, accumsan nec ipsum et, convallis sollicitudin dui. Proin dictum quam a semper malesuada. Etiam porta sit amet risus quis porta. Nulla facilisi. Cras at interdum ante. Ut gravida pharetra ligula vitae malesuada.</span><br></p>', 1, '2020-06-24', 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/blog/blog5.png');

-- --------------------------------------------------------

--
-- Table structure for table `test_assign_for_patine`
--

CREATE TABLE IF NOT EXISTS `test_assign_for_patine` (
  `test_ass_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prescription_id` varchar(200) NOT NULL,
  `appointment_id` varchar(100) NOT NULL,
  `test_id` int(11) NOT NULL,
  `test_assign_description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`test_ass_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_assign_for_patine`
--

INSERT INTO `test_assign_for_patine` (`test_ass_id`, `prescription_id`, `appointment_id`, `test_id`, `test_assign_description`) VALUES
(1, '1', 'A20LQX30', 9, 'test'),
(2, '1', 'A20LQX30', 12, 'ss'),
(3, '2', 'A20IY68', 9, 'a'),
(4, '3', 'A2087TS', 13, 'test'),
(7, '6', 'A20CQLL', 9, 'aa'),
(8, '7', 'A207P78N', 12, 'a-t'),
(9, '7', 'A207P78N', 13, 'at'),
(10, '1', 'A20Z9TH', 27, ''),
(11, '1', 'A20Z9TH', 28, ''),
(12, '2', 'A20LG1G', 25, 'asdfasd'),
(13, '3', 'A20UK7Z', 27, ''),
(14, '3', 'A20UK7Z', 28, ''),
(15, '4', 'A20T58Q', 29, 'asdfasd'),
(16, '5', 'A20VRPQ', 27, ''),
(17, '5', 'A20VRPQ', 28, ''),
(18, '5', 'A20VRPQ', 6, ''),
(19, '6', 'A208SHI', 31, '[removed]alert&#40;\'aldskfa\'&#41;;[removed]');

-- --------------------------------------------------------

--
-- Table structure for table `test_name_tbl`
--

CREATE TABLE IF NOT EXISTS `test_name_tbl` (
  `test_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `test_name` varchar(200) NOT NULL,
  `test_description` varchar(250) NOT NULL,
  `test_type` varchar(20) DEFAULT NULL,
  `t_n_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_name_tbl`
--

INSERT INTO `test_name_tbl` (`test_id`, `test_name`, `test_description`, `test_type`, `t_n_status`) VALUES
(6, 'Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, 1),
(7, 'Lorem Ipsum is ', 'simply dummy text of the printing and typesetting industry.', NULL, 1),
(12, 'It is a long established', 'It is a long established fact that a reader will be distracted ', NULL, 1),
(13, 'the readable content', 'the readable content of a page when looking', NULL, 1),
(25, 'This is Test Name', 'This is Test Description', NULL, 1),
(27, 'x-ray ', 'Donec venenatis arcu aliquam erat condimentum, ac cursus neque ultricies.', NULL, 1),
(28, 'Blood test', 'Donec venenatis arcu aliquam erat condimentum, ac cursus neque ultricies.Donec venenatis arcu aliquam erat condimentum, ac cursus neque ultricies.', NULL, 1),
(29, 'asdf', 'doctor', NULL, 1),
(31, '[removed]alert&#40;\'aldskfa\'&#41;;[removed]', 'doctor', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE IF NOT EXISTS `users_tbl` (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_id` int(11) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `user_email` varchar(55) NOT NULL,
  `user_phone` varchar(15) DEFAULT NULL,
  `birth_date` varchar(55) DEFAULT NULL,
  `sex` varchar(55) DEFAULT NULL,
  `blood_group` varchar(12) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `venue_tbl`
--

CREATE TABLE IF NOT EXISTS `venue_tbl` (
  `venue_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `venue_name` text NOT NULL,
  `venue_contact` varchar(100) NOT NULL,
  `venue_address` text NOT NULL,
  `venue_map` text DEFAULT NULL,
  `create_id` int(11) NOT NULL,
  `venue_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`venue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venue_tbl`
--

INSERT INTO `venue_tbl` (`venue_id`, `venue_name`, `venue_contact`, `venue_address`, `venue_map`, `create_id`, `venue_status`) VALUES
(1, 'Demo Medical Collage', '89645456454', '1911 Clement , GA 30303 , Dhaka -1220', '   &lt;iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.6948459281284!2d90.41880131429853!3d23.82944789167036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c65cbecf4d41:0xbce2b71e1c301332!2sMannan Plaza!5e0!3m2!1sen!2sbd!4v1591596959273!5m2!1sen!2sbd\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"&gt;&lt;/iframe&gt;                                                                                                                                                                                                                                                            ', 0, 1),
(3, 'Green tower', '65485168451', '98 Green Road', '   &lt;iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.6948459281284!2d90.41880131429853!3d23.82944789167036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c65cbecf4d41:0xbce2b71e1c301332!2sMannan Plaza!5e0!3m2!1sen!2sbd!4v1591596959273!5m2!1sen!2sbd\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"&gt;&lt;/iframe&gt;                                                                                 ', 0, 1),
(4, 'Manan Tower', '56465644846', 'Khilkhet, dhaka-1229', '  &lt;iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.6948459281284!2d90.41880131429853!3d23.82944789167036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c65cbecf4d41:0xbce2b71e1c301332!2sMannan Plaza!5e0!3m2!1sen!2sbd!4v1591596959273!5m2!1sen!2sbd\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"&gt;&lt;/iframe&gt;  ', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_pages_tbl`
--

CREATE TABLE IF NOT EXISTS `web_pages_tbl` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `head_line` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_pages_tbl`
--

INSERT INTO `web_pages_tbl` (`id`, `name`, `details`, `sequence`, `date`, `icon`, `picture`, `head_line`, `status`) VALUES
(1, 'phone', '2335346456', NULL, NULL, NULL, NULL, NULL, 1),
(2, 'email', 'hotline@gmail.com', NULL, NULL, NULL, NULL, NULL, 1),
(3, 'facebook', 'https://www.facebook.com/', NULL, NULL, NULL, NULL, NULL, 1),
(4, 'twitter', 'https://twitter.com/?lang=en', NULL, NULL, NULL, NULL, NULL, 1),
(5, 'linkedin', 'https://www.linkedin.com/', NULL, NULL, NULL, NULL, NULL, 1),
(6, 'youtube', 'https://twitter.com/?lang=en', NULL, NULL, NULL, NULL, NULL, 1),
(7, 'google', 'https://plus.google.com/', NULL, NULL, NULL, NULL, NULL, 1),
(8, 'hotline', '+88 10751-194212 ', NULL, NULL, NULL, NULL, NULL, 1),
(9, 'working_des', 'Substract, allowing the most important elements to come forward. This results in simple yet sophisticated user experience and designs that we, and our clients, are ver Substract, allowing the most important elements to come forward. This results in simple yet sophisticated user experience and designs that we, and our clients, are ver                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ', NULL, NULL, NULL, NULL, NULL, 1),
(11, 'logo', NULL, NULL, NULL, NULL, 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/images/22.png', NULL, 1),
(12, 'about_img', NULL, NULL, NULL, NULL, 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/images/ttabou.png', NULL, 1),
(13, 'about_img', NULL, NULL, NULL, NULL, 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/images/ttabou.png', NULL, 1),
(14, 'about_img', NULL, NULL, NULL, NULL, 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/images/ttabou.png', NULL, 1),
(15, 'app_image', NULL, NULL, NULL, NULL, 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/images/appoin2.png', NULL, 1),
(16, 'google_map', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.6960669342925!2d90.41879721445734!3d23.829404491671724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8a4136c4b61%3A0x19549f5462616f04!2sBdtask%20-%20A%20Leading%20Software%20Company%20In%20Bangladesh!5e0!3m2!1sen!2sbd!4v1592993980275!5m2!1sen!2sbd\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ', NULL, NULL, NULL, NULL, NULL, 1),
(17, 'total_appointment_details', 'Lorem Ipsum is simply dummy text ofthe industry\'s standard', NULL, NULL, NULL, NULL, NULL, 1),
(18, 'today_appointment_details', 'Text Area  text ofthe industry\'s standard  Lorem Ipsum is si', NULL, NULL, NULL, NULL, NULL, 1),
(19, 'total_patient_details', 'Ipsum is simply dummy text ofthe industry\'s standard ', NULL, NULL, NULL, NULL, NULL, 1),
(20, 'address', '98 Green road, Farmgate, Dhaka-1215', NULL, NULL, NULL, NULL, NULL, 1),
(21, 'twitter_post', 'https://twitter.com/bdtask', NULL, NULL, NULL, NULL, NULL, 1),
(22, 'footer_picture', NULL, NULL, NULL, NULL, 'http://localhost/DOCTOR-VS1.5/./assets/uploads/images/doctor2.png', NULL, 1),
(23, 'website_on_off', 'on', NULL, NULL, NULL, NULL, NULL, 1),
(24, 'third_party_api', '', NULL, NULL, NULL, NULL, NULL, 1),
(25, 'copy_right', '<p>Developed By <a href=\"http://bdtask.com/\">BDtask</a></p>', NULL, NULL, NULL, NULL, NULL, 1),
(26, 'website_title', 'DoctoreSs', NULL, NULL, NULL, NULL, NULL, 1),
(35, 'timezone', 'Asia/Dhaka', NULL, NULL, NULL, NULL, NULL, 1),
(92, 'footer_picture', NULL, NULL, NULL, NULL, 'https://soft23.bdtask.com/doctor-new/./assets/uploads/images/logo.png', NULL, 1),
(93, 'footer_picture', NULL, NULL, NULL, NULL, 'https://soft23.bdtask.com/doctor-new/./assets/uploads/images/logo.png', NULL, 1),
(94, 'footer_picture', NULL, NULL, NULL, NULL, 'https://soft23.bdtask.com/doctor-new/./assets/uploads/images/logo.png', NULL, 1),
(95, 'fabicon', NULL, NULL, NULL, NULL, 'https://soft23.bdtask.com/doctor-new-main/./assets/uploads/images/dr-fav1.png', NULL, 1);

-- --------------------------------------------------------

--
-- Structure for view `action_serial`
--
DROP TABLE IF EXISTS `action_serial`;

CREATE VIEW `action_serial`  AS  select `appointment_tbl`.`id` AS `id`,`appointment_tbl`.`appointment_id` AS `appointment_id`,`appointment_tbl`.`patient_id` AS `patient_id`,`appointment_tbl`.`schedul_id` AS `schedul_id`,`appointment_tbl`.`date` AS `date`,`appointment_tbl`.`sequence` AS `sequence`,`appointment_tbl`.`venue_id` AS `venue_id`,`appointment_tbl`.`doctor_id` AS `doctor_id`,`appointment_tbl`.`problem` AS `problem`,`appointment_tbl`.`get_date_time` AS `get_date_time`,`appointment_tbl`.`get_by` AS `get_by`,`appointment_tbl`.`status` AS `status`,`schedul_setup_tbl`.`day` AS `day`,`schedul_setup_tbl`.`start_time` AS `start_time`,`schedul_setup_tbl`.`end_time` AS `end_time`,`schedul_setup_tbl`.`per_patient_time` AS `per_patient_time`,`schedul_setup_tbl`.`visibility` AS `visibility` from (`appointment_tbl` join `schedul_setup_tbl`) where `appointment_tbl`.`schedul_id` = `schedul_setup_tbl`.`schedul_id` and `schedul_setup_tbl`.`status` = '1' ;

