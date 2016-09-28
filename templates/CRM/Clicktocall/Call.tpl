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
      }).success(function(d) {
        //alert("Calling " + $(this).data.phoneNumber + "...");
      }).fail(function(error) {
	console.log(error.responseText);
      });
  });
});
</script>
{/literal}
