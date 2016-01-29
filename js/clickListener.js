$(document).ready(function () {
    $("button").click(function () {
        alert(this.id);
//        alert(this.value);
        $.post("index.php",
                {
                    ajax: "true",
                    action: "showList",
                    area: "Auto",
                    view: "listeAuto",
                    id: this.id
                },
        function (data, status) {
            $('#content').html(data);
        });
    });


//    $("button").click(Mitarbeiter);
//    function Mitarbeiter() {
//        $.post("index.php",
//                {
//                    ajax: "true",
//                    action: "showList",
//                    area: "Auto",
//                    view: "listeAuto",
//                    id: this.id
//                },
//        function (data, status) {
//            $('#content').html(data);
//            $("button").click(Mitarbeiter2);
//        });
//    }
//    function Mitarbeiter2() {
//        $.post("index.php",
//                {
//                    ajax: "true",
//                    action: "showList",
//                    area: "Mitarbeiter",
//                    view: "listeMitarbeiter",
//                    id: this.id
//                },
//        function (data, status) {
//            $('#content').html(data);
//            $("button").click(Mitarbeiter);
//        });
//    }






    $('a.menuItem').click(function () {
//        alert(this.id);
        var aMenuOptions = getMenuOptions(this.id);
        $.post("index.php",
                {
                    ajax: "true",
                    action: aMenuOptions[0],
                    area: aMenuOptions[1],
                    view: aMenuOptions[2]
                },
        function (data, status) {
//                    alert(data);
            $('#content').html(data);
        });
    });

    function getMenuOptions(id) {
        var options = [];
        switch (id) {
            case 'menuMitarbeiterAnzeige' :
                options = ['showList', 'Mitarbeiter', 'listeMitarbeiter'];
                break;

            case 'menuMitarbeiterNeuAnlegen' :
                break;

            case 'menuAbteilungAnzeigen' :
                options = ['showList', 'Abteilung', 'listeAbteilung'];
                break;

            case 'menuAbteilungNeuAnlegen' :
                break;

            case 'menuFuhrparkAnzeigen' :
                options = ['showList', 'Auto', 'listeAuto'];
                break;

            case 'menuFuhrparkAusleihe' :
                options = ['showList', 'Ausleihe', 'listeAusleihe'];
                break;

            case 'menuFuhrparkNeuAnlegen' :
                break;

            case 'menuProjekteAnzeigen' :
                options = ['showList', 'Projekt', 'listeProjekt'];
                break;

            case 'menuProjekteNeuAnlegen' :
                break;

            case 'menuMitarbeiterToProjektAnzeigen' :
                options = ['showList', 'ProjektMitarbeiter', 'listeProjektMitarbeiter'];
                break;

            case 'menuMitarbeiterToProjektNeuAnlegen' :
                break;

            default:
                options = ['standard', 'standard', 'standard'];
                break;
        }

        return options;
    }

    $('#cssmenu > ul > li > a').click(function () {
//        alert(this.id);
        $('#cssmenu li').removeClass('active');
        $(this).closest('li').addClass('active');
        var checkElement = $(this).next();
        if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
//            alert(this.id);
            $(this).closest('li').removeClass('active');
            checkElement.slideUp('normal');
        }
        if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
//            alert(this.id);
            $('#cssmenu ul ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
        }
        if ($(this).closest('li').find('ul').children().length === 0) {
            return true;
        } else {
            return false;
        }
    });
});

var projekt_id;
var mitarbeiter_id;
var von;
var bis;
var id;
$(document).ready(function () {
    $('#OK').click(updateProjektMitarbeiter);
});
function updateProjektMitarbeiter() {
    $.post("index.php",
            {
                ajax: "true",
                projekt_id: this.projekt_id,
                mitarbeiter_id: this.mitarbeiter_id,
                von: this.von,
                bis: this.bis,
                id: this.id
            },
    function (data, status) {
        $('#content').html(data);
    });
}
