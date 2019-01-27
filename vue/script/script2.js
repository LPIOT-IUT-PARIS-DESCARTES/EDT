const BASE_URL = getBaseUrl();
const COLUMN_CLASS = "column";
const MODULE_TITRE = "module";
const MODULE_TOTAL_TITRE = "Total";
const MODULE_TOTAL_CLASS = "columnTot";
const PERIOD_TOTAL_ID = "lineTot";
const STATUS_SUCCESS = "success";
const STATUS_FAILED_MESSAGE = "HTTP_REQUEST failed. Please contact Ayaz.";

/**
 * --------------------------------------------------------------------------------------------------------------------------
 * ------------------------------------------------ BASIC FUNCTIONS ----------------------------------------------------------
 * --------------------------------------------------------------------------------------------------------------------------
 */

/**
 * Initialize the page
 */
$(document).ready(function () { initialize(); });

/**
 * Add time for a course
 */
$(document).on('click', '.white', function () {
    //TODO: Replace this by a custom dialog box w/ JQuery
    let hours = prompt("Saisissez le nombre d'heures que vous souhaitez");
    if (hours != null) {
        if ($(this).html() != '') {
            $(this).html('');
            $(this).append(hours);
        } else {
            $(this).append(hours);
        }
    }
});


/**
 * --------------------------------------------------------------------------------------------------------------------------
 * ------------------------------------------------ MAIN FUNCTIONS ----------------------------------------------------------
 * --------------------------------------------------------------------------------------------------------------------------
 */

/**
 * Function that initialize the timetable
 */
function initialize() {
    let nbColumn = 0;
    //Adding periods
    $.get(BASE_URL + "?controle=PeriodeController&action=index", function (data, status) {
        if (status == STATUS_SUCCESS) {
            let periods = JSON.parse(data);
            let periodsLength = periods.length;
            nbColumn = periodsLength + 1;
            initializeTitleTotalModuleColumn();
            for (p in periods) {
                let period = periods[p];
                initializePeriodColumn(periodsLength, period);
                initializeTotalPeriodLine(periodsLength);
                periodsLength--;
            }
        } else {
            alert(STATUS_FAILED_MESSAGE);
        }
    });
    //Adding Modules and courses
    $.get(BASE_URL + "?controle=ModuleController&action=index", function (data, status) {
        if (status == STATUS_SUCCESS) {
            let modules = JSON.parse(data);
            for (let m in modules) {
                let module = modules[m];
                initializeModuleLine(module, nbColumn);
                $.get(BASE_URL + "?controle=MatiereController&action=showByModule&id=" + module.id, function (data, status) {
                    if (status == STATUS_SUCCESS) {
                        let courses = JSON.parse(data);
                        for (let c in courses) {
                            let course = courses[c];
                            initializeCourseLine(course, module.id, nbColumn);
                            initializeTotalModuleColumn(null, course.id);
                        }
                    } else {
                        alert(STATUS_FAILED_MESSAGE);
                    }
                });
                initializeTotalModuleColumn(module.id, null);
            }
        } else {
            alert(STATUS_FAILED_MESSAGE);
        }
    });
};



/**
 * ---------------------------------------------------------------------------------------------------------------------
 * ------------------------------------------------ FUNCTIONS ----------------------------------------------------------
 * ---------------------------------------------------------------------------------------------------------------------
 */


/**
 * Function that return the div of a clickable element
 * @param {*} div 
 */
function getLine(div) {
    return div.parent().attr('id');
}

function getColumn(div) {
    let classes = div.attr('class').split(/\s+/);
    let res = null;
    $.each(classes, function (index, item) {
        if (item.startsWith(COLUMN_CLASS)) {
            res = item;
        }
    });
    return res;
}

/**
 * Function that initializes the period columns AND the total module column (only the title)
 * @param {*} id 
 * @param {*} period 
 * @param {*} tot 
 */
function initializePeriodColumn(id, period) {
    $('<div class="cellules titre red text-center ' + COLUMN_CLASS + '-' + id + '">'
        + period.periode + ' (' + period.diff + ' sem)</div>').insertAfter($('#titre'));
}

/**
 * Function that initializes the total period lines
 * @param {*} id 
 */
function initializeTotalPeriodLine(id) {
    $('<div class="cellules total yellow text-center" id=' + PERIOD_TOTAL_ID +
        '-' + id + '>0</div>').insertAfter($('#' + PERIOD_TOTAL_ID));
}
/**
 * Function that initializes the total module column title
 */
function initializeTitleTotalModuleColumn() {
    $('<div class="cellules total silver text-center ' + MODULE_TOTAL_CLASS + '"><p><b>'
        + MODULE_TOTAL_TITRE + '</b></p></div>').insertAfter($('#titre'));
}

/**
 * Function that initializes the total module in column
 * @param {*} id 
 */
function initializeTotalModuleColumn(id, course_id) {
    if (course_id == null) {
        $('#' + MODULE_TITRE + '-' + id).append('<div class="cellules total green text-center '
            + MODULE_TOTAL_CLASS + '-' + id + '">0</div>');
    } else {
        $('#' + course_id).append('<div class="cellules titre droppable silver text-center"></div>');
    }
}

/**
 * Function that initializes the module lines
 * @param {*} module 
 */
function initializeModuleLine(module, nbColumn) {
    //Add title of the module on the line (first cell)
    $('<div class="row edt" id=' + MODULE_TITRE + '-' + module.id + '><div class="cellules titre droppable blue text-center">'
        + module.nom + '</div>').insertAfter($('#H'));
    //Add non clickable div in the module line
    for (let i = 1; i < nbColumn; i++) {
        $('#' + MODULE_TITRE + '-' + module.id).append('<div class="cellules titre droppable silver text-center"></div>');
    }
}

function initializeCourseLine(course, module_id, nbColumn) {
    //Add title of course on the line
    $('<div class="row edt" id=' + course.id + '><div class="cellules titre droppable purple text-center">'
        + course.nom + '</div>').insertAfter($('#' + MODULE_TITRE + '-' + module_id));
    //Add clickable div in the course line
    for (let i = 1; i < nbColumn; i++) {
        $('#' + course.id).append('<div draggable="true" class="cellules titre droppable white ui-widget-content text-center ' + COLUMN_CLASS + '-' + i + '"></div>');
    }

}

/**
 * Function that returns the base url
 */
function getBaseUrl() {
    let baseurl = window.location.origin + window.location.pathname;
    if (baseurl.charAt(baseurl.length - 1) == "/") {
        baseurl = baseurl.slice(0, -1);
    }
    return baseurl;
}