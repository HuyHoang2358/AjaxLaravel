<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield("title") | Admin manager</title>
    @include("partials.adminHead")
    @yield("head")
</head>
<body class="sidebar-main-menu sidebar-main">
    @include("partials.adminLoading")
    <div class="wrapper">
        @include("partials.adminSidebar")
        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            @include("partials.adminHeader")
            <div class="container-fluid">
                @yield("content")
            </div>
            @include("partials.adminFooter")
        </div>
    </div>
    @include("partials.adminJSBody")
</body>
</html>
