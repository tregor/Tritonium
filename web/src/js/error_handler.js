$(document).ready(function () {
    selectBacktrace();
    $("#backtraceSwitch").click(function () {
        $("#backtraceList").toggle(300);
    });
});

function selectBacktrace(index = 0) {
    if ($('#file' + index).length === 0) {
        selectBacktrace(index + 1);
        return;
    }
    $('.code').hide();
    $('#file' + index).show();
    $("#backtraceList").show();
}