let $attendant, $computer, $laboratory, $date, $hours;
//Esta funcion se va a ejecutar cuando la pagina haya cargado
const noHoursAlert = `<div class="alert alert-danger" role="alert">
        <strong>Lo sentimos!</strong> No se encontraron horas disponibles para la fecha seleccionada.
</div>`;
$(function () {
    //Guardamos la referencia del select
    $laboratory = $("#laboratory");
    $attendant = $("#attendant");
    $computer = $("#computer");
    $date = $("#date");
    $hours = $("#hours");
    $laboratory.change(() => {
        const laboratoryId = $laboratory.val();
        const url = `/laboratories/${laboratoryId}/attendants`;
        $.getJSON(url, onAttendantsLoaded);
    });
    $laboratory.change(() => {
        const laboratoryId = $laboratory.val();
        const url = `/computerLaboratory/computers?laboratory_id=${laboratoryId}`;
        $.getJSON(url, onComputersLoaded);
    });

    $laboratory.change(loadHours);
    $date.change(loadHours);
});

function onAttendantsLoaded(attendants) {
    let htmlOptions = "";
    attendants.forEach((attendant) => {
        htmlOptions += `<option value ="${attendant.id}">${attendant.name}</option>`;
    });
    $attendant.html(htmlOptions);
}
function onComputersLoaded(computers) {
    let htmlOptions = "";
    const computer = computers;
    for (let i = 0; i < computer.length; i++) {
        htmlOptions += `<option value ="${computer[i].id}">${computer[i].num_pc}</option>`;
    }
    $computer.html(htmlOptions);
}
function loadHours() {
    const selectedDate = $date.val();
    const laboratoryId = $laboratory.val();
    const url = `/scheduleLaboratory/hours?date=${selectedDate}&laboratory_id=${laboratoryId}`;
    $.getJSON(url, displayHours);
}

function displayHours(data) {
    if (Object.entries(data).length == 0) {
        $hours.html(noHoursAlert);
        return;
    }

    let htmlOptions = " ";

    if (Object.entries(data).length) {
        let hours = data;

        htmlOptions += `<div class="form-group">
                            <select name="hour" id="hours" class="form-control" required>`;
        for (let clave in hours) {
            htmlOptions += `<option value="${hours[clave]}">${hours[clave]}</option>`;
        }
        `</select>
                        </div>`;

        $hours.html(htmlOptions);
    }
}
