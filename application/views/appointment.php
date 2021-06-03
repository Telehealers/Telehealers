<?php
     date_default_timezone_set(@$info->timezone->details);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <link rel="icon" href="<?php echo (!empty(html_escape($info->fabicon->picture))?html_escape($info->fabicon->picture):null); ?>" type="image">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="<?php echo base_url();?>web_assets2/css/main.css">
	<link href="<?php echo base_url()?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>web_assets2/appointment/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url();?>web_assets2/appointment/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>web_assets2/appointment/css/calendar_style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<!--     <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"  crossorigin="anonymous"></script>
 -->
<!-- jQuery -->


 <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/js/intlTelInput.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"  crossorigin="anonymous"></script>

   <title><?php echo $meta_info[0]['page_title']; ?></title>
	<meta name="keywords" content="<?php echo $meta_info[0]['meta_keywords']; ?>">
	<meta name="description" content="<?php echo $meta_info[0]['meta_description']; ?>">
	<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Y9P95E4VWH');
</script>
	<script type="text/javascript">
/* var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/608c0bf662662a09efc3afa9/1f4hgtf3e';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})(); */
</script>
</head>
<?php
function GeraHash($qtd){
//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
$Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
$QuantidadeCaracteres = strlen($Caracteres);
$QuantidadeCaracteres--;
$Hash=NULL;
for($x=1;$x<=$qtd;$x++){
    $Posicao = rand(0,$QuantidadeCaracteres);
    $Hash .= substr($Caracteres,$Posicao,1);
}
return $Hash;
}
//Here you specify how many characters the returning string must have
$hello = GeraHash(5);
    
?>

<style>
    .owl-carousel .owl-item img{width:65%;}


    input.range {
  -webkit-appearance: none;
  bottom: -10px;
  position: relative;
  width: 100%;
  margin: 0;
  padding: 0;
  border: 0;
  background: transparent;
}

input.range:focus {
  outline: 0;
}
input.range::-moz-focus-outer {
  border: 0;
}

input.range::-webkit-slider-thumb {
  box-shadow: 1px 1px 1px black, 0px 0px 1px black;
  border: 0;
  height: 20px;
  width: 20px;
  border-radius: 50%;
  background: white;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -7.5px;
}

input.range::-moz-range-thumb {
  box-shadow: 1px 1px 1px black, 0px 0px 1px black;
  border: 0;
  height: 20px;
  width: 20px;
  border-radius: 50%;
  background: white;
  cursor: pointer;
}
input.range::-ms-thumb {
  box-shadow: 1px 1px 1px black, 0px 0px 1px black;
  border: 0;
  height: 20px;
  width: 20px;
  border-radius: 50%;
  background: white;
  cursor: pointer;
  height: 5px;
}

input.range::-webkit-slider-runnable-track {
  width: 100%;
  height: 5px;
  cursor: pointer;
  box-shadow: 1px 1px 1px rgba(0, 0, 0, 0), 0px 0px 1px rgba(13, 13, 13, 0);
  background: indigo;
  border-radius: 20px;
  border: 0;
}

input.range::-moz-range-track {
  width: 100%;
  height: 5px;
  cursor: pointer;
  box-shadow: 1px 1px 1px rgba(0, 0, 0, 0), 0px 0px 1px rgba(13, 13, 13, 0);
  background: indigo;
  border-radius: 20px;
  border: 0;
}

input.range::-ms-track {
  width: 100%;
  height: 5px;
  cursor: pointer;
  background: transparent;
  border-color: transparent;
  color: transparent;
}

input.range::-ms-fill-lower,
input.range::-ms-fill-upper {
  background: indigo;
  border: 0;
  border-radius: 40px;
  box-shadow: 1px 1px 1px rgba(0, 0, 0, 0), 0px 0px 1px rgba(13, 13, 13, 0);
}

.range__tick {
  fill: #a0a0a0;
}

.range__tick:first-child {
  -webkit-transform: translateX(2px);
  -moz-transform: translateX(2px);
  -ms-transform: translateX(2px);
  -o-transform: translateX(2px);
  transform: translateX(2px);
}
.range__tick:last-child {
  -webkit-transform: translateX(-3px);
  -moz-transform: translateX(-3px);
  -ms-transform: translateX(-3px);
  -o-transform: translateX(-3px);
  transform: translateX(-3px);
}

.range__field {
  border: 0;
}
#dLabel {
    width: 240px;
  height: 40px;
  border-radius: 4px;
  background-color: #fff;
  border: solid 1px #cccccc;
  text-align: left;
  padding: 7.5px 15px;
  color: #ccc;
  letter-spacing: 0.7px;
  /* margin-top: 25px; */


}

 /* .caret {
    float: right;
    margin-top: 9px;
    display: block;
  } */

