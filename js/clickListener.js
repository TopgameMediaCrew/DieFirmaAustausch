$(document).ready(function () {
    $('button').off('click');
    $('button').click(function () {
//        alert(this.value);
//        alert(this.id);
//        alert(this.className);

        if (this.value == 'bearbeiten') {
            var aTableEdit = getMenuOptions(this.className);
            alert('bearbeiten');
        } else if (this.value == 'loeschen') {
            alert('löschen');
            alert(this.className);
            alert(this.value);
            alert(this.id);
        } else if (this.className == 'insertHersteller') {
            var value = document.getElementById('name').value;
            $.post("index.php", {
                ajax: "true",
                action: "insert",
                area: "Hersteller",
                view: "listeHersteller",
                hersteller: value
                        // hersteller: "test"
            },
            function (data, status) {
             //   alert(data);
                $('#content').html(data);
            });
        } else if (this.className == 'insertAbteilung') {
            
           
            var value = document.getElementById('name').value;
            $.post("index.php", {
                ajax: "true",
                action: "insert",
                area: "Abteilung",
                view: "listeAbteilung",
                abteilung: value
                        // hersteller: "test"
            },
            function (data, status) {
                alert(data);
                $('#content').html(data);
            });
        } else if (this.className == 'insertProjekt') {
             //alert('insertProjekt');
            var value = document.getElementById('name').value;
            $.post("index.php", {
                ajax: "true",
                action: "insert",
                area: "Projekt",
                view: "listeProjekt",
                projekt: value
                        // hersteller: "test"
            },
            function (data, status) {
             //   alert(data);
                $('#content').html(data);
            });
        
        
        }


        $.post("index.php",
                {
                    ajax: "true",
                    action: aTableEdit[0],
                    area: aTableEdit[1],
                    view: aTableEdit[2],
                    id: this.id
                },
        function (data, status) {
//                    alert(data);
            $('#content').html(data);
        });
    });

    $('a.menuItem').off('click');
    $('a.menuItem').click(function () {
//        alert(this.id);
        var aMenuOptions = getMenuOptions(this.id);

        $.post("index.php",
                {
                    ajax: "true",
                    action: aMenuOptions[0],
                    area: aMenuOptions[1],
                    view: aMenuOptions[2],
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
                options = ['showInsert', 'Abteilung', 'insertAbteilung'];
                break;
            case 'menuFuhrparkAnzeigen' :
                options = ['showList', 'Auto', 'listeAuto'];
                break;
            case 'menuHerstellerAnzeigen' :
                options = ['showList', 'Hersteller', 'listeHersteller'];
                break;
            case 'menuFuhrparkAusleihe' :
                options = ['showList', 'Ausleihe', 'listeAusleihe'];
                break;
            case 'menuFuhrparkHerstellerErstellen':
                options = ['showInsert', 'Hersteller', 'insertHersteller'];
            case 'menuFuhrparkNeuAnlegen' :

                break;
            case 'menuProjekteAnzeigen' :
                options = ['showList', 'Projekt', 'listeProjekt'];
                break;
            case 'menuProjekteNeuAnlegen' :
                options = ['showInsert', 'Projekt', 'insertProjekt'];
                break;
            case 'menuMitarbeiterToProjektAnzeigen' :
                options = ['showList', 'ProjektMitarbeiter', 'listeProjektMitarbeiter'];
                break;
            case 'menuMitarbeiterToProjektNeuAnlegen' :

                break;


            case 'editMitarbeiter' :
                options = ['showUpdate', 'Mitarbeiter', 'formularMitarbeiter'];
                break;
            case 'editAbteilung' :
                options = ['showUpdate', 'Abteilung', 'formularAbteilung'];
                break;
            case 'editAuto' :
                options = ['showUpdate', 'Auto', 'formularAuto'];
                break;
            case 'editHersteller' :
                options = ['showUpdate', 'Hersteller', 'formularHersteller'];
                break;
            case 'editAusleihe' :
                options = ['showUpdate', 'Ausleihe', 'formularAusleihe'];
                break;
            case 'editProjekt' :
                options = ['showUpdate', 'Projekt', 'formularProjekt'];
                break;
            case 'editProjektMitarbeiter' :
                options = ['showUpdate', 'ProjektMitarbeiter', 'formularProjektMitarbeiter'];
                break;


            default:
                options = ['standard', 'standard', 'standard'];
        }

        return options;
    }

    $('#cssmenu > ul > li > a').off('click');
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
        if ($(this).closest('li').find('ul').children().length == 0) {
            return true;
        } else {
            return false;
        }
    });
});