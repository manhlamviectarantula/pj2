<style>
    footer {
        background: linear-gradient(rgba(7, 6, 29, 0.699), rgba(7, 6, 29, 0.699)), url(./images/pattern1.png) center repeat;
        padding: 90px 0;
        z-index: 1;
        position: relative;
    }

    footer::after {
        content: '';
        display: block;
        width: 100%;
        height: .5px;
        background-color: #F9C560;
        position: absolute;
        top: 0;
        left: 0;
    }

    .payment-options ul li {
        display: inline-block;
        margin-right: 8px;
    }

    footer h5 {
        color: #fff;
        font-family: "Source Sans Pro", sans-serif;
        margin-bottom: 15px;
    }

    .footer-logo-block img {
        display: block;
        margin-bottom: 15px;
    }

    footer p,
    footer,
    footer span {
        font-weight: 300;
        color: #9c9da5;
    }

    .address h5 a {
        color: #5c4ac7;
        font-size: 26px;
        font-family: "Give You Glory", cursive;
        margin-left: 20px;
        font-weight: 600;
    }

    .address h5 a:hover {
        color: #fff;
    }

    .popular-locations ul li {
        display: inline-block;
        width: 49%;
    }

    ul {
        padding: 0;
    }

    footer ul li {
        margin-bottom: 6px;
    }

    footer ul li a {
        color: #9c9da5;
        transition: all 0.3s;
    }

    .how-it-works-links {
        margin-bottom: 70px;
    }

    .address p {
        margin-bottom: 35px;
    }

    footer ul li a:hover {
        color: #5c4ac7;
    }

    footer li a {
        line-height: 20px;
        display: inline-block;
    }

    .payment-options ul {
        margin-top: 10px;
        float: left;
        width: 100%;
    }

    @media (min-width: 320px) and (max-width: 768px) {
        .footer-logo-block {
            margin-bottom: 25px;
        }
    }
</style>
<footer class="footer">
    <div class="container">
        <div class="bottom-footer">
            <div class="row">
                <div class="col-xs-12 col-sm-3 payment-options color-gray">
                    <h5>Đa dạng thanh toán</h5>
                    <ul>
                        <li>
                            <a href="#"> <img src="./images/paypal.png" alt="Paypal"> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="./images/mastercard.png" alt="Mastercard"> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="./images/maestro.png" alt="Maestro"> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="./images/stripe.png" alt="Stripe"> </a>
                        </li>
                        <li>
                            <a href="#"> <img src="./images/bitcoin.png" alt="Bitcoin"> </a>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 address color-gray">
                    <h5>Trụ sở chính</h5>
                    <p>Flemington Tower, 182 Đ. Lê Đại Hành, Phường 15, Quận 11, Thành phố Hồ Chí Minh</p>
                </div>
                <div class="col-xs-12 col-sm-5 additional-info color-gray">
                    <h5>Cần trợ giúp?</h5>
                    <p>Nếu có thắc mắc thông tin về nhà hàng hay cần hỗ trợ về các vấn đề khác hãy liên hệ ngay với chúng tôi.</p>
                    <h5>Hotline:</h5>
                    <p>+0818 799 299</p>
                    <p>+028 7305 6262</p>
                </div>
            </div>
        </div>
    </div>
</footer>