<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tourism Offer Popup</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom styles for tourism vibe */
    .modal-content {
      border-radius: 10px;
      overflow: hidden;
       background:#e3fae7;
    }
    .modal-header {
      background: linear-gradient(45deg, #164cad, #3dcd24);
      border: none;
      color: white;
      text-align: center;
    }
    .modal-body {
      /* background: url('https://via.placeholder.com/600x300?text=Adventure+Tour') no-repeat center; */

      /* background-size: cover; */
      background:#e3fae7;
      color: rgb(8 16 118);
      /* text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7); */
      padding: 2rem;
      text-align: center;
    }
    .modal-footer {
      border: none;
      justify-content: center;
    }
    .btn-book {
      background-color: #164cad;
      border: none;
      padding: 10px 10px;
      font-weight: bold;
      color: white;
    }
    .btn-book:hover {
      background-color: #218838;
      color: white;
    }
    .close-btn {
      color: white;
      opacity: 1;
    }
  </style>
</head>
<body>
  <!-- Bootstrap Modal -->
  <div class="modal fade" id="offerPopup" tabindex="-1" aria-labelledby="offerPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="offerPopupLabel">Exclusive Offer!</h5>
          <button type="button" class="btn-close close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h3>up to 30% Offer for Adventure Games!</h3>
          <p>Book now for unforgettable experiences. Offer ends soon!</p>
        </div>
        <div class="modal-footer">
          <a href="offers.php" class="btn btn-book">Explore Now</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and Popper -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <!-- Plain JS for Popup Logic -->
  <script>
    // Check if popup has been shown in this session
    function showPopup() {
      if (!localStorage.getItem('popupShown')) {
        setTimeout(() => {
          var popup = new bootstrap.Modal(document.getElementById('offerPopup'), {
            keyboard: true
          });
          popup.show();
          // Mark popup as shown in this session
          localStorage.setItem('popupShown', 'true');
        }, 2000); // 3-second delay
      }
    }

    // Reset popup for new sessions (optional, can adjust logic)
    window.addEventListener('beforeunload', () => {
      localStorage.removeItem('popupShown');
    });

    // Trigger popup on page load
    window.onload = showPopup;
    // document.querySelector('.btn-book').addEventListener('click', () => {
    // // Replace with your analytics (e.g., Google Analytics)
    // console.log('Offer button clicked!');
    // });
  </script>
</body>
</html>