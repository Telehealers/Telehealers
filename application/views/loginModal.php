 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:10%">
          <div class="modal-dialog" style="vertical-align: middle;">
            <div class="modal-content">
              <!-- <div class="modal-header d-block">
              <h4 class="modal-title" id="myModalLabel">Login</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              </div> -->
              <div class="modal-body" style="background:#f9f9f9">
              <div class="bs-example">
            <ul id="myTab" class="nav nav-pills">
                <!-- <li class="nav-item">   
                    <a href="#home" class="nav-link active">Home</a>
                </li> -->
                
                <li class="nav-item">
                    <a href="#messages" id="regtab" class="nav-link" style="width:150px">Registration</a>
                </li>
                <li class="nav-item">
                    <a href="#profile" id="logtab" class="nav-link" style="width:150px">Login</a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- <div class="tab-pane fade show active" id="home">
                    <h4 class="mt-2">Home tab content</h4>
                    <p>Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui. Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                </div> -->
                <div class="tab-pane fade show active" id="profile">
                <div class="login-wrapper" style="background:#FFF;">

                    <div class="container-center">
                        <div class="panel panel-bd">

                        <?php
                            $exception = $this->session->flashdata('exception');
                            if(!empty($exception)){
                                     echo '<div class="alert alert-danger">
                                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>WOPS!</strong> '.html_escape($exception).'
                                  </div>';
                            }
                        ?>

                            <!-- <div class="panel-heading">
                                <div class="view-header">
                                    <div class="header-icon">
                                        <i class="pe-7s-unlock"></i>
                                    </div>
                                    <div class="header-title">
                                        <h3>Login</h3>
                                        <small><strong><?php echo display('login_title');?></strong></small>
                                    </div>
                                </div>
                            </div> -->

                            <?php
                                $result = $this->db->select('*')->from('web_pages_tbl')->where('name','footer_logo')->where('status',1)->get()->row();
                            ?>

                            <div class="panel-body" style="padding:8% 10% 2% 10%;background:#f9f9f9">
                                <?php
                                    $attributes = array('role'=>'form','id'=>'loginForm');
                                    echo form_open_multipart('authentication', $attributes);
                                ?>

                                        <div class="form-group">
        								    <div id="meserr" style="color:red;"></div>
                                            <input class="form-control" id="phone" placeholder="Mobile Number" name="phone" type="text" required pattern="[1-9]{1}[0-9]{9}" />
                                             <span class="text-danger"></span>
                                        </div>
        								<div class="form-group" id="otp_field" style="display:none;">
        								    <div id="meserr" style="color:red;"></div>
                                            <input class="form-control" id="otp" placeholder="Enter Otp" name="otp" type="text" required pattern="[1-9]{1}[0-9]{9}" />
                                             <span class="text-danger"></span>
                                        </div>
        								<div id="otpmess" style="color:green;"></div>
                                        <button type="button" id="sendOtp" class="btn btn-lg btn-success btn-block ">Send OTP</button>
        								<button type="button" id="login" style="display:none;" class="btn btn-lg btn-success btn-block">Login</button>
                                        <input type="hidden" id="base_url" value="<?php echo base_url()?>">
                                </form>
                            </div>
        					<span style="text-align:center;width: 100%;float: left;margin-top: 20px;"><a href="<?php echo base_url();?>">Go to site</a></span>
                        </div>
                    </div>
                </div>
                    <!-- <h4 class="mt-2">Profile tab content</h4>
                    <p>Vestibulum nec erat eu nulla rhoncus fringilla ut non neque. Vivamus nibh urna, ornare id gravida ut, mollis a magna. Aliquam porttitor condimentum nisi, eu viverra ipsum porta ut. Nam hendrerit bibendum turpis, sed molestie mi fermentum id. Aenean volutpat velit sem. Sed consequat ante in rutrum convallis. Nunc facilisis leo at faucibus adipiscing.</p> -->

                </div>
                <div class="tab-pane fade" id="messages">
                <div class="registration-wrapper" style="background:#FFF;">

            <div class="container-center">
                <div class="panel panel-bd">

                <?php
                    $exception = $this->session->flashdata('exception');
                    if(!empty($exception)){
                             echo '<div class="alert alert-danger">
                            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>WOPS!</strong> '.html_escape($exception).'
                          </div>';
                    }
                ?>

                    <!-- <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong><?php echo display('login_title');?></strong></small>
                            </div>
                        </div>
                    </div> -->

                    <?php
                        $result = $this->db->select('*')->from('web_pages_tbl')->where('name','footer_logo')->where('status',1)->get()->row();
                    ?>

                    <div class="panel-body" style="padding: 8% 10% 2% 10%;background:#f9f9f9">
                        <div class="row">
                            Please register to book an appointment
                        </div>    
                    <hr>
                        <?php
                            $attributes = array('name'=>'registerForm', 'id'=>"registerForm",'role'=>'form');
                            echo form_open_multipart('authentication', $attributes);
                        ?>

                                <div class="form-group">
                                    <div id="meserrReg" style="color:red;"></div>
                                    <input class="form-control" id="name" placeholder="Name" name="name" type="text" required  />
                                     <span class="text-danger"></span>
                                </div>
                                <!-- new input fields added -- abinash  -->
                                <div class="form-group">
                                    <div id="meserr" style="color:red;"></div>
                                    <input class="form-control" id="phone1" placeholder="Mobile Number" name="phone" title="Enter 10 digit mobile number" type="tel" required  pattern="[1-9]{1}[0-9]{9}"   />
                                     <span class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <div id="meserr" style="color:red;"></div>
                                    <input class="form-control" id="email" placeholder="Email" name="meail" type="text" required  />
                                     <span class="text-danger"></span>
                                </div>
                                <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div id="meserr" style="color:red;"></div>
                                    <input class="form-control" id="age" placeholder="Age" name="age" type="text" required  />
                                     <span class="text-danger"></span>
                                </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group d-flex" style="line-height:2.5">
                                    <div id="meserr" style="color:red;"></div>
                                    <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="M">
              <label class="form-check-label" for="inlineRadio1">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="F">
              <label class="form-check-label" for="inlineRadio2">Female</label>
            </div>
                                     <span class="text-danger"></span>
                                </div>
                                </div>
                                </div>
                                 <div class="form-group" id="otp_field1" style="display:none;">
                                 <div id="meserr1" style="color:red;"></div>
                                    <input class="form-control" id="otp1" placeholder="Enter Otp" name="otp" type="text" required pattern="[1-9]{1}[0-9]{9}" />
                                     <span class="text-danger"></span>
                                </div>

                                <!-- end of line -->
                <div id="otpmess1" style="color:green;"></div>
                <button type="button" id="register" class="btn btn-lg btn-success btn-block">Register</button>

                <button type="button" id="auth" class="btn btn-lg btn-success btn-block" style="display:none;">Authenticate</button>
                                <!-- <button type="button" id="sendOtp_register" class="btn btn-lg btn-success btn-block">Send OTP</button>
             -->
                                <input type="hidden" id="base_url" value="<?php echo base_url()?>">
                                <input type="hidden" id="registeringuser" value="">
                        </form>
                    </div>
            <span style="text-align:center;width: 100%;float: left;margin-top: 20px;"><a href="<?php echo base_url();?>">Go to site</a></span>
                </div>
            </div>
            </div>
                    </div>
                </div>

            </div>
                  </div>
                  <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div> -->
                </div>
              </div>
            </div>
