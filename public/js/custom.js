$(document).ready(function() {
    $(".ticket_num").click(function() {
        var text = $(this).text();

        $.ajax({
            type: "POST",
            url: "/book_ticket",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: { ticket_num: text },
            success: function(data) {
                if (!$.trim(data)) {
                    alert("Ticket Not Booked");
                } else {
                    var data = JSON.parse(data);
                    // data = data.split(' ');
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        $("#" + data[i]).css({ display: "block" });
                        $("#" + data[i]).append(" = " + data[i]);
                    }
                    alert("Ticket Booked");
                }
            }
        });
    });
});
