<?php
// Escaping Function used to protect against cross site scripting attack
// htmlspecialchars converts special characters back to text
// ENT_COMPAT converts double quotes and leaves single quotes alone
function __($text) {
  return htmlspecialchars($text, ENT_COMPAT);
}

//Check if value is in array using in_array, which returns true, then if true adds a checked class, used to see if checkbox should be checked 
function checked($value, $array) {
  if(in_array($value, $array)){
    echo 'checked="checked"';
  }
}

// Creates form group component based on arguments passed
function text($name, $id, $label, $placeholder, $type = 'text' ) {?>
  <div class="form-group">
    <label for="<?php echo $id; ?>"><?php echo $label; ?></label>
    <input type="<?php echo $type; ?>" name="<?php echo $name; ?>" class="form-control" id="<?php echo $id; ?>" placeholder="<?php echo $placeholder; ?>" value="<?php echo isset($_SESSION[$name]) ? $_SESSION[$name] : ''; ?>">
  </div>
<?php }

// Creates checkbox componendt and uses checked function to check session super global for checked status
function checkbox($name, $id, $label, $options = array()) {?>
  <div class="form-group">
    <p><?php echo $label; ?></p> 
    <?php foreach ($options as $value => $title) : ?>
    <label class="checkbox-inline" for="<?php echo $id; ?>">
     <input type="checkbox" name="<?php echo $name; ?>[]" value="<?php echo $value; ?>" <?php isset($_SESSION['interests']) ? checked($value, $_SESSION['interests']) : ''; ?>>
     <span class="checkbox-title"><?php echo $title; ?></span>
    </label>
    <?php endforeach; ?>
  </div>
<?php }

// Submit Button Component
function submit($value = 'submit', $class = 'btn btn-primary') {?>
  <button type="submit" class="<?php echo $class; ?>"><?php echo $value; ?></button>
<?php }

// Database Connection
function db_connect(){
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  
  if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error); //kills script if not connected
  }
  return $conn;
}

function insert($data = array()) {
  // Connect to Database
  $conn = db_connect();
  
  // Whitelist and convert to variables
  $name = $data['name'];
  $email = $data['email'];
  $interests = $data['interests'];
  $address = $data['address'];
  $city = $data['city'];
  $province = $data['province'];
  
  // Serialize interests for now. Not sure if this is optimal for sql database as we should avoid adding arrays, maybe a join table is better for this. 
  $interests = serialize($interests);
  
  // Prepare and Bind 
  $stmt = $conn->prepare("INSERT INTO mpforms(name, email, interests, address, city, province) VALUES (?, ?, ?, ?, ?, ?)"); //SQL Injection  protection
  $stmt->bind_param("ssssss", $name, $email, $interests, $address, $city, $province);
  
  // Execute code 
  $insert = $stmt->execute();
  
  if ($insert) {
    return $conn->insert_id;
  }
  
  return false;
}


function show_results($insert_id){
  $conn = db_connect();
  
  //prepare and bind 
  $stmt = $conn->prepare("SELECT name, email, interests, address, city, province FROM mpforms WHERE id = ?");
  $stmt->bind_param('d', $insert_id);
  
  // Execute and bind results
  $stmt->execute();
  $response = $stmt->get_result();
  $results = $response->fetch_array(MYSQLI_ASSOC);
  
  return $results;
}


// Clear button,
// Last page tells you what you are missing and takes you back to the first page
// expand some form details












