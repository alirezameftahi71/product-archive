$(function () {
  // Call the resizer for list-group
  resizeListGroup();
  // Searchbox filter
  $("#searchBox").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#listItems a").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  // Fill the side menu
  getAllProducts();
});

// Calculate the height of main area and asign it to list-group
function resizeListGroup() {
  $('.list-group').height($('#main-area').height() - $('footer').outerHeight() - $('.navbar').outerHeight() + 10);
}

// Bind the resize event to resizeListGroup()
$(window).bind('resize', resizeListGroup);

// Make passed id in items selected and scroll to it
function makeItemSelected(id) {
  $('.list-group #' + id).trigger('click');
  window.location.href += "#" + id;
}

// Read all the data 
function getAllProducts() {
  _apiRequest(
    "../include/_php/services/read.php",
    "GET",
    null,
    "json",
    function (result) {
      $.each(result, function (i) {
        $('#listItems').append('<a href="#" id="' + result[i]['id'] + '" class="list-group-item list-group-item-action">' + result[i]['title'] + '</a>');
      });
      $($('#listItems').children()).click(function () {
        $($('#listItems').children()).removeClass('active');
        $(this).addClass('active');
        // Fill the tables and place the photo if exists
        getProductById($(this)[0].id, fillMainTable);
      });
      // Check if there's a return queryString 
      if (window.location.search) {
        var id = window.location.search.split("?id=").pop();
        makeItemSelected(id);
      } else {
        // Fill the table with first data
        getProductById(result[0]['id'], fillMainTable);
        $($('#listItems').children()[0]).addClass('active');
      }
    }
  );
}

function getCoverPic(data) {
  var res = "http://via.placeholder.com/270x330";
  if (data != null && data != undefined && data != "")
    res = "data:image/jpeg;base64," + data;
  return res;
}

// Fills in the main table 
function fillMainTable(result) {
  if (!result) {
    $("table #title").html("Example Product Name");
    $("table #releaseDate").html("20xx");
    $("table #rate").html("#/5");
    $("table #genre").html("Example Genre");
    $("table #platform").html("Example platform");
    $("table #publisher").html("Example Company");
    $("#description").html("Full Description goes here in multiple lines providing more and detailed information about the product, like story line or history.");
    $("#cover-pic").attr('src', "http://via.placeholder.com/270x330");
  } else {
    $("table #title").html( result[0]['title'] ? result[0]['title'] : "---");
    $("table #releaseDate").html(result[0]['released_date'] ? result[0]['released_date'] : "---");
    $("table #rate").html(result[0]['rate'] ? result[0]['rate'] + "/5" : "---");
    $("table #genre").html(result[0]['genres'] ? result[0]['genres'] : "---");
    $("table #platform").html(result[0]['platforms'] ? result[0]['platforms'] : "---");
    $("table #publisher").html(result[0]['publishers'] ? result[0]['publishers'] : "---");
    $("#description").html(result[0]['description'] ? result[0]['description'] : "");
    $("#cover-pic").attr('src', getCoverPic(result[0]['cover_pic']) ? getCoverPic(result[0]['cover_pic']) : "http://via.placeholder.com/270x330");
  }

}

// Find the selected product's id
function getCurrentProductID() {
  return $('#listItems .active').attr('id');
}

// Delete the product
function deleteProduct() {
  _apiRequest(
    "../include/_php/services/delete.php",
    "GET",
    "id=" + getCurrentProductID(),
    "text",
    function (result) {
      createAlertMessage("messageBox", "Success", result);
      var delElement = $('#listItems .active');
      var preElement = delElement.prev();
      var preId = preElement.attr('id');
      preElement.addClass('active');
      delElement.remove();
      if (preId != undefined)
        getProductById(preId, fillMainTable);
      else
        fillMainTable();
    },
    function (result) {
      createAlertMessage("messageBox", "Fail", result);
    },
  );
}

// Update the product
function updateProduct() {
  window.location.replace("update_product.php?id=" + getCurrentProductID());
}