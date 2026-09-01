<?php

include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
//echo '<pre>';
//print_R($_POST);
//print_R($_FILES);

if (isset($_POST['submit_vendor'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $category_id = $_POST['category_id'];
    $city_id = $_POST['city_id'];
    $name = $_POST['name'];
    $description = $_POST['descriptiion'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $mobile = $_POST['mobile'];
    $office_no = $_POST['office_no'];
    $pincode = $_POST['pincode'];
    $email = $_POST['email'];
    foreach ($_FILES as $key => $value) {
		$image=$_FILES["horoscope"]["name"];   
			$target_dir = "horoscope-list/";
			$imageFileType = pathinfo($image,PATHINFO_EXTENSION);
			$img_name=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
			$target_file = $target_dir.$img_name; 
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			 echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
			 echo "<script>window.location='horoscope.php'</script>";
			}
        if ($value['tmp_name'] != "") {
            move_uploaded_file($value['tmp_name'], '../vendors/vendor-img/' . $value['name']);
        }
    }

    $image = ($_FILES['image']['name']) ? $_FILES['image']['name'] : "";
    $image_1 = ($_FILES['image_1']['name']) ? $_FILES['image_1']['name'] : "";
    $image_2 = ($_FILES['image_2']['name']) ? $_FILES['image_2']['name'] : "";
    $image_3 = ($_FILES['image_3']['name']) ? $_FILES['image_3']['name'] : "";
    $image_4 = ($_FILES['image_4']['name']) ? $_FILES['image_4']['name'] : "";
    $image_5 = ($_FILES['image_5']['name']) ? $_FILES['image_5']['name'] : "";
    $image_6 = ($_FILES['image_6']['name']) ? $_FILES['image_6']['name'] : "";
    $image_7 = ($_FILES['image_7']['name']) ? $_FILES['image_7']['name'] : "";
    $image_8 = ($_FILES['image_8']['name']) ? $_FILES['image_8']['name'] : "";

    $strart_price = $_POST['starting_price'];
    $strart_category = $_POST['starting_category'];
    $att_name = $_POST['attribute_name'];
    $att_value = $_POST['attribute_value'];
    if ($id == "") {
        $sql1 = "insert into vendors set category_id = " . $category_id . ",name='" . $name . "',city_id=" . $city_id . ",address1='" . mysql_real_escape_string($address1) . "',
                address2='" . mysql_real_escape_string($address2) . "',pincode=" . $pincode . ",description='" . mysql_real_escape_string($description) . "',mobile_no='" . $mobile . "',
                office_no='" . $office_no . "',email='" . $email . "',starting_price='" . $strart_price . "',stating_category='" . $strart_category . "',image='" . $image . "',
                image_1='" . $image_1 . "',image_2='" . $image_2 . "',image_3='" . $image_3 . "',image_4='" . $image_4 . "',image_5='" . $image_5 . "',image_6='" . $image_6 . "',image_7='" . $image_7 . "',image_8='" . $image_8 . "'   ";
    } else {
        $sql1 = "update vendors set category_id = " . $category_id . ",name='" . $name . "',city_id=" . $city_id . ",address1='" . mysql_real_escape_string($address1) . "',
                address2='" . mysql_real_escape_string($address2) . "',pincode=" . $pincode . ",description='" . mysql_real_escape_string($description) . "',mobile_no='" . $mobile . "',
                office_no='" . $office_no . "',email='" . $email . "',starting_price='" . $strart_price . "',stating_category='" . $strart_category . "'";

        if ($image != "") {
            $sql1.=",image='" . $image . "'";
        }
        if ($image_1 != "") {
            $sql1.=",image_1='" . $image_1 . "'";
        }
        if ($image_2 != "") {
            $sql1.=",image_2='" . $image_2 . "'";
        }
        if ($image_3 != "") {
            $sql1.=",image_3='" . $image_3 . "'";
        }
        if ($image_4 != "") {
            $sql1.=",image_4='" . $image_4 . "'";
        }
        if ($image_5 != "") {
            $sql1.=",image_5='" . $image_5 . "'";
        }
        if ($image_6 != "") {
            $sql1.=",image_6='" . $image_6 . "'";
        }
        if ($image_6 != "") {
            $sql1.=",image_6='" . $image_7 . "'";
        }
        if ($image_7 != "") {
            $sql1.=",image_7='" . $image_7 . "'";
        }
        if ($image_8 != "") {
            $sql1.=",image_8='" . $image_8 . "'";
        }
        $sql1 .= " where id=$id";
    }
    //echo $sql1;exit;
    $rs = $DatabaseCo->dbLink->query($sql1);
    $vendor_table = mysqli_fetch_object($DatabaseCo->dbLink->query("select * from vendors where email = '" . $email . "' "));
    foreach ($att_name as $att_id => $attribute) {
        $check_attribute = $DatabaseCo->dbLink->query("select * from vendor_specification where vendor_id = '" . $vendor_table->id . "' and attribute_id = $att_id ");
        if (mysqli_num_rows($check_attribute) == 0) {
            $sql2 = 'insert into vendor_specification set ';
            $sql2.= "vendor_id = $vendor_table->id, attribute_id = $att_id, attribute_name = '$attribute', attribute_value = '$att_value[$att_id]'";
        } else {
            $sql2 = 'update vendor_specification set ';
            $sql2.= "attribute_name = '$attribute', attribute_value = '$att_value[$att_id]' where vendor_id = $id and attribute_id = $att_id";
        }
        $rs1 = $DatabaseCo->dbLink->query($sql2);
    }

    if ($rs && $rs1) {
        if ($id == "") {
            $_SESSION['vendor']['msg'] = 'Vendor Successfully added';
        } else {
            $_SESSION['vendor']['msg'] = 'Vendor Successfully edited';
        }
        $_SESSION['vendor']['status'] = 'success';
        header('location:all-vendor.php');
    } else {
        $_SESSION['vendor']['status'] = 'danger';
        $_SESSION['vendor']['msg'] = 'something went wrong';
        header('location:all-vendor.php');
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $vendor_id = $_GET['id'];
    $sql = "delete from vendors where id = " . $vendor_id . "";
    $sql2 = "delete from vendor_specification where vendor_id = " . $vendor_id . " ";
    $DatabaseCo->dbLink->query($sql2);
    $rs = $DatabaseCo->dbLink->query($sql);
    if ($rs) {
        $_SESSION['vendor']['status'] = 'success';
        $_SESSION['vendor']['msg'] = 'Vendor successfully deleted';
        header('location:all-vendor.php');
    } else {
        $_SESSION['vendor']['status'] = 'danger';
        $_SESSION['vendor']['msg'] = 'something went wrong';
        header('location:all-vendor.php');
    }
}

if (isset($_POST['addmore'])) {
    $addmore = $_POST['addmore'];
    $html = '<h4>Vendor Specification ' . $addmore . '</h4>';
    $html.= '<div class="row">';
    $html.= '<div class="col-md-6">';
    $html.= '<div class="form-group">';
    $html.= '<label class="control-label">';
    $html.= 'Vendor Specification Title';
    $html.= '</label>';
    $html.= '<input name="attribute_name[]" data-validetta="required" type="text" class="form-control">';
    $html.= '</div>';
    $html.= '</div>';
    $html.= '<div class="col-md-6">';
    $html.= '<div class="form-group">';
    $html.= '<label class="control-label">';
    $html.= 'Vendor Specification Description';
    $html.= '</label>';
    $html.= '<input type="text" name="attribute_value[]" data-validetta="required" class="form-control">';
    $html.= '</div></div></div>';
    echo $html;
}
?>