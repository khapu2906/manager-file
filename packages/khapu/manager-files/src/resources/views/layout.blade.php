<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>index 3</title>
    <link rel="stylesheet" href="{{asset('khapu-filemanager/css/font-awesome.min.css')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('khapu-filemanager/css/style.css')}}" />
</head>

<body>
    <div class="head">
        <div class="container">
            <div class="head-ct">
                <div class="head-left">
                    <div class="hl-top">
                        <span class="btn-return">
                  <i class="fa fa-angle-left"></i>
                </span>
                        <div class="hlt-link">
                            <a href="#">Shared</a>
                            <span>/</span>
                            <a href="#">Projects</a>
                            <span>/</span>
                            <a href="javascript:;" class="active">Template - Project</a>
                        </div>
                        <span class="btn-star">
                  <i class="fa fa-star-o"></i>
                </span>
                    </div>
                    <div class="hl-bottom">
                        <div class="hl-item">
                            <a href="#"><i class="fa fa-upload"></i>Upload</a>
                        </div>
                        <div class="hl-item">
                            <a href="#"><i class="fa fa-plus"></i>New</a>
                            <div class="hl-submenu">
                                <a href="#">submenu-1</a>
                                <a href="#">submenu-2</a>
                                <a href="#">submenu-3</a>
                                <a href="#">submenu-4</a>
                            </div>
                            <span class="btn-down">
                                <i class="fa fa-angle-down"></i>
                            </span>
                        </div>
                        <div class="hl-item">
                            <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i>Share</a>
                            <div class="hl-submenu">
                                <a href="#">submenu-1</a>
                                <a href="#">submenu-2</a>
                                <a href="#">submenu-3</a>
                                <a href="#">submenu-4</a>
                            </div><span class="btn-down">
                                <i class="fa fa-angle-down"></i>
                            </span>
                        </div>
                        <div class="hl-item">
                            <a href="#"><i class="fa fa-download" aria-hidden="true"></i></i>Dowload</a>
                        </div>
                        <div class="hl-item">
                            <a href="#">More</a>
                            <div class="hl-submenu">
                                <a href="#">submenu-1</a>
                                <a href="#">submenu-2</a>
                                <a href="#">submenu-3</a>
                                <a href="#">submenu-4</a>
                            </div><span class="btn-down">
                                <i class="fa fa-angle-down"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="head-right">
                    <form action="" role="search" class="search-top">
                        <div class="form-group">
                            <input type="text" placeholder="Search for files" />
                            <button><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="grid-content">
        @yield('content');
    </div>
    <div class="popup popup-image">
        <div class="content">
            <img src="{{asset('khapu-filemanager/images/img1.jpg')}}" alt="">
        </div>
        <div class="close-popup">
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>
        <div class="bg-black">

        </div>
    </div>
</body>
<script src="{{asset('khapu-filemanager/js/jquery.min.js')}}"></script>
<script src="{{asset('khapu-filemanager/js/main.js')}}"></script>

</html>