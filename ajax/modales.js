(function() {
    //  idConfirmar;
    // idModalConfirmar;
    $(function() {
        // $("#myModal").modal(options);
        $("#idConfirmar").on("click", function() {
            $("#idModalConfirmar").modal();
        });
    });
})();

(function() {
    //  idConfirmar;
    // idModalConfirmar;
    $(function() {
        // $("#myModal").modal(options);
        $("#idAnular").on("click", function() {
            $("#idModalAnular").modal();
        });
    });
})();

(function() {
    // Reportar daños;
    $(function() {
        $("#idReportarDaños").on("click", function() {
            $("#idModalReportar").modal();
        });
    });
})();