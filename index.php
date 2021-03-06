<?php

require 'header.php';

$first = isset($_POST['first']) && !empty($_POST['first']) ? $_POST['first'] : null;
$last = isset($_POST['last']) && !empty($_POST['last']) ? $_POST['last'] : null;
$q1 = isset($_POST['q1']) && !empty($_POST['q1']) ? $_POST['q1'] : null;
$q2 = isset($_POST['q2']) && !empty($_POST['q2']) ? $_POST['q2'] : null;
$q3 = isset($_POST['q3']) && !empty($_POST['q3']) ? $_POST['q3'] : null;
$q4 = isset($_POST['q4']) && !empty($_POST['q4']) ? $_POST['q4'] : null;
$q5 = isset($_POST['q5']) && !empty($_POST['q5']) ? $_POST['q5'] : null;
$ph = isset($_POST['ph']) && !empty($_POST['ph']) ? $_POST['ph'] : null;
$email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : null;
$emcon = isset($_POST['emcon']) && !empty($_POST['emcon']) ? $_POST['emcon'] : null;
$emph = isset($_POST['emph']) && !empty($_POST['emph']) ? $_POST['emph'] : null;
$emr = isset($_POST['emr']) && !empty($_POST['emr']) ? $_POST['emr'] : null;
$sigdata = isset($_POST['sigdata']) && !empty($_POST['sigdata']) ? $_POST['sigdata'] : null;

$submit_success = false;
$have_any_data = false;

if(
    $first != null &&
    $last != null &&
    $q1 != null &&
    $q2 != null &&
    $q3 != null &&
    $q4 != null &&
    $q5 != null &&
    $ph != null &&
    $email != null &&
    $emcon != null &&
    $emph != null &&
    $emr != null &&
    $sigdata != null
) {
    //WE HAVE DATA

    require 'password.php';
    $conn = mysqli_connect($mysqlHost, $mysqlUser, $mysqlPass, $mysqlDB);
    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
        exit;
    }

    //echo 'Connected successfully';
    //echo "Hello\n";
    //var_dump($_GET);
    // hah security, what's that.
    $sql = "INSERT INTO waiver_data (fname, lname, assent1, assent2, assent3, assent4, assent5, phone, email, ec_name, ec_phone, ec_relate, signature) VALUES ('" .
    mysqli_real_escape_string($conn, $first) . "','" .
    mysqli_real_escape_string($conn, $last) . "'," .
    mysqli_real_escape_string($conn, $q1) . "," .
    mysqli_real_escape_string($conn, $q2) . "," .
    mysqli_real_escape_string($conn, $q3) . "," .
    mysqli_real_escape_string($conn, $q4) . "," .
    mysqli_real_escape_string($conn, $q5) . ",'" .
    mysqli_real_escape_string($conn, $ph) . "','" .
    mysqli_real_escape_string($conn, $email) . "','" .
    mysqli_real_escape_string($conn, $emcon) . "','" .
    mysqli_real_escape_string($conn, $emph) . "','"    .
    mysqli_real_escape_string($conn, $emr) . "','" .
    mysqli_real_escape_string($conn, $sigdata) . "')";
    //echo $sql;

    if ($conn->query($sql) === TRUE) {
        $submit_success = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }

    $conn->close();
}

//We submitted, clear data so we don't put it back in form
if($submit_success) {
    $first = null;
    $last = null;
    $q1 = null;
    $q2 = null;
    $q3 = null;
    $q4 = null;
    $q5 = null;
    $ph = null;
    $email = null;
    $emcon = null;
    $emph = null;
    $emr = null;
    $sigdata = null;
}

$have_any_data =
    $first != null ||
    $last != null ||
    $q1 != null ||
    $q2 != null ||
    $q3 != null ||
    $q4 != null ||
    $q5 != null ||
    $ph != null ||
    $email != null ||
    $emcon != null ||
    $emph != null ||
    $emr != null ||
    $sigdata != null;
?>
<div data-role='page' id='pMain'>
    <div data-role='content' style='padding: 15px'>
        <img style="position: relative;max-width: 50%;width: auto\9;" src="i3logo.jpg">

<?PHP
    if($submit_success) {
?>
<div style="background-color: green; height: 30px;">
    Submission Accepted
</div>
<?PHP
    }
?>

<?PHP
    if($have_any_data) {
?>
<div style="background-color: red; height: 30px;">
    Please fill out all fields and accept all conditions.
</div>
<?PHP
    }
