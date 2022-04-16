function createNewRoom() {
        
    var newRoom = document.createElement('div');
    newRoom.className = 'row';

    newRoom.innerHTML = `<div class="col"><label class="form-label">Room Type</label><input class="form-control" type="text" name="type[]" style="width: 400px;"></div>
                        <div class="col"><label class="form-label">Room Features</label><textarea class="form-control" name="features[]" style="width: 400px;"></textarea></div>
                        <div class="col"><label class="form-label">Area</label><input class="form-control" type="number" name="area1[]" min="0" style="width: 130px;"></div>
                        <div class="col"><label class="form-label">Length</label><input class="form-control" type="number" name="length[]" min="0" style="width: 130px;"></div>
                        <div class="col"><button class="btn btn-primary" id="delete_room" type="button" style="margin-top: 32px;" onclick="removeRoom(event);">Remove</button></div>`

    document.getElementById("room-list").appendChild(newRoom);
}

function removeRoom(event) {
    event.target.parentElement.parentElement.remove();
}

function toggleRemovePhoto(event) {
    photoEl = event.target.parentElement;
    if ($(photoEl).hasClass("remain")) {
        $(event.target).text("Keep Photo");
        $(photoEl).children("img").css("opacity", "50%");
        $(photoEl).children("input[type='text']").attr("disabled", false);
        $(photoEl).removeClass("remain");
        $(photoEl).addClass("remove");
        $(event.target).removeClass("btn-danger");
        $(event.target).addClass("btn-success");
        if ($('#photo-container ul').children('li.remain').length < 1) {
            $("input[name='photoPath[]']").attr("required", true);
        }
    } else if (photoEl.matches(".remove")) {
        $(event.target).text("Remove Photo");
        $(photoEl).children("img").css("opacity", "100%");
        $(photoEl).children("input[type='text']").attr("disabled", true);
        $(photoEl).removeClass("remove");
        $(photoEl).addClass("remain");
        $(event.target).removeClass("btn-success");
        $(event.target).addClass("btn-danger");
        if ($('#photo-container ul').children('li.remain').length >= 1) {
            $("input[name='photoPath[]']").attr("required", false);
        }
    }
}

function setSelected(selectName, optionVal) {
    $("select[name='" + selectName + "'] option[value='" + optionVal + "']").attr("selected", true);
}