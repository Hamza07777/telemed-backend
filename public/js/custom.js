//insert consultant
// $('.insertConsultantForm').hide();
$('#addConsultantButton').on('click',function(){
    $('#insertModalTitle').html('Add Consultant');
    $('.insertRecord').html($('.insertConsultantForm').html());
});

//edit consultant
$('.editConsultantButton').on('click',function(){
 //t=$('.editConsultantButton').closest('.consName').html();
 consName=$(this).closest('tr').find('.consName').html();
 consEmail=$(this).closest('tr').find('.consEmail').html();
 consSpeciality=$(this).closest('tr').find('.consSpeciality').html();
 consCommission=$(this).closest('tr').find('.consCommission').html();
 consStatus=$(this).closest('tr').find('.consStatus').html();
 consEditAction=$(this).closest('tr').find('.consEditAction').html();

//$('.insertConsultantForm');
$('#insertModalTitle').html('Edit Consultant')
$('.insertRecord').html($('.insertConsultantForm').html());
var form=$('.insertRecord');
form.find('input[name="name"]').val(consName);
form.find('input[name="email"]').val(consEmail);
form.find('input[name="speciality"]').val(consSpeciality);
form.find('input[name="commission"]').val(consCommission);

if(consStatus==0)
{
form.find('input[name="status"]').removeAttr('checked');;
}

//change the form action
form.find('form').attr('action', consEditAction);
//alert(consEditAction);
// form.find('form').attr('method', 'GET');

});
