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

function submit($value = 'submit', $class = 'btn btn-primary') {?>
  <button type="submit" class="<?php echo $class; ?>"><?php echo $value; ?></button>
<?php }