.dropdown-menu {
  width: 240px;
  padding: 0;
  margin: 0;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.dropdown button:hover, .dropdown button:focus {
  border: none;
  outline: 0;
}

.dropdown.open button#dLabel {
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;

    box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.23);
  border: solid 1px #666;
   border-bottom: none;
}

.dropdown.open ul {
   box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.23);
  border: solid 1px #666;
  border-top: none;
  height: 200px;
  overflow-y: scroll;
}

.dropdown-menu li {

     line-height: 1.5;
  letter-spacing: 0.7px;
  color: #666;
    font-size: 14px;
  cursor: pointer;
  padding: 7.5px 15px;
  border-top: solid 1px #f3f3f3;



}

.dropdown-menu li:hover {
  background-color: #ccc;
}
.labelStyle{
  /* font-weight: 600; */
    font-size: 17px;
    /* color: #6c757d; */

    color: #5d5d5d;
}


/* style for buttons  */
@import url('https://fonts.googleapis.com/css?family=Nunito+Sans:400&display=swap');
/** base styles **/

/** button group styles **/
 .btn-group {
	 border-radius: 1rem;
	 /* box-shadow: -2.3px -2.3px 3.8px rgba(255, 255, 255, 0.2), -6.3px -6.3px 10.6px rgba(255, 255, 255, 0.3), -15.1px -15.1px 25.6px rgba(255, 255, 255, 0.4), -50px -50px 85px rgba(255, 255, 255, 0.07), 2.3px 2.3px 3.8px rgba(0, 0, 0, 0.024), 6.3px 6.3px 10.6px rgba(0, 0, 0, 0.035), 15.1px 15.1px 25.6px rgba(0, 0, 0, 0.046), 50px 50px 85px rgba(0, 0, 0, 0.07); */
   box-shadow : rgb(0 0 0 / 15%) 1.95px 1.95px 2.6px;
}
 .btn-group__item {
	 border: none;
	 min-width: 6rem;
	 padding: 1rem 2rem;
	 background-color: #eee;
	 cursor: pointer;
	 margin: 0;
	 box-shadow: inset 0px 0px 0px -15px rebeccapurple;
	 transition: all 300ms ease-out;
}
 .btn-group__item:last-child {
	 border-top-right-radius: 1rem;
	 border-bottom-right-radius: 1rem;
}
 .btn-group__item:first-child {
	 border-top-left-radius: 1rem;
	 border-bottom-left-radius: 1rem;
}
 .btn-group__item:hover, .btn-group__item:focus {
	 color: rebeccapurple;
	 box-shadow: inset 0px -20px 0px -15px rebeccapurple;
}
 .btn-group__item:focus {
	 outline: none;
}
 .btn-group__item:after {
	 content: '✔️';
	 margin-left: 0.5rem;
	 display: inline-block;
	 color: rebeccapurple;
	 position: absolute;
	 transform: translatey(10px);
	 opacity: 0;
	 transition: all 200ms ease-out;
}
 .btn-group__item--active:after {
	  content: '✔️';
   margin-left: 0.5rem;
   display: inline-block;
   color: rebeccapurple;
   position: absolute;
   transform: translatey(10px);
   opacity: 0;
   transition: all 200ms ease-out;

}

#outer {
   float: left;
   overflow: hidden;
   white-space: nowrap;
   display: inline-block;
 }

 #left-button {
   float: left;
   width: 30px;
   text-align: center;
 }

 #right-button {
   float: left;
   width: 30px;
   text-align: center;
 }

 a {
   text-decoration: none;
   font-weight: bolder;
   color: red;
 }

 #inner:first-child {
   margin-left: 0;
 }

 label {
   margin-left: 10px;
 }

 .hide {
   display: none;
 }

#outer {
  width : fit-content ;
}


/* body {
  font-family: tahoma;
  height: 100vh;
  background-image: url(https://picsum.photos/g/3000/2000);
  background-size: cover;
  background-position: center;
  display: flex;
  align-items: center;
} */

.our-team {
  padding: 5% 5% 5% 8%;
  margin-bottom: 30px;
  margin-left:10px;
  margin-right:10px;
  background-color: #eeeeee;
  box-shadow : rgb(0 0 0 / 15%) 1.95px 1.95px 2.6px;
  cursor: pointer;
  text-align: center;
  overflow: hidden;
  position: relative;
  border-radius: 8px;
}

