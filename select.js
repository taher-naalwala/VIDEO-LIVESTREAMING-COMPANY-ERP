$(function () {
    $('input[name="daterange1"]').daterangepicker({
        opens: 'left'
    }, function (start, end, label) {
        var first_date = start.format('YYYY-MM-DD');

        var second_date = end.format('YYYY-MM-DD');

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "ajax.php?start_date=" + first_date + "&end_date=" + second_date, false);
        xmlhttp.send(null);
        document.getElementById("event").innerHTML = xmlhttp.responseText;
    });
});

$(function() {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left'
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  });

function change_city() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?cityid=" + document.getElementById("citydd").value, false);
    xmlhttp.send(null);
    document.getElementById("mohalla").innerHTML = xmlhttp.responseText;

}
function change_city_edit() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?cityid_edit=" + document.getElementById("citydd").value, false);
    xmlhttp.send(null);
    document.getElementById("mohalla").innerHTML = xmlhttp.responseText;

}

function change_city_reg() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?cityid_reg=" + document.getElementById("citydd_reg").value, false);
    xmlhttp.send(null);
    document.getElementById("mohalla").innerHTML = xmlhttp.responseText;

}

function change_mohalla_reg() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?mohallaid_reg=" + document.getElementById("mohalladd_reg").value, false);
    xmlhttp.send(null);
    document.getElementById("event").innerHTML = xmlhttp.responseText;
}

function change_mohalla_report() {
    var c=document.getElementById("mohalladd").value;
    if(c.length==0)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "ajax.php?its_empty=" + c, false);
        xmlhttp.send(null);
        document.getElementById("table").innerHTML = xmlhttp.responseText;
    }
    else
    {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?mohallaid_report=" + c, false);
    xmlhttp.send(null);
    document.getElementById("table").innerHTML = xmlhttp.responseText;
    }
    var maxLength = 50;
    $(".show-read-more").each(function () {
        var myStr = $(this).text();
        if ($.trim(myStr).length > maxLength) {
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
            $(this).append('<span class="more-text">' + removedStr + '</span>');
        }
    });
    $(".read-more").click(function () {
        $(this).siblings(".more-text").contents().unwrap();
        $(this).remove();
    });

  
        $("#ckbCheckAll").click(function () {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });
   

}

$(document).ready(function () {
    $("#its").keyup(function () {
        var c = $(this).val();
        var m=document.getElementById("mohalladd").value;
       
        if (c.length == 8) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "ajax.php?its_report=" + c + "&mohallaid="+m , false);
            xmlhttp.send(null);
            document.getElementById("table").innerHTML = xmlhttp.responseText;
        }
        if(c.length==0) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "ajax.php?its_empty=" + c+ "&mohallaid="+m, false);
            xmlhttp.send(null);
            document.getElementById("table").innerHTML = xmlhttp.responseText;
        }
        var maxLength = 50;
        $(".show-read-more").each(function () {
            var myStr = $(this).text();
            if ($.trim(myStr).length > maxLength) {
                var newStr = myStr.substring(0, maxLength);
                var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                $(this).empty().html(newStr);
                $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
                $(this).append('<span class="more-text">' + removedStr + '</span>');
            }
        });
        $(".read-more").click(function () {
            $(this).siblings(".more-text").contents().unwrap();
            $(this).remove();
        });
    });
    
})

function change_mohalla_report_app() {
    var c=document.getElementById("mohalladd").value;
    
    if(c.length==0)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "ajax.php?its_empty_app=" + c, false);
        xmlhttp.send(null);
        document.getElementById("table").innerHTML = xmlhttp.responseText;
    }
    else
    {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?mohallaid_report_app=" + c, false);
    xmlhttp.send(null);
    document.getElementById("table").innerHTML = xmlhttp.responseText;
    }
    var maxLength = 50;
    $(".show-read-more").each(function () {
        var myStr = $(this).text();
        if ($.trim(myStr).length > maxLength) {
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
            $(this).append('<span class="more-text">' + removedStr + '</span>');
        }
    });
    $(".read-more").click(function () {
        $(this).siblings(".more-text").contents().unwrap();
        $(this).remove();
    });

    $(document).ready(function () {
        $("#its_app").keyup(function () {
            var c = $(this).val();
            var m=document.getElementById("mohalladd").value;
            if (c.length == 8) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "ajax.php?its_report_app=" + c+ "&mohallaid="+m, false);
                xmlhttp.send(null);
                document.getElementById("table").innerHTML = xmlhttp.responseText;
            }
            if(c.length==0) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "ajax.php?its_empty_app=" + c+ "&mohallaid="+m, false);
                xmlhttp.send(null);
                document.getElementById("table").innerHTML = xmlhttp.responseText;
            }
            var maxLength = 50;
            $(".show-read-more").each(function () {
                var myStr = $(this).text();
                if ($.trim(myStr).length > maxLength) {
                    var newStr = myStr.substring(0, maxLength);
                    var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                    $(this).empty().html(newStr);
                    $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
                    $(this).append('<span class="more-text">' + removedStr + '</span>');
                }
            });
            $(".read-more").click(function () {
                $(this).siblings(".more-text").contents().unwrap();
                $(this).remove();
            });
        });
    })

}



function change_mohalla_report_denied() {
    var c=document.getElementById("mohalladd").value;
    if(c.length==0)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "ajax.php?its_empty_denied=" + c, false);
        xmlhttp.send(null);
        document.getElementById("table").innerHTML = xmlhttp.responseText;
    }
    else
    {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?mohallaid_report_denied=" + c, false);
    xmlhttp.send(null);
    document.getElementById("table").innerHTML = xmlhttp.responseText;
    }
    var maxLength = 50;
    $(".show-read-more").each(function () {
        var myStr = $(this).text();
        if ($.trim(myStr).length > maxLength) {
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
            $(this).append('<span class="more-text">' + removedStr + '</span>');
        }
    });
    $(".read-more").click(function () {
        $(this).siblings(".more-text").contents().unwrap();
        $(this).remove();
    });

}

$(document).ready(function () {
    $("#its_denied").keyup(function () {
        var c = $(this).val();
        var m=document.getElementById("mohalladd").value;
        if (c.length == 8) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "ajax.php?its_report_denied=" + c+"&mohallaid="+m, false);
            xmlhttp.send(null);
            document.getElementById("table").innerHTML = xmlhttp.responseText;
        }
        if(c.length==0) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "ajax.php?its_empty_denied=" + c+"&mohallaid="+m, false);
            xmlhttp.send(null);
            document.getElementById("table").innerHTML = xmlhttp.responseText;
        }
        var maxLength = 50;
        $(".show-read-more").each(function () {
            var myStr = $(this).text();
            if ($.trim(myStr).length > maxLength) {
                var newStr = myStr.substring(0, maxLength);
                var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                $(this).empty().html(newStr);
                $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
                $(this).append('<span class="more-text">' + removedStr + '</span>');
            }
        });
        $(".read-more").click(function () {
            $(this).siblings(".more-text").contents().unwrap();
            $(this).remove();
        });
    });
})

function city_access() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?cityid=" + document.getElementById("citydd").value, false);
    xmlhttp.send(null);
    document.getElementById("mohalla").innerHTML = xmlhttp.responseText;

}

