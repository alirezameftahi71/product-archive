// Global variables
var last_insert_id;

$(function () {
  // Tag inputs functionalities
  tagsManagerHandler("genre", '../include/_php/services/get_genres.php');
  tagsManagerHandler("platform", '../include/_php/services/get_platforms.php');
  tagsManagerHandler("publisher", '../include/_php/services/get_publishers.php');
  $('#btn-submit').click(sendAddInfo);
  $('#file-browse-wrapper a').hide();
});

// Send data to php services
function sendAddInfo() {
  var data = $('form').serialize();
  _apiRequest(
    "../include/_php/services/create.php",
    "POST",
    data,
    "TEXT",
    function (result) {
      last_insert_id = result;
      var file = $('#cover-pic').prop('files')[0];
      var file_data = new FormData();
      file_data.append('file', file);
      // Send photo
      _apiRequest(
        "../include/_php/services/add_picture.php?id=" + last_insert_id,
        "POST",
        file_data,
        "TEXT",
        function (result) {
          createAlertMessage("messageBox", "success", result);
        },
        function () {
          createAlertMessage("messageBox", "fail", result)
        },
        true
      );
    }, function(result) {
      
    }
  );
}