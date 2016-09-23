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
        phoneNumber: $(this).html()
      }
      }).done(function(data) {
      }).fail(function(error) {
      });
  });
});
</script>
{/literal}