.our-team .picture {
  display: inline-block;
  /* height: 130px; */
  width: 130px;
  margin-bottom: 50px;
  z-index: 1;
  position: relative;
}

.our-team .picture::before {
  content: "";
  width: 100%;
  height: 0;
  border-radius: 50%;
  background-color: #1369ce;
  position: absolute;
  bottom: 135%;
  right: 0;
  left: 0;
  opacity: 0.9;
  transform: scale(3);
  transition: all 0.3s linear 0s;
}


.our-team .picture::after {
  content: "";
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background-color: #1369ce;
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
}

.our-team .picture img {
  width: 100%;
  max-height:104px;
  height: auto;
  border-radius: 50%;
  transform: scale(1);
  transition: all 0.9s ease 0s;
}

.our-team:hover .picture img {
  box-shadow: 0 0 0 14px #f7f5ec;
  transform: scale(0.7);
}

.our-team .title {
  display: block;
  font-size: 15px;
  color: #4e5052;
  text-transform: capitalize;
}


</style>
<body>
  <?php $this->load->view('header.php')?>
    <div class="container" style="background: white;margin-top: 20px;margin-bottom: 20px;border-radius: 10px;box-shadow: 4px 5px 8px #ababab;">
    <div class="row" style="text-align:center; color:white;background:grey;border-top-left-radius: 8px;border-top-right-radius: 8px;padding:10px ;padding-left:100px;padding-right:100px">
    <div class="col-12">
    <h4>Book Appointment</h4>
    </div>
    </div>
    <?php   $attributes = array('class' => 'form-horizontal','role'=>'form');
            echo form_open_multipart('Appointment/confirmation', $attributes);
      ?>
    <div id="q_succ_msg" class="mt-3 alert alert-success" style="display:none"></div>

    <div class="row pt-4" style="margin-bottom: 20px;padding-left:2%;padding-right:2%">
    <div class="col-sm-12 col-md-4 col-lg-4">
    <div class="dropdown display-flex" >
  <button id="dLabel" class="dropdown-select float-right" style="width:100%; text-align:center;" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Select Language<span class="caret" id="language" style="float: right"></span></button>
  <ul class="dropdown-menu" id=""style="height: 200px;overflow: auto;" aria-labelledby="dLabel">
    <?php if(is_array($language_arr) && count($language_arr)>0){
                                        foreach($language_arr as $val){
                                           ?>
    <li ><?php echo $val;?></li>
    <?php }}?>
  </ul>
</div>
</div>
    <div class="col-sm-12 col-md-4 col-lg-4" >
    <div class="form-group" style="margin-bottom: 0;padding-top: 4px;padding-left:6%;padding-right:6%; ">
            <div class='input-group date' id='datepicker'>
               <input type='text' name="p_date" id="p_date"class="form-control" value="<?php echo date("Y-m-d");?>" />
               <span class="input-group-addon">
               </span>
            </div>
         </div>
    </div> 
    <div class="col-sm-12 col-md-4 col-lg-4" style="display:flex;margin-top: 1%;" id="">
        <div class="form-check" style="margin-left:30px">
          <input class="form-check-input" type="radio" name="flexRadioDefault" value="covid" id="flexRadioDefault1" checked>
          <label class="form-check-label pl-4" for="flexRadioDefault1">Covid</label>
      </div>
  <div class="form-check" style="margin-left:30px">
        <input class="form-check-input" type="radio" name="flexRadioDefault" value="non_covid" id="flexRadioDefault2" >
        <label class="form-check-label pl-4" for="flexRadioDefault2">Non-Covid</label>
  </div>

    </div>
    </div>
    <div class="row mb-3" style="padding-left:2%;padding-right:2%">
    <div class="col-sm-12 col-md-12 col-lg-12">
    <div>
    <h1 for="customRange3" class="form-label labelStyle" style="margin-top: 0;">Book Time Slot</h1>
    <fieldset class="range__field" id="time_hour" value="10">
   <input class="range" type="range" min="-2" max="10" value="-2">
   <svg role="presentation" width="100%" height="10" xmlns="http://www.w3.org/2000/svg">
      <rect class="range__tick" x="0%" y="3" width="1" height="10"></rect>
      <rect class="range__tick" x="8.3%" y="3" width="1" height="10"></rect>
      <rect class="range__tick" x="16.6%" y="3" width="1" height="10"></rect>
      <rect class="range__tick" x="24.9%" y="3" width="1" height="10"></rect>
      <rect class="range__tick" x="33.2%" y="3" width="1" height="10"></rect>
      <rect class="range__tick" x="41.5%" y="3" width="1" height="10"></rect>
      <rect class="range__tick" x="49.8%" y="3" width="1" height="10"></rect>
      <rect class="range__tick" x="58.1%" y="3" width="1" height="10"></rect>
      <rect class="range__tick" x="66.4%" y="3" width="1" height="10"></rect>
      <rect class="range__tick" x="74.7%" y="3" width="1" height="10"></rect>
      <rect class="range__tick" x="83%" y="3" width="1" height="10"></rect>
      <rect class="range__tick" x="91.3%" y="3" width="1" height="10"></rect>
      <rect class="range__tick" x="99.6%" y="3" width="1" height="10"></rect>


   </svg>
   <svg role="presentation" width="100%" height="14" xmlns="http://www.w3.org/2000/svg">
      <text class="range__point" x="0%" y="14" text-anchor="start">10</text>
      <text class="range__point" x="8.3%" y="14" text-anchor="middle">11</text>
      <text class="range__point" x="16.6%" y="14" text-anchor="middle">12</text>
      <text class="range__point" x="24.9%" y="14" text-anchor="middle">1</text>
      <text class="range__point" x="33.2%" y="14" text-anchor="middle">2</text>
      <text class="range__point" x="41.5%" y="14" text-anchor="middle">3</text>
      <text class="range__point" x="49.8%" y="14" text-anchor="middle">4</text>
      <text class="range__point" x="58.1%" y="14" text-anchor="middle">5</text>
      <text class="range__point" x="66.4%" y="14" text-anchor="middle">6</text>
      <text class="range__point" x="74.7%" y="14" text-anchor="middle">7</text>
      <text class="range__point" x="83%" y="14" text-anchor="end">8</text>
      <text class="range__point" x="91.3%" y="14" text-anchor="middle">9</text>
      <text class="range__point" x="99.6%" y="14" text-anchor="end">10</text>
   </svg>
