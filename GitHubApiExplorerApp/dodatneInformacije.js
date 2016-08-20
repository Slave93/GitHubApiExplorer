/**
 * Created by Slavko on 15.12.2015.
 */
function popuniBag(jezik,opcija,error) {
    if (typeof error != 'undefined') {
        $("#modalUsersTitle").html(error);
        $("#modalUsersBody").html("");
    }else {
        jQuery.ajax({
            url: 'dodatneInformacije.php?' + opcija + '=1&language=' + jezik,
            success: function (data) {
                data = JSON.parse(data);
                datum = data.datum;
                naslov = data.naslov;
                sadrzaj = data.sadrzaj;
                type = "";
                if (opcija == "obug") {
                    type = "Oldest ";
                } else if (opcija == "nbug") {
                    type = "Latest ";
                }
                $("#modalBugsTitle").html(type + "bug is " + naslov + ", created at " + datum);
                $("#modalBugsBody").html(sadrzaj);
            },
            async: false
        });
    }
}
function popuniKorisnikeIzZemlje(jezik,zemlja,error){
    $("#modalUsersTitle").html("");
    $("#modalUsersBody").html("");
    if (typeof error != 'undefined') {
        $("#modalUsersTitle").html(error);
        $("#modalUsersBody").html("");
    }else {
        jQuery.ajax({
            url: 'dodatneInformacije.php?country=' + zemlja + '&language=' + jezik,
            success: function (data) {
                $("#modalUsersTitle").html("Number of users that use " + jezik + " from " + zemlja);
                $("#modalUsersBody").html("There are " + data + " users that use " + jezik + " from " + zemlja);
            },
            async: true
        });
    }
}
function popuniRepozitorijumeSaZvezdicom(jezik,zvezdice,error){
    $("#modalReposTitle").html("");
    $("#modalReposBody").html("");
    if (typeof error != 'undefined') {
        $("#modalReposTitle").html(error);
        $("#modalReposBody").html("");
    }else {
        jQuery.ajax({
            url: 'dodatneInformacije.php?stars=' + zvezdice + '&language=' + jezik,
            success: function (data) {
                $("#modalReposTitle").html("Number of repositoriums related to " + jezik + " with " + zvezdice + " stars");
                $("#modalReposBody").html("There are " + data + " of repositoriums related to " + jezik + " with " + zvezdice + " stars");
            },
            async: false
        });
    }
}