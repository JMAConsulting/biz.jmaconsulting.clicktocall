{literal}
<script type="text/javascript">
CRM.$(function($) {
  $('.phone_number').click( function(e) {
    e.preventDefault();
    var dataUrl = {/literal}"{crmURL p='civicrm/call' h=0 }"{literal};
    $.ajax({
      url: dataUrl,
      method: 'POST',
      dataType: 'json',
      data: {
        phoneNumber: $(this).data("phone"),
	cid: {/literal}{$contactId}{literal}
      }
      }).done(function(data) {
        alert("Calling " + $(this).data("phone") + "...");
      }).fail(function(error) {
        alert("There was an error placing the call.");
	console.log(error.responseText);
      });
  });
});
</script>
{/literal}
