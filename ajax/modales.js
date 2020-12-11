(function () {
  //  idConfirmar;
  // idModalConfirmar;
  $(function () {
    // $("#myModal").modal(options);
    $("#idConfirmar").on("click", function () {
      $("#idModalConfirmar").modal();
    });
  });
})();

(function () {
  //  idConfirmar;
  // idModalConfirmar;
  $(function () {
    // $("#myModal").modal(options);
    $("#idAnular").on("click", function () {
      $("#idModalAnular").modal();
    });
  });
})();

(function () {
  // Reportar daños;
  $(function () {
    $("#idReportarDaños").on("click", function () {
      $("#idModalReportar").modal();
    });
  });
})();
// btnDev

(function () {
  // Modal calificar;
  $(function () {
    $("#idBotonConfirmar").on("click", function () {
      setTimeout(() => {
        $("#idModalCalificar").modal();
      }, 6000);
    });
  });
})();

// (function() {

//     $(function() {

//         $("#idBotonRealizar").on("click", function() {
//             $("#idModalCalificar").modal();
//         });
//     });
// })();

setTimeout(() => {
  const reportar = document.getElementById("msjReportar");

  if (reportar != null) {
    reportar.style.display = "none";
  }
}, 6000);

setTimeout(() => {
  const anular = document.getElementById("msjAnular");
  if (anular != null) {
    anular.style.display = "none";
  }
}, 6000);

setTimeout(() => {
  const calificar = document.getElementById("msjCalificar");
  if (calificar != null) {
    calificar.style.display = "none";
  }
}, 6000);
