<?php
  $data = file_get_contents("php://input");
  preg_match("/\<EMailAddress\>(.*?)\<\/EMailAddress\>/", $data, $matches);
  header("Content-Type: application/xml");
  list($account, $domain) = split('@' ,$matches[1]);
?>
<?php echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>
<Autodiscover xmlns="http://schemas.microsoft.com/exchange/autodiscover/responseschema/2006">
 <Response xmlns="http://schemas.microsoft.com/exchange/autodiscover/outlook/responseschema/2006a">
  <Account>
   <AccountType>email</AccountType>
   <Action>settings</Action>
    <Protocol>
     <Type>POP3</Type>
     <Server><?php echo 'pop.'.$domain; ?></Server>
     <Port>110</Port>
     <LoginName><?php echo $matches[1]; ?></LoginName>
     <DomainRequired>off</DomainRequired>
     <SPA>off</SPA>
     <SSL>off</SSL>
     <AuthRequired>on</AuthRequired>
     <DomainRequired>off</DomainRequired>
    </Protocol>
    <Protocol>
     <Type>IMAP</Type>
     <Server><?php echo 'pop.'.$domain; ?></Server>
     <Port>143</Port>
     <DomainRequired>off</DomainRequired>
     <LoginName><?php echo $matches[1]; ?></LoginName>
     <SPA>off</SPA>
     <SSL>off</SSL>
     <AuthRequired>on</AuthRequired>
    </Protocol>
    <Protocol>
     <Type>SMTP</Type>
     <Server><?php echo 'mail.'.$domain; ?></Server>
     <Port>587</Port>
     <DomainRequired>off</DomainRequired>
     <LoginName><?php echo $matches[1]; ?></LoginName>
     <SPA>off</SPA>
     <SSL>off</SSL>
     <AuthRequired>on</AuthRequired>
     <UsePOPAuth>on</UsePOPAuth>
     <SMTPLast>off</SMTPLast>
    </Protocol>
   </Account>
 </Response>
</Autodiscover>