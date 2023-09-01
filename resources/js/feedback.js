$(document).ready(function() {
    function updateFeedbacks() {
      // Send an AJAX request to fetch new data from the server
      $.ajax({
        url: 'your_server_endpoint', // Replace with the actual endpoint URL
        method: 'GET',
        dataType: 'json',
        success: function(data) {
          // Update the content of each feedback div
          $('#feedback-1').html(data[0]); // Replace `data[0]` with the appropriate content for the first feedback
          $('#feedback-2').html(data[1]); // Replace `data[1]` with the appropriate content for the second feedback
          $('#feedback-3').html(data[2]); // Replace `data[2]` with the appropriate content for the third feedback
        },
        error: function() {
          console.log('Error fetching feedback data.');
        }
      });
    }

    // Call the updateFeedbacks function initially
    updateFeedbacks();

    // Call the updateFeedbacks function every 4 seconds
    setInterval(updateFeedbacks, 4000);
  });
