
function check_property_type() {
    var current_property = $("#selected_property_type").val();
    if (current_property == "1") { //kuca
        $('#floor').fadeOut(50);
    } else if (current_property == "3") { //lokal
        $('#heat').fadeOut(50);
        $('#floor').fadeOut(50);
        $('#building_floors').fadeOut(50);
        $('#structure').fadeOut(50);
    } else if (current_property == "4") { //garaza
        $('#structure').fadeOut(50);
        $('#parking').fadeOut(50);
        $('#accommodation').fadeOut(50);
        $('#heat').fadeOut(50);
        $('#floor').fadeOut(50);
        $('#building_floors').fadeOut(50);
    }
}