class PHPMailer {

public $From;
public $FromName;
public $AddAddress;

public $Subject;
public $Body;

public function setFrom($email, $name=''){
  $this->From = $email;
  $this->FromName = $name;
}  

public function addAddress($email){
  $this->AddAddress = $email;
}

public function send(){
  $headers = "From: $this->FromName <$this->From>";
  
  $sent = mail($this->AddAddress, $this->Subject, $this->Body, $headers);
  
  return $sent ? true : false; 
}

}