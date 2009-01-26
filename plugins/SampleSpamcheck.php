<?php
/**!info**
{
  "Plugin Name"  : "Sample spam check",
  "Plugin URI"   : "http://enanocms.org/plugin/sample-spamcheck",
  "Description"  : "Sample spam check plugin. Very basic, and designed only to demonstrate how to develop spam filtering plugins to developers.",
  "Author"       : "Dan Fuhry",
  "Version"      : "1.0",
  "Author URI"   : "http://enanocms.org/"
}
**!*/

// Attach to the spam_check hook
$plugins->attachHook('spam_check', 'sample_spam_check($string, $name, $email, $url, $ip);');

function sample_spam_check(&$string, &$name, &$email, &$url, &$ip)
{
  // Define our word list
  $words = array('boob', 'titty', 'teenage', 'viagra');
  foreach ( $words as $word )
  {
    if ( stristr($string, $word) )
      return false;
  }
  // This name always means trouble.
  if ( $name == 'Pojo' )
    return false;
  // Block hotmail e-mail addresses
  if ( preg_match('/@hotmail\.com$/', $email) )
    return false;
  // Check URL for bad words
  foreach ( $words as $word )
  {
    if ( stristr($url, $word) )
      return false;
  }
  // block IPs
  if ( $ip == '127.0.1.1') 
    return false;
  
  // Always return true if all checks pass!
  return true;
}