</fieldset>
    </div>
    </div></div>
        <div class="row mt-4" style="padding-left:2%;padding-right:2%">
 <div class="col-sm-12 col-md-6 col-lg-6">
    <div class="btn-group"id="minute" role="group" aria-label="Basic example">
  <button type="button" id="btn1" class="btn btn-secondary">0:00</button>
  <button type="button" class="btn btn-secondary">0:15</button>
  <button type="button" class="btn btn-secondary">0:30</button>
  <button type="button" class="btn btn-secondary">0:45</button>
</div>

    </div>
    <div class="col-sm-12 col-md-3 col-lg-2" style="">
    <div class="btn-group" role="group"  id="meredium" aria-label="Basic example">
  <button type="button" id="ambtn" class="btn btn-secondary">A M</button>
  <button type="button" class="btn btn-secondary">P M</button>

</div>
    </div>

    <div class="col-sm-12 col-md-3 col-lg-4">

<h1 for="customRange3" id="time" class="form-label labelStyle" style="margin-bottom: 0 !important;margin-top:0px;padding-top: 5px;"></h1>


    </div></div>
    
    <div class="row mb-3" id="department_type" style="display:none;padding-left:2%;padding-right:2%">

    <div class="col-sm-12 col-md-12 col-lg-12">
    <h1 for="customRange3" class="form-label labelStyle mb-4 mt-4" style="margin-top:0%">Departments</h1>
    <div class="btn-group" id="elem" style="width:inherit;height:40px !important;display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-content: space-between;
    justify-content: center;
    align-items: center;
">
         <?php if(is_array($services) && count($services)>0){
                //var_dump($departments);

                foreach($services as $val){
                    if($val['id']>1){
                        ?><button type="button"class="btn-group__item btn-group__item" value="<?php echo $val['id']?>">
                            <?php echo $val['servicetype'];
                                           ?></button><?php }}} ?>
   </div>
    </div>
    </div>

    <div class="row" style="padding-left:2%;padding-right:2%">
    <div class="col-sm-12 col-md-12 col-lg-12">
    <h1 for="customRange3" class="form-label labelStyle mb-3" >Consultants</h1>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url()?>">
        <input type="hidden" name="sequence" id="sequence" value="">
        <input type="hidden" name="p_id" id="p_id" value="P21MFI6Q">
        <input type="hidden" name="doctor_id" id="doctor_id" >
        <input type="hidden" name="servicetype_id" id="servicetype_id" >
    </div>
    </div>
    <div class="container" style="padding:0px;height: 500px;overflow-y: auto;overflow-x: hidden;width: auto;">
  <div class="row"  id="docs" style="padding-left:2%;padding-right:2%">

    </div>
    </div>
    <div class="container-fluid" style="padding-left:2%;padding-right:2%">
    <div class="col-md-10 col-sm-10 col-lg-11 "></div>
    <div class="col-md-2 col-sm-2 col-lg-1">

    </div>


    <div class="form-group row">
          <div class="col-sm-offset-3 col-sm-6">

          </div>
      </div>
    </div>
    <div class="row" style="padding: 10px;background: #f3f3f3;box-shadow: 0px -4px 5px #cac3c3ad;">
  <div class="col-12">
  <div style="float:right">
