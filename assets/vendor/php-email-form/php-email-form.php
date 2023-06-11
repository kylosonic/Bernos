<?php

class PHP_Email_Form
{
  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $message;
  public $headers;
  public $smtp;

  public function __construct()
  {
    $this->to = '';
    $this->from_name = '';
    $this->from_email = '';
    $this->subject = '';
    $this->message = '';
    $this->headers = '';
    $this->smtp = array();
  }

  public function add_message($content, $label = '', $newline = true)
  {
    if ($newline)
      $this->message .= $label . ": " . $content . "\n";
    else
      $this->message .= $label . ": " . $content;
  }

  public function send()
  {
    $this->headers = "From: " . $this->from_name . " <" . $this->from_email . ">" . "\r\n";
    $this->headers .= "Reply-To: " . $this->from_email . "\r\n";
    $this->headers .= "MIME-Version: 1.0\r\n";
    $this->headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (!empty($this->smtp)) {
      $smtp_host = $this->smtp['host'];
      $smtp_username = $this->smtp['username'];
      $smtp_password = $this->smtp['password'];
      $smtp_port = $this->smtp['port'];
      $this->headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
      ini_set("SMTP", $smtp_host);
      ini_set("smtp_port", $smtp_port);
      ini_set("sendmail_from", $this->from_email);
      ini_set("auth_username", $smtp_username);
      ini_set("auth_password", $smtp_password);
    }

    return mail($this->to, $this->subject, $this->message, $this->headers);
  }
}
