<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PetLand</title>
  <!-- Bootstrap CSS -->
<!-- Liên kết CSS của Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

<!-- Liên kết JavaScript của Bootstrap và jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>


  <link rel="stylesheet" href="./assets/css/thongtin.css">
  <style>
    .hidden {
      display: none;
    }
    
    
  </style>
  <style>
    /* CSS làm đẹp cho đơn hàng */
    .order-card {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 16px;
      margin-bottom: 12px;
      background-color: #f9f9f9;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    /* .order-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    } */

    .order-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
      margin-right: 16px;
    }

    .order-info {
      flex: 1;
      margin-right: 16px;
    }

    .order-title {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 8px;
      color: #333;
    }

    .order-status {
      font-size: 14px;
      margin-bottom: 8px;
    }

    .order-quantity {
      font-size: 14px;
      color: #555;
    }

    .order-btn {
      font-size: 14px;
      padding: 8px 12px;
      border-radius: 4px;
    }
      /* Toàn bộ màn hình tối */
      .overlay {
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6); /* Nền mờ */
        z-index: 1000;
    }

    /* Form chính */
    .main-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 15px;
        width: 500px;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Tiêu đề */
    .form-container h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    /* Đánh giá sao */
    .rating {
        display: flex;
        justify-content: center;
        margin: 10px 0;
    }

    .rating input {
        display: none;
    }

    .rating label {
        font-size: 30px;
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .rating input:checked ~ label,
    .rating label:hover,
    .rating label:hover ~ label {
        color: #f5a623; /* Màu vàng khi chọn */
    }

    /* Nội dung đánh giá */
    textarea {
        width: 100%;
        height: 100px;
        margin: 10px 0;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    textarea:focus {
        outline: none;
        border-color: #f5a623;
    }

    /* Nút hành động */
    .form-actions {
        display: flex;
        justify-content: space-between;
    }

    .form-actions button {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .form-actions button[type="button"] {
        background-color: #ddd;
        color: #333;
    }

    .form-actions button[type="button"]:hover {
        background-color: #bbb;
    }

    .form-actions button[type="submit"] {
        background-color: #f5a623;
        color: #fff;
    }

    .form-actions button[type="submit"]:hover {
        background-color: #d48820;
    }

    /* Nút đánh giá */
    .review-link {
        cursor: pointer;
        color: #f5a623;
        text-decoration: none;
        font-size: 18px;
    }

    .review-link:hover {
        text-decoration: underline;
    }
  </style>
</head>

<body>
  <!-- Main Container -->
  <div class="container my-4">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3 mb-4 mb-md-0">
        <div class="list-group">
          <div class="profile-section p-3 border-bottom text-center">
            <!-- Avatar và tên người dùng -->
            <img src="../uploads/user/default.jpg" alt="Avatar" class="rounded-circle" style="width: 60px; height: 60px;">
            <h5 class="fw-bold mt-2">
              <?php
              if (isset($_SESSION['user']['name'])) {
                echo htmlspecialchars($_SESSION['user']['name']);
              } else {
                echo 'Người dùng';
              }
              ?>
            </h5>
            <p><a href="?act=edit-profile" class="text-decoration-none fw-bold">Sửa Hồ Sơ</a></p>
          </div>
          <a href="#orders" class="list-group-item list-group-item-action" onclick="showSection('orders')">Đơn hàng của tôi</a>
          <a href="?act=change-password" class="list-group-item list-group-item-action" onclick="showSection('change-password')">Đổi mật khẩu</a>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-md-9">
        <!-- Orders Section -->
        <section id="orders" class="p-4 border-custom rounded">
  <h2 class="h5 fw-bold">Đơn hàng của tôi</h2>

  <!-- CSS trực tiếp cho thiết kế -->
  

  <!-- Tabs -->
  <ul class="nav nav-tabs mb-3">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#all-orders">Tất cả</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#pending-orders">Chờ xác nhận</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#shipping-orders">Đang giao</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#completed-orders">Hoàn thành</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#canceled-orders">Đã hủy</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#refund-orders">Trả hàng/hoàn tiền</a>
    </li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content">
    <!-- Tất cả -->
    <div class="tab-pane fade show active" id="all-orders">
      <?php foreach ($orders_items as $order): ?>
        <?php if ($_SESSION['user_id'] == $order['user_id']): ?>
          <div class="order-card">
            <img src="<?= htmlspecialchars($order['image']) ?>" alt="Product Image" class="order-image">
            <div class="order-info">
              <p class="order-title"><?= htmlspecialchars($order['title']) ?></p>
              <p class="order-status">
                Trạng thái: 
                <span class="<?= $order['shipping_status'] === 'delivered' ? 'text-success' : ($order['shipping_status'] === 'cancelled' ? 'text-danger' : 'text-warning') ?>">
                  <?= $order['shipping_status'] === 'pending' ? 'Chờ xác nhận' : 
                      ($order['shipping_status'] === 'delivering' ? 'Đang giao' : 
                      ($order['shipping_status'] === 'delivered' ? 'Hoàn thành' : 
                      ($order['shipping_status'] === 'cancelled' ? 'Đã hủy' : 'Trả hàng/hoàn tiền'))) ?>
                </span>
              </p>
              <p class="order-quantity">Số lượng: <?= htmlspecialchars($order['quantity']) ?></p>
            </div>
            <button 
              class="btn btn-outline-primary btn-sm order-btn" 
              onclick="window.location.href='?act=chi-tiet-don-hang&order_id=<?= htmlspecialchars($order['order_id']) ?>'">
              Xem chi tiết
            </button>
            <!-- Hiển thị nút Đánh giá nếu sản phẩm chưa được đánh giá -->
            <?php
// Kiểm tra xem đã đánh giá chưa
$hasReviewed = $this->modelOrder->hasReviewed($_SESSION['user_id'] , $order['id']);
?>

<?php if ($order['shipping_status'] == 'delivered' && !$hasReviewed): ?>
    <a href="javascript:void(0);" class="review-link" onclick="toggleForm()">Đánh giá</a>

    <!-- Form đánh giá -->
    <div class="overlay" id="reviewOverlay" style="display: none;">
        <div class="main-container">
            <div class="form-container">
                <h1>Đánh giá sản phẩm</h1>
                <form action="?act=add-reviews" method="POST">
                    <!-- Input ẩn -->
                    <input type="hidden" id="comic_id" name="comic_id" value="<?=$order['id']?>">
                    <input type="hidden" id="user_id" name="user_id" value="<?= $_SESSION['user_id'] ?>">

                    <!-- Đánh giá sao -->
                    <label for="rating">Chọn Đánh Giá:</label>
                    <div class="rating">
                      <input type="radio" id="star5" name="rating" value="excellent">
                      <label for="star5" title="Xuất sắc">&#9733;</label>

                      <input type="radio" id="star4" name="rating" value="good">
                      <label for="star4" title="Tốt">&#9733;</label>

                      <input type="radio" id="star3" name="rating" value="average">
                      <label for="star3" title="Bình thường">&#9733;</label>

                      <input type="radio" id="star2" name="rating" value="bad">
                      <label for="star2" title="Tệ">&#9733;</label>

                      <input type="radio" id="star1" name="rating" value="very_bad">
                      <label for="star1" title="Rất tệ">&#9733;</label>
                    </div>

                    <!-- Nội dung đánh giá -->
                    <label for="review_text">Nội dung đánh giá:</label>
                    <textarea id="review_text" name="review_text" placeholder="Nhập đánh giá của bạn..." required></textarea>

                    <!-- Nút gửi -->
                    <div class="form-actions">
                        <button type="button" onclick="toggleForm()">Hủy</button>
                        <button type="submit">Gửi đánh giá</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php elseif ($hasReviewed): ?>
    <p>Bạn đã đánh giá sản phẩm này.</p>
<?php endif; ?>

          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <!-- Chờ xác nhận -->
    <div class="tab-pane fade" id="pending-orders">
      <?php foreach ($orders_items as $order): ?>
        <?php if ($_SESSION['user_id'] == $order['user_id'] && $order['shipping_status'] === 'pending'): ?>
          <div class="order-card">
            <img src="<?= htmlspecialchars($order['image']) ?>" alt="Product Image" class="order-image">
            <div class="order-info">
              <p class="order-title"><?= htmlspecialchars($order['title']) ?></p>
              <p class="order-status">
                Trạng thái: <span class="text-warning">Chờ xác nhận</span>
              </p>
              <p class="order-quantity">Số lượng: <?= htmlspecialchars($order['quantity']) ?></p>
            </div>
            <button class="btn btn-outline-primary btn-sm order-btn">Xem chi tiết</button>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <!-- Đang giao -->
    <div class="tab-pane fade" id="shipping-orders">
      <?php foreach ($orders_items as $order): ?>
        <?php if ($_SESSION['user_id'] == $order['user_id'] && $order['shipping_status'] === 'delivering'): ?>
          <div class="order-card">
            <img src="<?= htmlspecialchars($order['image']) ?>" alt="Product Image" class="order-image">
            <div class="order-info">
              <p class="order-title"><?= htmlspecialchars($order['title']) ?></p>
              <p class="order-status">
                Trạng thái: <span class="text-primary">Đang giao</span>
              </p>
              <p class="order-quantity">Số lượng: <?= htmlspecialchars($order['quantity']) ?></p>
            </div>
            <button class="btn btn-outline-primary btn-sm order-btn">Xem chi tiết</button>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <!-- Hoàn thành -->
<div class="tab-pane fade" id="completed-orders">
  <?php foreach ($orders_items as $order): ?>
    <?php if ($_SESSION['user_id'] == $order['user_id'] && $order['shipping_status'] === 'delivered'): ?>
      <div class="order-card">
        <img src="<?= htmlspecialchars($order['image']) ?>" alt="Product Image" class="order-image">
        <div class="order-info">
          <p class="order-title"><?= htmlspecialchars($order['title']) ?></p>
          <p class="order-status">
            Trạng thái: <span class="text-success">Hoàn thành</span>
          </p>
          <p class="order-quantity">Số lượng: <?= htmlspecialchars($order['quantity']) ?></p>
        </div>
        <button class="btn btn-outline-primary btn-sm order-btn" onclick="window.location.href='?act=chi-tiet-don-hang&order_id=<?= htmlspecialchars($order['order_id']) ?>'">
          Xem chi tiết
        </button>

        <?php
// Kiểm tra xem đã đánh giá chưa
$hasReviewed = $this->modelOrder->hasReviewed($_SESSION['user_id'] , $order['id']);
?>

<?php if ($order['shipping_status'] == 'delivered' && !$hasReviewed): ?>
    <a href="javascript:void(0);" class="review-link" onclick="toggleForm()">Đánh giá</a>

    <!-- Form đánh giá -->
    <div class="overlay" id="reviewOverlay" style="display: none;">
        <div class="main-container">
            <div class="form-container">
                <h1>Đánh giá sản phẩm</h1>
                <form action="?act=add-reviews" method="POST">
                    <!-- Input ẩn -->
                    <input type="hidden" id="comic_id" name="comic_id" value="<?=$order['id']?>">
                    <input type="hidden" id="user_id" name="user_id" value="<?= $_SESSION['user_id'] ?>">

                    <!-- Đánh giá sao -->
                    <label for="rating">Chọn Đánh Giá:</label>
                    <div class="rating">
                      <input type="radio" id="star5" name="rating" value="excellent">
                      <label for="star5" title="Xuất sắc">&#9733;</label>

                      <input type="radio" id="star4" name="rating" value="good">
                      <label for="star4" title="Tốt">&#9733;</label>

                      <input type="radio" id="star3" name="rating" value="average">
                      <label for="star3" title="Bình thường">&#9733;</label>

                      <input type="radio" id="star2" name="rating" value="bad">
                      <label for="star2" title="Tệ">&#9733;</label>

                      <input type="radio" id="star1" name="rating" value="very_bad">
                      <label for="star1" title="Rất tệ">&#9733;</label>
                    </div>

                    <!-- Nội dung đánh giá -->
                    <label for="review_text">Nội dung đánh giá:</label>
                    <textarea id="review_text" name="review_text" placeholder="Nhập đánh giá của bạn..." required></textarea>

                    <!-- Nút gửi -->
                    <div class="form-actions">
                        <button type="button" onclick="toggleForm()">Hủy</button>
                        <button type="submit">Gửi đánh giá</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php elseif ($hasReviewed): ?>
    <p>Bạn đã đánh giá sản phẩm này.</p>
<?php endif; ?>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
</div>


    <!-- Đã hủy -->
    <div class="tab-pane fade" id="canceled-orders">
      <?php foreach ($orders_items as $order): ?>
        <?php if ($_SESSION['user_id'] == $order['user_id'] && $order['shipping_status'] === 'cancelled'): ?>
          <div class="order-card">
            <img src="<?= htmlspecialchars($order['image']) ?>" alt="Product Image" class="order-image">
            <div class="order-info">
              <p class="order-title"><?= htmlspecialchars($order['title']) ?></p>
              <p class="order-status">
                Trạng thái: <span class="text-danger">Đã hủy</span>
              </p>
              <p class="order-quantity">Số lượng: <?= htmlspecialchars($order['quantity']) ?></p>
            </div>
            <button class="btn btn-outline-primary btn-sm order-btn">Xem chi tiết</button>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <!-- Trả hàng/hoàn tiền -->
    <div class="tab-pane fade" id="refund-orders">
      <?php foreach ($orders_items as $order): ?>
        <?php if ($_SESSION['user_id'] == $order['user_id'] && $order['shipping_status'] === 'return'): ?>
          <div class="order-card">
            <img src="<?= htmlspecialchars($order['image']) ?>" alt="Product Image" class="order-image">
            <div class="order-info">
              <p class="order-title"><?= htmlspecialchars($order['title']) ?></p>
              <p class="order-status">
                Trạng thái: <span class="text-warning">Trả hàng/hoàn tiền</span>
              </p>
              <p class="order-quantity">Số lượng: <?= htmlspecialchars($order['quantity']) ?></p>
            </div>
            <button class="btn btn-outline-primary btn-sm order-btn">Xem chi tiết</button>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>


        <!-- Change Password Section -->
       
        
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    function showSection(sectionId) {
      const sections = document.querySelectorAll('.col-md-9 > section');
      sections.forEach(section => {
        if (section.id === sectionId) {
          section.classList.remove('hidden'); // Hiển thị phần được chọn
        } else {
          section.classList.add('hidden'); // Ẩn các phần khác
        }
      });
    }

    // Mặc định hiển thị "Đơn hàng của tôi"
    showSection('orders');
   
  </script>
  <script>
   function toggleForm() {
        const overlay = document.getElementById('reviewOverlay');
        overlay.style.display = overlay.style.display === 'none' ? 'flex' : 'none';
    }
</script>
</body>

</html>