<button type="submit"  class="btn btn-success" style="width: 200px;height: 50px;font-size: 25px;background: #393f7d;"><?php echo display('submit')?></button>
</div>
  </div>
  </div>

  </div>

</div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Save changes</button>
    </div>
</div>></form>
<script>
var servicetype='';
function getDoctors(language,date,hour,min,am_pm,servicetype){
    $('#docs')[0].textContent='';
    $('#my-modal').modal({show: 'false'});
    var base_url=$('#base_url').val();
    $.ajax({
    url:base_url+'index.php/Appointment/getdoctorforappointment',
    method: 'post',
    data: {servicetype_id:servicetype,preferred_language:language,booking_date:date,booking_hour:hour,booking_minute:min,booking_am_pm:am_pm},
    type: 'POST',
    success: function(response){
      $('#docs').prepend(response);
    }
  });
}
function cleanHours(originalVal){
  originalVal=parseInt(originalVal)
 if(originalVal<=0){
      originalVal+=12;
    }
  return originalVal
}
date_today=new Date();
function fetchTime(date,hour, minute,am_pm,language){

  date = date ? date : $('#datepicker').datepicker('getFormattedDate');
  date_cool = new Date(date);
  hour = hour ? hour : cleanHours($('#time_hour')[0].elements[0].value);
  minute= minute ? minute: $('#minute .active').text().substr(2,4);
  am_pm=am_pm? am_pm : ($('#meredium .active').text()).replace(/\s/g, "");
  date_time = date_cool.toDateString()+" "+hour+":"+minute+" "+am_pm;
  selected_dt = new Date(date_time);
  document.getElementById("time").innerHTML = date_time;
  $("#sequence").val(hour+":"+minute+" "+am_pm);
  time=hour+":"+minute+" "+am_pm;
  console.log(selected_dt.toString(),date_today.toString());
  if(selected_dt.getTime()< date_today.getTime()){
        $('#docs')[0].textContent='';
         return; 
  }


  language=language?language:$('#dLabel').text()

  //console.log(language);
  if(language=='Select Language'){
    language='';
  }

  if($('input:radio[id^="flexRadioDefault"]')[0].checked){
    servicetype='1'; // default dept general dept / general physician , needs to be checked with db
  }
  else if($('input:radio[id^="flexRadioDefault"]')[1].checked & !servicetype){
      $('#q_succ_msg').html('select a department to view doctors');
      $('#q_succ_msg').show();
  }

  if(servicetype){
    $('#q_succ_msg').hide();
    $('#servicetype').val(servicetype);
    getDoctors(language,date,hour,minute,am_pm,servicetype);
  }

}
$(document).ready(function(){

// $('#minute button').click(function(){
//     console.log('hello');
// });
  $("#datepicker").datepicker(
{format: "yyyy-mm-dd",
startDate: new Date()
});

$('#btn1').ready(function(){
  $('#btn1').addClass("active");
});
$('#ambtn').ready(function(){
  $('#ambtn').addClass("active");
});

$('#datepicker').on('changeDate',function(e) {
    var date=($('#datepicker').datepicker('getFormattedDate'));
    fetchTime(date);
    $('#p_date').val(date);
    console.log($('#p_date').val());

  });

$('#dLabel ').on('DOMNodeInserted',function(e){
    var language=e.target.innerHTML;
    //console.log(language);
  fetchTime(null,null,null,null,language,null);

});



$('#time_hour').on('change', function(ev){
    var hour = cleanHours(parseInt(ev.target.value));
    fetchTime(null,hour,null,null,null,null);

});

$('#meredium button').on('click',function(e){

  $(this).addClass("active").siblings().removeClass("active");
  fetchTime();

});

$('#minute button').on('click',function(e){
  var minute=(e.target.innerHTML).substr(2, 4)
  $(this).addClass("active").siblings().removeClass("active");
  fetchTime();

});
$('#elem').on('click',function(e){
  servicetype=(e.target.value);
  getTime();

});
$('#docs').on('click',function(event){
      var docid = event.target.getAttribute("data-value");
       console.log('docid',docid);
       $('#doctor_id').val(docid);
});



$('#p_name').keypress(function (e) {
  var charLength = $(this).val().length;
  var regex = new RegExp("^[a-zA-Z ]+$");
  var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
  if (regex.test(strigChar)) {
    if(charLength < 21){
    return true;
    }
  }
  return false;
});
function changeCall(ev){
  console.log("ev",ev)
}
$(document).on('click', 'input:radio[id^="flexRadioDefault"]', function(event) {
  console.log("event clicked",event.target.value);
  var queryType = event.target.value;
  var base_url = $('#base_url').val();

  if(queryType == "covid"){
  // department_type
  document.getElementById('services').style.display = 'none';


  }

  if(queryType == "non_covid"){
    $('#docs')[0].textContent='';

  document.getElementById('services').style.display = 'block';


}
});

$(function() {
       var print = function(msg) {
         alert(msg);
       };

       var setInvisible = function(elem) {
         elem.css('visibility', 'hidden');
       };
       var setVisible = function(elem) {
         elem.css('visibility', 'visible');
       };

       var elem = $("#elem");
       var items = elem.children();

       // Inserting Buttons
       elem.prepend('<div class="col-sm-1 col-md-1 col-lg-1"><div id="right-button" style="visibility: hidden;font-size:30px;color: #4c0082;font-weight: 900;"><</div></div>');
       elem.append('<div class="col-sm-1 col-md-1 col-lg-1">  <div id="left-button" style="font-size:30px;color: #4c0082;font-weight: 900;">></div>');

//       Inserting Inner
       items.wrapAll('<div id="inner" />');

       // Inserting Outer

       elem.find('#inner').wrap('<div class="col-sm-10 col-md-10 col-lg-10"id="outer"/>');

       var outer = $('#outer');

       var updateUI = function() {
         var maxWidth = outer.outerWidth(true);
         var actualWidth = 0;
         $.each($('#inner >'), function(i, item) {
           actualWidth += $(item).outerWidth(true);
         });

         if (actualWidth <= maxWidth) {
           setVisible($('#left-button'));
         }
       };
       updateUI();


       // $('#dLabel').on('change',function(){
       //  debugger;
       //  alert(this.value);
       // })

       $('#right-button').click(function() {
         var leftPos = outer.scrollLeft();
         outer.animate({
           scrollLeft: leftPos - 200
         }, 800, function() {

           if ($('#outer').scrollLeft() <= 0) {
             setInvisible($('#right-button'));
           }
         });
       });

       $('#left-button').click(function() {
         setVisible($('#right-button'));
         var leftPos = outer.scrollLeft();
         outer.animate({
           scrollLeft: leftPos + 200
         }, 800);
       });

       $(window).resize(function() {
         updateUI();
       });
     });


const buttons = document.querySelectorAll(".btn-group__item");
buttons.forEach(button => {
  button.addEventListener("click",(e) => {
    // do some action according to button

    // show success feedback
    $(this).addClass("btn-group__item--active").siblings().removeClass("btn-group__item--active");

  })
})
const docs = document.querySelectorAll(".our-team");
docs.forEach(button => {
  button.addEventListener("click",(e) => {
    // do some action according to button
    // show success feedback
    $(this).addClass("btn-group__item--active").siblings().removeClass("btn-group__item--active");

  })
})


$('.dropdown-menu li').on('click', function() {
  var getValue = $(this).text();
  $('.dropdown-select').text(getValue);
});

$('#p_phone').keypress(function (e) {
  var charLength = $(this).val().length;
  if(charLength < 10){
    return true;
  }else{
    return false;
  }
});



$("#p_phone").keypress (function (event) {
      if ((event.which < 32) || (event.which > 126)) return true;
      return jQuery.isNumeric ($(this).val () + String.fromCharCode (event.which));
  });

$('#contact_us').click(function(){
  var full_name    = $('#full_name').val();
  var email_id     = $('#email_id').val();
  var subject      = $('#subject').val();
  var message      = $('#message').val();
  var captchdas    = '<?php echo $hello; ?>';
  var captcha_code = $('#captcha_code').val();
  var base_url = $('#base_url').val();
  var msg = '';

  if(full_name==""){
    msg += 'Please enter full name.<br>';
  }
  if(email_id==""){
    msg += 'Please enter email ID.<br>';
  }else{
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
          if(email_id.match(mailformat))
          {}else{
              msg += 'You have entered an Invalid Email ID.<br>';
          }
  }
  if(subject==""){
    msg += 'Please enter subject.<br>';
  }
  if(message==""){
    msg += 'Please enter your message.<br>';
  }
  if(captcha_code==""){
    msg += 'Please enter captcha code.<br>';
  }
  else{
    if(captchdas != captcha_code){
      msg += 'Please enter a valid captcha code.<br>';
    }
  }
  if(msg!=""){
          $('#q_succ_msg').hide();
          $('#q_show_error').show();
          $('#q_succ_msg').html('');
          $('#q_show_error').html(msg);
      }else{
    $('#q_show_error').hide();
    $('#q_succ_msg').show();
    $('#q_succ_msg').html('Please wait...');
    $.ajax({
      url:base_url+'index.php/Welcome/contactEmail',
      method: 'post',
      data: {full_name:full_name, email_id:email_id, subject:subject, message:message},
      type: 'POST',
      success: function(response){
        //$('#q_succ_msg').html('Your details has been submited successfully.');
        $('#full_name').val('');
        $('#email_id').val('');
        $('#subject').val('');
        $('#message').val('');
        $('#captcha_code').val('');
        $('#q_succ_msg').html(response);
      }
    });
      }

});

$(document).on('click', '.dropdown-menu li a', function() {
    $('#datebox').val($(this).html());
});
  $(document).on("click","#add_service", function(){
  var services =	$('input[name="service"]:checked').val();
  var base_url = $('#base_url').val();
//	$('.multi_step_form .book_popup_11').remove();
  if(services==""){
    alert("Please select service first");
    return false;
  }
  if(services=="Covid Consultancy"){
  //	var getHtml = $('#userdiv').html();
  //	$(getHtml).insertAfter('#book_popup_2');
  }else{
  //	$('.multi_step_form .book_popup_11').remove();
  }
  $.ajax({
    url:base_url+'index.php/Welcome/getservicetype',
    method: 'post',
    data: {services:services},
    type: 'POST',
    success: function(response){
      //alert(response);
      $('#service_type').html(response);
    }
  });
  $('#service1').val(services);
});


$(document).on("click","#add_servicetype", function(){
  var servicestype =	$('input[name="servicetype"]:checked').val();
  var base_url = $('#base_url').val();
  var lang_set_val =	$('#service3').val();

  $('#service2').val(servicestype);
  //alert(lang_set_val)
  if(servicestype==""){
    alert("Please select service type first");
    return false;
  }
  /* $.ajax({
    url:'http://telehealers.in/index.php/Welcome/getservicetypedoctor',
    method: 'post',
    data: {servicestype:servicestype},
    type: 'POST',
    success: function(response){
      alert(response);
      $('#service_type').html(response);
    }
  }); */
  $.ajax({
    url:base_url+'index.php/Welcome/getdoctorforappointment',
    method: 'post',
    data: {servicestype:servicestype,lang_set_val:lang_set_val},
    type: 'POST',
    success: function(response){
      //alert(response);
      $('#book_popup_5 .doctors_list').html(response);

    }
  });
});


$(document).on("click","#app_type", function(){

});

  $(document).on("click",".add_patient2", function(){
    $('.multi_step_form .book_popup_4').remove();
  var p_type =	$('input[name="p_type"]:checked').val();
  //alert(p_type);
  if(p_type == 1){
    var getHtml = $('#patient_type').html();
    $(getHtml).insertAfter('#book_popup_11');
  }
  if(p_type == 2){
    $('.multi_step_form .book_popup_4').remove();
  }
});

$(document).on("change","#p_email",function(){
    setSlot();
});
$(document).on("change","#p_email_old",function(){
  var email = $(this).val();
  base_url = $('#base_url').val();
  $.ajax({
    url:base_url+'index.php/Welcome/getPatientDetails',
    method: 'post',
    data: {email:email},
    type: 'POST',
    success: function(response){
      //alert(response);
      if(response!=""){
          if(response==1){
              $('#email_msg').html('<span style="color:red;float:left;">This email ID already Used!</span><span style="color:green;float:right;cursor:pointer;font-size:10px;" onclick="setfields()">To change in existing details like age, name, sex, click here</span>');
              $('#bb_app').hide();

          }else if(response==2){
              $('#email_msg').html('<span style="color:red;float:left;">This email ID already Used!</span><span style="color:green;float:right;cursor:pointer;font-size:10px;" onclick="setfields()">To change in existing details like age, name, sex, click here</span>');
              $('#bb_app').hide();

          }else{
              $('#bb_app').show();
            var p_data = response.split(',');
            var p_name = p_data[0];
            var p_phone = p_data[1];
            var p_sex = p_data[2];
            var p_age = p_data[3];
            $('#p_name').val(p_name);
            $('#p_name').attr("disabled", true);
            $('#p_phone').val(p_phone);
            $('#p_phone').attr("disabled", true);
            $('#p_gender').val(p_sex);
            $('#p_gender').attr("disabled", true);
            $('#p_age').val(p_age);
            $('#p_age').attr("disabled", true);
            $('#email_msg').html('<span style="color:red;float:left;">Existing Patient</span><span style="color:green;float:right;cursor:pointer;font-size:10px;" onclick="setfields()">To change in existing details like age, name, sex, click here</span>');
            $('#p_date').focus();
            $('#existing_user').val(1);
          }
      }else{
          $('#bb_app').show();
        //$('#p_name').val('');
        $('#p_phone').val('');
        $('#p_gender').val('');
        $('#p_age').val('');
        $('#p_name').attr("disabled", false);
        $('#p_phone').attr("disabled", false);
        $('#p_gender').attr("disabled", false);
        $('#p_age').attr("disabled", false);
        $('#email_msg').html('<span style="color:green;float:left;">New Patient</span>');
        $('#existing_user').val(0);
      }
      //$('#book_popup_5 .doctors_list').html(response);

    }
  });
});
$( ".datepicker3" ).datepicker({ minDate: 0});
// $('.datepicker').datepicker({
// format: 'dd-mm-yyyy',
// autoclose: true,
// startDate: '0d'
// });

$('.cell').click(function(){
$('.cell').removeClass('select');
$(this).addClass('select');
});
});

