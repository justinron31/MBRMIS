// ─── Search Placeholder ───────────────────────────────────────
window.onload = function () {
  var input = document.querySelector('.dt-search input[type="search"]');
  if (input) {
    input.placeholder = "Search";
  }
};

// ─── Toggle Exportbutton ──────────────────────────────────────
function toggleExport() {
  var exportTitle = document.querySelector(".exportTitle");
  var dtStart = document.querySelector(".dt-layout-cell.dt-start");
  var button = document.querySelector(".export__file-btn");

  var displayStyle = window.getComputedStyle(dtStart).display;

  if (displayStyle === "none") {
    dtStart.style.display = "flex";
    exportTitle.textContent = "X";
    button.style.backgroundColor = "red";
  } else {
    dtStart.style.display = "none";
    exportTitle.textContent = "Export";
    button.style.backgroundColor = "";
  }
}

document.addEventListener("click", function (event) {
  var dtStart = document.querySelector(".dt-layout-cell.dt-start");
  var button = document.querySelector(".export__file-btn");
  var exportTitle = document.querySelector(".exportTitle");

  var isClickInsideDtStart = dtStart.contains(event.target);
  var isClickInsideButton = button.contains(event.target);
  var isClickInsideExportTitle = exportTitle.contains(event.target);

  if (
    !isClickInsideDtStart &&
    !isClickInsideButton &&
    !isClickInsideExportTitle
  ) {
    var displayStyle = window.getComputedStyle(dtStart).display;
    if (displayStyle !== "none") {
      toggleExport();
    }
  }
});
