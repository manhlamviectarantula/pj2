<?php
if (!empty($_GET["action"])) {
	$productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
	$quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';

	switch ($_GET["action"]) {

		case "add":
			if (!empty($quantity)) {

				$stmt = $db->prepare("SELECT * FROM dishes INNER JOIN restaurants on dishes.rs_id = restaurants.rs_id where d_id= ?"); // Chuẩn bị một câu lệnh SQL để truy vấn trong Cơ sở dữ liệu. Đoạn mã này truy vấn thông tin về một món ăn với d_id tương ứng.
				$stmt->bind_param('i', $productId); //Gắn giá trị cho tham số trong câu lệnh truy vấn. Ở đây, giá trị của $productId được gắn vào câu truy vấn để lấy thông tin chi tiết về món ăn.
				$stmt->execute(); // Thực thi câu lệnh truy vấn.

				$productDetails = $stmt->get_result()->fetch_object(); //Lấy kết quả của câu lệnh truy vấn và chuyển đổi thành một đối tượng (object) chứa thông tin về món ăn.
				
				$itemArray = array( //Tạo một mảng $itemArray chứa thông tin về món ăn, bao gồm d_name, d_id, quantity, và price.
					$productDetails->d_id => array( //d_id là khóa của mảng chính, có giá trị là d_id của sản phẩm.
						'res_name'    => $productDetails->res_name,
						'd_name'   => $productDetails->d_name, //d_name là tên của sản phẩm, được lấy từ thuộc tính $productDetails->d_name.
						'd_id'     => $productDetails->d_id, //d_id là id của sản phẩm, đã được sử dụng làm khóa của mảng chính.
						'quantity' => $quantity, //quantity là số lượng sản phẩm, có giá trị là $quantity (số lượng này được truyền vào từ người dùng hoặc từ một nguồn khác).
						'price'    => $productDetails->price //price là giá của sản phẩm, được lấy từ thuộc tính $productDetails->price 
					)
				);

				if (!empty($_SESSION["cart_item"])) { //Kiểm tra xem giỏ hàng trong phiên làm việc ($_SESSION["cart_item"]) có chứa các sản phẩm hay không.
					if (in_array($productDetails->d_id, array_keys($_SESSION["cart_item"]))) { //Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay không bằng cách so sánh d_id của sản phẩm với các khóa của mảng giỏ hàng.
						foreach ($_SESSION["cart_item"] as $k => $v) { //Trong trường hợp sản phẩm đã tồn tại, mã lặp qua từng sản phẩm trong giỏ hàng và cập nhật số lượng của sản phẩm tương ứng.
							if ($productDetails->d_id == $k) {
								if (empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $quantity;
							}
						}
					} else {
						$_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray; //Trong trường hợp sản phẩm chưa tồn tại, sản phẩm mới được thêm vào giỏ hàng.
					}
				} else {
					$_SESSION["cart_item"] = $itemArray; //Nếu giỏ hàng không có sản phẩm nào, thì sản phẩm mới được thêm vào giỏ hàng.
				}
			}
			break;

		case "remove":
			if (!empty($_SESSION["cart_item"])) {
				foreach ($_SESSION["cart_item"] as $k => $v) {
					if ($productId == $v['d_id'])
						unset($_SESSION["cart_item"][$k]);
				}
			}
			break;

		// case "empty":
		// 	unset($_SESSION["cart_item"]);
		// 	break;

		case "check":
			header("location:checkout.php");
			break;
	}
}
