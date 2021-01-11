var limit = 3;
var start = 0;
var action = "inactive";

function load_country_data(limit,start){
    $.ajax({
        url:'loadmore.php',
        method:'POST',
        data:{limit:limit, start:start},
        cache:false,
        success:function(data)
        {
            $('#load_data').load("loadmore.php");
            if (data==' ')
            {
                alert("no data left!");
                action="active";
            }
            else
            {
                action="inactive";
            }
        }
    })
}

if (action=="inactive"){
    action="active";
    load_country_data(limit,start);
}

$(window).scroll(function() {
    if(($(window).scrollTop() == $(document).height() - $(window).height()) && action=='inactive' ) {
        action = 'active';
        start=start+limit;
        setTimeout(function(){
            load_country_data(limit,start)
        },1000);
    }
});
