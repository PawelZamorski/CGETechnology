// Source: https://www.w3schools.com/howto/howto_js_sort_table.asp
// Sorts data according to column in ascending or descending order.
// Parameter:
// col - number of table column
// ascending - boolean variable. If true, sort data in ascending order.
function sortTable(col, ascending) {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[col];
      y = rows[i + 1].getElementsByTagName("TD")[col];
      // check if sort in asscending order
      if(ascending == true) {
        //check if the two rows should switch place:
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else {
        //check if the two rows should switch place:
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}

// Source: https://www.w3schools.com/howto/howto_js_filter_table.asp
// Filters data according to text.
// Parameter:
// col - number of table column
// inputId - id of input element to get value (text) from
function filter(col, inputId) {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById(inputId);
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[col];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

// Filter data by Type column
function filterType() {
  filter(4, "inputType");
}

// Filter data by Project column
function filterProject() {
  filter(2, "inputProject");
}

// Filter data by year. Filters (hides/shows) only data that match 'year'. Other data are not changed.
// Parameter:
// col - number of table column
// year - year to be filtered
// show - boolean variable to show/hide data. If true data are shown.
function filterYear(col, year, show) {
  // Declare variables
  var filter, table, tr, td, i, txtValue;
  filter = year;
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and show/hide those who match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[col];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        // show elements that match 
        if(show == true) {
          tr[i].style.display = "";
        } else { // hide element
          tr[i].style.display = "none";
        }
      }
    }
  }
}


// Select year (checkbox) to filter data by year 
// Parameter:
// year - year to be filtered
function selectYear(year) {
  var checkBox = document.getElementById(year);
  if(checkBox.checked == true) {
    filterYear(1, year, true);
  } else {
    filterYear(1, year, false);
  }
}
