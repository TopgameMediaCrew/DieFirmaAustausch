$(document).ready(function () {
    $('button').off('click');
    $('button').click(function () {
     var inputs = document.getElementsByTagName('input');
     var drops = document.getElementsByTagName('select'); 
//        alert(this.className);
//        
//        
//        alert(this.value);
//        alert(this.id);
        if (this.value == 'bearbeiten') {
            var aTableEdit = getMenuOptions(this.className);
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
        }
        if (this.className == 'editHersteller' && this.value == 'bearbeiten') {
            var aTableEdit = getMenuOptions(this.className);
            $.post("index.php", {
                ajax: "true",
                action: "showUpdate",
                area: "Hersteller",
                view: "formularHersteller",
                id: this.id
            },
            function (data, status) {
                //   alert(data);
                $('#content').html(data);
            });
        }
        if (this.className == 'editHersteller' && this.value == 'bearbeiten') {
            var aTableEdit = getMenuOptions(this.className);
            $.post("index.php", {
                ajax: "true",
                action: "showUpdate",
                area: "Hersteller",
                view: "formularHersteller",
                id: this.id
            },
            function (data, status) {
                //   alert(data);
                $('#content').html(data);
            });
        }
        if (this.className == 'editMitarbeiter' && this.value == 'bearbeiten') {
            var aTableEdit = getMenuOptions(this.className);
            $.post("index.php", {
                ajax: "true",
                action: "showUpdate",
                area: "Mitarbeiter",
                view: "formularMitarbeiter",
                id: this.id
            },
            function (data, status) {
                //   alert(data);
                $('#content').html(data);
            });
        }
        if (this.className == 'editProjekt' && this.value == 'bearbeiten') {
            var aTableEdit = getMenuOptions(this.className);
            $.post("index.php", {
                ajax: "true",
                action: "showUpdate",
                area: "Projekt",
                view: "formularProjekt",
                id: this.id
            },
            function (data, status) {
                //   alert(data);
                $('#content').html(data);
            });
        }
        if (this.className == "bearbeitenAuto") {
          
            var id = this.id;
           
      
            $.post("index.php",
                    {
                        ajax: "true",
                        action: "showUpdate",
                        area: "Auto",
                        view: "formularAuto",
//                        auto: auto,
//                        hersteller_id: hersteller_id,
//                        kennzeichen: kennzeichen,
                        id: id
                    },
            function (data, status) {
                $('#content').html(data);
            });

        }
        if (this.className == "updateAuto") {

            alert(document.getElementById('id').value);
            var hersteller_id = document.getElementById('hersteller').value;
            var auto = document.getElementById('autoName').value;
            var kennzeichen = document.getElementById('kennzeichen').value;
            var id = document.getElementById('id').value;
  
            $.post("index.php",
                    {
                        ajax: "true",
                        action: "update",
                        area: "Auto",
                        view: "listeAuto",
                        auto: auto,
                        hersteller_id: hersteller_id,
                        kennzeichen: kennzeichen,
                        id: id
                    },
            function (data, status) {
                $('#content').html(data);
            });

        }
        
        if (this.className == "updateMitarbeiter") {
            var inputs = document.getElementsByTagName('input');
            var select = document.getElementsByTagName('select');
            var id = inputs["id"].value;
            var vorname = inputs["vorname"].value;
            var nachname = inputs["nachname"].value;
            var geschlecht = $('input[type="radio"]:checked').val();
            var geburtsdatum = inputs["geburtsdatum"].value;
            var abteilung = select['abteilung'].value;
            var stundenlohn = inputs["stundenlohn"].value;
            var vorgesetzter = select["vorgesetzter"].value;
            
            var action = "update";
            var area = "mitarbeiter";
            var view = "formularMitarbeiter";
            var daten = {id:id, vorname:vorname, nachname:nachname, geschlecht:geschlecht, geburtsdatum:geburtsdatum, abteilung:abteilung, stundenlohn:stundenlohn, vorgesetzter:vorgesetzter};
            var daten = JSON.stringify(daten); 
        
            $.post("index.php", 
            {
                daten:daten,
                action:action,
                area:area,
                ajax: true,
                view:view
            },
        function (data)
        {
            $("#content").html(data);
        });
        }
        if (this.className == 'updateProjekt') {

            var proid = document.getElementById('id').value;
            var value = document.getElementById('name').value;

            $.post("index.php", {
                ajax: "true",
                action: "update",
                area: "Projekt",
                view: "listeProjekt",
                projekt: value,
                id: proid


            },
            function (data, status) {
                //   alert(data);
                $('#content').html(data);
            });
        }
        if (this.className === 'updateAusleihe') {
            alert('bin da');
            $.post("index.php",
                    {
                        ajax: "true",
                        action: "update",
                        area: "ausleihe",
                        view: "listeAusleihe",
                        autoId: $('#autoId').val(),
                        mitarbeiterId: $('#mitarbeiterId').val(),
                        dateVon: $('#dateVon').val(),
                        vonStunde: $('#vonStunde').val(),
                        dateBis: $('#dateBis').val(),
                        bisStunde: $('#bisStunde').val(),
                        id: $('#id').val()

                    },
                    function (data, status) {
//                    alert(data);
                        $('#content').html(data);
                    });
        }
        if (this.className == 'updateHersteller') {
            var herstid = document.getElementById('id').value;
            var value = document.getElementById('name').value;
            
            $.post("index.php", {
                ajax: "true",
                action: "update",
                area: "Hersteller",
                view: "listeHersteller",
                hersteller: value,
                id: herstid
            },
            function (data, status) {
                //   alert(data);
                $('#content').html(data);
            });
        }
        if (this.className == 'updateAbteilung') {
            alert ("ununsed");
            var abtid = document.getElementById('id').value;
            var value = document.getElementById('name').value;

            $.post("index.php", {
                ajax: "true",
                action: "update",
                area: "Abteilung",
                view: "listeAbteilung",
                abteilung: value,
                id: abtid
            },
            function (data, status) {
                //   alert(data);
                $('#content').html(data);
            });
        }
        if (this.className == 'editAbteilung' && this.value == 'löschen') {
          
            
            var abtid = this.id;
           
           

            $.post("index.php", {
                ajax: "true",
                action: "delete",
                area: "Abteilung",
                view: "listeAbteilung",
                id: abtid


            },
            function (data, status) {
                //   alert(data);
                $('#content').html(data);
            });
        
            
        }
        if (this.className == 'editAbteilung' && this.value == 'löschen') {
          
            
            var abtid = this.id;
           
           

            $.post("index.php", {
                ajax: "true",
                action: "delete",
                area: "Abteilung",
                view: "listeAbteilung",
                id: abtid


            },
            function (data, status) {
                //   alert(data);
                $('#content').html(data);
            });
        
            
        }
        if (this.className == 'editMitarbeiter' && this.value == 'löschen') {
            var id = this.id;
            $.post("index.php",
            {
                action: "delete",
                area: "Mitarbeiter",
                view: "formularMitarbeiter",
                ajax: true,
                id:id
            },
            function (data) 
            {      
                $('#content').html(data);
            });
        }
          if (this.className == "deleteAuto" && this.value=='loeschen') {
        
            var id = this.id;
         
            $.post("index.php",
                    {
                        ajax: "true",
                        action: "delete",
                        area: "Auto",
                        view: "listeAuto",
                        id: id 
                    },
            function (data, status) {
                $('#content').html(data);
            });

        } 
            
            
        
        if (this.className == 'editProjekt' && this.value == 'löschen') {
         var projid = this.id;
           
           

            $.post("index.php", {
                ajax: "true",
                action: "delete",
                area: "Projekt",
                view: "listeProjekt",
                id: projid


            },
            function (data, status) {
                //   alert(data);
                $('#content').html(data);
            });
        
          
            
            
            
            
        }
        if (this.value === 'loeschen') {
//            alert(this.className);
//            alert(this.value);
//            alert(this.id);
            $.post("index.php",
                    {
                        ajax: "true",
                        action: "delete",
                        area: "ausleihe",
                        view: "listeAusleihe",
                        id: this.id
                    },
                    function (data, status) {
//                    alert(data);
                        $('#content').html(data);
                    });
        }
//        if (this.class == "editHersteller" && this.value == 'löschen') {
//            alert(" Abteilung LÖSCHEN !!!");
//        }
        if (this.className == 'insertHersteller') {
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
        }
        if (this.className == 'insertHersteller') {
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
        }
        if (this.className == 'insertMitarbeiter') {
            alert("Bin hier");
            var inputs = document.getElementsByTagName('input');
            var select = document.getElementsByTagName('select');
            var id = inputs["id"].value;
            var vorname = inputs["vorname"].value;
            var nachname = inputs["nachname"].value;
            var geschlecht = $('input[type="radio"]:checked').val();
            var geburtsdatum = inputs["geburtsdatum"].value;
            var abteilung = select['abteilung'].value;
            var stundenlohn = inputs["stundenlohn"].value;
            var vorgesetzter = select["vorgesetzter"].value;
            
            var action = "insert";
            var area = "mitarbeiter";
            var view = "formularMitarbeiter";
            var daten = {id:id, vorname:vorname, nachname:nachname, geschlecht:geschlecht, geburtsdatum:geburtsdatum, abteilung:abteilung, stundenlohn:stundenlohn, vorgesetzter:vorgesetzter};
            var daten = JSON.stringify(daten); 
        
            $.post("index.php", 
            {
                daten:daten,
                action:action,
                area:area,
                ajax: true,
                view:view
            },
            function (data)
            {
                $("#content").html(data);
            });
        }
        if (this.className == 'insertProjekt') {
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
       if (this.className == "insertAuto") {
           
            var hersteller_id = document.getElementById('hersteller').value;
            var auto = document.getElementById('autoName').value;
            var kennzeichen = document.getElementById('kennzeichen').value;
            $.post("index.php",
                    {
                        ajax: "true",
                        action: "insert",
                        area: "Auto",
                        view: "listeAuto",
                        auto: auto,
                        hersteller_id: hersteller_id,
                        kennzeichen: kennzeichen
                    },
            function (data, status) {
                $('#content').html(data);
            });
        }
       if (this.className === 'inputAusleihe') {
            $.post("index.php",
                    {
                        ajax: "true",
                        action: "insert",
                        area: "ausleihe",
                        view: "listeAusleihe",
                        autoId: $('#autoId').val(),
                        mitarbeiterId: $('#mitarbeiterId').val(),
                        dateVon: $('#dateVon').val(),
                        vonStunde: $('#vonStunde').val(),
                        dateBis: $('#dateBis').val(),
                        bisStunde: $('#bisStunde').val()
                    },
                    function (data, status) {
//                    alert(data);
                        $('#content').html(data);
                    });
        }
         if (this.className == "updateProjektMitarbeiter") {
            var id = inputs['id'].value;
            var projekt = drops['projekt'].value;
            var mitarbeiter = drops['mitarbeiter'].value;
            var vonDate = inputs['vonTag'].value + ' ' + inputs['vonZeit'].value;
            var bisDate = inputs['bisTag'].value + ' ' + inputs['bisZeit'].value;

            $.post("index.php",
                    {
                        ajax: "true",
                        action: "update",
                        area: "ProjektMitarbeiter",
                        view: "listeProjektMitarbeiter",
                        projekt: projekt,
                        mitarbeiter: mitarbeiter,
                        von: vonDate,
                        bis: bisDate,
                        upmid: id
                    },
            function (data, status) {
                $('#content').html(data);
            });
        }

        if (this.className == "insertProjektMitarbeiter") {
            var projekt = drops['projekt'].value;
            var mitarbeiter = drops['mitarbeiter'].value;
            var vonDate = inputs['vonTag'].value + ' ' + inputs['vonZeit'].value;
            var bisDate = inputs['bisTag'].value + ' ' + inputs['bisZeit'].value;

            $.post("index.php",
                    {
                        ajax: "true",
                        action: "insert",
                        area: "ProjektMitarbeiter",
                        view: "listeProjektMitarbeiter",
                        projekt: projekt,
                        mitarbeiter: mitarbeiter,
                        von: vonDate,
                        bis: bisDate
                    },
            function (data, status) {
                $('#content').html(data);
            });
        }

        if (this.className == 'loeschenProjektMitarbeiter' && this.value == 'loeschen') {
            var lpmid = this.id;
            $.post("index.php",
                    {
                        ajax: "true",
                        action: "delete",
                        area: "ProjektMitarbeiter",
                        view: "listeProjektMitarbeiter",
                        lpmid: lpmid
                    },
            function (data, status) {
                $('#content').html(data);
            });
        }
       // ???
       // 
//        $.post("index.php",
//                {
//                    ajax: "true",
//                    action: aTableEdit[0],
//                    area: aTableEdit[1],
//                    view: aTableEdit[2],
//                    id: this.id
//                },
//        function (data, status) {
////                    alert(data);
//            $('#content').html(data);
//        });
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
                options = ['showInsert', 'Mitarbeiter', 'formularMitarbeiter'];
                break;
            case 'menuAbteilungAnzeigen' :
                options = ['showList', 'Abteilung', 'listeAbteilung'];
                break;
            case 'menuAbteilungNeuAnlegen' :
                options = ['showInsert', 'Abteilung', 'formularAbteilung'];
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
            case 'menuHerstellerNeuAnlegen':
                options = ['showInsert', 'Hersteller', 'formularHersteller'];
                break;
            case 'menuFuhrparkNeuAnlegen' :
                options = ['showInsert','Auto','formularAuto'];
                break; 
            case 'menuFuhrparkAusleiheNeuAnlegen':
                options = ['showInput', 'Ausleihe', 'formularAusleihe'];
                break;
            case 'bearbeitenAuto' :
                options = ['showUpdate','Auto','formularAuto'];
                break;
            case 'menuProjekteAnzeigen' :
                options = ['showList', 'Projekt', 'listeProjekt'];
                break;
            case 'menuProjekteNeuAnlegen' :
                options = ['showInsert', 'Projekt', 'formularProjekt'];
                break;
            case 'menuMitarbeiterToProjektAnzeigen' :
                options = ['showList', 'ProjektMitarbeiter', 'listeProjektMitarbeiter'];
                break;
            case 'menuMitarbeiterToProjektNeuAnlegen' :
                   options = ['showInsert', 'ProjektMitarbeiter', 'formularProjektMitarbeiter'];       
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
            case 'bearbeitenProjektMitarbeiter' :
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
     $('#dateVon').datepicker({
        inline: true,
        showOtherMonths: true,
        closeText: 'schließen',
        prevText: '&#x3c;zurück',
        nextText: 'Vor&#x3e;',
        currentText: 'heute',
        monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
            'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
        monthNamesShort: ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun',
            'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'],
        dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
        dayNamesShort: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
        dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
        weekHeader: 'Wo',
        firstDay: new Date(),
        dateFormat: "dd.mm.yy",
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        showAnim: "slideDown",
//        showOn: "button",
        showWeek: true,
        onClose: function (selectedDate) {
            $("#dateBis").datepicker("option", "minDate", selectedDate);
        }
    });

    $('#dateBis').datepicker({
        inline: true,
        showOtherMonths: true,
        closeText: 'schließen',
        prevText: '&#x3c;zurück',
        nextText: 'Vor&#x3e;',
        currentText: 'heute',
        monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
            'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
        monthNamesShort: ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun',
            'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'],
        dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
        dayNamesShort: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
        dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
        weekHeader: 'Wo',
//        firstDay: new Date(),
        dateFormat: "dd.mm.yy",
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        showAnim: "slideDown",
//        showOn: "button",
        showWeek: true,
        onClose: function (selectedDate) {
            $("#dateVon").datepicker("option", "maxDate", selectedDate);
        }
    });
});