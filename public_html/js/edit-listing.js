function createNewRoom() {
        
    var newRoom = document.createElement('div');
    newRoom.id = 'room_input';

    newRoom.innerHTML = `<div class="row">
                            <div class="col"><label class="form-label">Room Type</label><input class="form-control" type="text" name="type" style="width: 400px;"></div>
                            <div class="col"><label class="form-label">Room Features</label><textarea class="form-control" name="features" style="width: 400px;"></textarea></div>
                            <div class="col"><label class="form-label">Area</label><input class="form-control" type="number" name="area" min="0" style="width: 130px;"></div>
                            <div class="col"><label class="form-label">Length</label><input class="form-control" type="number" name="length" min="0" style="width: 130px;"></div>
                            <div class="col"><button class="btn btn-primary" id="delete_room" type="button" style="margin-top: 32px;" onclick="removeRoom();">Remove</button></div>
                        </div>`

    document.getElementById("rooms").appendChild(newRoom);
}

function removeRoom() {

    var room = document.getElementById('room_input');

    room.parentNode.removeChild(room);
}