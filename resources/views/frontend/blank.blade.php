<!DOCTYPE html>
<html>

<head>
    <title>Blank</title>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/frontend-fab.png') }}" />

     @include('frontend.includes.header-links')

</head>

<body>

    <!-- <div id="loader"></div> -->

    <div class="main_div">

        <!-- header -->
         @include('frontend.includes.header')
        <!-- /header -->

        <!-- main content -->
        <div class="main_content">
            <h1 class="my-5 text-center py-5" style="color: #bdbdbd;">
                This is a blank page.
            </h1>
        </div>
        <!-- /main content -->

        <!-- footer -->
         @include('frontend.includes.footer')
        <!-- /footer -->

    </div>

     @include('frontend.includes.footer-links')

</body>

</html>

