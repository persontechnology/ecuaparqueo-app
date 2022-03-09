var lista_estacionamientos = [];

function setListaEstablecimientos(establecimientos) {
    debugger;
    return (lista_estacionamientos = establecimientos);
}

function getListaEstablecimientos() {
    return lista_estacionamientos;
}
function bbuu(params) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var type = "POST";
    var ajaxurl = "/espacios-actualizar-todos";
    $.ajax({
        type: type,
        url: ajaxurl,
        data: {
            estacionamientos: getListaEstablecimientos(),
        },
        dataType: "json",
        success: function (data) {
            if (data?.tipo === "success") {
                window.location = "listar-espacios/1";
            }
        },
        error: function (data) {
            console.log(data);
        },
    });
}
$("#btn-update").click(function (e) {
    debugger;
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    e.preventDefault();
    var type = "POST";
    var ajaxurl = "/eespacios-actualizar-todos";
    $.ajax({
        type: type,
        url: ajaxurl,
        data: {
            estacionamientos: getListaEstablecimientos(),
        },
        dataType: "json",
        success: function (data) {
            if (data?.tipo === "success") {
                window.location = "listar-espacios/1";
            }
        },
        error: function (data) {
            console.log(data);
        },
    });
});

/* ------------------------------------------------------------------------------
 *
 *  # jQuery UI interactions
 *
 *  Demo JS code for jqueryui_interactions.html page
 *
 * ---------------------------------------------------------------------------- */

// Setup module
// ------------------------------

var JqueryUiInteractions = (function () {
    //
    // Setup module components
    //

    // Draggable
    var _componentUiDraggable = function () {
        if (!$().draggable) {
            console.warn("Warning - jQuery UI components are not loaded.");
            return;
        }

        // Basic setup
        $(".draggable-element").draggable({
            containment: "#draggable-default-container",
            cursor: "move",
            scroll: true,
            stop: function (event, ui) {
                let numeroId = $(this).attr("id");
                let numero = numeroId.split("-");
                let data = {
                    left: ui.position.left,
                    top: ui.position.top,
                    number: numero[1],
                };
                actualizarArray(data);
                return;
            },
        });

        //
        // Constrain movement
        //

        // Both
        $("#draggable-move-both").draggable({
            containment: "#draggable-containment-container",
        });

        // Vertical
        $("#draggable-move-vertical").draggable({
            containment: "#draggable-containment-container",
            axis: "y",
        });

        // Horizontal
        $("#draggable-move-horizontal").draggable({
            containment: "#draggable-containment-container",
            axis: "x",
        });

        //
        // Revert position
        //

        // Element
        $("#draggable-revert-element").draggable({
            containment: "#draggable-revert-container",
            revert: true,
        });

        // Clone helper
        $("#draggable-revert-clone").draggable({
            containment: "#draggable-default-container",
            cursor: "move",
            scroll: true,
            helper: "clone",
            stop: function (event, ui) {
                let data = {
                    left: ui.position.left,
                    top: ui.position.top,
                };
                debugger;
            },
        });

        // Speed
        $("#draggable-revert-speed").draggable({
            containment: "#draggable-revert-container",
            revert: true,
            revertDuration: 1500,
        });

        //
        // Cursors
        //

        // Move cursor
        $("#draggable-cursor-move").draggable({
            containment: "#draggable-cursor-container",
            cursor: "move",
        });

        // Crosshair cursor
        $("#draggable-cursor-crosshair").draggable({
            containment: "#draggable-cursor-container",
            cursor: "crosshair",
        });

        // Bottom cursor
        $("#draggable-cursor-bottom").draggable({
            containment: "#draggable-cursor-container",
            cursorAt: {
                bottom: 0,
            },
        });

        //
        // Handles
        //

        // Text
        $("#draggable-handle-text").draggable({
            containment: "#draggable-handle-container",
            handle: "span",
        });

        // Icon
        $("#draggable-handle-icon").draggable({
            containment: "#draggable-handle-container",
            handle: ".handle-icon",
        });

        // Exception
        $("#draggable-handle-exception").draggable({
            containment: "#draggable-handle-container",
            cancel: "span",
        });

        //
        // Events
        //

        // Define elements
        var $start_counter = $("#draggable-event-start"),
            $drag_counter = $("#draggable-event-drag"),
            $stop_counter = $("#draggable-event-stop"),
            counts = [0, 0, 0];

        // Start event
        $start_counter.draggable({
            containment: "#draggable-events-container",
            start: function () {
                counts[0]++;
                updateCounterStatus($start_counter, counts[0]);
            },
        });

        // Drag event
        $drag_counter.draggable({
            containment: "#draggable-events-container",
            drag: function () {
                counts[1]++;
                updateCounterStatus($drag_counter, counts[1]);
            },
        });

        // Stop event
        $stop_counter.draggable({
            containment: "#draggable-events-container",
            stop: function () {
                counts[2]++;
                updateCounterStatus($stop_counter, counts[2]);
            },
        });

        // Update counter text
        function updateCounterStatus($event_counter, new_count) {
            $(".event-count", $event_counter).text(new_count);
        }
    };

    //
    // Return objects assigned to module
    //

    return {
        init: function () {
            _componentUiDraggable();
        },
    };
})();

// Initialize module
// ------------------------------

document.addEventListener("DOMContentLoaded", function () {
    JqueryUiInteractions.init();
});
function actualizarArray(params) {
    if (params?.number && lista_estacionamientos?.length > 0) {
        let fl = lista_estacionamientos.find(
            (esta) => esta?.id === Number(params?.number)
        );
        if (fl) {
            const newArray = lista_estacionamientos.map((estacio) => {
                if (estacio?.id === Number(params?.number)) {
                    return { ...estacio, left: params?.left, top: params?.top };
                }
                return estacio;
            });
            lista_estacionamientos = newArray;
        }
    }
}