?>

        <h1>Beginning on May 29th, 2020 all previous waivers are invalid.  If you have not filled out a waiver since that date you will need to do so again.</h1>

        <h1>Liability Release:</h1><br>

        <form action="#" method="post">
        <h3>Between i3Detroit, Nonprofit Corporation, 1481A Wordsworth Ferndale, MI 48220 ("i3Detroit") and</h3>

        <div data-role="fieldcontain" class="ui-hide-label"><input type="text" name="first" id="first" value="<?PHP echo $first ?>" placeholder="First"/></div>

        <div data-role="fieldcontain" class="ui-hide-label"><input type="text" name="last" id="last" value="<?PHP echo $last ?>" placeholder="Last"/></div>
        <div data-role="fieldcontain"><input type="text" name="ph" id="ph" value="<?PHP echo $ph ?>" placeholder="Phone Number"/></div>
        <div data-role="fieldcontain"><input type="text" name="email" id="email" value="<?PHP echo $email ?>" placeholder="Email Address"/></div>
        <table>
        <tr><td width="10%">
            <select name="q1" id="q1" data-role="slider">
            <option value="0" <?PHP echo $q1 === "0" ? 'selected="selected"' : '' ?>>No</option>
            <option value="1" <?PHP echo $q1 === "1" ? 'selected="selected"' : '' ?>>Yes</option>
            </select></td></td>
        <td>By signing this agreement, I acknowledge that i3Detroit is a dangerous place and I agree to hold harmless i3Detroit, its members, its officers, and its directors.</td>
        </tr>


        <tr><td width="10%">
            <select name="q2" id="q2" data-role="slider">
            <option value="0" <?PHP echo $q2 === "0" ? 'selected="selected"' : '' ?>>No</option>
            <option value="1" <?PHP echo $q2 === "1" ? 'selected="selected"' : '' ?>>Yes</option>
            </select></td>
            <td>I understand that I am personally responsible for my safety and actions. I will follow all safety instructions and signage at i3Detroit.</td>
        </tr>


        <tr><td width="10%">
            <select name="q3" id="q3" data-role="slider">
            <option value="0" <?PHP echo $q3 === "0" ? 'selected="selected"' : '' ?>>No</option>
            <option value="1" <?PHP echo $q3 === "1" ? 'selected="selected"' : '' ?>>Yes</option>
            </select></td>
            <td>I also understand that I am responsible for properly monitoring and labeling anything I bring to i3Detroit and that i3Detroit is not responsible for any lost, damaged, or stolen property.</td>
        </tr>

        <tr><td width="10%">
            <select name="q4" id="q4" data-role="slider">
            <option value="0" <?PHP echo $q4 === "0" ? 'selected="selected"' : '' ?>>No</option>
            <option value="1" <?PHP echo $q4 === "1" ? 'selected="selected"' : '' ?>>Yes</option>
            </select></td>
            <td>I understand that I may be exposed to communicable diseases while at i3Detroit and I release i3Detroit from any liability should I contract such a disease.</td>
        </tr>

        <tr><td width="10%">
            <select name="q5" id="q5" data-role="slider">
            <option value="0" <?PHP echo $q5 === "0" ? 'selected="selected"' : '' ?>>No</option>
            <option value="1" <?PHP echo $q5 === "1" ? 'selected="selected"' : '' ?>>Yes</option>
            </select></td>
            <td>I affirm that I am 18 years of age or older, and that I am mentally competent to sign this release.</td>
        </tr>
        </table>

        <div><b>Emergency Contact Info</b></div>
        <div data-role="fieldcontain">
            <input type="text" name="emcon" id="emcon" value="<?PHP echo $emcon ?>" placeholder="Name"/>
        </div>
        <div data-role="fieldcontain">
            <input type="text" name="emph" id="emph" value="<?PHP echo $emph ?>" placeholder="Phone Number"/>
        </div>
        <div data-role="fieldcontain">
            <input type="text" name="emr" id="emr" value="<?PHP echo $emr ?>" placeholder="Relationship"/>
        </div>

        <h3>Signature</h3>
        <div id="signature"></div>
        <input type="hidden" id="sigdata" name="sigdata" />

        <input value="Submit" type="submit" id="submit" />
        <input type="button" value="Reset Form" onClick="window.location.reload()">
        </form>
    </div>
</div>
<script src="libs/jSignature.min.js"></script>
<script>
$(document).ready(function() {
    $("#signature").jSignature();
    $('#submit').click(function(){
        var sigData = $('#signature').jSignature('getData','svgbase64');
        $('#sigdata').val(sigData);
    });
});
</script>

<?php
    require 'footer.php';
?>
