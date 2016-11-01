<div class="help"><span>Login to your <a href="https://www.twilio.com">Twilio</a> Account and enter the credentials found on your <a href="https://www.twilio.com/console">console</a> below. In case you do not have a registered/verified Twilio number, please make sure your current primary number in CiviCRM is verified with Twilio.</span></div>
<div class="crm-container crm-block crm-form-block crm-twilio-form-block">
<table class="form-layout">
  <tbody>
    <tr>
     <td class="label">
       {$form.twilio_account_sid.label}
     </td>
     <td>
       {$form.twilio_account_sid.html}
     </td>
    </tr>
    <tr>
     <td class="label">
       {$form.twilio_auth_token.label}
     </td>
     <td>
       {$form.twilio_auth_token.html}
     </td>
    </tr>
    <tr>
     <td class="label">
       {$form.twilio_number.label}
     </td>
     <td>
       {$form.twilio_number.html}
     </td>
    </tr>
    <tr>
     <td class="label">
       {$form.is_record.label}
     </td>
     <td>
       {$form.is_record.html}
     </td>
    </tr>
  </tbody>
</table> 
   <div class="crm-submit-buttons">
     {include file="CRM/common/formButtons.tpl" location="bottom"}
   </div>
</div>
