<?php
require_once 'connection.php';
$errors = [];
$hobbies = [];
$terms = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['sname'] ?? "");
    $email = trim($_POST['semail'] ?? "");
    $age = trim($_POST['sage'] ?? "");
    $gender = $_POST['sgender'] ?? "";
    $course = $_POST['scourse'] ?? '';
    $skill = $_POST['sskill'] ?? "";
    if (!empty($_POST['Hobbies'])) {
        $hobbies = $_POST['Hobbies'];
    } 
    if (!empty($_POST['Terms'])) {
        $terms = $_POST['Terms'];
    }

    if(empty($name)){
        $errors['name'] = " !Require";
    }
    elseif(is_numeric($name)){
        $errors['name'] = " !number is not allowd";
    }
    elseif(strlen($name) < 2){
         $errors['name'] = " !Enter Valid Range";
    }
    else{
        $errors['name'] = "";
    }

    if(empty($email)){
        $errors['email'] = " !Require";
    }
    elseif (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $errors['email'] = " !Email is not Valid";
    }
    else{
        $errors['email'] = "";
    }

    if(empty($age)){
        $errors['age'] = " !Require";
    }
    elseif (!($age > 4 && $age < 16)) {
        $errors['age'] = " !Enter Age Between 5 to 15";
    }
    else{
        $errors['age'] = "";
    }

    if(empty($gender)){
        $errors['gender'] = " !Require";
    }
    else{
        $errors['gender'] = "";
    }

    if (empty($course) || $course == "select") {
        $errors['course'] = " !Require";
    }
    else{
        $errors['course'] = "";
    }

    if (empty($hobbies)) {
        $errors['hobbies'] = " !Require";
    }
    else{
        $errors['hobbies'] = "";
    }

    if(empty($skill)){
        $errors['skill'] = " !Require";
    }
    else{
        $errors['skill'] = "";
    }

    if (empty($terms)) {
        $errors['terms'] = " !Require";
    }
    else{
        $errors['terms'] = "";
    }


    if (!array_filter($errors)) {
        $hobbies_str = implode(", ", $hobbies);
        $terms_str = implode(", ", $terms);
        $sql = "INSERT INTO students (name, email, age, gender, course, hobbies, skill, terms) VALUES ('$name', '$email', '$age', '$gender', '$course', '$hobbies_str', '$skill' , '$terms_str')";        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Student details submitted successfully!');</script>";
            $name = $email = $age = $gender = $course = $skill = "";
            $hobbies = [];
            $terms = [];
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="contain">
        <h1>Student Profile</h1>
        
            <form id="sform" action="" method="POST">
                <div>
                <label>Student Full Name</label>
                <input type="text" name ="sname" value="<?php echo $name; ?>"><span class="error"><?php echo $errors['name']; ?></span>
                </div>

                <div>
                <label>Email</label>
                <input type="text" name="semail" value="<?php echo $email; ?>"><span class="error"><?php echo $errors['email']; ?></span>
                </div>

                <div>
                <label>Age</label>
                <input type="number" name="sage" value="<?php echo $age; ?>"><span class="error"><?php echo $errors['age']; ?></span>
                </div>

                <div>
                <label>Gender</label><span class="error"><?php echo $errors['gender']; ?></span><br>
                <input type="radio" name="sgender" value="Male" <?= ($gender == 'Male') ? 'checked' : '' ?> id="Male" class="sgender"><label for="Male">Male</label>
                <input type="radio" name="sgender" value="Female" <?= ($gender == 'Female') ? 'checked' : '' ?> id="Female" class="sgender"><label for="Female">Female</label>
                <input type="radio" name="sgender" value="Other" <?= ($gender == 'Other') ? 'checked' : '' ?> id="Other" class="sgender"><label for="Other">Other</label><br>
                </div>

                <div>
                <label>Course</label>
                <select name="scourse">
                    <option value="select" <?php if($course == 'select') echo 'selected'; ?> >- Select -</option>
                    <option value="Other" <?php if($course == 'Other') echo 'selected'; ?>>- Other -</option>
                    <option value="BCA" <?php if($course == 'BCA') echo 'selected'; ?>>- BCA -</option>
                    <option value="MCA" <?php if($course == 'MCA') echo 'selected'; ?>>- MCA -</option>
                    <option value="Deploma" <?php if($course == 'Deploma') echo 'selected'; ?>>- Deploma -</option>
                    <option value="B.com" <?php if($course == 'B.com') echo 'selected'; ?>>- B.com -</option>
                    <option value="M.com" <?php if($course == 'M.com') echo 'selected'; ?>>- M.com -</option>
                </select><span class="error"><?php echo $errors['course']; ?></span><br>
                </div>

                <div>
                <label>Hobbies</label><span class="error"><?php echo $errors['hobbies']; ?></span><br>
                <input type="checkbox" name="Hobbies[]" value="Reading" <?php echo (in_array("Reading", $hobbies)) ? "checked" : ""; ?> id="Reading" class="Hobbies"><label for="Reading">Reading</label>
                <input type="checkbox" name="Hobbies[]" value="Travelling" <?php echo (in_array("Travelling", $hobbies)) ? "checked" : ""; ?> id="Travelling" class="Hobbies"><label for="Travelling">Travelling</label>
                <input type="checkbox" name="Hobbies[]" value="Singing" <?php echo (in_array("Singing", $hobbies)) ? "checked" : ""; ?> id="Singing" class="Hobbies"><label for="Singing">Singing</label>
                <input type="checkbox" name="Hobbies[]" value="Dancing" <?php echo (in_array("Dancing", $hobbies)) ? "checked" : ""; ?> id="Dancing" class="Hobbies"><label for="Dancing">Dancing</label>
                <input type="checkbox" name="Hobbies[]" value="Other" <?php echo (in_array("Other", $hobbies)) ? "checked" : ""; ?> id="Otherh" class="Hobbies"><label for="Otherh">Other</label>
                </div>

                <div>
                <label>Skill Level</label><span class="error"><?php echo $errors['skill']; ?></span><br>
                <input type="radio" name="sskill" value="Beginner" <?= ($skill == 'Beginner') ? 'checked' : '' ?>  id="Beginner" class="sskill"><label for="Beginner">Beginner</label>
                <input type="radio" name="sskill" value="Intermediate" <?= ($skill == 'Intermediate') ? 'checked' : '' ?> id="Intermediate" class="sskill"><label for="Intermediate">Intermediate</label>
                <input type="radio" name="sskill" value="Advanced" <?= ($skill == 'Advanced') ? 'checked' : '' ?> id="Advanced" class="sskill"><label for="Advanced">Advanced</label><br>
                </div>

                <div id="Terms" class="fcenter">
                <input type="checkbox" name="Terms[]" value="true" <?php echo $terms; ?> id="terms"><label for="terms">Terms and Condition</label><span class="error"><?php echo $errors['terms']; ?></span>
                </div>

                <div class="fcenter">
                    <button  type="submit">Submit</button>
                </div>

            </form>
      
    </div>
</body>
</html>