function preventBack() { window.history.forward(); }
setTimeout("preventBack()", 0);
window.onbeforeunload = function () { null };