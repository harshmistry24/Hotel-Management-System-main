<?php
include 'db_connect.php';

// Fetch menu images
$query = "SELECT * FROM food_menu_images ORDER BY id DESC";
$result = $conn->query($query);
?>

<!-- Navigation bar -->
<?php include 'header.php' ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Restaurant Menu</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Arial", sans-serif;
      }

      body {
        background-color: #f5f5f5;
        padding: 2rem;
        line-height: 1.6;
      }

      .container {
        max-width: 1200px;
        margin: 0 auto;
      }

      .header {
        text-align: center;
        margin-bottom: 3rem;
        padding: 2rem 0;
        background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
        border-radius: 15px;
        color: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      }

      h1 {
        font-size: 2.8rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
      }

      .subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
      }

      .menu-section {
        margin-bottom: 3rem;
      }

      .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        padding: 1rem;
      }

      .menu-item {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
      }

      .menu-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      }

      .menu-item img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
      }

      .menu-item .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
        padding: 1.5rem;
        color: white;
        text-align: center;
        font-size: 1.2rem;
        font-weight: bold;
      }

      /* Modal Styles */
      .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        z-index: 1000;
        overflow-y: auto;
        padding: 20px;
      }

      .modal-content {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
      }

      .modal-content img {
        max-width: 100%;
        max-height: 90vh;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 10px;
        display: block;
      }

      .close-modal {
        position: fixed;
        top: 20px;
        right: 20px;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        background: rgba(0, 0, 0, 0.5);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        z-index: 1001;
      }

      .close-modal:hover {
        background: rgba(0, 0, 0, 0.8);
        transform: rotate(90deg);
      }

      @media (max-width: 768px) {
        .menu-grid {
          grid-template-columns: 1fr;
          gap: 1.5rem;
        }

        .menu-item img {
          height: 250px;
        }

        h1 {
          font-size: 2rem;
        }

        .modal {
          padding: 10px;
        }

        .modal-content {
          padding: 10px;
        }

        .modal-content img {
          max-height: 85vh;
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h1>Our Menu</h1>
        <p class="subtitle">Click on any menu page to view in detail</p>
      </div>

      <div class="menu-section">
    <div class="menu-grid">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="menu-item" onclick="openModal(this)">
                <img src="admin/food/<?= $row['image_name'] ?>" alt="Menu Image"/>
                <div class="overlay"><p><?= $row['menu_description'] ?></p></div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
    </div>

    <!-- Modal -->
    <div id="imageModal" class="modal">
      <span class="close-modal" onclick="closeModal()">&times;</span>
      <div class="modal-content">
        <img id="modalImage" src="" alt="Menu Page" />
      </div>
    </div>

    <script>
      function openModal(element) {
        const modal = document.getElementById("imageModal");
        const modalImg = document.getElementById("modalImage");
        const img = element.querySelector("img");

        modal.style.display = "block";
        modalImg.src = img.src;
      }

      function closeModal() {
        document.getElementById("imageModal").style.display = "none";
      }

      // Close modal when clicking outside the image
      window.onclick = function (event) {
        const modal = document.getElementById("imageModal");
        if (event.target == modal) {
          modal.style.display = "none";
        }
      };

      // Close modal with Escape key
      document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
          document.getElementById("imageModal").style.display = "none";
        }
      });
    </script>

    <!-- footer -->
    <?php include 'footer.php' ?>

  </body>
</html>
