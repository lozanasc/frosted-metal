$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});

function setForm(id, name, weight, quantity, activity, condition){
    $('#eid').val(id);
    // var imager = "<img src='http://127.0.0.1:8000/images/equipments/"+image+"' style='width:100px;'>";
    // $('#eimage').html(imager);
    $('#ename').val(name);
    $('#eweight').val(weight);
    $('#equantity').val(quantity);
    $('#eactivity').val(activity);
    $('#econdition').val(condition);
}


$(document).ready(function(){
    $('#save').on('click',function(e){
            e.preventDefault();
            var id = $('#eid').val();
            // var image = $('#image').val();
            var name = $('#ename').val();
            var weight = $('#eweight').val();
            var quantity = $('#equantity').val();
            var activity = $('#eactivity').val();
            var condition = $('#econdition').val();

            console.log(id);
    
        $.ajax({
            url:"/updatetools",
            type:"post",
            dataType: "json",
            data:{
                id:id,
                // image:image,
                name:name,
                weight:weight,
                quantity:quantity,
                activity:activity,
                condition:condition,
                _token: $('input[name=_token]').val()
            },
            success: function(data){
                if(data.status == 200){
                    
                    // $('#timage').text(image);
                    $('#tname').text(name);
                    $('#tweight').text(weight);
                    $('#tquantity').text(quantity);
                    $('#tactivity').text(activity);
                    $('#tcondition').text(condition);
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


/*


$('#formsubmit').submit(function(e){
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: new FormData(this),
        processData: false,
        dataType: 'json',
        contentType: false,
        error: function(ts){
            alert(ts.responseText);
        },
        success: function(data){
            alert(data.msg);
        }
    });
});*/