$(document).ready(function () {
    $('#postbutton').attr('disabled', true);

    $('#postbutton,textarea').on('keyup', function () {
        var textarea_value = $("#textareapost").val();
        var text_value = $('#imgInp').val();
        if (textarea_value != '' || text_value != '') {
            $('#postbutton').attr('disabled', false);
        } else {
            $('#postbutton').attr('disabled', true);
        }
    });

	$('.like').click(function(){
		var postid=$(this).attr('id');
		var email=$(this).attr('email');
        $.ajax({
            url:'likes.php',
            type:'post',
            async: false,
            data:{
                'liked': 1,
				'postid' : postid,
				'email' : email
            },
            success:function(content){
            }
        });
    });

    $('.unlike').click(function(){
		var postid=$(this).attr('id');
		var email=$(this).attr('email');
        $.ajax({
            url:'likes.php',
            type:'post',
            async: false,
            data:{
                'unliked': 1,
				'postid' : postid,
				'email' : email
            },
            success:function(content){
            }
        });
    });

    $('.komen').click(function(){
        var komen = $('#komentar').val();
		var postid=$(this).attr('id');
        $.ajax({
            url:'comments.php',
            type:'post',
            async: false,
            data:{
                'komen' : 1,
                'komentar' : komen,
				'postid' : postid,
            },
            success:function(content){

            }
        });
    });
});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#blah').css("display","block")
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}	

$("#imgInp").change(function(){
    readURL(this);
});