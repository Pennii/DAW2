var openedWindow;

function abrir() {
  openedWindow = window.open("http://www.google.es","nueva","height=800,width=600");
}

function closeOpenedWindow() {
  openedWindow.close();
}