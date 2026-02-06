function validateForm() {
    var name = document.querySelector('input[name="player_name"]').value;
    var number = document.querySelector('input[name="player_number"]').value;
    var position = document.querySelector('input[name="player_position"]').value;
    if (name === "" || number === "" || position === "") {
        alert("Can't leave an empty field");
        return false;
    } else {
        return true;
    }
}