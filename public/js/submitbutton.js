window.addEventListener('DOMContentLoaded', function () {
    document.getElementById('submit1').disabled = true;
    document.getElementById('input1').addEventListener('keyup', function () {
        if (this.value.length < 2) {
            document.getElementById('submit1').disabled = true;
        } else {
            document.getElementById('submit1').disabled = false;
        }
    }, false);
    document.getElementById('input1').addEventListener('change', function () {
        if (this.value.length < 2) {
            document.getElementById('submit1').disabled = true;
        }
    }, false);
}, false);
