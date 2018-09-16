<?php
/**
 * @package    Product Module
 * @author     Dasitha Abeysinghe <dazimax@gmail.com>
 */
?>
<meta charset="UTF-8">
<title>@section('title')Admin Panel @show</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="description" content="">
<meta name="keywords" content="coco bootstrap template, coco admin, bootstrap,admin template, bootstrap admin,">
<meta name="author" content="Dasitha Abeysinghe">

<!-- Base Css Files -->
<link href="{{ URL::asset('assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/libs/bootstrap/css/bic_calendar.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/libs/fontello/css/fontello.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/libs/jquery-icheck/skins/all.css') }}" rel="stylesheet" />
<!-- Extra CSS Libraries Start -->
<link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
<!-- Extra CSS Libraries End -->
<link href="{{ URL::asset('assets/css/style-responsive.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<link rel="shortcut icon" href="{{ URL::asset('assets/img/favicon.ico') }}">

<!-- js -->
{{--<script src="{{ URL::asset('assets/libs/jquery/jquery-1.11.1.min.js') }}"></script>--}}
<script src="{{ URL::asset('assets/libs/jquery/jquery-1.12.4.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery/jquery-ui.js') }}"></script>

<!-- AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script type="text/javascript">
    var ecommerceapp = angular.module('ecommerceapp',[]);
    ecommerceapp.controller('duplicateItemsCtrl',["$scope",function($scope){
        $scope.imageItems = [{}];
        $scope.qtyItems = [{}];
        //add multiple images to product gallery
        $scope.addImage = function(){
            $scope.imageItems.push({});
        };
        //add multiple product inventory qty and prices
        $scope.addQtyPrice = function(){
            $scope.qtyItems.push({});
        };
    }]);
</script>
