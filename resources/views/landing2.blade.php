<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalCoin - Buy Now Or Never</title>
    <link rel="stylesheet" href="/v2/assets/libs/OwlCarousel-2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/v2/dist/css/iconfont/tabler-icons.css">
    <link rel="stylesheet" href="/v2/dist/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="icon" href="/img/royalcoin.png">


</head>

<body>

    <header class="main-header position-fixed w-100">
        <div class="container">
            <nav class="navbar navbar-expand-xl py-0">
                <div class="logo">
                    <a class="navbar-brand py-0 me-0" href="#"><img src="/img/royalcoins-label.png" width="180"
                            alt=""></a>
                </div>
                <a class="d-inline-block d-lg-block d-xl-none d-xxl-none  nav-toggler text-decoration-none"
                    data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="ti ti-menu-2 text-warning"></i>
                </a>
            </nav>
        </div>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <div class="logo">
                    <a class="navbar-brand py-0 me-0" href="#"><img src="/v2/assets/images/Creato-logo.svg"
                            alt=""></a>
                </div>
                <button type="button" class="btn-close text-reset  ms-auto" data-bs-dismiss="offcanvas"
                    aria-label="Close"><i class="ti ti-x text-warning"></i></button>
            </div>
            <div class="offcanvas-body pt-0">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" aria-current="page" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#">Pricing </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#">Elements </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#">blog </a>
                    </li>
                </ul>
                <div class="login d-block align-items-center mt-3">
                    <a class="btn btn-warning text-capitalize w-100" href="#">contact us</a>
                </div>
            </div>
        </div>
    </header>
    <!------------------------------>
    <!-- Header End  -->
    <!------------------------------>

    <!------------------------------>
    <!--- Hero Banner Start--------->
    <!------------------------------>

    <section class="hero-banner position-relative overflow-hidden">
        <div class="container">
            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true"
                data-bs-backdrop="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Error</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="errorModalBody">
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex flex-wrap align-items-center">

                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="position-relative left-hero-color">
                        <!-- Modal Structure -->

                        <h1 class="mb-0 fw-bold">
                            Royal Coins is the future of digital currency.
                        </h1>
                        <p>The coins you love.</p>
                        <a href="/RoyalCoin_Whitepaper.pdf" class="btn btn-warning btn-hover-secondery"><span
                                class="d-inline-block me-2"><i class="bi bi-cloud-download"></i></span> Download
                            Whitepaper</a>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 d-flex justify-content-center">
                    <div class=" right-hero-color">
                        <div class="card col-12">
                            <div class="card-body">
                                <h5 class="card-title text-center">Buy RoyalCoins</h5>
                                <form action="{{ route('checkout.post') }}" method="POST" class="mb-3">
                                    @csrf
                                    <p class="badge bg-warning">1 RoyalCoins = ${{ $price }}</p>
                                    <p class="badge bg-info">Use Solana wallet address</p>
                                    <hr>
                                    <!-- Pilihan Mata Uang -->
                                    <div class="mb-3 text-center">
                                        <label class="form-label">Select Currency:</label><br>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="currency"
                                                        id="currencyCRYPTO" value="crypto" checked>
                                                    <label class="form-check-label btn btn-outline-primary"
                                                        for="currencyCRYPTO">CRYPTO</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="currency"
                                                        id="currencyUSD" value="usd">
                                                    <label class="form-check-label btn btn-outline-primary"
                                                        for="currencyUSD">USD</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="currency"
                                                        id="currencyEUR" value="eur">
                                                    <label class="form-check-label btn btn-outline-primary"
                                                        for="currencyEUR">EUR</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-white"><i class="bi bi-wallet2"></i></span>
                                        <input type="text" class="form-control" id="wallet" name="wallet"
                                            placeholder="Receive Address" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-white"><i
                                                class="bi bi-currency-dollar"></i></span>
                                        <input type="text" class="form-control" id="amount" name="usdAmount"
                                            placeholder="Amount in USD/EUR" onkeyup="checkMaxValueAndConvert()"
                                            required>
                                    </div>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-white"><img src="/img/royalcoin.png"
                                                width="20" alt=""></span>
                                        <input type="text" class="form-control bg-white" id="royalCoinAmount"
                                            placeholder="RoyalCoins">
                                    </div>
                                    <input type="hidden" name="royalCoinAmount" id="hiddenRoyalCoinAmount"
                                        value="0">
                                    <button type="submit" class="btn btn-warning btn-block w-100">Buy <span
                                            id="royalCoinAmountDisplay">0</span> RoyalCoins</button>
                                </form>

                                <p class="mb-0">Powered by <img
                                        src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg"
                                        alt="" height="30"></p>

                                <hr>

                                Total Token : <b>1,000,000</b> <br>
                                Token Left : <b>{{ number_format($totalLeftToken, 0) }}</b>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------------------------------>
    <!--- Hero Banner End--------->
    <!------------------------------>

    <!------------------------------>
    <!--- Service sectin Start------>
    <!------------------------------>
    <section class="service position-relative overflow-hidden">
        <div class="container position-relative">
            <img src="/v2/assets/images/service/dot-shape.png" class="shape position-absolute">
            <div class="row">
                <div class="col-12"><small class="fs-7 d-block">Buy Our Token</small></div>
                <div
                    class="col-12 d-xxl-flex d-xl-flex d-lg-flex d-md-flex d-sm-block d-block align-items-center justify-content-xxl-between justify-content-xl-between justify-content-lg-between justify-content-md-between justify-content-sm-between justify-content-sm-center ">
                    <h2 class="fs-2 text-black mb-0">Our Featured Service<br> that We Provide</h2>
                    <a href="#" class="btn btn-warning btn-hover-secondery section-btn">Buy Token</a>
                </div>
            </div>
            <div class="row d-flex flex-wrap justify-content-center step-row">
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 text-center">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div
                                class="icon-round overflow-hidden rounded-circle position-relative d-flex align-items-center justify-content-center mx-auto text-center">
                                <i class="bi bi-cart text-warning position-relative"></i>
                            </div>
                            <h5 class="mb-0 fw-500">Step 1</h5>
                            <h3 class="fs-4">Buy The Token</h3>
                            <p class="fs-7 mb-0 fw-500">Prepare your wallet and funds. Input your wallet and complete
                                the transaction on the platform.</p>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 text-center">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div
                                class="icon-round overflow-hidden rounded-circle position-relative d-flex align-items-center justify-content-center mx-auto text-center">
                                <i class="bi bi-layout-text-sidebar text-warning position-relative"></i>
                            </div>
                            <h5 class="mb-0 fw-500">Step 2</h5>
                            <h3 class="fs-4">Wait For The Token Listing</h3>
                            <p class="fs-7 mb-0 fw-500">After purchase, wait for the token to be listed on exchanges.
                                Follow official updates for details.</p>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 text-center">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <div
                                class="icon-round overflow-hidden rounded-circle position-relative d-flex align-items-center justify-content-center mx-auto text-center">
                                <i class="bi bi-wallet2 text-warning position-relative"></i>
                            </div>
                            <h5 class="mb-0 fw-500">Step 3</h5>
                            <h3 class="fs-4">Get Your Token</h3>
                            <p class="fs-7 mb-0 fw-500">Once listed, you can trade your tokens on exchanges. Monitor
                                the market closely.</p>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------------------------------>
    <!--- Service sectin Start------>
    <!------------------------------>

    <!---------------------------------->
    <!--- Our Service sectin Start------>
    <!---------------------------------->
    <section class="our-service position-relative overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <img src="/img/royalcoin.png" class="img-fluid">
                </div>
                <div
                    class="col-xxl-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ps-xxl-0 ps-xl-0 ps-lg-3 ps-md-3 ps-sm-3 ps-3">
                    <small class="fs-7 d-block">Our Service</small>
                    <h2 class="fs-2 text-black mb-0">Our Featured Service that We Provide</h2>
                    <p class="mb-0 fw-500 fs-7">
                        RoyalCoin offers a secure and user-friendly wallet service that allows users to store, send, and
                        receive RLC tokens. The wallet is compatible with major Solana wallets, including Phantom and
                        Sollet, providing seamless integration and easy management of assets.
                    </p>
                    <ul class="list-unstyled mb-0 pl-0">
                        <li class="d-flex flex-wrap align-items-start">
                            <i class="ti ti-circle-check fs-4 pe-2"></i>
                            <span class="fs-7 text-black">Seamless integration with Solana blockchain.</span>
                        </li>
                        <li class="d-flex flex-wrap align-items-start">
                            <i class="ti ti-circle-check fs-4 pe-2"></i>
                            <span class="fs-7 text-black">Real-time transaction processing and confirmations.</span>
                        </li>
                        <li class="d-flex flex-wrap align-items-start">
                            <i class="ti ti-circle-check fs-4 pe-2"></i>
                            <span class="fs-7 text-black">Secure storage solutions with multi-signature support.</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </section>
    <!------------------------------>
    <!--- Our Service sectin End---->
    <!------------------------------>
    <!------------------------------>
    <!-- Pricing section Start------>
    <!------------------------------>
    <section class="pricing position-relative overflow-hidden">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                    <small class="fs-7 d-block">Pricing Plan</small>
                    <h2 class="fs-3 pricing-head text-black mb-0 position-relative">What’s About Our Pricing
                        Token</h2>
                </div>
            </div>
            <div class="row justify-content-center price-plan">
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card position-relative shadow border-0 h-100">
                        <div class="position-absolute badge bg-warning d-inline-block mx-auto">
                            Most Popular
                        </div>
                        <div class="card-body pb-4">
                            <small class="fs-7 d-block text-warning text-center">Presale 1</small>
                            <h2 class="mb-4 text-center position-relative"><sub
                                    class="fs-2 text-black">5,000</sub><sup class="fs-6 position-absolute">$</sup>
                            </h2>
                            <small class="fs-7 d-block text-center">Early Access</small>
                            <p class="fs-7 text-center fw-500">Early access with exclusive rates for initial investors.

                            </p>
                        </div>
                        <div class="card-action text-center pb-xxl-5 pb-xl-5 pb-lg-5 pb-md-4 pb-sm-4 pb-4">
                            <a href="#" class="btn btn-warning btn-hover-secondery text-capitalize">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card position-relative shadow border-0 h-100">

                        <div class="card-body pb-4">
                            <small class="fs-7 d-block text-warning text-center">Presale 2</small>
                            <h2 class="mb-4 text-center position-relative"><sub
                                    class="fs-2 text-black">50,000</sub><sup class="fs-6 position-absolute">$</sup>
                            </h2>
                            <small class="fs-7 d-block text-center">Growth Phase
                            </small>
                            <p class="fs-7 text-center fw-500">Expanded allocation for broader participation.

                            </p>
                        </div>
                        <div class="card-action text-center pb-xxl-5 pb-xl-5 pb-lg-5 pb-md-4 pb-sm-4 pb-4">
                            <a href="#" class="btn btn-secondary btn-hover-secondery text-capitalize disabled"
                                disabled>Buy
                                Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card position-relative shadow border-0 h-100">
                        <div class="card-body pb-4">
                            <small class="fs-7 d-block text-warning text-center">Presale 3</small>
                            <h2 class="mb-4 text-center position-relative"><sub
                                    class="fs-2 text-black">500,000</sub><sup class="fs-6 position-absolute">$</sup>
                            </h2>
                            <small class="fs-7 d-block text-center">Final Opportunity</small>
                            <p class="fs-7 text-center fw-500">Final presale phase with substantial investment
                                opportunity.

                            </p>

                        </div>
                        <div class="card-action text-center pb-xxl-5 pb-xl-5 pb-lg-5 pb-md-4 pb-sm-4 pb-4">
                            <a href="#" class="btn btn-secondary btn-hover-secondery text-capitalize disabled"
                                disabled>Buy
                                Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------------------------------>
    <!-- Pricing section End-------->
    <!------------------------------>

    <!------------------------------>
    <!------ FAQ section Start------>
    <!------------------------------>
    <section class="faq position-relative overflow-hidden">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <small class="fs-7 d-block">Frequently Asked Questions</small>
                    <h2 class="fs-3 text-black mb-0">Want to ask something from us?</h2>
                </div>
            </div>
            <div class="accordion-block">
                <div class="accordion row" id="accordionPanelsStayOpenExample">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button text-black fs-7" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne"
                                    aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    What is RoyalCoin backed by?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body fs-7 fw-500 pt-0">
                                    RoyalCoin is backed by real-world assets, including Carbon Credits and gold,
                                    providing intrinsic value and stability to the token.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed text-black fs-7" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    How can I participate in the presale?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body fs-7 fw-500 pt-0">
                                    You can participate in the RoyalCoin presale by registering on our platform and
                                    following the steps to purchase tokens during the presale stages.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button collapsed text-black fs-7" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    What are the benefits of holding RoyalCoin?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body fs-7 fw-500 pt-0">
                                    Holding RoyalCoin provides access to staking rewards, potential price appreciation,
                                    and the ability to participate in the governance of the RoyalCoin network.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                <button class="accordion-button collapsed text-black fs-7" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                    On which exchanges will RoyalCoin be listed?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingFour">
                                <div class="accordion-body fs-7 fw-500 pt-0">
                                    RoyalCoin will initially be listed on major decentralized exchanges (DEXs) on the
                                    Solana network. Plans for centralized exchange (CEX) listings will be announced
                                    post-launch.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                                <button class="accordion-button collapsed text-black fs-7" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                    How is RoyalCoin different from other cryptocurrencies?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingFive">
                                <div class="accordion-body fs-7 fw-500 pt-0">
                                    RoyalCoin is distinct due to its backing by Carbon Credits and gold, as well as its
                                    integration with the high-speed Solana blockchain, ensuring low fees and fast
                                    transactions.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                                <button class="accordion-button collapsed text-black fs-7" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix"
                                    aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                                    What is the total supply of RoyalCoin?
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingSix">
                                <div class="accordion-body fs-7 fw-500 pt-0">
                                    The total supply of RoyalCoin is capped at 1,000,000 tokens, ensuring scarcity and
                                    value appreciation as adoption grows.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------------------------------>
    <!------ FAQ section End------>
    <!------------------------------>

    <!------------------------------>
    <!-----Contact section Start---->
    <!------------------------------>
    <section class="contact bg-primary position-relative overflow-hidden">
        <div class="container position-relative">
            <div class="row">
                <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                    <small class="fs-7 d-block text-warning">Buy Token Now</small>
                    <h2 class="fs-3 text-white mb-0">Ready to take the oppurtunity?</h2>
                </div>
                <div class="card col-6" id="buy-royalcoins-card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Buy RoyalCoins</h5>
                        <form action="{{ route('checkout.post') }}" method="POST" class="mb-3">
                            @csrf
                            <p class="badge bg-warning">1 RoyalCoins = ${{ $price }}</p>
                            <p class="badge bg-info">Use Solana wallet address</p>

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white"><i class="bi bi-wallet2"></i></span>
                                <input type="text" class="form-control" id="wallet" name="wallet"
                                    placeholder="Receive Address" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white"><i class="bi bi-currency-dollar"></i></span>
                                <input type="text" class="form-control" id="usdAmount2" name="usdAmount"
                                    placeholder="Amount in USD" onkeyup="formatAndConvertToRoyalCoins2()" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white"><img src="/img/royalcoin.png" width="20"
                                        alt=""></span>
                                <input type="text" class="form-control bg-white" id="royalCoinAmount2"
                                    placeholder="RoyalCoins" readonly>
                            </div>
                            <input type="hidden" name="royalCoinAmount" id="hiddenRoyalCoinAmount2" value="0">
                            <button type="submit" class="btn btn-warning btn-block w-100">Buy <span
                                    id="royalCoinAmountDisplay2">0</span> RoyalCoins</button>
                        </form>

                        <p class="mb-0">Powered by <img
                                src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg"
                                alt="" height="30"></p>

                        <hr>

                        Total Token : <b> 1.000.000 </b> <br>
                        Token Left : <b>{{ number_format($totalLeftToken, 0) }}
                        </b>
                    </div>
                </div>
            </div>
            {{-- <div class="trusted-companies">
                <div class="row justify-content-center">
                    <div class="col-xx-8 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                        <h3 class="fs-7 mb-0 text-white text-center">Trusted by content creators across the world
                        </h3>
                        <ul
                            class="d-flex flex-wrap align-items-center list-unstyled mb-0 pl-0 owl-carousel owl-theme trusted-logos">
                            <li class="text-center item"><a href="#"><img
                                        src="/v2/assets/images/contact/google.svg"></a></li>
                            <li class="text-center item"><a href="#"><img
                                        src="/v2/assets/images/contact/microsoft.svg"></a></li>
                            <li class="text-center item"><a href="#"><img
                                        src="/v2/assets/images/contact/amazon.svg"></a></li>
                            <li class="text-center item"><a href="#"><img
                                        src="/v2/assets/images/contact/unique.svg"></a></li>
                            <li class="text-center item"><a href="#"><img
                                        src="/v2/assets/images/contact/google.svg"></a></li>
                            <li class="text-center item"><a href="#"><img
                                        src="/v2/assets/images/contact/microsoft.svg"></a></li>
                            <li class="text-center item"><a href="#"><img
                                        src="/v2/assets/images/contact/amazon.svg"></a></li>
                            <li class="text-center item"><a href="#"><img
                                        src="/v2/assets/images/contact/unique.svg"></a></li>
                        </ul>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!------------------------------>
    <!-----Contact section End----->
    <!------------------------------>



    <script src="/v2/dist/js/jquery.min.js"></script>
    <script src="/v2/dist/js/bootstrap.min.js"></script>
    <script src="/v2/assets/libs/OwlCarousel-2/dist/owl.carousel.min.js"></script>
    <script src="/v2/dist/js/custom.js"></script>

    <script>
        const usdToRoyalCoinRate = <?php echo json_encode($price); ?>;
        let eurConversionRate = null; // Variable to hold the EUR conversion rate

        async function fetchEurConversionRate() {
            try {
                const response = await fetch('https://api.exchangerate-api.com/v4/latest/USD');
                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }
                const data = await response.json();
                eurConversionRate = data.rates.EUR; // Get EUR conversion rate
                console.log(`EUR Conversion Rate: ${eurConversionRate}`);
            } catch (error) {
                console.error('Error fetching EUR conversion rate:', error);
                eurConversionRate = 1; // Fallback rate if API fails
            }
        }

        fetchEurConversionRate();

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function checkMaxValueAndConvert() {
            const maxAmountUSDandEUR = 999999;
            const maxAmountCrypto = 90000000;
            const amountInput = document.getElementById('amount');
            let amount = parseFloat(amountInput.value.replace(/,/g, ''));

            const selectedCurrency = document.querySelector('input[name="currency"]:checked').value;

            let maxAmount = maxAmountUSDandEUR; // Default to maxAmountUSDandEUR

            if (selectedCurrency === 'crypto') {
                maxAmount = maxAmountCrypto; // Use maxAmountCrypto for crypto
            }

            if (amount > maxAmount) {
                // Set the error message in the modal
                const errorModalBody = document.getElementById('errorModalBody');
                errorModalBody.textContent =
                    `The maximum allowed amount for ${selectedCurrency.toUpperCase()} is ${formatNumber(maxAmount)}.`;

                // Show the error modal
                const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();

                // Set amount to max amount
                amount = maxAmount;
            }

            // Format the amount with commas
            amountInput.value = formatNumber(amount);

            // Call the conversion function to calculate and display RoyalCoins
            formatAndConvertToRoyalCoins();
        }

        function formatAndConvertToRoyalCoins() {
            const amountInput = document.getElementById('amount');
            let amount = parseFloat(amountInput.value.replace(/,/g, ''));

            if (isNaN(amount)) {
                amountInput.value = "";
                document.getElementById('royalCoinAmount').value = "";
                document.getElementById('hiddenRoyalCoinAmount').value = "";
                document.getElementById('royalCoinAmountDisplay').textContent = "";
                return;
            }

            const selectedCurrency = document.querySelector('input[name="currency"]:checked').value;
            let conversionRate;

            if (selectedCurrency === 'eur' && eurConversionRate !== null) {
                conversionRate = usdToRoyalCoinRate * eurConversionRate;
            } else {
                conversionRate = usdToRoyalCoinRate;
            }

            amountInput.value = formatNumber(amount);

            let royalCoinAmount = (amount / conversionRate).toFixed(4);

            document.getElementById('royalCoinAmount').value = royalCoinAmount;
            document.getElementById('hiddenRoyalCoinAmount').value = royalCoinAmount;
            document.getElementById('royalCoinAmountDisplay').textContent = royalCoinAmount;
        }

        function formatAndConvertToCurrency() {
            const royalCoinInput = document.getElementById('royalCoinAmount');
            let royalCoinAmount = parseFloat(royalCoinInput.value.replace(/,/g, ''));

            if (isNaN(royalCoinAmount)) {
                royalCoinInput.value = "";
                document.getElementById('amount').value = "";
                document.getElementById('hiddenRoyalCoinAmount').value = "";
                return;
            }

            const selectedCurrency = document.querySelector('input[name="currency"]:checked').value;
            let conversionRate;

            if (selectedCurrency === 'eur' && eurConversionRate !== null) {
                conversionRate = usdToRoyalCoinRate * eurConversionRate;
            } else {
                conversionRate = usdToRoyalCoinRate;
            }

            let amount = (royalCoinAmount * conversionRate).toFixed(2);

            document.getElementById('amount').value = formatNumber(amount);
            document.getElementById('hiddenRoyalCoinAmount').value = royalCoinAmount;
        }

        document.querySelectorAll('input[name="currency"]').forEach((radio) => {
            radio.addEventListener('change', () => {
                checkMaxValueAndConvert(); // Recalculate when currency changes
            });
        });

        document.getElementById('royalCoinAmount').addEventListener('keyup', formatAndConvertToCurrency);

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('error') || $errors->any())
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            @endif
        });
    </script>

</body>

</html>
