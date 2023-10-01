<?php
/**
 * Plugin Name: VA Disability Benefit Calculator
 * Plugin URI: https://therouteoptions.com
 * Description: VA Disability Benefit Calculator
 * Version: 1.0
 * Author: The Route Options
 * Author URI: https://therouteoptions.com
 */


/* Add css/js file */
function vdbc_enqueue() {
    wp_enqueue_style( 'vdbc-stye', plugins_url() . '/va-disability-benefit-calculator/main.css', array(),  time() );
    wp_enqueue_script('wcs-ajax-scripts', plugins_url() . '/va-disability-benefit-calculator/main.js', array('jquery'), time(), true);
    wp_localize_script( 'wcs-ajax-scripts', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ));       
}
add_action( 'wp_enqueue_scripts', 'vdbc_enqueue' );


/* Ajax request */
function submit_vdbc_request() {

    if ( isset($_POST) ) {

        if ( $_POST['lleg'] && $_POST['llegPer']) {
            foreach ($_POST['llegPer'] as $lleg) {
                $llegs[] .= $lleg['value'];
            }
            $llegSum = array_sum($llegs);
        } else {
            $llegs = array();
        } 

        if ( $_POST['rleg'] && $_POST['rlegPer']) {
            foreach ($_POST['rlegPer'] as $rleg) {
                $rlegs[] .= $rleg['value'];
            }
            $rlegSum = array_sum($rlegs);
        } else {
            $rlegs = array();
        }         

        if ( $_POST['larm'] && $_POST['larmPer']) {
            foreach ($_POST['larmPer'] as $larm) {
                $larms[] .= $larm['value'];
            }
            $larmSum = array_sum($larms);
        } else {
            $larms = array();
        }           


        if ( $_POST['rarm'] && $_POST['rarmPer']) {
            foreach ($_POST['rarmPer'] as $rarm) {
                $rarms[] .= $rarm['value'];
            }
            $rarmSum = array_sum($rarms);
        } else {
            $rarms = array();
        }        

        if ( $_POST['others'] && $_POST['otherPer']) {
            foreach ($_POST['otherPer'] as $other) {
                $others[] .= $other['value'];
            }
            $otherSum = array_sum($others);
        } else {
            $others = array();
        }

        if ( $_POST['child']) {
            $child = $_POST['child'];
        } else {
            $child = 0;
        }

        if ( $_POST['ElderChild']) {
            $elderChild = $_POST['ElderChild'];
        } else {
            $elderChild = 0;
        }  
        
        if ( $_POST['parents']) {
            $parents = $_POST['parents'];
        } else {
            $parents = 0;
        }

        if ( $_POST['married']) {
            $mStatus = $_POST['married'];
        } else {
            $mStatus = 0;
        } 

        if ( $_POST['maritalAA']) {
            $marAA = $_POST['maritalAA'];
        } else {
            $marAA = 0;
        }    
        
        require_once 'calculation.php';

        $data['bf'] = round($bf, 1);
        $data['total_com'] = round($final_tcr, 0);
        $data['monthly_comp'] = number_format($monthly_comp, 2);
        
        echo json_encode($data);
        die();
    }
}

add_action( 'wp_ajax_submit_vdbc_request', 'submit_vdbc_request' );
add_action( 'wp_ajax_nopriv_submit_vdbc_request', 'submit_vdbc_request' );