$( document ).ajaxComplete(function() {
//verificationForm();
var current_fs, next_fs, previous_fs; //fieldsets
      var left, opacity, scale; //fieldset properties which we will animate
      var animating; //flag to prevent quick multi-click glitches



/*$(".add_patient2").click(function () {
  var p_type =	$('input[name="p_type"]:checked').val();
  //alert(p_type);
  if(p_type == 1){
    var getHtml = $('#patient_type').html();
    $(getHtml).insertAfter('#book_popup_11');
  }
  if(p_type == 2){
    $('.multi_step_form .book_popup_4').remove();
  }
});
*/





  $(document).on("click",".next1", function(){
          if (animating) return false;
          animating = true;

          current_fs = $(this).parent();
          next_fs = $(this).parent().next();

          //activate next step on progressbar using the index of next_fs
          $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

          //show the next fieldset
          next_fs.show();
          //hide the current fieldset with style
          current_fs.animate({
              opacity: 0
          }, {
              step: function (now, mx) {
                  //as the opacity of current_fs reduces to 0 - stored in "now"
                  //1. scale current_fs down to 80%
                  scale = 1 - (1 - now) * 0.2;
                  //2. bring next_fs from the right(50%)
                  left = (now * 50) + "%";
                  //3. increase opacity of next_fs to 1 as it moves in
                  opacity = 1 - now;
                  current_fs.css({
                      'transform': 'scale(' + scale + ')',
                      'position': 'absolute'
                  });
                  next_fs.css({
                      'left': left,
                      'opacity': opacity
                  });
              },
              duration: 600,
              complete: function () {
                  current_fs.hide();
                  animating = false;
              },
              //this comes from the custom easing plugin
              easing: 'easeInOutBack'
          });
      });

  $(document).on("click",".previous_button", function(){
    $('#message_id').html('');
  });
  $(document).on("click",".previous_button1", function(){
          if (animating) return false;
          animating = true;



          current_fs = $(this).parent();
          previous_fs = $(this).parent().prev();

          //de-activate current step on progressbar
          $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

          //show the previous fieldset
          previous_fs.show();
          //hide the current fieldset with style
          current_fs.animate({
              opacity: 0
          }, {
              step: function (now, mx) {
                  //as the opacity of current_fs reduces to 0 - stored in "now"
                  //1. scale previous_fs from 80% to 100%
                  scale = 0.8 + (1 - now) * 0.2;
                  //2. take current_fs to the right(50%) - from 0%
                  left = ((1 - now) * 50) + "%";
                  //3. increase opacity of previous_fs to 1 as it moves in
                  opacity = 1 - now;
                  current_fs.css({
                      'left': left
                  });
                  previous_fs.css({
                      'transform': 'scale(' + scale + ')',
                      'opacity': opacity
                  });
              },
              duration: 600,
              complete: function () {
                  current_fs.hide();
                  animating = false;
              },
              //this comes from the custom easing plugin
              easing: 'easeInOutBack'
          });
      });
 
  $(".submit").click(function () {
    $('#myModal').modal('show');
          // return false;
      })

});
</script>
<?php $this->load->view('footer');?>
</body>
</html>
