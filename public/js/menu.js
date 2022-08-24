/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function menu(id) {
    var others = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < others.length; i++) {
      var openDropdown = others[i];
      openDropdown.style.display = "none";
      }
  document.getElementById("myDropdown"+id).style.display = "flex";
}


// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.img')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      openDropdown.style.display = "none";
      }
    }
  }

  function submitForm(form){
      document.getElementById(form).submit();
  }

  function confirmDelete() {
      if (confirm("Are you sure you want to delete the image?")) {
         submitForm('delete');
      }
}

if(document.getElementById('cart-number').innerHTML== 0){
    document.getElementById('cart-number').style.display= "none";
}
