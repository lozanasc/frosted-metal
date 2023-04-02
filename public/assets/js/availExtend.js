$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});

function setForm( id, plan, type){
    $('#eid').val(id);
    $('#eplan').val(plan);
    $('#etype').val(type);   
}
$(document).ready(function(){
    $('#send').on('click', function(e){
        e.preventDefault();
        var id = $('#eid').val();
        var plan = $('#eplan').val();
        var type = $('#etype').val();
    
        console.log(id);
    
        $.ajax({
            url:"/availExtend",
            type:"post",
            dataType: "json",
            data:{
                id:id,
                plan:plan,
                type:type,
                _token: $('input[name=_token]').val()    
            },
            success: function(data){
                if(data.status == 200){
                    $('#tplan').text(plan);
                    $('#ttype').text(type);
                    Swal.fire(
                        'Updated!',
                        'Equipment Updated successfully!',
                        'success'
                    )
                }else{
                    Swal.fire(
                        'Oops!',
                        'Something went wrong. Please try again!',
                        'error'
                    )
                }
                $('#closeModal').trigger('click');
    
            }
        });
    
    });
});
