$(document).ready(function(){
    $('.follow').click(function(){
        let statusfollow = $('.follow').attr('class');
        var a1 = $(".jumlahfollowes").attr('value');
        var a2 = "1";

        if(statusfollow == "btn btn-edit-profile mt-2 mb-0 follow"){
            $('.follow').attr('class', 'btn btn-edit-profile mt-2 mb-0 follow aktif');
            $(".follow").text("Unfollow");
            //var total = Number(a1) + Number(a2);
            //$(".jumlahfollowers").text(total);
            $(".jumlahfollowes").load('location');
        }
        else if(statusfollow == "btn btn-edit-profile mt-2 mb-0 follow aktif"){
            $('.follow').attr('class', 'btn btn-edit-profile mt-2 mb-0 follow');
            $(".follow").text("Follow");
            $(".jumlahfollowes").load('location');
        }
    })

    $('.likeku').click(function(){
        let statuslike = $('.likeku').attr('class');

        if(statuslike == "btn btn-like likeku"){
            $('.likeku').attr('class', 'btn btn-like likeku aktif');
            $(".likeku").text("Unlike");
            //var total = Number(a1) + Number(a2);
            //$(".jumlahfollowers").text(total);
        }
        else if(statuslike == "btn btn-like likeku aktif"){
            $('.likeku').attr('class', 'btn btn-like likeku');
            $(".likeku").text("Like");
        }
    })

})