/* Shortcode pay calculator form*/
function vdbc_shortcode() {
    ob_start();
    ?>

<form id="vdbcFrm">
<div id="vdbc">
    <!-- title
    <div class="header">
        <h3>VA Disability Benefit Calculator</h3>
    </div>
    -->
    
    <div class="content">
        <!-- Left Content -->
        <div class="left_cont">

            <h3 class="add_header">Select the disability and the benefit % below<br>(Do this for each of your disabilities)</h3>
            <!-- Left Leg -->
            <div class="input_content lleg_content">
                <label class="container">Left Leg*
                  <input type="checkbox" name="lleg" class="vadis" id="lleg" value="1">
                  <span class="checkmark"></span>
                </label>
            
                <div class="selectWrap llegWrap">
                    <div style="margin-bottom: 5px;">
                    <select name="llegPer" id="llegPer" class="inputSelect llegPer">
                        <option value='0' selected="true">0%</option>
                        <?php 
                            for ($x = 1; $x <= 10; $x++) {
                              $val = $x*10;  
                              echo '<option value="'.$val.'">'.$val.'%</option>';
                            }
                        ?>
                    </select>
                    <a href="javascript:void(0);" class="add_button add_lleg_btn" title="Add field">
                        <img src="<?php echo plugin_dir_url( __DIR__ ).'/va-disability-benefit-calculator/add-icon.png'; ?>"/>
                    </a>                    
                    </div>
                </div>
            </div> 

            <!-- Right Leg -->
            <div class="input_content rleg_content">
                <label class="container">Right Leg*
                  <input type="checkbox" name="rleg" class="vadis" id="rleg" value="1">
                  <span class="checkmark"></span>
                </label>
            
                <div class="selectWrap rlegWrap">
                    <div style="margin-bottom: 5px;">
                    <select name="rlegPer" id="rlegPer" class="inputSelect rlegPer">
                        <option value='0' selected="true">0%</option>
                        <?php 
                            for ($x = 1; $x <= 10; $x++) {
                              $val = $x*10;  
                              echo '<option value="'.$val.'">'.$val.'%</option>';
                            }
                        ?>
                    </select>
                    <a href="javascript:void(0);" class="add_button add_rleg_btn" title="Add field">
                        <img src="<?php echo plugin_dir_url( __DIR__ ).'/va-disability-benefit-calculator/add-icon.png'; ?>"/>
                    </a>                     
                    </div>
                </div>
            </div>

            <!-- Left Arm -->
            <div class="input_content larm_content">
                <label class="container">Left Arm*
                  <input type="checkbox" name="larm" class="vadis" id="larm" value="1">
                  <span class="checkmark"></span>
                </label>
            
                <div class="selectWrap larmWrap">
                    <div style="margin-bottom: 5px;">
                        <select name="larmPer" id="larmPer" class="inputSelect larmPer">
                            <option value='0' selected="true">0%</option>
                            <?php 
                                for ($x = 1; $x <= 10; $x++) {
                                  $val = $x*10;  
                                  echo '<option value="'.$val.'">'.$val.'%</option>';
                                }
                            ?>
                        </select>
                        <a href="javascript:void(0);" class="add_button add_larm_btn" title="Add field">
                            <img src="<?php echo plugin_dir_url( __DIR__ ).'/va-disability-benefit-calculator/add-icon.png'; ?>"/>
                        </a>                          
                    </div>
                </div>
            </div> 

            <!-- Right Arm -->
            <div class="input_content rarm_content">
                <label class="container">Right Arm*
                  <input type="checkbox" name="rarm" class="vadis" id="rarm" value="1">
                  <span class="checkmark"></span>
                </label>
            
                <div class="selectWrap rarmWrap">
                    <div style="margin-bottom: 5px;">
                        <select name="rarmPer" id="rarmPer" class="inputSelect rarmPer">
                            <option value='0' selected="true">0%</option>
                            <?php 
                                for ($x = 1; $x <= 10; $x++) {
                                  $val = $x*10;  
                                  echo '<option value="'.$val.'">'.$val.'%</option>';
                                }
                            ?>
                        </select>
                        <a href="javascript:void(0);" class="add_button add_rarm_btn" title="Add field">
                            <img src="<?php echo plugin_dir_url( __DIR__ ).'/va-disability-benefit-calculator/add-icon.png'; ?>"/>
                        </a>                        
                    </div>
                </div>
            </div>            

            <?php echo "<input type='hidden' id='remImg' value='".plugin_dir_url( __DIR__ ).'/va-disability-benefit-calculator/remove-icon.png'."'>"; ?>
            <!-- Others -->
            <div class="input_content others_content">
                <label class="container">Other**
                  <input type="checkbox" name="others" class="others" id="others" value="1">
                  <span class="checkmark"></span>
                </label>
            
                <div class="selectWrap othersWrap">
                    <div style="margin-bottom: 5px;">
                    <select name="otherPer" id="otherPer" class="inputSelect otherPer">
                        <option value='0' selected="true">0%</option>
                        <?php 
                            for ($x = 1; $x <= 10; $x++) {
                              $val = $x*10;  
                              echo '<option value="'.$val.'">'.$val.'%</option>';
                            }
                        ?>
                    </select>
                    <a href="javascript:void(0);" class="add_other_btn add_button" title="Add field">
                        <img src="<?php echo plugin_dir_url( __DIR__ ).'/va-disability-benefit-calculator/add-icon.png'; ?>"/>
                    </a>
                    </div>
                </div>
            </div>            

        <p class="info_text">* Includes joints and nerves affecting the extremities. Examples include conditions such as arthritis, strains, sprains, radiculopathy, sciatic nerve, femoral nerve, cubital nerve, etc.</p>
        <p class="info_text">** Includes all conditions not involving joints and nerves. Examples include diabetes, mental health, skin, dental, stomach, sinus, headaches, cancer, lumbar and neck issues, etc.</p>
        </div>

        <!-- Right Content -->
        <div class="right_cont">

            <h3 class="add_header">Additional Payment Factors</h3>
            <div class="input_content">
                <label>No. of Dependent Child. Under the Age of 18</label>
                <span>
                    <select name="child" id="child" class="addSelect">
                        <option value='0' selected="true">None</option>
                        <?php 
                            for ($x = 1; $x <= 10; $x++) {
                              echo '<option value="'.$x.'">'.$x.'</option>';
                            }
                        ?>
                    </select>
                </span>
            </div>

            <div class="input_content">
                <label>No. of Dependent Child. Between the Age of 18 to 24</label>
                <span>
                    <select name="ElderChild" id="ElderChild" class="addSelect">
                        <option value='0' selected="true">None</option>
                        <?php 
                            for ($x = 1; $x <= 10; $x++) {
                              echo '<option value="'.$x.'">'.$x.'</option>';
                            }
                        ?>
                    </select>
                </span>
            </div>            

            <div class="input_content">
                <label>No. of Dependent Parents</label>
                <span>
                    <select name="parents" id="parents" class="addSelect">
                        <option value='0' selected="true">None</option>
                        <?php 
                            for ($x = 1; $x <= 2; $x++) {
                              echo '<option value="'.$x.'">'.$x.'</option>';
                            }
                        ?>
                    </select>
                </span>
            </div>

            <div class="input_content">
                <div class="marStatus">
                    <p>Marital Status</p> 
                    <label> 
                        <input type="radio" name="married" class="MarryInp" id="single" value="0" checked> Single &nbsp;
                    </label>  
                    <label>
                        <input type="radio" name="married" class="MarryInp" id="marry" value="1">
                        Married
                    </label>
                </div>
            </div>  

            <div class="input_content">
                <div id="maritalAA" class="marStatus">
                    <p>Does Your Spouse Need Aid and Attendance (A/A)?</p> 
                    <label> 
                        <input type="radio" name="maritalAA" class="MarryInp" id="maritalAA-no" value="0" checked> No &nbsp;
                    </label>  
                    <label>
                        <input type="radio" name="maritalAA" class="MarryInp" id="maritalAA-yes" value="1">
                        Yes
                    </label>
                </div>
            </div>              
         
        </div>        
    </div>
</div>

    <div class="vdbcResult" id="vdbcResult" align="center">
        <h3>Bilateral Factor: <span id="bf">0%</span></h3>
        <h3>Combined Disability: <span id="total_com">0%</span></h3>
        <h3>Total Monthly Compensation: <span id="monthly_comp">0.00</span></h3>
        <p class="info_text">Numbers are not legally binding.</p>        
    </div>    

    <div class="vdbc_btn" align="center">
        <input type="hidden" name="vdbcData" value='1'>
        <!-- <input type="submit" id="submit_vdbc" value="Submit"> -->
        <button type="submit" id="submit_vdbc">Submit</button>
        <button type="button" id="vdbc_reset">Reset All Factors</button>
    </div>

</form>
    <?php
    return ob_get_clean();
}

add_shortcode( 'vdbcalculator', 'vdbc_shortcode' );


