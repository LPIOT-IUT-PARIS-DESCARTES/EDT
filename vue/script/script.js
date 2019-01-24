//Récupérer le nom de domaine
var baseurl = window.location.origin + window.location.pathname;
if (baseurl.charAt(baseurl.length - 1) == "/") {
    baseurl = baseurl.slice(0, -1);
}
$(document).ready(function() {
    /*
     * Handler sur click sur le bouton "Générer EDT"
     */
    $("#start").one('click', function() {
        var nb_col = 0;
        //Récupération des périodes
        $.get(baseurl + "?controle=PeriodeController&action=index", function(data, status) {
            var object = JSON.parse(data);
            var cpt = object.length;
            nb_col = cpt + 1;
            var id_tot = cpt + 1;
            //Insertion de la colonne des totaux par module
            $('<div class="cellules total silver" id=titretotm-' + (cpt + 1) + '><p><b>Total par Module</b></p></div>').insertAfter($('#titre'));
            for (var o in object) {
                var item = object[o];
                $('<div class="cellules titre lime" id=' + cpt + '>' + item.periode + ' (' + item.diff + ' sem)</div>').insertAfter($('#titre'))
                //Insertion de la ligne pour les totaux par période
                $('<div class="cellules total silver text-center" id=tot-' + cpt + '>0</div>').insertAfter($('#titre_total_periode'))
                cpt = cpt - 1;
            }
        })
        //Récupération des modules
        $.get(baseurl + "?controle=ModuleController&action=index", function(data, status) {
            var object = JSON.parse(data);
            for (var o in object) {
                var item = object[o];
                //Insertion des modules dans le tableau
                $('<div class="row edt" id= row' + item.id + '>' +
                    '<div class="cellules titre droppable silver" id=' + item.id + '>' + item.nom + '</div>').insertAfter($('#H'));
                //Insertion de la colonne des totaux par module
                for (var i = 1; i < nb_col; i++) {
                    $('#row' + item.id).append('<div class="cellules titre droppable silver" id=' + item.id + '-' + i + '></div>');
                }
                $('#row' + item.id).append('<div class="cellules total silver text-center" id=totm-' + item.id + '>0</div>');
                //Insertion des modules dans le select
                $('#select_module').append('<option id=' + item.id + '>' + item.nom + '</option>');
            }
        });
    });

    /*
     * Handler du select module
     */
    $('#select_module').change(function() {
        var id = $(this).children(":selected").attr("id");
        $.get(baseurl + "?controle=MatiereController&action=showByModule&id=" + id, function(data, status) {
            var object = JSON.parse(data);
            $('#label_matiere').css("display", "block");
            $()
            $("#select_matiere").css("display", "block");
            for (var o in object) {
                var item = object[o];
                $('#select_matiere').append('<option id=' + item.id + '>' + item.nom + '</option>');
            }
            $('#select_module').prop('disabled', 'disabled');
        });
    });

    /*
     * Handler du select matiere
     */
    $('#select_matiere').change(function() {
        //Récupération des périodes
        $.get(baseurl + "?controle=PeriodeController&action=index", function(data, status) {
            var object = JSON.parse(data);
            $('#label_periode').css("display", "block");
            $("#select_periode").css("display", "block");
            for (var o in object) {
                var item = object[o];
                $('#select_periode').append('<option id=' + item.id + '>' + item.periode + '(' + item.diff + 'sem)</option>');
            }
            $('#select_matiere').prop('disabled', 'disabled');
            $('#select_periode').removeAttr('disabled');
        });
    });

    /*
     * Handler du select periode
     */
    $('#select_periode').change(function() {
        $('#select_periode').prop('disabled', 'disabled');
        $("#validate").css("display", "block");

    });
    $('#edt').on('click', '.para', function() {
        let id_matiere = $(this).attr('id').split('-')[1];
        let parent = $(this).parent().closest('div').attr('id');
        alert(parent);
        $.get(baseurl + "?controle=MatiereController&action=show&id=" + id_matiere, function(data, status) {
            var item = JSON.parse(data);
            let nbheure = item.nbHeure;
            minusTotalM(parent.split('-')[0], nbheure);
            minusTotal(parent.split('-')[1], nbheure);
        });
        $(this).remove();
    });
    /*
     * Handler sur bouton de validation
     */
    $('#validate').click(function() {
        id_module = $('#select_module').children(":selected").attr("id");
        id_matiere = $('#select_matiere').children(":selected").attr("id");
        id_periode = $('#select_periode').children(":selected").attr("id");
        $.get(baseurl + "?controle=MatiereController&action=show&id=" + id_matiere, function(data, status) {
            var item = JSON.parse(data);

            /*
             * Cette partie est assez compliqué j'ai donc mit un fichier .txt pour expliquer mon algorithme.
             */

            //Si on veut ajouter à la première case
            if (id_periode == 1) {
                //Si la div est vide mais existe
                if ($('#' + id_module + '-' + id_periode).is(':empty')) {
                    setHtmlById(id_module, id_matiere, item, null);
                    addTotal(id_periode, item.nbHeure);
                    addTotalM(id_module, item.nbHeure);
                }
                //La div existe mais n'est pas vide, on doit donc concaténer le texte
                else if ($('#' + id_module + '-' + id_periode).length) {
                    var old_text = getHtmlById(id_module, id_periode);
                    if (old_text.includes(item.label)){
                        alert('Vous ne pouvez ajouter 2 fois la même matière pour une même période');
                        $("#reload_page").click();
                    } else {
                        setHtmlById(id_module, id_matiere, item, old_text);
                        addTotal(id_periode, item.nbHeure);
                        addTotalM(id_module, item.nbHeure);
                    }
                }
                //La div n'existe pas, on doit donc la créer				
                else {
                    $('#row' + id_module).append('<div class="cellules titre droppable silver" id=' + id_module + '-' + id_periode + '>' + '<p id="matiere-'+item.id+'" style="color:'+item.couleur+';">' + item.label + '</p></div>');
                    addTotal(id_periode, item.nbHeure);
                    addTotalM(id_module, item.nbHeure);
                }
            } else {
                for (var i = 1; i < id_periode; i++) {
                    //Si la div n'existe pas on la créer 
                    if ($('#' + id_module + '-' + i).length == 0) {
                        createDiv(id_module,id_period);
                    }
                }
                //Si la div est vide mais existe
                if ($('#' + id_module + '-' + i).is(':empty')) {
                    setHtmlById(id_module, id_periode, item);
                    addTotal(id_periode, item.nbHeure);
                    addTotalM(id_module, item.nbHeure);
                }
                //La div existe mais n'est pas vide on doit donc concaténer le texte
                else if ($('#' + id_module + '-' + id_periode).length) {
                    var old_text = $('#' + id_module + '-' + id_periode).html();
                    if (old_text.includes(item.label)){
                        alert('Vous ne pouvez ajouter 2 fois la même matière pour une même période');
                        $("#reload_page").click();
                    } else {
                        setHtmlById(id_module, id_periode, item, old_text);
                        addTotal(id_periode, item.nbHeure);
                        addTotalM(id_module, item.nbHeure);
                    }
                }
                //La div n'existe pas on doit donc créer la div
                else {
                    createDiv(id_module, id_period);
                    setHtmlById(id_module, id_period, item)
                    addTotal(id_periode, item.nbHeure);
                    addTotalM(id_module, item.nbHeure);
                }
            }
        });
        $(this).css("display", "none");
        $("#reload_page").css("display", "block");
    });
    /*
     * Handler du bouton d'ajout d'une nouvelle matière
     */
    $('#reload_page').click(function() {
        $('#label_matiere').css("display", "none");
        $('#select_matiere').removeAttr('disabled');
        $("#select_matiere").css("display", "none");
        $('#select_matiere').children('option:not(:first)').remove();
        $('#select_matiere option:contains("Matiere")').prop('selected', true);

        $('#label_periode').css("display", "none");
        $('#select_periode').css("display", "none");
        $('#select_periode').children('option:not(:first)').remove();

        $(this).css("display", "none");
        $('#select_module').removeAttr('disabled');
        $('#select_module option:contains("Module")').prop('selected', true);
    });
    /**
     * Create Div
     * @param {*} id_module 
     * @param {*} id_period 
     */
    function createDiv(id_module, id_period){
        $('#row' + id_module).append('<div class="cellules titre droppable silver" id=' + id_module + '-' + id_period + '></div>');
    }
    /**
     * Create a course in html
     * @param {*} id_module 
     * @param {*} id_period
     * @param {*} item 
     */
    function setHtmlById(id_module, id_period, item, old_text){
        if (old_text == null ){
            $('#' + id_module + '-' + id_period).html('<p class="para" id="matiere-'+item.id+'" style="color:'+item.couleur+';">'  + item.label + '</p>'); 
        } else {
            $('#' + id_module + '-' + id_period).html(old_text + '<p class="para" id="matiere-'+item.id+'" style="color:'+item.couleur+';">' + item.label + '</p>');
        }
    }
    /**
     * Get a course from id
     * @param {*} id_module 
     * @param {*} id_period 
     */
    function getHtmlById(id_module, id_period) {
        return document.getElementById(id_module+'-'+id_period).html();
    }
    /** Add Total Period
     * 
     * @param {*} id_period 
     * @param {*} nbHeure 
     */
    function addTotal(id_period, nbHeure) {
        var old_total = $('#tot-' + id_period).html();
        var old_total_int = parseInt(old_total);
        nbHeure = parseInt(nbHeure);
        var new_total = old_total_int + nbHeure;
        $('#tot-' + id_period).empty();
        $('#tot-' + id_period).html(new_total);
    }
    /**
     * Add total module
     * @param {*} id_module 
     * @param {*} nbHeure 
     */
    function addTotalM(id_module, nbHeure) {
        var old_total = $('#totm-' + id_module).html();
        var old_total_int = parseInt(old_total);
        nbHeure = parseInt(nbHeure);
        var new_total = old_total_int + nbHeure;
        $('#totm-' + id_module).empty();
        $('#totm-' + id_module).html(new_total);
    }
    /**
     * Minus total period
     * @param {*} id_period 
     * @param {*} nbHeure 
     */
    function minusTotal(id_period, nbHeure){
        var old_total = $('#tot-' + id_period).html();
        var old_total_int = parseInt(old_total);
        nbHeure = parseInt(nbHeure);
        var new_total = old_total_int - nbHeure;
        $('#tot-' + id_period).empty();
        $('#tot-' + id_period).html(new_total);  
    }
    /**
     * Minus total modul
     * @param {*} id_module 
     * @param {*} nbHeure 
     */
    function minusTotalM(id_module, nbHeure) {
        var old_total = $('#totm-' + id_module).html();
        var old_total_int = parseInt(old_total);
        nbHeure = parseInt(nbHeure);
        var new_total = old_total_int - nbHeure;
        $('#totm-' + id_module).empty();
        $('#totm-' + id_module).html(new_total);
    }
});