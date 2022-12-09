<?php
    include "./core/process.php";
    if(checkLogin()){
      if(checkAdmin()) {
        header('Location: admin/home');
      }
      else {
        include "include/header.php";   
      }
           
    }
    else{
      include "include/header_notlogin.php";
    }

?>
<link rel="stylesheet" href="./assets/css/common.css">
<div class="container padding-top">
    <h2 class="title">Contact</h2>
    <div class="row contact">
      <div class="col-md-3 contact-card">
          <a href="https://www.facebook.com/anhkhoa.ngo1704/"><img style="border-radius: 50%; width: 80%" src="https://scontent.fsgn5-8.fna.fbcdn.net/v/t1.6435-9/96949143_1272860759576198_6761997971111280640_n.jpg?_nc_cat=103&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=tCmoNJddceIAX-QXIPf&tn=HUy4RpLVWeZ3FFMa&_nc_ht=scontent.fsgn5-8.fna&oh=a237abf4cba8e3ebcfa03b307940d988&oe=61C40F35" alt="img-khoa"></a>
        <div class="title-card-contact small-letter">
          Khoa Ngo
        </div>
        <div class="des-card-contact">
            Finance Manager
        </div>
      </div>
      <div class="col-md-3 contact-card">
      <a href="https://www.facebook.com/profile.php?id=100009602137301"><img style="border-radius: 50%; width: 80%" src="https://scontent.fsgn5-8.fna.fbcdn.net/v/t1.6435-9/50434605_2179557445707639_6824014949518409728_n.jpg?_nc_cat=103&ccb=1-5&_nc_sid=174925&_nc_ohc=7xHCEihwFRMAX_BvH3A&_nc_ht=scontent.fsgn5-8.fna&oh=67a0e5657e4f07b43bb87784ba122977&oe=61C35C45" alt="img-khoa"></a>
        <div class="title-card-contact small-letter">
          Khoa Tran
        </div>
        <div class="des-card-contact">
            Marketing Manager
        </div>
      </div>
      <div class="col-md-3 contact-card">
      <a href="https://www.facebook.com/khangmin0812"><img style="border-radius: 50%; width: 80%" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/p206x206/256387596_631983037836192_2415708734992561212_n.jpg?_nc_cat=104&ccb=1-5&_nc_sid=aee45a&_nc_ohc=__FTJ-ZebVIAX9mlCa9&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=40a9d9d31a71da43707c00da923c9db7&oe=61C25476" alt="img-khang"></a>
        <div class="title-card-contact small-letter">
            Khang Nguyen
        </div>
        <div class="des-card-contact">
            Leasing Manager
        </div>
      </div>
      <div class="col-md-3 contact-card">
      <a href="https://www.facebook.com/michael.pham.1401933"><img style="border-radius: 50%; width: 80%" src="https://scontent.fsgn5-10.fna.fbcdn.net/v/t1.18169-9/27858226_2002217240039299_3532918632429742634_n.jpg?_nc_cat=110&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=QV2f4LPu9JMAX9dpqCI&_nc_ht=scontent.fsgn5-10.fna&oh=d2dfed0150b0c587cad5a72fa052fe5b&oe=61C0E57C" alt="img-khang"></a>
        <div class="title-card-contact small-letter">
            Khang Pham
        </div>
        <div class="des-card-contact">
            Operation Manager
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
        <div class="col-md-12 text-center mb-5 site-animate">
        </div>
        <div class="col-md-7 mb-5 site-animate">
                <!-- <div class="form-group">
                    <label for="name" class="sr-only">Name</label>
                    <input  type="text" class="form-control" id="name" placeholder="Tên">
                </div>
                <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Email">
                </div> -->
              <?php if(checkLogin()) { ?>
              <div id="form-message">
                  <div class="rate-title">Message:</div>
                <div class="form-group">
                    <label for="message" class="sr-only">Feedback</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control"
                              placeholder="Please write your feedback here..."></textarea>
                    
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-lg" id="send-message">Send message</button>
                </div>
              </div>
              <div class="thankyou" id="thankyou">Thank you for you message!</div>
              <?php } ?>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4 site-animate">
            <!-- <p><img src="~/Assets/img/hcmut.jpg" alt="" class="img-fluid"></p> -->
            <p class="text-black">
                <strong>Address:</strong> <br> University of Technology <br> National University <br> Ho Chi Minh city, Viet Nam <br> <br>
                <strong>Phone:</strong> <br> +84 123456789 <br> <br>
                <a class="link coming-soon">
                  <i class="fa fa-facebook social"></i>
                </a>
                <a class="link coming-soon">
                  <i class="fa fa-youtube social"></i>
                </a>
                <a class="link coming-soon">
                  <i class="fa fa-instagram social"></i>
                </a>
            </p>
        </div>
    </div>
    <!-- <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d979.8789509643088!2d106.70414382923056!3d10.771750416994221!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f4156ae62ad%3A0x411a671f3794c4fd!2sSamsung%20Vietnam!5e0!3m2!1svi!2s!4v1620196991103!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
    <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7836.210796326625!2d106.802477073545!3d10.879587622914032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d8a5568c997f%3A0xdeac05f17a166e0c!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBraG9hIC0gxJBIUUcgVFAuSENN!5e0!3m2!1svi!2s!4v1637595812915!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
  </div>


<script src="assets/js/product.js"></script>

<script>
    $(".coming-soon").click(() => {
        alert("Coming soon !");
    })
</script>

<?php
    include 'include/footer.php';
?>