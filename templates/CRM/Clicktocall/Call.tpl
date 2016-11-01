{literal}
<script type="text/javascript">
CRM.$(function($) {
  $('.phone_number').click( function(e) {
    e.preventDefault();
    var dataUrl = {/literal}"{crmURL p='civicrm/call' h=0 }"{literal};
    var phone = $(this).data("phone");
    if (!String(phone).match("^\\+")) {
      alert("Phone number must contain a valid country code preceeded by +");
      return false;
    }
    $.ajax({
      url: dataUrl,
      method: 'POST',
      dataType: 'json',
      data: {
        phoneNumber: phone,
	cid: {/literal}{$contactId}{literal}
      }
      }).success(function(d) {
        alert("Calling " + phone + "...");
      }).fail(function(error) {
        alert("There was an error placing the call. " + error.responseText);
      });
  });
});
</script>
{/literal}
